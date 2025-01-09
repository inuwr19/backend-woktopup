<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = ['report_date', 'total_orders', 'total_revenue', 'total_products_sold', 'top_product_id', 'top_game_id', 'status'];
}
