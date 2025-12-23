<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                Browse Products
            </h2>
            <div class="flex gap-3">
                <a href="{{ route('user.orders') }}" class="text-sm font-medium text-gray-600 hover:text-indigo-600 transition">
                    My Orders
                </a>
                <span class="text-gray-300">|</span>
                <a href="{{ route('cart.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500 transition flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Cart
                </a>
            </div>
        </div>
    </x-slot>

    <!-- Success Flash Message -->
    @if (session('success'))
        <div x-data="{ show: true }"
             x-show="show"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform translate-y-2"
             x-init="setTimeout(() => show = false, 4000)"
             class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg shadow-sm flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
                <button @click="show = false" class="text-green-600 hover:text-green-800">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </div>
    @endif

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Search & Filter Bar -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 mb-8">
                <form method="GET" action="{{ route('dashboard') }}" class="flex flex-col md:flex-row gap-4 items-center">
                    <div class="relative flex-grow w-full md:w-auto">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" name="search" placeholder="Search products..." class="pl-10 block w-full rounded-lg border-gray-200 bg-slate-50 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-shadow duration-200 focus:shadow-sm" value="{{ request('search') }}">
                    </div>
                    
                    <div class="flex gap-2 w-full md:w-auto">
                        <input type="number" name="min_price" placeholder="Min RM" class="block w-full md:w-24 rounded-lg border-gray-200 bg-slate-50 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ request('min_price') }}">
                        <input type="number" name="max_price" placeholder="Max RM" class="block w-full md:w-24 rounded-lg border-gray-200 bg-slate-50 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ request('max_price') }}">
                    </div>

                    <div class="flex gap-2 w-full md:w-auto">
                        <button type="submit" class="w-full md:w-auto px-6 py-2.5 bg-indigo-600 text-white font-medium text-sm rounded-lg hover:bg-indigo-700 transition shadow-md shadow-indigo-200">
                            Filter
                        </button>
                        <a href="{{ route('dashboard') }}" class="w-full md:w-auto px-6 py-2.5 bg-white border border-gray-200 text-gray-700 font-medium text-sm rounded-lg hover:bg-gray-50 transition text-center hover:text-indigo-600 hover:border-indigo-200">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($products as $product)
                    <div class="group bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col h-full relative">
                        <!-- Gradient Top Border on Hover -->
                        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>

                        <div class="p-6 flex flex-col flex-grow">
                            <div class="flex-grow">
                                <div class="mb-3 flex justify-between items-start">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-semibold bg-indigo-50 text-indigo-700 border border-indigo-100">
                                        {{ $product->category }}
                                    </span>
                                    @if($product->stock < 5)
                                        <span class="text-[10px] font-bold uppercase tracking-wider text-amber-600 bg-amber-50 px-2 py-0.5 rounded-full border border-amber-100">
                                            Low Stock
                                        </span>
                                    @endif
                                </div>
                                
                                <h3 class="text-lg font-bold text-gray-900 group-hover:text-indigo-600 transition-colors truncate mb-2">
                                    {{ $product->name }}
                                </h3>
                                <p class="text-sm text-gray-500 line-clamp-3 leading-relaxed">{{ $product->description }}</p>
                            </div>
                            
                            <div class="mt-5 pt-5 border-t border-slate-50 flex items-end justify-between">
                                <div>
                                    <p class="text-xs text-gray-400 font-medium mb-0.5">Price</p>
                                    <p class="text-2xl font-bold text-gray-900 tracking-tight">RM{{ number_format($product->price, 2) }}</p>
                                </div>
                                <div class="text-right">
                                     <p class="text-xs text-gray-400 font-medium mb-1">{{ $product->stock }} available</p>
                                </div>
                            </div>

                            <div class="mt-5">
                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center justify-center gap-2 bg-gray-900 text-white hover:bg-indigo-600 px-4 py-3 rounded-xl font-semibold transition-all duration-300 shadow-sm hover:shadow-indigo-200 hover:shadow-lg group-hover:bg-indigo-600">
                                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:-translate-y-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                        Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full flex flex-col items-center justify-center py-16 text-center bg-white rounded-2xl border border-slate-100 shadow-sm">
                        <div class="bg-indigo-50 p-4 rounded-full mb-4">
                            <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">No products found</h3>
                        <p class="text-gray-500 mt-2 max-w-sm">We couldn't find anything matching your search criteria. Try using different keywords or adjusting the price range.</p>
                        <a href="{{ route('dashboard') }}" class="mt-6 text-indigo-600 hover:text-indigo-800 font-medium text-sm flex items-center gap-1 transition-colors">
                            <span>Clear all filters</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </a>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>