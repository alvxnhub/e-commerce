<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
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

    
    // Display admin dashboard with all orders grouped by status
    
    public function dashboard()
    {
        $orders = Order::with('product')->latest()->get();
        $pending = Order::with('product')->where('status', 'pending')->latest()->get();
        $ready = Order::with('product')->where('status', 'ready')->latest()->get();
        $completed = Order::with('product')->where('status', 'completed')->latest()->get();
        $cancelled = Order::with('product')->where('status', 'cancelled')->latest()->get();
        
        return view('admin.dashboard', compact('orders', 'pending', 'ready', 'completed', 'cancelled'));
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

    // Display all users (excluding admin accounts)
    public function users()
    {
        $users = User::where('role', '!=', 'admin')->latest()->paginate(15);
        return view('admin.users', compact('users'));
    }

    // Suspend a user
    public function suspendUser($id)
    {
        $user = User::findOrFail($id);
        $user->update(['suspended' => true]);

        return redirect()->back()->with('success', 'User account has been suspended.');
    }

    // Unsuspend a user
    public function unsuspendUser($id)
    {
        $user = User::findOrFail($id);
        $user->update(['suspended' => false]);

        return redirect()->back()->with('success', 'User account has been restored.');
    }
}
