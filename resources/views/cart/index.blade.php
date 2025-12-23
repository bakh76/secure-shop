<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 leading-tight">
            Shopping Cart
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(!$cart || $cart->items->count() == 0)
                <!-- Empty State -->
                <div class="flex flex-col items-center justify-center py-24 bg-white rounded-2xl border border-slate-200 shadow-sm text-center relative overflow-hidden">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>
                    <div class="bg-indigo-50 p-6 rounded-full mb-6">
                        <svg class="w-12 h-12 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Your cart is empty</h3>
                    <p class="text-slate-500 mt-2 mb-8 max-w-sm">Looks like you haven't added anything to your cart yet. Browse our products to find something you love.</p>
                    <a href="{{ route('dashboard') }}" class="px-8 py-3 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition-all duration-200 shadow-md hover:shadow-lg hover:-translate-y-0.5">
                        Start Shopping
                    </a>
                </div>
            @else
                <div class="flex flex-col lg:flex-row gap-8 items-start">
                    
                    <!-- Left Column: Cart Items List -->
                    <div class="flex-1 w-full">
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden relative">
                            <!-- Gradient Strip -->
                            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-500 to-indigo-600"></div>

                            <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50 mt-1">
                                <h3 class="font-bold text-gray-900">Cart Items</h3>
                                <span class="text-xs font-bold uppercase tracking-wider text-indigo-600 bg-indigo-50 px-2 py-1 rounded-md border border-indigo-100">{{ $cart->items->count() }} items</span>
                            </div>

                            <div class="divide-y divide-slate-100">
                                @php $grandTotal = 0; @endphp
                                @foreach($cart->items as $item)
                                    @php 
                                        $subtotal = $item->product->price * $item->quantity;
                                        $grandTotal += $subtotal;
                                    @endphp
                                    <div class="p-6 flex flex-col sm:flex-row items-center gap-6 group hover:bg-slate-50/80 transition duration-200">
                                        
                                        <!-- Colorful Product Placeholder -->
                                        <div class="w-16 h-16 flex-shrink-0 bg-purple-50 border border-purple-100 rounded-2xl flex items-center justify-center text-purple-500 shadow-sm">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                        </div>

                                        <!-- Details -->
                                        <div class="flex-1 w-full text-center sm:text-left">
                                            <div class="flex flex-col sm:flex-row justify-between items-start mb-2">
                                                <div>
                                                    <h4 class="font-bold text-gray-900 text-lg group-hover:text-indigo-600 transition-colors">{{ $item->product->name }}</h4>
                                                    <p class="text-sm text-slate-500 font-medium">{{ $item->product->category }}</p>
                                                </div>
                                                <div class="mt-2 sm:mt-0 text-right">
                                                    <p class="font-bold text-slate-900 text-lg">RM{{ number_format($item->product->price, 2) }}</p>
                                                </div>
                                            </div>

                                            <div class="flex items-center justify-between mt-3">
                                                <!-- Colored Quantity Badge -->
                                                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-indigo-50 border border-indigo-100 text-sm font-semibold text-indigo-700">
                                                    <span class="text-xs uppercase text-indigo-400 font-bold tracking-wider">Qty</span>
                                                    <span>{{ $item->quantity }}</span>
                                                </div>

                                                <!-- Remove Action -->
                                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-sm font-semibold text-rose-500 hover:text-rose-700 transition flex items-center gap-1 opacity-80 group-hover:opacity-100 bg-rose-50 hover:bg-rose-100 px-3 py-1.5 rounded-lg">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                        Remove
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="mt-6">
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-bold transition group">
                                <div class="w-8 h-8 rounded-full bg-indigo-50 flex items-center justify-center mr-3 group-hover:bg-indigo-100 transition-colors">
                                    <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                                </div>
                                Continue Shopping
                            </a>
                        </div>
                    </div>

                    <!-- Right Column: Order Summary -->
                    <div class="w-full lg:w-[380px] flex-shrink-0">
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 sticky top-6 relative overflow-hidden">
                            <!-- Gradient Strip -->
                            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>

                            <h3 class="font-bold text-lg text-gray-900 mb-6 mt-2">Order Summary</h3>
                            
                            <div class="space-y-4 text-sm text-slate-600 border-b border-slate-100 pb-6 mb-6">
                                <div class="flex justify-between">
                                    <span>Subtotal</span>
                                    <span class="font-medium text-slate-900">RM{{ number_format($grandTotal, 2) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Shipping Estimate</span>
                                    <span class="text-emerald-600 font-bold bg-emerald-50 px-2 py-0.5 rounded text-xs uppercase tracking-wide">Free</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Tax Estimate</span>
                                    <span class="text-slate-400 italic">Calculated at checkout</span>
                                </div>
                            </div>

                            <div class="flex justify-between items-end mb-8">
                                <span class="text-base font-bold text-gray-900 mb-1">Order Total</span>
                                <span class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">
                                    RM{{ number_format($grandTotal, 2) }}
                                </span>
                            </div>

                            <a href="{{ route('checkout.index') }}" class="block w-full py-4 bg-gray-900 text-white text-center font-bold rounded-xl hover:bg-indigo-600 transition-all shadow-lg shadow-gray-200 hover:shadow-indigo-200 transform hover:-translate-y-0.5">
                                Proceed to Checkout
                            </a>
                            
                            <div class="mt-6 flex items-center justify-center gap-2 text-xs text-slate-400 font-medium">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                <span>Secure Checkout with Stripe</span>
                            </div>
                        </div>
                    </div>

                </div>
            @endif

        </div>
    </div>
</x-app-layout>