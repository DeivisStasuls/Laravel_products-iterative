<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Masīvi, kurus var aizpildīt masveidā
    protected $fillable = [
    'name',
    'quantity',
    'description',
    'expiration_date',
    'status',
    'price',
];


    // Ja vēlies, var formatēt datumu automātiski kā Carbon objektu
    protected $dates = [
        'expiration_date',
    ];
}
