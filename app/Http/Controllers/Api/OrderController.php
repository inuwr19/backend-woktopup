<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;
use App\Models\Order;


class OrderController extends Controller
{
    // Store new order (add item to cart)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'game_account_id' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
        ]);

        // $voucher = Voucher::find($request->voucher_id);
        // if (!$voucher) {
        //     return response()->json(['error' => 'Invalid voucher ID.'], 400);
        // }

        $order = Order::create([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'game_account_id' => $request->game_account_id,
            'quantity' => $request->quantity,
            'total_price' => $request->total_price,
            'payment_method' => $request->payment_method,
            'status' => $request->status,
            'transaction_id' => $request->transaction_id,
            'voucher_id' => $request->voucher_id,
        ]);

        // $order = Order::create(array_merge($validated, [
        //     // 'payment_method' => 'pending', // Default to Midtrans
        //     // 'status' => 'pending',         // Initial status
        //     // 'payment_proof' => 'midtrans',
        //     // 'transaction_id' => $request->transaction_id,
        //     // 'voucher_id' => $request->voucher_id,
        // ]));

        return response()->json($order, 201);
    }

    public function show($id)
    {
        $order = Order::with('user','product.game','voucher')->find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        return response()->json($order);
    }

    // Get all orders for a user
    public function index(Request $request)
    {
        $orders = Order::where('user_id', $request->user()->id)->get();
        return response()->json($orders);
    }

    // Delete an order
    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status !== 'pending') {
            return response()->json(['error' => 'Cannot delete completed order'], 400);
        }

        $order->delete();
        return response()->json(['message' => 'Order deleted']);
    }

}
