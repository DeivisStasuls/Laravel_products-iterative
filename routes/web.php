<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::get('/', function () {
    return redirect()->route('products.index');
});

Route::resource('products', ProductController::class);
// routes/web.php
Route::get('/products/{product}/adjust/{action}', [ProductController::class, 'adjustQuantity'])->name('products.adjust');
    Route::post('/products/{product}/adjust/{action}', [ProductController::class, 'adjustQuantity'])
    ->name('products.adjust');
