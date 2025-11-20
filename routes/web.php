<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Models\Tag;
use Illuminate\Http\Request;

// Pārvirza sākuma lapu uz produktu sarakstu
Route::get('/', function () {
    return redirect()->route('products.index');
});

// Definē visu produkta resursu ceļus (index, create, store, show, edit, update, destroy)
Route::resource('products', ProductController::class);

// Pielāgojam daudzuma palielināšanas un samazināšanas ceļus
Route::get('/products/{product}/adjust/{action}', [ProductController::class, 'adjustQuantity'])
    ->name('products.adjust');

// Šis ceļš apstrādā POST pieprasījumu, lai mainītu daudzumu
Route::post('/products/{product}/adjust/{action}', [ProductController::class, 'adjustQuantity'])
    ->name('products.adjust.post');

// Pievienot tagus produktiem
Route::post('/products/{product}/add-tags', [ProductController::class, 'addTags'])
    ->name('product.addTags');

// Noņemt tagu
Route::delete('/products/{product}/remove-tag/{tagId}', [ProductController::class, 'removeTag'])
    ->name('product.removeTag');

// Tagu meklēšana autocomplete funkcijai
Route::get('/tags/search', function (Request $request) {
    $query = $request->input('query');
    $tags = Tag::where('name', 'like', "%{$query}%")->get();
    return response()->json(['suggestions' => $tags]);
});

