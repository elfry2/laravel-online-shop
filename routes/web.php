<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');

// Checkout Routes
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Product Management Routes (Granular Definition)
    Route::prefix('admin')->name('products.')->group(function () {
        Route::get('/products', [ProductController::class, 'index'])
            ->name('index');

        Route::get('/products/create', [ProductController::class, 'create'])
            ->name('create');

        Route::post('/products', [ProductController::class, 'store'])
            ->name('store');

        Route::get('/products/{product}', [ProductController::class, 'show'])
            ->name('show');

        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
            ->name('edit');

        Route::put('/products/{product}', [ProductController::class, 'update'])
            ->name('update');

        Route::delete('/products/{product}', [ProductController::class, 'destroy'])
            ->name('destroy');
    });

    Route::middleware(['auth'])->prefix('admin')->name('admin.orders.')->group(function () {
        Route::get('/orders', [AdminOrderController::class, 'index'])->name('index');
        Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('show');
        Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('update-status');
    });
});

require __DIR__ . '/auth.php';
