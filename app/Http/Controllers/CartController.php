<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::where('user_id', Auth::id())
            ->with('product.category')
            ->get();

        $total = $cartItems->sum('subtotal');

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request, Product $product)
{
 
    $quantity = $request->input('quantity', 1);

    $cartItem = CartItem::where('user_id', Auth::id())
        ->where('product_id', $product->id)
        ->first();

    if ($cartItem) {
        $cartItem->increment('quantity', $quantity);
    } else {
        CartItem::create([
            'user_id'    => Auth::id(),
            'product_id' => $product->id,
            'quantity'   => $quantity,
        ]);
    }

    return back()->with('success', 'Produit ajouté au panier.');
}
    public function update(Request $request, CartItem $cartItem)
    {
        $this->authorize('update', $cartItem);

        $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $cartItem->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Quantité mise à jour.');
    }

    public function remove(CartItem $cartItem)
    {
        $this->authorize('delete', $cartItem);
        $cartItem->delete();
        return back()->with('success', 'Produit retiré du panier.');
    }

    public function clear()
    {
        CartItem::where('user_id', Auth::id())->delete();
        return back()->with('success', 'Panier vidé.');
    }
}
