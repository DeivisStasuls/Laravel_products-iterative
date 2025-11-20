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

     <div class="mt-4">
        <h3 class="text-xl font-semibold">Tags</h3>
        <form id="tags-form" data-product-id="{{ $product->id }}">
            @csrf
            <input type="text" id="autocomplete-tag" placeholder="Start typing tag name..." class="form-input mb-2" autocomplete="off">

            <div id="tag-list" class="mt-2">
                @foreach($product->tags as $tag)
                    <span class="badge badge-primary mr-1" data-tag-id="{{ $tag->id }}">
                        {{ $tag->name }}
                        <button type="button" class="remove-tag-btn text-white">X</button>
                    </span>
                @endforeach
            </div>
        </form>
    </div>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/js/product-tags.js', 'resources/js/product-adjust.js'])
</x-layout>