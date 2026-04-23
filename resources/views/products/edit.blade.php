@extends('layouts.app')
@section('title', 'Modifier : ' . $product->title)
@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <a href="{{ route('products.my') }}" class="text-sm text-indigo-600 hover:underline">
            <i class="fas fa-arrow-left"></i> Mes produits
        </a>
        <h1 class="text-2xl font-bold text-gray-900 mt-2">Modifier le produit</h1>
    </div>

    <div class="bg-white rounded-2xl shadow-sm p-6">
        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf @method('PUT')

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Titre du produit *</label>
                <input type="text" name="title" value="{{ old('title', $product->title) }}" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500 @error('title') border-red-500 @enderror">
                @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Description *</label>
                <textarea name="description" rows="4" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500 resize-none @error('description') border-red-500 @enderror">{{ old('description', $product->description) }}</textarea>
                @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Prix (TND) *</label>
                    <div class="relative">
                        <span class="absolute left-3 top-2.5 text-gray-400 text-sm">€</span>
                        <input type="number" name="price" value="{{ old('price', $product->price) }}" step="0.01" min="0" required
                            class="w-full pl-7 pr-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-indigo-500 @error('price') border-red-500 @enderror">
                    </div>
                    @error('price')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Stock *</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" min="0" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500 @error('stock') border-red-500 @enderror">
                    @error('stock')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Catégorie *</label>
                <select name="category_id" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500">
                    <option value="">Sélectionner une catégorie</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}
                        class="rounded border-gray-300 text-indigo-600">
                    <span class="text-sm font-semibold text-gray-700">Produit actif (visible dans le catalogue)</span>
                </label>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Image du produit</label>
                @if($product->image)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $product->image) }}"
                            class="h-32 rounded-lg object-cover" alt="{{ $product->title }}">
                        <p class="text-xs text-gray-400 mt-1">Image actuelle — Laissez vide pour conserver cette image</p>
                    </div>
                @endif
                <input type="file" name="image" accept="image/*"
                    class="w-full text-sm text-gray-500 border border-gray-300 rounded-lg p-2 @error('image') border-red-500 @enderror">
                @error('image')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                    class="flex-1 bg-indigo-600 text-white py-3 rounded-xl font-semibold hover:bg-indigo-700 transition">
                    <i class="fas fa-save mr-1"></i> Enregistrer les modifications
                </button>
                <a href="{{ route('products.my') }}"
                    class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition text-center">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
