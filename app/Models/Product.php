<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'quantity',
        'description',
        'expiration_date',
        'status',
        'price',
    ];

    protected $dates = [
        'expiration_date',
    ];

    // Increase quantity by 1
    public function increaseQuantity()
    {
        return $this->increment('quantity');
    }

    // Decrease quantity by 1 but never below 0
    public function decreaseQuantity()
    {
        if ($this->quantity > 0) {
            return $this->decrement('quantity');
        }

        return false;
    }
}
