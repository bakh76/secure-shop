<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class AdminController extends Controller
{
    // Admin Dashboard
    public function index()
    {
        return view('admin.dashboard');
    }

    // List all products
    public function indexProducts()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    // Show form to create product
    public function create()
    {
        return view('admin.products.create');
    }

    // Store new product
    public function store(Request $request)
    {
        // 🔥 Updated Validation for new fields
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);

        Product::create($request->all());

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully');
    }

    // Edit Product Form
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    // Update Product
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);

        $product->update($request->all());

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
    }

    // Delete product
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted');
    }
}