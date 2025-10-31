<x-layout title="Edit Product">
    <h1 class="text-2xl font-bold mb-4">Edit Product</h1>

    <form action="{{ route('products.store') }}" method="POST">
    @csrf
    <label for="name">Nosaukums:</label>
    <input type="text" name="name" id="name" value="{{ old('name') }}" required>
    <label for="price">Price:</label>
    <input type="number" name="price" id="price" step="0.01" value="{{ old('price', $product->price ?? '') }}" required>

    <label for="quantity">Daudzums:</label>
    <input type="number" name="quantity" id="quantity" value="{{ old('quantity', 0) }}" min="0" required>

    <label for="description">Apraksts:</label>
    <textarea name="description" id="description">{{ old('description') }}</textarea>

    <label for="expiration_date">Derīguma termiņš:</label>
    <input type="date" name="expiration_date" id="expiration_date" value="{{ old('expiration_date') }}">

    <label for="status">Statuss:</label>
    <select name="status" id="status" required>
        <option value="available" {{ old('status')=='available' ? 'selected' : '' }}>Available</option>
        <option value="unavailable" {{ old('status')=='unavailable' ? 'selected' : '' }}>Unavailable</option>
    </select>

    <button type="submit">Saglabāt</button>
</form>


    <a href="{{ route('products.index') }}" class="text-gray-600 underline block mt-4">← Back</a>
</x-layout>
