<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 leading-tight">
            Manage Products
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-slate-200 relative">
                <!-- Gradient Top Border -->
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>
                
                <!-- Table Header & Actions -->
                <div class="px-6 py-5 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-center bg-white gap-4 mt-1">
                    <div class="flex items-center gap-2">
                        <div class="bg-indigo-50 p-2 rounded-lg text-indigo-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">Product Inventory</h3>
                    </div>
                    
                    <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 text-white font-medium text-sm rounded-xl hover:bg-indigo-700 transition shadow-md hover:shadow-lg focus:ring-4 focus:ring-indigo-100 transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Add New Product
                    </a>
                </div>

                @if($products->isEmpty())
                    <!-- Empty State -->
                    <div class="flex flex-col items-center justify-center py-16 text-center">
                        <div class="bg-indigo-50 p-4 rounded-full mb-4">
                            <svg class="w-10 h-10 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">No products found</h3>
                        <p class="text-slate-500 mt-1 max-w-sm">Get started by adding your first product to the inventory.</p>
                        <a href="{{ route('admin.products.create') }}" class="mt-6 text-indigo-600 hover:text-indigo-800 font-medium text-sm">Add Product Now &rarr;</a>
                    </div>
                @else
                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-slate-600">
                            <thead class="bg-slate-50/50 text-xs uppercase font-bold text-slate-500 tracking-wider">
                                <tr>
                                    <th class="px-6 py-4">Product Name</th>
                                    <th class="px-6 py-4">Category</th>
                                    <th class="px-6 py-4">Price</th>
                                    <th class="px-6 py-4">Stock</th>
                                    <th class="px-6 py-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($products as $product)
                                    <tr class="hover:bg-slate-50/80 transition duration-150 group">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="h-10 w-10 rounded-lg bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-xs shrink-0">
                                                    {{ substr($product->name, 0, 1) }}
                                                </div>
                                                <div>
                                                    <p class="font-bold text-gray-900 text-base group-hover:text-indigo-600 transition-colors">{{ $product->name }}</p>
                                                    <p class="text-xs text-slate-400 truncate max-w-[200px]">{{ Str::limit($product->description, 40) }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-slate-100 text-slate-600 border border-slate-200 group-hover:bg-white group-hover:border-indigo-200 group-hover:text-indigo-600 transition-colors">
                                                {{ $product->category ?? 'General' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="font-bold text-slate-900 group-hover:text-indigo-600 transition-colors">RM{{ number_format($product->price, 2) }}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($product->stock > 0)
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                                    {{ $product->stock }} in stock
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-100">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                                    Out of stock
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex items-center justify-end gap-2 opacity-100 sm:opacity-0 sm:group-hover:opacity-100 transition-opacity">
                                                <a href="{{ route('admin.products.edit', $product->id) }}" class="p-2 bg-white border border-slate-200 rounded-lg text-slate-600 hover:text-indigo-600 hover:border-indigo-200 transition shadow-sm hover:shadow-md" title="Edit">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                                </a>
                                                
                                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-2 bg-white border border-slate-200 rounded-lg text-slate-600 hover:text-rose-600 hover:border-rose-200 transition shadow-sm hover:shadow-md" title="Delete">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                
            </div>
        </div>
    </div>
</x-app-layout>