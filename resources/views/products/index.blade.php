@extends('layouts.app')

@section('title', 'Catalogue')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Catalogue Produits</h1>
            <p class="text-gray-500 text-sm mt-1">{{ $products->total() }} produit(s) trouvé(s)</p>
        </div>
        @auth
            <a href="{{ route('products.create') }}"
                class="inline-flex items-center gap-2 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition text-sm font-medium">
                <i class="fas fa-plus"></i> Ajouter un produit
            </a>
        @endauth
    </div>

    <div class="flex flex-col lg:flex-row gap-8">
        {{-- Sidebar Filters --}}
        <aside class="lg:w-64 flex-shrink-0">
            <form action="{{ route('products.index') }}" method="GET" id="filterForm">
                <div class="bg-white rounded-xl shadow-sm p-5 space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Recherche</label>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Mot-clé..."
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-indigo-500">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Catégorie</label>
                        <div class="space-y-2">
                            @foreach($categories as $category)
                                <label class="flex items-center justify-between cursor-pointer">
                                    <div class="flex items-center gap-2">
                                        <input type="radio" name="category" value="{{ $category->id }}"
                                            {{ request('category') == $category->id ? 'checked' : '' }}
                                            class="text-indigo-600" onchange="this.form.submit()">
                                        <span class="text-sm text-gray-700">{{ $category->name }}</span>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-lg text-sm font-medium hover:bg-indigo-700 transition">
                        Appliquer
                    </button>
                </div>
            </form>
        </aside>

        {{-- Products Grid --}}
        <div class="flex-1">
            @if($products->isEmpty())
                <div class="text-center py-16 bg-white rounded-xl shadow-sm">
                    <i class="fas fa-box-open text-5xl text-gray-300 mb-4"></i>
                    <h3 class="text-lg font-semibold text-gray-500">Aucun produit trouvé</h3>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($products as $product)
                        <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-shadow group">
                            <div class="relative overflow-hidden bg-gray-100 h-48">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" class="w-full h-full object-cover">
                                @endif
                                
                                {{-- Badge Category --}}
                                <div class="absolute top-2 left-2">
                                    <span class="bg-white/90 text-indigo-600 text-xs px-2 py-1 rounded-full font-medium">
                                        {{ $product->category->name ?? 'Général' }}
                                    </span>
                                </div>

                                {{-- زر الـ Wishlist (القلب) --}}
                                @auth
                                    <div class="absolute top-2 right-2">
                                        <form action="{{ route('wishlist.add', $product->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-white p-2 rounded-full shadow-sm text-gray-400 hover:text-red-500 transition">
                                                <i class="fas fa-heart"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endauth
                            </div>

                            <div class="p-4">
                                <h3 class="font-semibold text-gray-800 text-sm mb-1 line-clamp-2">
                                    <a href="{{ route('products.show', $product) }}" class="hover:text-indigo-600">{{ $product->title }}</a>
                                </h3>
                                <div class="flex items-center justify-between mt-3">
                                    <span class="text-xl font-bold text-indigo-600">{{ number_format($product->price, 2) }} TND</span>
                                </div>
                                <p class="text-xs text-gray-400 mt-2 mb-4">
                                    Par <span class="text-indigo-500">{{ $product->user->name ?? 'Vendeur' }}</span>
                                    · Stock : {{ $product->stock }}
                                </p>

                                @auth
                                    <div class="space-y-2">
                                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" 
                                                class="w-full flex items-center justify-center gap-2 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition text-xs font-medium">
                                                <i class="fas fa-shopping-cart"></i> Ajouter au panier
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <a href="{{ route('login') }}" 
                                        class="block text-center w-full bg-gray-100 text-gray-600 px-4 py-2 rounded-lg text-xs font-medium">
                                        Connectez-vous pour acheter
                                    </a>
                                @endauth
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-8">{{ $products->links() }}</div>
            @endif
        </div>
    </div>
</div>
@endsection