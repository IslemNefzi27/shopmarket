@extends('layouts.app')

@section('title', $product->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('home') }}" class="hover:text-indigo-600">Accueil</a>
        <i class="fas fa-chevron-right text-xs"></i>
        <a href="{{ route('products.index', ['category' => $product->category_id]) }}" class="hover:text-indigo-600">
            {{ $product->category->name }}
        </a>
        <i class="fas fa-chevron-right text-xs"></i>
        <span class="text-gray-700 font-medium">{{ Str::limit($product->title, 50) }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 mb-12">

        {{-- Image --}}
        <div class="bg-white rounded-2xl overflow-hidden shadow-sm">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}"
                    alt="{{ $product->title }}"
                    class="w-full h-96 object-cover">
            @else
                <div class="w-full h-96 flex flex-col items-center justify-center bg-gray-100 text-gray-300">
                    <i class="fas fa-image text-7xl mb-3"></i>
                    <span class="text-sm">Aucune image disponible</span>
                </div>
            @endif
        </div>

        {{-- Details --}}
        <div class="space-y-6">
            <div>
                <span class="inline-block bg-indigo-100 text-indigo-700 text-xs px-3 py-1 rounded-full font-medium mb-3">
                    {{ $product->category->name }}
                </span>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $product->title }}</h1>

                {{-- Rating --}}
                <div class="flex items-center gap-2 mb-4">
                    <div class="flex items-center gap-0.5">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= $product->average_rating ? 'star-filled' : 'star-empty' }}"></i>
                        @endfor
                    </div>
                    <span class="text-sm text-gray-500">
                        {{ number_format($product->average_rating, 1) }}/5 — {{ $product->reviews_count }} avis
                    </span>
                </div>

                <div class="text-4xl font-bold text-indigo-600 mb-4">
                    {{ number_format($product->price, 2, ',', ' ') }} €
                </div>

                <p class="text-gray-600 leading-relaxed">{{ $product->description }}</p>
            </div>

            {{-- Stock --}}
            <div class="flex items-center gap-2 text-sm">
                @if($product->stock > 0)
                    <span class="text-green-600"><i class="fas fa-check-circle"></i> En stock ({{ $product->stock }} disponibles)</span>
                @else
                    <span class="text-red-500"><i class="fas fa-times-circle"></i> Rupture de stock</span>
                @endif
            </div>

            {{-- Seller --}}
            <div class="bg-gray-50 rounded-xl p-4 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold">
                    {{ strtoupper(substr($product->user->name, 0, 1)) }}
                </div>
                <div>
                    <p class="text-xs text-gray-500">Vendu par</p>
                    <p class="font-semibold text-gray-800">{{ $product->user->name }}</p>
                </div>
            </div>

            {{-- Actions --}}
            @if($product->stock > 0)
                @auth
                    <form action="{{ route('cart.add', $product) }}" method="POST" class="space-y-3">
                        @csrf
                        <div class="flex items-center gap-3">
                            <label class="text-sm font-medium text-gray-700">Quantité :</label>
                            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                                class="w-20 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-indigo-500">
                        </div>
                        <div class="flex gap-3">
                            <button type="submit"
                                class="flex-1 bg-indigo-600 text-white py-3 rounded-xl font-semibold hover:bg-indigo-700 transition flex items-center justify-center gap-2">
                                <i class="fas fa-shopping-cart"></i> Ajouter au panier
                            </button>
                            @if($isWishlisted)
                                <form action="{{ route('wishlist.remove', $product) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="border border-red-300 text-red-500 px-4 py-3 rounded-xl hover:bg-red-50 transition">
                                        <i class="fas fa-heart text-red-500"></i>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('wishlist.add', $product) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="border border-gray-300 text-gray-500 px-4 py-3 rounded-xl hover:bg-gray-50 transition">
                                        <i class="far fa-heart"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </form>
                @else
                    <div class="space-y-2">
                        <a href="{{ route('login') }}"
                            class="block w-full text-center bg-indigo-600 text-white py-3 rounded-xl font-semibold hover:bg-indigo-700 transition">
                            Connectez-vous pour acheter
                        </a>
                    </div>
                @endauth
            @else
                <button disabled class="w-full bg-gray-200 text-gray-500 py-3 rounded-xl font-semibold cursor-not-allowed">
                    Rupture de stock
                </button>
            @endif

            {{-- Edit/Delete if owner --}}
            @auth
                @if(auth()->id() === $product->user_id)
                    <div class="flex gap-3 pt-2 border-t">
                        <a href="{{ route('products.edit', $product) }}"
                            class="flex items-center gap-2 text-sm text-blue-600 hover:text-blue-700">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST"
                            onsubmit="return confirm('Supprimer ce produit ?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="flex items-center gap-2 text-sm text-red-500 hover:text-red-600">
                                <i class="fas fa-trash"></i> Supprimer
                            </button>
                        </form>
                    </div>
                @endif
            @endauth
        </div>
    </div>

    {{-- Reviews section --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        {{-- Existing Reviews --}}
        <div>
            <h2 class="text-xl font-bold text-gray-900 mb-4">
                Avis clients <span class="text-gray-400 font-normal text-base">({{ $product->reviews->count() }})</span>
            </h2>

            @if($product->reviews->isEmpty())
                <div class="text-center py-8 bg-white rounded-xl border border-dashed border-gray-300">
                    <i class="fas fa-comment-alt text-4xl text-gray-200 mb-3"></i>
                    <p class="text-gray-400">Aucun avis pour ce produit.</p>
                    <p class="text-gray-400 text-sm">Soyez le premier à laisser un avis !</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($product->reviews as $review)
                        <div class="bg-white rounded-xl p-4 shadow-sm">
                            <div class="flex items-start justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-semibold text-sm">
                                        {{ strtoupper(substr($review->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800 text-sm">{{ $review->user->name }}</p>
                                        <div class="flex gap-0.5 mt-0.5">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star text-xs {{ $i <= $review->rating ? 'star-filled' : 'star-empty' }}"></i>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="text-xs text-gray-400">{{ $review->created_at->diffForHumans() }}</span>
                                    @auth
                                        @if(auth()->id() === $review->user_id)
                                            <form action="{{ route('reviews.destroy', $review) }}" method="POST">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-400 hover:text-red-600 text-xs">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm mt-3 leading-relaxed">{{ $review->comment }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Add Review Form --}}
        @auth
            @php
                $userReview = $product->reviews->where('user_id', auth()->id())->first();
            @endphp
            <div>
                <h2 class="text-xl font-bold text-gray-900 mb-4">Laisser un avis</h2>
                @if($userReview)
                    <div class="bg-green-50 border border-green-200 rounded-xl p-4 text-green-700 text-sm">
                        <i class="fas fa-check-circle mr-2"></i>
                        Vous avez déjà évalué ce produit ({{ $userReview->rating }}/5).
                    </div>
                @else
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <form action="{{ route('reviews.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Note</label>
                                <div class="flex gap-2" x-data="{ rating: 0 }">
                                    @for($i = 1; $i <= 5; $i++)
                                        <label class="cursor-pointer">
                                            <input type="radio" name="rating" value="{{ $i }}" class="hidden" x-model="rating">
                                            <i class="fas fa-star text-2xl transition-colors"
                                                :class="rating >= {{ $i }} ? 'text-yellow-400' : 'text-gray-300'"></i>
                                        </label>
                                    @endfor
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Commentaire</label>
                                <textarea name="comment" rows="4" required
                                    placeholder="Partagez votre expérience avec ce produit..."
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-indigo-500 resize-none">{{ old('comment') }}</textarea>
                            </div>

                            <button type="submit"
                                class="w-full bg-indigo-600 text-white py-2.5 rounded-lg font-semibold hover:bg-indigo-700 transition">
                                Publier mon avis
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        @endauth
    </div>

    {{-- Related Products --}}
    @if($relatedProducts->isNotEmpty())
        <div class="mt-12">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Produits similaires</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($relatedProducts as $related)
                    <a href="{{ route('products.show', $related) }}"
                        class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition group">
                        <div class="bg-gray-100 h-32 flex items-center justify-center overflow-hidden">
                            @if($related->image)
                                <img src="{{ asset('storage/' . $related->image) }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform" alt="{{ $related->title }}">
                            @else
                                <i class="fas fa-image text-3xl text-gray-300"></i>
                            @endif
                        </div>
                        <div class="p-3">
                            <p class="text-sm font-medium text-gray-800 line-clamp-2">{{ $related->title }}</p>
                            <p class="text-indigo-600 font-bold mt-1">{{ number_format($related->price, 2, ',', ' ') }} TND</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

</div>
@endsection
