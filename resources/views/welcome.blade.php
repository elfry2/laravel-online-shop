<?php

use App\Models\Product;

$products = Product::latest()->paginate(12);

?>
<x-store-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Hero Header with explicit inline background style fallback if Tailwind compilation lags -->
            <div class="bg-indigo-900 text-white rounded-2xl p-8 mb-10 text-center sm:text-left flex flex-col sm:flex-row justify-between items-center shadow-lg" style="background-color: #312e81;">
                <div class="mb-6 sm:mb-0">
                    <h1 class="text-3xl font-extrabold tracking-tight">Welcome to Our Online Shop</h1>
                    <p class="mt-2 text-indigo-200 max-w-xl">Explore our curated collection of products built entirely using Laravel 12, Blade, and Tailwind CSS.</p>
                </div>
                @auth
                    <a href="{{ route('products.index') }}" class="bg-white text-indigo-900 hover:bg-indigo-50 font-semibold px-6 py-3 rounded-lg shadow transition whitespace-nowrap">
                        Manage Products
                    </a>
                @else
                    <a href="{{ route('login') }}" class="bg-indigo-600 hover:bg-indigo-500 text-white font-semibold px-6 py-3 rounded-lg shadow transition whitespace-nowrap">
                        Admin Login
                    </a>
                @endauth
            </div>

            <!-- Product Grid -->
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Featured Products</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse ($products as $product)
                    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition flex flex-col">
                        <div class="h-48 w-full bg-gray-100 overflow-hidden relative">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400 text-sm">
                                    No Image
                                </div>
                            @endif
                        </div>
                        <div class="p-4 flex flex-col flex-grow">
                            <h3 class="font-semibold text-gray-900 text-lg mb-1">{{ $product->name }}</h3>
                            <p class="text-indigo-600 font-bold mb-3">${{ number_format($product->price, 2) }}</p>
                            <p class="text-gray-500 text-sm mb-4 flex-grow line-clamp-2">{{ $product->description }}</p>
                            
                            <div class="mt-auto">
                                <form action="{{ route('cart.add', $product) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-md text-sm font-medium transition">
                                        Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center text-gray-500 bg-white rounded-xl border border-gray-200">
                        No products available yet. Go to the admin panel to add some!
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-store-layout>