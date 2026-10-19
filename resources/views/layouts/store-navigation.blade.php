<?php

use Illuminate\Support\Facades\Route;

$cartCount = session('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0;
?>

<nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Left Side: Logo & Shop Link -->
            <div class="flex items-center space-x-8">
                <div class="shrink-0 flex items-center">
                    <a href="{{ url('/') }}" class="font-bold text-xl text-indigo-600">
                        {{ config('app.name', 'Laravel Shop') }}
                    </a>
                </div>

                <div class="hidden space-x-8 sm:flex">
                    <a href="{{ url('/') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-indigo-500 text-sm font-medium leading-5 text-gray-900">
                        Shop
                    </a>
                </div>
            </div>

            <!-- Right Side: Cart, Admin, Auth Links -->
            <div class="hidden sm:flex sm:items-center gap-6">
                <!-- Shopping Cart -->
                <a href="{{ route('cart.index') }}" class="text-gray-700 hover:text-indigo-600 text-sm font-medium flex items-center gap-1.5 bg-gray-50 px-3 py-1.5 rounded-lg border border-gray-200">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span>Cart (<strong>{{ $cartCount }}</strong>)</span>
                </a>

                @auth
                    <div class="flex items-center gap-4">
                        <a href="{{ route('products.index') }}" class="text-sm font-medium text-gray-700 hover:text-indigo-600">Admin Dashboard</a>
                        
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-900">Logout</button>
                        </form>
                    </div>
                @else
                    <div class="flex items-center gap-4">
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-indigo-600">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium">Register</a>
                        @endif
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>