<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
    'name' => 'required|string|max:255',
    'quantity' => 'required|integer|min:0',
    'description' => 'nullable|string',
    'expiration_date' => 'nullable|date',
    'status' => 'required|in:available,unavailable',
    'price' => 'required|numeric|min:0',
]);



        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }
    public function adjustQuantity(Product $product, $action)
{
    if ($action === 'increase') {
        $product->increaseQuantity();
    } elseif ($action === 'decrease') {
        $product->decreaseQuantity();
    }

    if (request()->ajax()) {
        return response()->json(['quantity' => $product->quantity]);
    }

    return redirect()->route('products.show', $product)
                     ->with('success', 'Product quantity updated.');
}
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
    'name' => 'required|string|max:255',
    'quantity' => 'required|integer|min:0',
    'description' => 'nullable|string',
    'expiration_date' => 'nullable|date',
    'status' => 'required|in:available,unavailable',
    'price' => 'required|numeric|min:0',
]);



        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted.');
    }

       public function addTags(Request $request, Product $product)
{
    $tags = $request->input('tags', []);

    if (!is_array($tags) || count($tags) === 0) {
        return response()->json(['error' => 'At least one tag is required.'], 400);
    }

    foreach ($tags as $tagNameOrId) {
        if (is_numeric($tagNameOrId)) {
            $tag = Tag::find($tagNameOrId);
        } else {
            $tag = Tag::firstOrCreate(['name' => $tagNameOrId]);
        }

        if ($tag && !$product->tags->contains($tag)) {
            $product->tags()->attach($tag);
        }
    }

    return response()->json(['success' => true]);
}

public function removeTag(Product $product, $tagId)
{
    $tag = Tag::findOrFail($tagId);
    if ($product->tags->contains($tag)) {
        $product->tags()->detach($tag);
    }
    return response()->json(['success' => true]);
}




}

