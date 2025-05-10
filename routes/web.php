<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Website\MainController;
use App\Http\Controllers\Website\ProductController as WebsiteProductController;
use App\Http\Controllers\Website\ContactController;
use App\Http\Controllers\Website\OrderController;

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProductController as DashboardProductController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\OrderController as DashboardOrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Laravel Auth Routes (login, register, logout, etc.)
Auth::routes();

// Website Routes
Route::prefix('/')->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('website.home');
    Route::get('/products', [WebsiteProductController::class, 'index'])->name('website.products');
    Route::get('/contact', [ContactController::class, 'index'])->name('website.contact');
    Route::post('/contact', [ContactController::class, 'submit'])->name('website.contact.submit');

    Route::middleware('auth')->group(function () {
        Route::post('/add-to-cart/{id}', [OrderController::class, 'addToCart'])->name('cart.add');
        Route::post('/remove-from-cart/{id}', [OrderController::class, 'removeFromCart'])->name('cart.remove');
        Route::get('/cart', [OrderController::class, 'viewCart'])->name('cart.view');
        Route::get('/checkout', [OrderController::class, 'submitOrder'])->name('checkout.submit');
        Route::get('/invoice/{id}', [OrderController::class, 'viewInvoice'])->name('checkout.invoice');
        Route::get('/invoice/{id}/pdf', [OrderController::class, 'downloadInvoice'])->name('checkout.invoice.pdf');

        // User Orders
        Route::prefix('my-orders')->middleware('auth')->group(function () {
            Route::get('/', [OrderController::class, 'userOrders'])->name('user.orders.index');
            Route::get('/edit/{id}', [OrderController::class, 'editOrder'])->name('user.orders.edit');
            Route::post('/update/{id}', [OrderController::class, 'updateOrder'])->name('user.orders.update');
            Route::delete('/{id}', [OrderController::class, 'destroy'])->name('user.orders.delete');
        });

    });
});

// Dashboard Routes (require login)
Route::prefix('dashboard')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/reports', [DashboardController::class, 'getReports'])->name('dashboard.reports');

    // Categories
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('dashboard.categories.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('dashboard.categories.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('dashboard.categories.store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('dashboard.categories.edit');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('dashboard.categories.update');
        Route::delete('/delete/{id}', [CategoryController::class, 'destroy'])->name('dashboard.categories.delete');
    });

    // Products
    Route::prefix('products')->group(function () {
        Route::get('/', [DashboardProductController::class, 'index'])->name('dashboard.products.index');
        Route::get('/create', [DashboardProductController::class, 'create'])->name('dashboard.products.create');
        Route::post('/store', [DashboardProductController::class, 'store'])->name('dashboard.products.store');
        Route::get('/edit/{id}', [DashboardProductController::class, 'edit'])->name('dashboard.products.edit');
        Route::post('/update/{id}', [DashboardProductController::class, 'update'])->name('dashboard.products.update');
        Route::delete('/delete/{id}', [DashboardProductController::class, 'destroy'])->name('dashboard.products.delete');
    });

    // Orders
    Route::prefix('orders')->group(function () {
        Route::get('/', [DashboardOrderController::class, 'index'])->name('dashboard.orders.index');
        Route::delete('/{id}', [DashboardOrderController::class, 'destroy'])->name('dashboard.orders.delete');
    });
});
