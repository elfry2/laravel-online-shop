<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $total = array_reduce($cart, function ($sum, $item) {
            return $sum + ($item['price'] * $item['quantity']);
        }, 0);

        return view('checkout.index', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $validated = $request->validate([
            'shipping_name'        => 'required|string|max:255',
            'shipping_address'     => 'required|string|max:255',
            'shipping_city'        => 'required|string|max:255',
            'shipping_postal_code' => 'required|string|max:20',
        ]);

        $total = array_reduce($cart, function ($sum, $item) {
            return $sum + ($item['price'] * $item['quantity']);
        }, 0);

        DB::transaction(function () use ($validated, $cart, $total) {
            // 1. Create the order
            $order = Order::create([
                'user_id'              => auth()->id(), // null if guest
                'total_price'          => $total,
                'status'               => 'pending',
                'shipping_name'        => $validated['shipping_name'],
                'shipping_address'     => $validated['shipping_address'],
                'shipping_city'        => $validated['shipping_city'],
                'shipping_postal_code' => $validated['shipping_postal_code'],
            ]);

            // 2. Attach items & deduct product stock
            foreach ($cart as $productId => $details) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $productId,
                    'quantity'   => $details['quantity'],
                    'price'      => $details['price'],
                ]);

                // Reduce stock
                $product = Product::find($productId);
                if ($product) {
                    $product->decrement('stock', $details['quantity']);
                }
            }

            // Store order ID in session for confirmation page
            session()->put('last_order_id', $order->id);
        });

        // Clear cart
        session()->forget('cart');

        return redirect()->route('checkout.success');
    }

    public function success()
    {
        $orderId = session()->get('last_order_id');

        if (!$orderId) {
            return redirect()->route('home');
        }

        $order = Order::with('items.product')->findOrFail($orderId);

        return view('checkout.success', compact('order'));
    }
}