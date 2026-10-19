<x-store-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-xl p-8 border border-gray-200 text-center space-y-6">
                
                <!-- Success Check Icon -->
                <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>

                <h1 class="text-3xl font-extrabold text-gray-900">Thank You for Your Order!</h1>
                <p class="text-gray-600">Your order #{{ $order->id }} has been placed successfully.</p>

                <!-- Order Details Box -->
                <div class="border-t border-b py-4 my-6 text-left space-y-2 text-sm text-gray-700 bg-gray-50 p-6 rounded-lg">
                    <p><strong>Shipping To:</strong> {{ $order->shipping_name }}</p>
                    <p><strong>Address:</strong> {{ $order->shipping_address }}, {{ $order->shipping_city }} {{ $order->shipping_postal_code }}</p>
                    <p><strong>Order Status:</strong> <span class="capitalize font-semibold text-indigo-600">{{ $order->status }}</span></p>
                    <p><strong>Total Paid:</strong> ${{ number_format($order->total_price, 2) }}</p>
                </div>

                <a href="{{ url('/') }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-6 py-3 rounded-md transition shadow">
                    Continue Shopping
                </a>
            </div>
        </div>
    </div>
</x-store-layout>