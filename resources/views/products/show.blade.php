<!-- resources/views/products/show.blade.php -->
<x-layout :title="$product->name">
    <h1 class="text-2xl font-bold mb-2">{{ $product->name }}</h1>
    <p class="mb-2">{{ $product->description }}</p>
    <p class="font-semibold mb-4">Price: {{ $product->price }} €</p>
    <p class="font-semibold mb-4">Quantity: {{ $product->quantity }}</p>

    <!-- Palielināt un samazināt quantity -->
    <div class="mb-4">
        <a href="{{ route('products.adjust', ['product' => $product, 'action' => 'increase']) }}"
           class="text-green-600">Increase Quantity</a> |
        <a href="{{ route('products.adjust', ['product' => $product, 'action' => 'decrease']) }}"
           class="text-red-600">Decrease Quantity</a>
    </div>

    <a href="{{ route('products.edit', $product) }}" class="text-blue-600">Edit</a> |
    <a href="{{ route('products.index') }}" class="text-gray-600">Back</a>
</x-layout>
