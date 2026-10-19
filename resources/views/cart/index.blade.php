<x-store-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-6">Shopping Cart</h1>

            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('cart') && count(session('cart')) > 0)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Cart Items Table -->
                    <div class="lg:col-span-2 bg-white shadow-sm rounded-xl overflow-hidden border border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                                    <th class="px-6 py-3"></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach(session('cart') as $id => $details)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap flex items-center gap-3">
                                            @if(isset($details['image']))
                                                <img src="{{ asset('storage/' . $details['image']) }}" class="w-12 h-12 object-cover rounded-md" />
                                            @else
                                                <div class="w-12 h-12 bg-gray-100 rounded-md flex items-center justify-center text-xs text-gray-400">No img</div>
                                            @endif
                                            <span class="font-medium text-gray-900">{{ $details['name'] }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">${{ number_format($details['price'], 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center gap-2">
                                                @csrf
                                                @method('PATCH')
                                                <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" class="w-16 border-gray-300 rounded-md text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                                <button type="submit" class="text-xs text-indigo-600 hover:text-indigo-900 font-medium">Update</button>
                                            </form>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-900 font-semibold">
                                            ${{ number_format($details['price'] * $details['quantity'], 2) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 font-medium">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Cart Summary Sidebar -->
                    <div class="bg-white shadow-sm rounded-xl p-6 border border-gray-200 h-fit space-y-4">
                        <h2 class="text-lg font-bold text-gray-900 border-b pb-3">Order Summary</h2>
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Shipping</span>
                            <span>Free</span>
                        </div>
                        <div class="border-t pt-3 flex justify-between text-lg font-bold text-gray-900">
                            <span>Total</span>
                            <span class="text-indigo-600">${{ number_format($total, 2) }}</span>
                        </div>

<a href="{{ route('checkout.index') }}" class="block text-center w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 rounded-md transition shadow">
    Proceed to Checkout
</a>
                    </div>
                </div>
            @else
                <div class="bg-white shadow-sm rounded-xl p-12 text-center border border-gray-200 space-y-4">
                    <p class="text-gray-500">Your shopping cart is empty.</p>
                    <a href="{{ url('/') }}" class="inline-block bg-indigo-600 text-white font-medium px-6 py-2 rounded-md hover:bg-indigo-700 transition">
                        Start Shopping
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-store-layout>