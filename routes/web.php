<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AuthController as AdminAuth;
use App\Http\Controllers\Customer\AuthController as CustomerAuth;
use App\Http\Controllers\Admin\ProductController as AdminProducts;
use App\Http\Controllers\Admin\OrderController as AdminOrders;
use App\Http\Controllers\Customer\ShopController;
use App\Http\Controllers\Customer\OrderController as CustomerOrders;

// Home Page
Route::get('/', fn () => view('welcome'));

// -------------------- ADMIN ROUTES --------------------
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminAuth::class, 'showLogin'])->name('login');
    Route::post('login', [AdminAuth::class, 'login']);
    Route::get('register', [AdminAuth::class, 'showRegister'])->name('register');
    Route::post('register', [AdminAuth::class, 'register']);

    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', [AdminAuth::class, 'dashboard'])->name('dashboard');
        Route::post('logout', [AdminAuth::class, 'logout'])->name('logout');

        Route::get('orders', [AdminOrders::class, 'index'])->name('orders.index');
        Route::patch('orders/{order}', [AdminOrders::class, 'updateStatus'])->name('orders.updateStatus');

        // Import
        Route::get('products/import', [AdminProducts::class, 'importForm'])->name('products.import.form');
        Route::post('products/import', [AdminProducts::class, 'import'])->name('products.import');
        Route::resource('products', AdminProducts::class);

    });
});

// -------------------- CUSTOMER ROUTES --------------------
Route::prefix('customer')->name('customer.')->group(function () {
    Route::get('login', [CustomerAuth::class, 'showLogin'])->name('login');
    Route::post('login', [CustomerAuth::class, 'login']);
    Route::get('register', [CustomerAuth::class, 'showRegister'])->name('register');
    Route::post('register', [CustomerAuth::class, 'register']);

    Route::middleware('auth:customer')->group(function () {
        Route::get('dashboard', [CustomerAuth::class, 'dashboard'])->name('dashboard');
        Route::post('logout', [CustomerAuth::class, 'logout'])->name('logout');

        Route::get('shop', [ShopController::class, 'index'])->name('shop');
        Route::get('shop/{id}', [ShopController::class, 'show'])->name('shop.show');

        // -------------------- Customer Orders --------------------
        Route::post('orders', [CustomerOrders::class, 'store'])->name('orders.store');
        Route::get('orders', [CustomerOrders::class, 'index'])->name('orders.index');

        // Optional: Web Push subscription
        Route::post('push/subscribe', [CustomerOrders::class, 'subscribe'])->name('push.subscribe');
    });
});
