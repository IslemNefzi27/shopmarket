@extends('layouts.app')
@section('title', 'Mes produits')
@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-2xl font-bold text-gray-900">
            <i class="fas fa-box text-indigo-600 mr-2"></i> Mes Produits
        </h1>
        <a href="{{ route('products.create') }}"
            class="inline-flex items-center gap-2 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition text-sm font-medium">
            <i class="fas fa-plus"></i> Ajouter un produit
        </a>
    </div>

    @if($products->isEmpty())
        <div class="text-center py-20 bg-white rounded-2xl shadow-sm">
            <i class="fas fa-box-open text-6xl text-gray-200 mb-6"></i>
            <h3 class="text-xl font-semibold text-gray-500 mb-2">Vous n'avez pas encore de produits</h3>
            <p class="text-gray-400 mb-6">Commencez à vendre en ajoutant votre premier produit.</p>
            <a href="{{ route('products.create') }}"
                class="bg-indigo-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-indigo-700 transition">
                <i class="fas fa-plus mr-1"></i> Ajouter un produit
            </a>
        </div>
    @else
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-6 py-3">Produit</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-4 py-3">Catégorie</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-4 py-3">Prix</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-4 py-3">Stock</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-4 py-3">Statut</th>
                        <th class="text-right text-xs font-semibold text-gray-500 uppercase tracking-wide px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($products as $product)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-lg bg-gray-100 overflow-hidden flex-shrink-0">
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}"
                                                class="w-full h-full object-cover" alt="{{ $product->title }}">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <a href="{{ route('products.show', $product) }}"
                                            class="font-semibold text-gray-800 hover:text-indigo-600 text-sm block">
                                            {{ Str::limit($product->title, 40) }}
                                        </a>
                                        <p class="text-xs text-gray-400">{{ $product->created_at->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-600">{{ $product->category->name }}</td>
                            <td class="px-4 py-4 text-sm font-bold text-indigo-600">
                                {{ number_format($product->price, 2, ',', ' ') }} TND
                            </td>
                            <td class="px-4 py-4 text-sm {{ $product->stock === 0 ? 'text-red-500 font-semibold' : 'text-gray-600' }}">
                                {{ $product->stock }}
                            </td>
                            <td class="px-4 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $product->is_active ? 'Actif' : 'Inactif' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('products.edit', $product) }}"
                                        class="text-blue-500 hover:text-blue-700 text-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST"
                                        onsubmit="return confirm('Supprimer ce produit définitivement ?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-600 text-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $products->links() }}</div>
    @endif
</div>
@endsection
