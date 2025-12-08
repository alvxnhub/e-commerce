<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    
    //  Middleware to ensure only admins can access these routes
    
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check() && Auth::user()->role === 'admin') {
                return $next($request);
            }
            return redirect('/')->with('error', 'Unauthorized access');
        });
    }

    
    // Display admin dashboard with all orders
    
    public function dashboard()
    {
        $orders = Order::with('product')->latest()->paginate(15);
        return view('admin.dashboard', compact('orders'));
    }

   
    //  Update order status to ready for pickup
    
    public function markOrderReady($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'ready']);

        return redirect()->back()->with('success', 'Order marked as ready. Customer will be notified.');
    }


    // Update order status to completed

    public function completeOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'completed']);

        return redirect()->back()->with('success', 'Order marked as completed.');
    }

  
    //  Cancel an order
   
    public function cancelOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'cancelled']);

        return redirect()->back()->with('success', 'Order has been cancelled.');
    }
}
