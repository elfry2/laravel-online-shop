<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Order Details') }} #{{ $order->id }}
            </h2>
            <a href="{{ route('admin.orders.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                Back to Orders
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Update Status Card -->
            <div class="bg-white shadow-sm rounded-xl p-6 border border-gray-200 flex justify-between items-center">
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Current Status</h3>
                    <p class="text-lg font-bold capitalize text-indigo-600">{{ $order->status }}</p>
                </div>

                <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="flex items-center gap-3">
                    @csrf
                    @method('PATCH')
                    <select name="status" class="border-gray-300 rounded-md text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        Update Status
                    </button>
                </form>
            </div>

            <!-- Customer & Shipping Information -->
            <div class="bg-white shadow-sm rounded-xl p-6 border border-gray-200 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-2">Customer Information</h3>
                    <p class="text-gray-900 font-medium">{{ $order->shipping_name }}</p>
                    <p class="text-gray-600 text-sm">{{ $order->user?->email ?? 'Guest Checkout' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-2">Shipping Address</h3>
                    <p class="text-gray-900 text-sm">{{ $order->shipping_address }}</p>
                    <p class="text-gray-900 text-sm">{{ $order->shipping_city }}, {{ $order->shipping_postal_code }}</p>
                </div>
            </div>

            <!-- Ordered Items List -->
            <div class="bg-white shadow-sm rounded-xl p-6 border border-gray-200">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Ordered Items</h3>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                            <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($order->items as $item)
                            <tr>
                                <td class="px-4 py-3 text-sm text-gray-900 flex items-center gap-2">
                                    @if($item->product?->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}" class="w-10 h-10 object-cover rounded" />
                                    @endif
                                    <span>{{ $item->product?->name ?? 'Deleted Product' }}</span>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-500">${{ number_format($item->price, 2) }}</td>
                                <td class="px-4 py-3 text-sm text-gray-500">{{ $item->quantity }}</td>
                                <td class="px-4 py-3 text-sm font-semibold text-gray-900 text-right">${{ number_format($item->price * $item->quantity, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="border-t mt-4 pt-4 flex justify-between text-lg font-bold text-gray-900">
                    <span>Total Amount</span>
                    <span class="text-indigo-600">${{ number_format($order->total_price, 2) }}</span>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>