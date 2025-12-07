@extends('layouts.app')

@section('title', 'Admin Dashboard')
@vite(['resources/css/app.css', 'resources/js/app.js'])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body class="m-0 p-0 bg-gray-50">
    <div class="fixed top-0 left-0 right-0 z-40 bg-red-100 shadow-lg">
        <nav class="max-w-full px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/mcc-logo.png') }}" alt="MCC Logo" class="h-12 w-12 object-contain">
                <span class="font-bold text-2xl text-red-600">MCC Admin</span>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-gray-700 font-semibold">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 font-semibold transition">
                        Logout
                    </button>
                </form>
            </div>
        </nav>
    </div>
<div class="pt-10">
    <div class="pt-20 pb-8 px-6 min-h-screen bg-gray-50">
        <div class="max-w-full">
            <!-- Header Section -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-red-500 mb-2">Order Management</h1>
                <p class="text-red-400 ml-5">Manage and track all customer orders in real-time</p>
            </div>

            <!-- Success Message -->
            @if(session('success'))
            <div class="mb-6 p-4 bg-green-500 text-white rounded-lg shadow-lg border-l-4 border-green-700 flex items-center gap-3">
                <span>{{ session('success') }}</span>
            </div>
            @endif

            <!-- Table Container -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-gray-700">
                        <thead class="bg-red-600 text-white sticky top-0">
                            <tr>
                                <th class="px-6 py-4 text-left font-semibold">Order ID</th>
                                <th class="px-6 py-4 text-left font-semibold">Product</th>
                                <th class="px-6 py-4 text-left font-semibold">Customer</th>
                                <th class="px-6 py-4 text-left font-semibold">Contact</th>
                                <th class="px-6 py-4 text-left font-semibold">Address</th>
                                <th class="px-6 py-4 text-center font-semibold">Qty</th>
                                <th class="px-6 py-4 text-left font-semibold">Total</th>
                                <th class="px-6 py-4 text-left font-semibold">Status</th>
                                <th class="px-6 py-4 text-left font-semibold">Date</th>
                                <th class="px-6 py-4 text-left font-semibold">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($orders as $order)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 font-bold text-blue-600">#{{ $order->id }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $order->product_name }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $order->customer_name }}</td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-700">{{ $order->email }}</div>
                                    <div class="text-xs text-gray-500">{{ $order->phone }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $order->address }}</td>
                                <td class="px-6 py-4 text-center font-semibold text-gray-900">{{ $order->quantity }}</td>
                                <td class="px-6 py-4 font-bold text-green-600">₱{{ number_format($order->total_price, 2) }}</td>
                                <td class="px-6 py-4">
                                    @if($order->status === 'pending')
                                        <span class="inline-flex items-center gap-2 bg-yellow-100 text-yellow-800 px-4 py-2 rounded-full text-xs font-bold">
                                            <span class="w-2 h-2 bg-yellow-500 rounded-full animate-pulse"></span>
                                            Pending
                                        </span>
                                    @elseif($order->status === 'ready')
                                        <span class="inline-flex items-center gap-2 bg-green-100 text-green-800 px-4 py-2 rounded-full text-xs font-bold">
                                            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                                            Ready
                                        </span>
                                    @elseif($order->status === 'completed')
                                        <span class="inline-flex items-center gap-2 bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-xs font-bold">
                                            <span class="w-2 h-2 bg-blue-500"></span>
                                            Completed
                                        </span>
                                    @elseif($order->status === 'cancelled')
                                        <span class="inline-flex items-center gap-2 bg-red-100 text-red-800 px-4 py-2 rounded-full text-xs font-bold">
                                            <span class="w-2 h-2 bg-red-500"></span>
                                            Cancelled
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $order->created_at->timezone('Asia/Manila')->format('M d, Y') }}<br><span class="text-xs text-gray-500">{{ $order->created_at->timezone('Asia/Manila')->format('h:i A') }}</span></td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-2">
                                        @if($order->status === 'pending')
                                        <form action="{{ route('admin.order.ready', $order->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded text-xs font-bold transition-colors duration-200 whitespace-nowrap">
                                                ✓ Mark Ready
                                            </button>
                                        </form>
                                        @endif

                                        @if($order->status === 'ready')
                                        <form action="{{ route('admin.order.complete', $order->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded text-xs font-bold transition-colors duration-200 whitespace-nowrap">
                                                ✓ Completed
                                            </button>
                                        </form>
                                        @endif

                                        @if($order->status !== 'completed' && $order->status !== 'cancelled')
                                        <form action="{{ route('admin.order.cancel', $order->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded text-xs font-bold transition-colors duration-200 whitespace-nowrap" onclick="return confirm('Cancel this order?')">
                                                ✕ Cancel
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="px-6 py-12 text-center">
                                    <div class="text-gray-500 text-lg">
                                        <svg class="mx-auto w-12 h-12 mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                        </svg>
                                        No orders found.
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

                <!-- Pagination -->
                <div class="bg-gray-100 px-6 py-4 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-600">
                            Showing <span class="font-semibold text-gray-900">{{ $orders->count() }}</span> orders
                        </div>
                        <div class="text-gray-700">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
