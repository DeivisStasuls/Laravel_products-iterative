<x-layout title="Products">
    <h1 class="text-2xl font-bold mb-4">Product List</h1>

    <a href="{{ route('products.create') }}" class="text-blue-600 underline mb-3 inline-block">
        Create New Product
    </a>

    @if(session('success'))
        <p class="text-green-600 mb-3">{{ session('success') }}</p>
    @endif

    <ul class="space-y-2">
        @foreach($products as $product)
            <li class="border-b pb-2 flex justify-between items-center">
                <div>
                    <a href="{{ route('products.show', $product) }}" class="font-semibold">
                        {{ $product->name }}
                    </a>
                    <span class="text-gray-500 ml-2">{{ $product->price }} €</span>
                </div>
                <div class="space-x-2">
                    <a href="{{ route('products.edit', $product) }}" class="text-blue-500">Edit</a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500" type="submit">Delete</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</x-layout>
