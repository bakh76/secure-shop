<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Product; // Import Product

class UserController extends Controller
{
    // User Dashboard + Product Search Logic
    public function index(Request $request)
    {
        $query = Product::query();

        // 1. Search by Name or Category
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        // 2. Filter by Min Price
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        // 3. Filter by Max Price
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query->get();

        return view('dashboard', compact('products'));
    }

    // User Orders Page
    public function orders()
    {
        $user = Auth::user();
        
        // Fetch orders WITH items, sorted by newest first
        $orders = $user->orders()->with('items')->orderBy('created_at', 'desc')->get(); 
        
        return view('user.orders', compact('orders'));
    }
}