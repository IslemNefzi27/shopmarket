<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'user', 'reviews'])->active();

        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        // Sort
        match($request->get('sort', 'newest')) {
            'price_asc'  => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'oldest'     => $query->orderBy('created_at', 'asc'),
            default      => $query->orderBy('created_at', 'desc'),
        };

        $products   = $query->paginate(12)->withQueryString();
        $categories = Category::withCount('products')->get();

        return view('products.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        $product->load(['category', 'user', 'reviews.user']);
        $relatedProducts = Product::active()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        $isWishlisted = Auth::check()
            ? Auth::user()->wishlists()->where('product_id', $product->id)->exists()
            : false;

        return view('products.show', compact('product', 'relatedProducts', 'isWishlisted'));
    }

    public function myProducts()
    {
        $products = Product::where('user_id', Auth::id())
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('products.my-products', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price'       => ['required', 'numeric', 'min:0'],
            'stock'       => ['required', 'integer', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
            'image'       => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $data['user_id']   = Auth::id();
        $data['is_active'] = true;

        Product::create($data);

        return redirect()->route('products.my')
            ->with('success', 'Produit ajouté avec succès !');
    }

    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);

        $data = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price'       => ['required', 'numeric', 'min:0'],
            'stock'       => ['required', 'integer', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
            'image'       => ['nullable', 'image', 'max:2048'],
            'is_active'   => ['boolean'],
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');
        $product->update($data);

        return redirect()->route('products.my')
            ->with('success', 'Produit mis à jour avec succès !');
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.my')
            ->with('success', 'Produit supprimé avec succès !');
    }

    public function wishlist()
    {
        $products = Auth::user()->wishlists()->with('category')->paginate(12);
        return view('products.wishlist', compact('products'));
    }

    public function addToWishlist(Product $product)
    {
        Auth::user()->wishlists()->syncWithoutDetaching([$product->id]);
        return back()->with('success', 'Produit ajouté à votre liste de souhaits.');
    }

    public function removeFromWishlist(Product $product)
    {
        Auth::user()->wishlists()->detach($product->id);
        return back()->with('success', 'Produit retiré de votre liste de souhaits.');
    }

    public function search(Request $request)
    {
        $results = Product::active()
            ->search($request->q)
            ->with('category')
            ->limit(10)
            ->get(['id', 'title', 'price', 'image']);

        return response()->json($results);
    }
}
