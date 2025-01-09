<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['game_id', 'name', 'price', 'description', 'status'];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
