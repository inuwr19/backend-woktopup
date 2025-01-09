<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Order;
use App\Models\Payment;
use Midtrans\Notification;
use Midtrans\Transaction;


class PaymentController extends Controller
{
    public function createPayment(Request $request)
    {
        $order = Order::with(['user', 'product.game'])->find($request->order_id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY'); // Tambahkan server key di .env
        Config::$isProduction = false; // Ubah ke true di production
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Buat payload transaksi
        $transactionDetails = [
            'transaction_details' => [
                'order_id' => $order->id,
                'gross_amount' => $order->total_price,
            ],
            'customer_details' => [
                'first_name' => $order->user->name,
                'email' => $order->user->email,
            ],
            'item_details' => [
                [
                    'id' => $order->product_id,
                    'price' => $order->total_price,
                    'quantity' => $order->quantity,
                    'name' => $order->product->name,
                ]
            ],
        ];

        // Buat Snap Token
        $snapToken = Snap::getSnapToken($transactionDetails);

        return response()->json(['snap_token' => $snapToken]);
    }

    public function handleNotification(Request $request)
{
    try {
        $data = $request->all();
        $transactionStatus = $data['result']['transaction_status'];
        $paymentType = $data['result']['payment_type'];
        $orderId = $data['result']['order_id'];
        $fraudStatus = $data['result']['fraud_status'];
        $transactionId = $data['result']['transaction_id'];
        $grossAmount = $data['result']['gross_amount'];

        // Cari order berdasarkan ID
        $order = Order::find($orderId);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Update tabel payments
        Payment::updateOrCreate(
            ['order_id' => $orderId],
            [
                'payment_method' => $paymentType,
                'transaction_id' => $transactionId,
                'amount' => $grossAmount,
                'status' => $transactionStatus,
            ]
        );

        // Update tabel orders berdasarkan status transaksi
        if ($transactionStatus == 'capture') {
            if ($paymentType == 'credit_card' && $fraudStatus == 'challenge') {
                $order->status = 'pending';
                $order->payment_proof = 'challenged';
            } else {
                $order->status = 'paid';
                $order->payment_proof = 'confirmed';
            }
        } elseif ($transactionStatus == 'settlement') {
            $order->status = 'paid';
            $order->payment_proof = 'confirmed';
        } elseif ($transactionStatus == 'pending') {
            $order->status = 'pending';
            $order->payment_proof = 'pending';
        } elseif ($transactionStatus == 'deny') {
            $order->status = 'failed';
            $order->payment_proof = 'denied';
        } elseif ($transactionStatus == 'expire') {
            $order->status = 'failed';
            $order->payment_proof = 'expired';
        } elseif ($transactionStatus == 'cancel') {
            $order->status = 'failed';
            $order->payment_proof = 'canceled';
        }

        $order->save();

        return response()->json(['message' => 'Notification handled successfully']);
    } catch (\Exception $e) {
        Log::error('Midtrans Notification Error: ' . $e->getMessage());
        return response()->json(['message' => 'Error handling notification'], 500);
    }
}


}
