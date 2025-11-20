<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'quantity', 'description', 'expiration_date', 'status', 'price'
    ];

    public function increaseQuantity()
    {
        $this->quantity++;
        $this->save();
    }

    public function decreaseQuantity()
    {
        if ($this->quantity > 0) {
            $this->quantity--;
            $this->save();
        }
    }
}
