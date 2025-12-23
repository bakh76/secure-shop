<x-app-layout>
    <div class="bg-slate-50 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col lg:flex-row gap-8 lg:gap-12">
                
                <!-- Left Side: Order Summary -->
                <div class="w-full lg:w-5/12 order-2 lg:order-1">
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden sticky top-6 relative">
                        <!-- Gradient Top Border -->
                        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>

                        <div class="p-6 border-b border-slate-100 bg-slate-50/50 mt-1">
                            <h2 class="text-lg font-bold text-gray-900">Order Summary</h2>
                        </div>
                        
                        <div class="p-6">
                            <ul class="divide-y divide-slate-100">
                                @php $total = 0; @endphp
                                @foreach($cart->items as $item)
                                    @php 
                                        $subtotal = $item->product->price * $item->quantity;
                                        $total += $subtotal;
                                    @endphp
                                    <li class="py-4 flex gap-4 items-center">
                                        
                                        <!-- Product Avatar (Color Placeholder) -->
                                        <div class="h-10 w-10 flex-shrink-0 rounded-full bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-sm">
                                            {{ substr($item->product->name, 0, 1) }}
                                        </div>

                                        <div class="flex flex-1 flex-col">
                                            <div>
                                                <div class="flex justify-between text-base font-medium text-gray-900">
                                                    <h3 class="text-slate-800">{{ $item->product->name }}</h3>
                                                    <p class="ml-4 font-bold text-slate-900">RM{{ number_format($subtotal, 2) }}</p>
                                                </div>
                                                <p class="mt-1 text-sm text-slate-500">{{ $item->product->category }}</p>
                                            </div>
                                            <div class="flex flex-1 items-end justify-between text-sm mt-1">
                                                <p class="text-slate-500">Qty <span class="font-semibold text-indigo-600">{{ $item->quantity }}</span></p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="border-t border-slate-100 pt-6 mt-6 space-y-4">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm text-slate-600">Subtotal</p>
                                    <p class="font-medium text-slate-900">RM{{ number_format($total, 2) }}</p>
                                </div>
                                <div class="flex items-center justify-between">
                                    <p class="text-sm text-slate-600">Shipping</p>
                                    <p class="font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded text-xs uppercase tracking-wide">Free</p>
                                </div>
                                <div class="flex items-center justify-between border-t border-slate-100 pt-4">
                                    <p class="text-base font-bold text-gray-900">Total</p>
                                    <p class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">RM{{ number_format($total, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side: Payment Form -->
                <div class="w-full lg:w-7/12 order-1 lg:order-2">
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden relative">
                        <!-- Gradient Top Border -->
                        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-500 to-indigo-600"></div>

                        <div class="p-8">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6">Checkout Details</h2>

                            @if (session('error'))
                                <div class="mb-6 bg-rose-50 border border-rose-100 text-rose-600 px-4 py-3 rounded-xl text-sm font-medium flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form action="{{ route('checkout.store') }}" method="POST" id="payment-form" class="space-y-8">
                                @csrf
                                <input type="hidden" name="payment_method_id" id="payment_method_id">

                                <!-- Shipping Info -->
                                <div>
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-sm border border-indigo-200">1</div>
                                        <h3 class="text-lg font-bold text-gray-900">Shipping Address</h3>
                                    </div>

                                    <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4 ml-0 sm:ml-11">
                                        <div class="sm:col-span-2">
                                            <label for="address" class="block text-sm font-medium text-slate-700 mb-1">Address</label>
                                            <input type="text" name="address" id="address" required class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-3 transition-all bg-slate-50 focus:bg-white" placeholder="123 Main St">
                                        </div>

                                        <div>
                                            <label for="city" class="block text-sm font-medium text-slate-700 mb-1">City</label>
                                            <input type="text" name="city" id="city" required class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-3 transition-all bg-slate-50 focus:bg-white" placeholder="New York">
                                        </div>

                                        <div>
                                            <label for="zip" class="block text-sm font-medium text-slate-700 mb-1">Postal code</label>
                                            <input type="text" name="zip" id="zip" required class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-3 transition-all bg-slate-50 focus:bg-white" placeholder="10001">
                                        </div>
                                    </div>
                                </div>

                                <!-- Payment Section -->
                                <div class="pt-8 border-t border-slate-100">
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-sm border border-indigo-200">2</div>
                                        <h3 class="text-lg font-bold text-gray-900">Payment Method</h3>
                                    </div>
                                    
                                    <div class="ml-0 sm:ml-11 bg-indigo-50/30 rounded-2xl p-6 border border-indigo-100/50">
                                        <label class="flex items-center gap-3 mb-6 cursor-pointer">
                                            <input type="radio" checked class="h-5 w-5 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                            <span class="font-bold text-gray-900">Credit or Debit Card</span>
                                            <div class="ml-auto flex gap-2 opacity-60 grayscale hover:grayscale-0 transition-all">
                                                <div class="h-6 w-10 bg-white rounded border border-gray-200 flex items-center justify-center text-[10px] font-bold text-slate-500 shadow-sm">VISA</div>
                                                <div class="h-6 w-10 bg-white rounded border border-gray-200 flex items-center justify-center text-[10px] font-bold text-slate-500 shadow-sm">MC</div>
                                            </div>
                                        </label>

                                        <!-- Stripe Element Container -->
                                        <div id="card-element" class="p-4 bg-white border border-slate-200 rounded-xl shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:border-indigo-500 transition-all"></div>
                                        <div id="card-errors" class="text-rose-500 text-sm mt-2 font-medium" role="alert"></div>
                                    
                                        <div class="mt-4 flex items-center gap-2 text-xs text-slate-500 font-medium">
                                            <svg class="h-4 w-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                            Payments are secure and encrypted.
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" id="submit-button" class="ml-0 sm:ml-11 w-[calc(100%-0px)] sm:w-[calc(100%-2.75rem)] flex justify-center items-center gap-2 py-4 px-4 border border-transparent rounded-xl shadow-lg shadow-indigo-200 text-base font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all transform hover:-translate-y-0.5">
                                    <span>Pay RM{{ number_format($total, 2) }}</span>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Stripe JS Logic -->
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe("{{ env('STRIPE_KEY') }}");
        const elements = stripe.elements();
        
        // Custom styling for Stripe Element to match Tailwind
        const style = {
            base: {
                color: '#1e293b',
                fontFamily: '"Instrument Sans", sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#94a3b8'
                }
            },
            invalid: {
                color: '#e11d48',
                iconColor: '#e11d48'
            }
        };

        const cardElement = elements.create('card', {style: style, hidePostalCode: true});
        cardElement.mount('#card-element');

        const form = document.getElementById('payment-form');
        const submitButton = document.getElementById('submit-button');

        form.addEventListener('submit', async (event) => {
            event.preventDefault();
            submitButton.disabled = true;
            submitButton.innerHTML = '<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Processing...';

            const { paymentMethod, error } = await stripe.createPaymentMethod({
                type: 'card',
                card: cardElement,
            });

            if (error) {
                const errorElement = document.getElementById('card-errors');
                errorElement.textContent = error.message;
                submitButton.disabled = false;
                submitButton.textContent = 'Pay ${{ number_format($total, 2) }}';
            } else {
                document.getElementById('payment_method_id').value = paymentMethod.id;
                form.submit();
            }
        });
    </script>
</x-app-layout>