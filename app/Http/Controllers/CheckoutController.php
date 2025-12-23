<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Cart;
use App\Models\Order;
use App\Models\CartItem;
use App\Models\OrderItem; // Added this
use App\Mail\OrderPlaced; // Added this
use Stripe\Stripe;        // Added this
use Stripe\PaymentIntent; // Added this

class CheckoutController extends Controller
{
    // Show Checkout Page
    public function index()
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->with('items.product')->first();

        if (!$cart || $cart->items->count() == 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        return view('checkout.index', compact('cart'));
    }

    // Process Payment & Create Order
    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'zip' => 'required|string|max:20',
            'payment_method_id' => 'required' // Token from Stripe JS
        ]);

        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->with('items.product')->first();

        if (!$cart) {
            return redirect()->route('cart.index');
        }

        // 1. Calculate Total
        $totalAmount = 0;
        foreach ($cart->items as $item) {
            $totalAmount += $item->product->price * $item->quantity;
        }
        $stripeAmount =(int) round($totalAmount * 100); // Convert to cents for Stripe

        DB::beginTransaction();

        try {
            // 2. Process Payment with Stripe
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $paymentIntent = PaymentIntent::create([
                'amount' => $stripeAmount,
                'currency' => 'usd', // Change to 'myr' if needed
                'payment_method' => $request->payment_method_id,
                'confirmation_method' => 'manual',
                'confirm' => true,
                'return_url' => route('dashboard'),
            ]);

            // 3. Create Order
            $order = Order::create([
                'user_id' => $user->id,
                'status' => 'processing',
                'total' => $totalAmount,
                'payment_method' => 'stripe_card',
                'payment_status' => 'paid',
                'shipping_address' => $request->address . ', ' . $request->city . ' ' . $request->zip,
            ]);

            // 4. Save Order Items (Crucial for Order History)
            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name, // Snapshot name
                    'price' => $item->product->price,       // Snapshot price
                    'quantity' => $item->quantity,
                ]);
            }

            // 5. Clear Cart
            CartItem::where('cart_id', $cart->id)->delete();
            $cart->delete();

            DB::commit();

            // 6. Send Email (Wrap in try-catch to not break flow if mail fails)
            try {
                Mail::to($user->email)->send(new OrderPlaced($order));
            } catch (\Exception $e) {
                // Log::error("Email failed: " . $e->getMessage());
            }
            
            return redirect()->route('dashboard')->with('success', 'Payment successful! Order placed.');

        } catch (\Stripe\Exception\CardException $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Payment failed: ' . $e->getError()->message);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Order failed: ' . $e->getMessage());
        }
    }
}