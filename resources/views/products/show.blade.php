<x-layout :title="$product->name">
    <h1 class="text-2xl font-bold mb-2">{{ $product->name }}</h1>
    <p class="mb-2">{{ $product->description }}</p>
    <p class="font-semibold mb-4">Price: {{ $product->price }} €</p>
    <p class="font-semibold mb-4">Quantity: <span id="product-quantity">{{ $product->quantity }}</span></p>

    <div class="mb-4">
        <a href="{{ route('products.adjust', ['product' => $product, 'action' => 'increase']) }}"
           class="text-green-600" id="increase-btn" data-product-id="{{ $product->id }}">Increase Quantity</a> |
        <a href="{{ route('products.adjust', ['product' => $product, 'action' => 'decrease']) }}"
           class="text-red-600" id="decrease-btn" data-product-id="{{ $product->id }}">Decrease Quantity</a>
    </div>

    <a href="{{ route('products.edit', $product) }}" class="text-blue-600">Edit</a> |
    <a href="{{ route('products.index') }}" class="text-gray-600">Back</a>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/js/product-adjust.js'])

</x-layout>
