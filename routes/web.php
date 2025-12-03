<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
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
