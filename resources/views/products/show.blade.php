<x-layout :title="$product->name">
    <h1 class="text-2xl font-bold mb-2">{{ $product->name }}</h1>
    <p class="mb-2">{{ $product->description }}</p>
    <p class="font-semibold mb-4">Price: {{ $product->price }} €</p>

    <a href="{{ route('products.edit', $product) }}" class="text-blue-600">Edit</a> |
    <a href="{{ route('products.index') }}" class="text-gray-600">Back</a>
</x-layout>
