<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

class CartController extends Controller
{
    // View Cart Page
    public function index()
    {
        $user = Auth::user();
        
        // Get user's cart or return empty if none exists
        $cart = Cart::where('user_id', $user->id)->with('items.product')->first();
        
        return view('cart.index', compact('cart'));
    }

    // Add Item to Cart
    public function addToCart(Request $request, Product $product)
    {
        $user = Auth::user();

        // 1. Find or Create Cart for User
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        // 2. Check if product already exists in cart
        $cartItem = CartItem::where('cart_id', $cart->id)
                            ->where('product_id', $product->id)
                            ->first();

        if ($cartItem) {
            // Increment quantity
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            // Create new item
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => 1
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    // Remove Item
    public function removeItem(CartItem $cartItem)
    {
        // Security Check: Ensure this item belongs to the logged-in user's cart
        if ($cartItem->cart->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Item removed.');
    }
}