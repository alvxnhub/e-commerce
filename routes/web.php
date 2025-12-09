<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    $orders = Order::where('user_id', Auth::id())->latest()->get();
    return view('dashboard', compact('orders'));
})->middleware(['auth'])->name('dashboard');

// Admin Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/order/{id}/ready', [AdminController::class, 'markOrderReady'])->name('order.ready');
    Route::post('/order/{id}/complete', [AdminController::class, 'completeOrder'])->name('order.complete');
    Route::post('/order/{id}/cancel', [AdminController::class, 'cancelOrder'])->name('order.cancel');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::post('/user/{id}/suspend', [AdminController::class, 'suspendUser'])->name('user.suspend');
    Route::post('/user/{id}/unsuspend', [AdminController::class, 'unsuspendUser'])->name('user.unsuspend');
});

Route::middleware('auth')->group(function () {
   
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Orders
    Route::get('/order/{id}', [OrderController::class, 'orderForm'])->name('order.form');
    Route::post('/order/{id}', [OrderController::class, 'placeOrder'])->name('order.place');
});

Route::get('/products', function () {
    $products = Product::all();
    return view('product.index', compact('products'));
})->name('products.index');

Route::get('/product/{id}', [OrderController::class, 'showProduct'])->name('product.show');

require __DIR__.'/auth.php';

