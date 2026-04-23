@extends('layouts.app')
@section('title', 'Ajouter un produit')
@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <a href="{{ route('products.my') }}" class="text-sm text-indigo-600 hover:underline">
            <i class="fas fa-arrow-left"></i> Mes produits
        </a>
        <h1 class="text-2xl font-bold text-gray-900 mt-2">Ajouter un produit</h1>
    </div>

    <div class="bg-white rounded-2xl shadow-sm p-6">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Titre du produit *</label>
                <input type="text" name="title" value="{{ old('title') }}" required
                    placeholder="Ex : Smartphone Samsung Galaxy A54"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500 @error('title') border-red-500 @enderror">
                @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Description *</label>
                <textarea name="description" rows="4" required
                    placeholder="Décrivez votre produit en détail..."
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500 resize-none @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Prix (TND) *</label>
                    <div class="relative">
                        <span class="absolute left-3 top-2.5 text-gray-400 text-sm">TND</span>
                        <input type="number" name="price" value="{{ old('price') }}" step="0.01" min="0" required
                            placeholder="0.00"
                            class="w-full pl-7 pr-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-indigo-500 @error('price') border-red-500 @enderror">
                    </div>
                    @error('price')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Stock *</label>
                    <input type="number" name="stock" value="{{ old('stock', 1) }}" min="0" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500 @error('stock') border-red-500 @enderror">
                    @error('stock')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Catégorie *</label>
                <select name="category_id" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500 @error('category_id') border-red-500 @enderror">
                    <option value="">Sélectionner une catégorie</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Image du produit</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-indigo-400 transition"
                    x-data="{ preview: null }">
                    <input type="file" name="image" accept="image/*" id="imageInput" class="hidden"
                        @change="preview = URL.createObjectURL($event.target.files[0])">
                    <template x-if="!preview">
                        <div>
                            <i class="fas fa-cloud-upload-alt text-3xl text-gray-300 mb-2"></i>
                            <p class="text-sm text-gray-500">Cliquez ou glissez une image ici</p>
                            <p class="text-xs text-gray-400 mt-1">PNG, JPG, WEBP — Max 2Mo</p>
                        </div>
                    </template>
                    <template x-if="preview">
                        <img :src="preview" class="max-h-40 mx-auto rounded-lg object-cover">
                    </template>
                    <label for="imageInput" class="mt-3 inline-block bg-gray-100 text-gray-700 px-4 py-1.5 rounded-lg text-xs cursor-pointer hover:bg-gray-200">
                        Choisir un fichier
                    </label>
                </div>
                @error('image')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                    class="flex-1 bg-indigo-600 text-white py-3 rounded-xl font-semibold hover:bg-indigo-700 transition">
                    <i class="fas fa-plus mr-1"></i> Publier le produit
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
