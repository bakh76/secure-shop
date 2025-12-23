<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 leading-tight">
            My Order History
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if($orders->isEmpty())
                <!-- Empty State -->
                <div class="flex flex-col items-center justify-center py-24 bg-white rounded-2xl border border-slate-200 shadow-sm text-center">
                    <div class="bg-indigo-50 p-6 rounded-full mb-6">
                        <svg class="w-12 h-12 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">No orders found</h3>
                    <p class="text-slate-500 mt-2 mb-8 max-w-sm">You haven't placed any orders yet. Start shopping to see your history here.</p>
                    <a href="{{ route('dashboard') }}" class="px-8 py-3 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition-all duration-200 shadow-md hover:shadow-lg hover:-translate-y-0.5">
                        Start Shopping
                    </a>
                </div>
            @else
                <div class="space-y-8">
                    @foreach($orders as $order)
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-all duration-200 relative group">
                            <!-- Gradient Top Border -->
                            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>

                            <!-- Order Header -->
                            <div class="bg-slate-50/50 px-6 py-5 border-b border-slate-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mt-1">
                                <div class="flex flex-col md:flex-row md:items-center gap-4 md:gap-10">
                                    <div>
                                        <p class="text-xs text-slate-500 uppercase tracking-wider font-bold">Order Placed</p>
                                        <p class="text-sm font-medium text-slate-700">{{ $order->created_at->format('d M Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-500 uppercase tracking-wider font-bold">Order ID</p>
                                        <p class="text-sm font-bold text-indigo-600">#{{ $order->id }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-500 uppercase tracking-wider font-bold">Total Amount</p>
                                        <p class="text-sm font-bold text-slate-900">RM{{ number_format($order->total, 2) }}</p>
                                    </div>
                                </div>
                                
                                <div>
                                    @php
                                        $statusClasses = [
                                            'completed' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                                            'processing' => 'bg-indigo-100 text-indigo-700 border-indigo-200',
                                            'pending' => 'bg-amber-100 text-amber-700 border-amber-200',
                                            'cancelled' => 'bg-rose-100 text-rose-700 border-rose-200',
                                            'paid' => 'bg-teal-100 text-teal-700 border-teal-200',
                                        ];
                                        $currentStatusClass = $statusClasses[strtolower($order->status)] ?? 'bg-slate-100 text-slate-700 border-slate-200';
                                    @endphp
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide border {{ $currentStatusClass }}">
                                        {{ $order->status }}
                                    </span>
                                </div>
                            </div>

                            <!-- Order Items -->
                            <div class="p-6">
                                <ul class="divide-y divide-slate-100">
                                    @foreach($order->items as $item)
                                        <li class="py-4 first:pt-0 last:pb-0 flex items-center justify-between">
                                            <div class="flex items-center gap-4">
                                                <!-- Item Icon -->
                                                <div class="h-12 w-12 flex-shrink-0 rounded-xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-500">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                                </div>
                                                <div>
                                                    <p class="font-bold text-slate-800">{{ $item->product_name }}</p>
                                                    <p class="text-sm text-slate-500 font-medium">Qty: {{ $item->quantity }} &times; RM{{ number_format($item->price, 2) }}</p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <p class="font-bold text-slate-900">RM{{ number_format($item->price * $item->quantity, 2) }}</p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Shipping Footer -->
                            <div class="bg-slate-50/50 px-6 py-4 border-t border-slate-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2">
                                <div class="text-sm text-slate-500 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <span class="font-semibold text-slate-700">Shipping to:</span> 
                                    <span class="text-slate-600">{{ $order->shipping_address ?? 'Address not available' }}</span>
                                </div>
                                <div class="text-xs text-slate-400 font-medium">
                                    Secure Payment via Stripe
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>