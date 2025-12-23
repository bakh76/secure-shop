<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 leading-tight">
            Edit Product
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-slate-200 relative">
                <!-- Gradient Top Border -->
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>

                <div class="p-8">
                    <div class="mb-8 border-b border-slate-100 pb-6 flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Editing: {{ $product->name }}</h3>
                            <p class="text-sm text-slate-500 mt-1">Update the product details below.</p>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-slate-100 text-slate-600 border border-slate-200">
                            ID: #{{ $product->id }}
                        </span>
                    </div>

                    <!-- Display Validation Errors -->
                    @if ($errors->any())
                        <div class="mb-6 bg-rose-50 border border-rose-100 text-rose-600 px-4 py-3 rounded-xl text-sm font-medium">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Product Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-3 transition-all bg-slate-50 focus:bg-white" placeholder="Product Name">
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category" class="block text-sm font-medium text-slate-700 mb-1">Category</label>
                            <div class="relative">
                                <select name="category" id="category" class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-3 transition-all bg-slate-50 focus:bg-white appearance-none">
                                    <option value="Electronics" {{ $product->category == 'Electronics' ? 'selected' : '' }}>Electronics</option>
                                    <option value="Clothing" {{ $product->category == 'Clothing' ? 'selected' : '' }}>Clothing</option>
                                    <option value="Books" {{ $product->category == 'Books' ? 'selected' : '' }}>Books</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>

                        <!-- Grid for Price & Stock -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="price" class="block text-sm font-medium text-slate-700 mb-1">Price</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-slate-400 font-bold">RM</span>
                                    </div>
                                    <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $product->price) }}" required class="pl-10 block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-3 transition-all bg-slate-50 focus:bg-white">
                                </div>
                            </div>
                            <div>
                                <label for="stock" class="block text-sm font-medium text-slate-700 mb-1">Stock Quantity</label>
                                <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" required class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-3 transition-all bg-slate-50 focus:bg-white">
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-slate-700 mb-1">Description</label>
                            <textarea name="description" id="description" rows="4" class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-3 transition-all bg-slate-50 focus:bg-white">{{ old('description', $product->description) }}</textarea>
                        </div>

                        <!-- Actions -->
                        <div class="pt-6 flex items-center justify-end gap-4 border-t border-slate-100">
                            <a href="{{ route('admin.products.index') }}" class="text-slate-500 hover:text-slate-800 font-medium text-sm transition-colors px-4 py-2">Cancel</a>
                            <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 text-white font-bold text-sm rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-200 transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                Update Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>