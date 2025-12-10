<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function showProduct($id)
    {
        $product = Product::findOrFail($id);
        return view('product.show', compact('product'));
    }

    public function orderForm($id)
    {
        $product = Product::findOrFail($id);
        return view('order.form', compact('product'));
    }

    public function placeOrder(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'customer_name' => 'required|string|max:255',
            'email'         => 'required|email|max:255',
            'phone'         => 'required|string|max:20',
            'address'       => 'required|string|max:500',
            'quantity'      => 'required|integer|min:1',
        ]);

        $quantity = $request->input('quantity');

        Order::create([
            'product_id'   => $product->id,
            'product_name' => $product->name,
            'customer_name'=> $request->customer_name,
            'email'        => $request->email,
            'phone'        => $request->phone,
            'address'      => $request->address,
            'quantity'     => $quantity,
            'total_price'  => $product->price * $quantity,
            'user_id'      => Auth::id(),
        ]);

        return view('order.success');
    }
}
