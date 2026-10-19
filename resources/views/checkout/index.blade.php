<x-store-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-6">Checkout</h1>

            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <!-- Shipping Address Form -->
                    <div class="lg:col-span-2 bg-white shadow-sm rounded-xl p-6 border border-gray-200 space-y-6">
                        <h2 class="text-lg font-bold text-gray-900 border-b pb-3">Shipping Information</h2>

                        <div>
                            <x-input-label for="shipping_name" :value="__('Full Name')" />
                            <x-text-input id="shipping_name" name="shipping_name" type="text" class="mt-1 block w-full" :value="old('shipping_name', auth()->user()?->name)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('shipping_name')" />
                        </div>

                        <div>
                            <x-input-label for="shipping_address" :value="__('Address')" />
                            <x-text-input id="shipping_address" name="shipping_address" type="text" class="mt-1 block w-full" :value="old('shipping_address')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('shipping_address')" />
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="shipping_city" :value="__('City')" />
                                <x-text-input id="shipping_city" name="shipping_city" type="text" class="mt-1 block w-full" :value="old('shipping_city')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('shipping_city')" />
                            </div>

                            <div>
                                <x-input-label for="shipping_postal_code" :value="__('Postal Code')" />
                                <x-text-input id="shipping_postal_code" name="shipping_postal_code" type="text" class="mt-1 block w-full" :value="old('shipping_postal_code')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('shipping_postal_code')" />
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary Sidebar -->
                    <div class="bg-white shadow-sm rounded-xl p-6 border border-gray-200 h-fit space-y-4">
                        <h2 class="text-lg font-bold text-gray-900 border-b pb-3">Order Summary</h2>

                        <div class="space-y-3 max-h-60 overflow-y-auto">
                            @foreach($cart as $item)
                                <div class="flex justify-between items-center text-sm">
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $item['name'] }}</p>
                                        <p class="text-gray-500">Qty: {{ $item['quantity'] }}</p>
                                    </div>
                                    <span class="font-semibold text-gray-900">${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="border-t pt-3 flex justify-between text-lg font-bold text-gray-900">
                            <span>Total Amount</span>
                            <span class="text-indigo-600">${{ number_format($total, 2) }}</span>
                        </div>

                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 rounded-md transition shadow">
                            Place Order
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</x-store-layout>