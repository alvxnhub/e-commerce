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
            </div>

            <!-- Success Message -->
            @if(session('success'))
            <div class="mb-6 p-4 bg-green-500 text-white rounded-lg shadow-lg border-l-4 border-green-700 flex items-center gap-3">
                <span>{{ session('success') }}</span>
            </div>
            @endif

            <!-- Status Tabs -->
            <div class="mb-6 flex gap-2 overflow-x-auto pb-2">
                <button onclick="showTab('all')" class="tab-btn active px-6 py-2 bg-gray-500 text-white rounded-lg font-semibold whitespace-nowrap hover:bg-gray-600 transition">
                    All Orders ({{ $orders->count() }})
                </button>
                <button onclick="showTab('pending')" class="tab-btn active px-6 py-2 bg-yellow-500 text-white rounded-lg font-semibold whitespace-nowrap hover:bg-yellow-600 transition">
                    Pending ({{ $pending->count() }})
                </button>
                <button onclick="showTab('ready')" class="tab-btn px-6 py-2 bg-green-500 text-white rounded-lg font-semibold whitespace-nowrap hover:bg-green-600 transition">
                    Ready ({{ $ready->count() }})
                </button>
                <button onclick="showTab('completed')" class="tab-btn px-6 py-2 bg-blue-500 text-white rounded-lg font-semibold whitespace-nowrap hover:bg-blue-600 transition">
                    Completed ({{ $completed->count() }})
                </button>
                <button onclick="showTab('cancelled')" class="tab-btn px-6 py-2 bg-red-500 text-white rounded-lg font-semibold whitespace-nowrap hover:bg-red-600 transition">
                    Cancelled ({{ $cancelled->count() }})
                </button>
            </div>

            <!-- All Orders Tab -->
            <div id="all-tab" class="tab-content">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-gray-700">
                            <thead class="bg-gray-500 text-white sticky top-0">
                                <tr>
                                    <th class="px-6 py-4 text-left font-semibold">Order ID</th>
                                    <th class="px-6 py-4 text-left font-semibold">Product</th>
                                    <th class="px-6 py-4 text-left font-semibold">Customer</th>
                                    <th class="px-6 py-4 text-left font-semibold">Contact</th>
                                    <th class="px-6 py-4 text-left font-semibold">Address</th>
                                    <th class="px-6 py-4 text-center font-semibold">Qty</th>
                                    <th class="px-6 py-4 text-left font-semibold">Total</th>
                                    <th class="px-6 py-4 text-left font-semibold">Date</th>
                                    <th class="px-6 py-4 text-left font-semibold">Status</th>
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
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $order->created_at->timezone('Asia/Manila')->format('M d, Y') }}<br><span class="text-xs text-gray-500">{{ $order->created_at->timezone('Asia/Manila')->format('h:i A') }}</span></td>
                                    <td class="px-6 py-4 text-sm font-semibold">
                                        @if($order->status == 'pending')
                                            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs">Pending</span>
                                        @elseif($order->status == 'ready')
                                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs">Ready</span>
                                        @elseif($order->status == 'completed')
                                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs">Completed</span>
                                        @else
                                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs">Cancelled</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="px-6 py-12 text-center text-gray-500">No orders</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Pending Orders Tab -->
            <div id="pending-tab" class="tab-content hidden">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-gray-700">
                            <thead class="bg-yellow-500 text-white sticky top-0">
                                <tr>
                                    <th class="px-6 py-4 text-left font-semibold">Order ID</th>
                                    <th class="px-6 py-4 text-left font-semibold">Product</th>
                                    <th class="px-6 py-4 text-left font-semibold">Customer</th>
                                    <th class="px-6 py-4 text-left font-semibold">Contact</th>
                                    <th class="px-6 py-4 text-left font-semibold">Address</th>
                                    <th class="px-6 py-4 text-center font-semibold">Qty</th>
                                    <th class="px-6 py-4 text-left font-semibold">Total</th>
                                    <th class="px-6 py-4 text-left font-semibold">Date</th>
                                    <th class="px-6 py-4 text-left font-semibold">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($pending as $order)
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
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $order->created_at->timezone('Asia/Manila')->format('M d, Y') }}<br><span class="text-xs text-gray-500">{{ $order->created_at->timezone('Asia/Manila')->format('h:i A') }}</span></td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('admin.order.ready', $order->id) }}" method="POST" class="inline mr-2">
                                            @csrf
                                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded text-xs font-bold transition-colors duration-200 whitespace-nowrap">
                                                ✓ Mark Ready
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.order.cancel', $order->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="bg-red-100 text-red-800 px-3 py-2 rounded text-xs font-bold hover:bg-red-300 transition-colors duration-200 whitespace-nowrap">
                                                X Cancel
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="px-6 py-12 text-center text-gray-500">No pending orders</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Ready Orders Tab -->
            <div id="ready-tab" class="tab-content hidden">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-gray-700">
                            <thead class="bg-green-500 text-white sticky top-0">
                                <tr>
                                    <th class="px-6 py-4 text-left font-semibold">Order ID</th>
                                    <th class="px-6 py-4 text-left font-semibold">Product</th>
                                    <th class="px-6 py-4 text-left font-semibold">Customer</th>
                                    <th class="px-6 py-4 text-left font-semibold">Contact</th>
                                    <th class="px-6 py-4 text-left font-semibold">Address</th>
                                    <th class="px-6 py-4 text-center font-semibold">Qty</th>
                                    <th class="px-6 py-4 text-left font-semibold">Total</th>
                                    <th class="px-6 py-4 text-left font-semibold">Date</th>
                                    <th class="px-6 py-4 text-left font-semibold">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($ready as $order)
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
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $order->created_at->timezone('Asia/Manila')->format('M d, Y') }}<br><span class="text-xs text-gray-500">{{ $order->created_at->timezone('Asia/Manila')->format('h:i A') }}</span></td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('admin.order.complete', $order->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded text-xs font-bold transition-colors duration-200 whitespace-nowrap">
                                                ✓ Completed
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="px-6 py-12 text-center text-gray-500">No ready orders</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Completed Orders Tab -->
            <div id="completed-tab" class="tab-content hidden">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-gray-700">
                            <thead class="bg-blue-500 text-white sticky top-0">
                                <tr>
                                    <th class="px-6 py-4 text-left font-semibold">Order ID</th>
                                    <th class="px-6 py-4 text-left font-semibold">Product</th>
                                    <th class="px-6 py-4 text-left font-semibold">Customer</th>
                                    <th class="px-6 py-4 text-left font-semibold">Contact</th>
                                    <th class="px-6 py-4 text-left font-semibold">Address</th>
                                    <th class="px-6 py-4 text-center font-semibold">Qty</th>
                                    <th class="px-6 py-4 text-left font-semibold">Total</th>
                                    <th class="px-6 py-4 text-left font-semibold">Date</th>
                                    <th class="px-6 py-4 text-left font-semibold">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($completed as $order)
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
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $order->created_at->timezone('Asia/Manila')->format('M d, Y') }}<br><span class="text-xs text-gray-500">{{ $order->created_at->timezone('Asia/Manila')->format('h:i A') }}</span></td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center gap-2 bg-green-100 text-green-800 px-4 py-2 rounded-full text-xs font-bold">
                                            ✓ Completed
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="px-6 py-12 text-center text-gray-500">No completed orders</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Cancelled Orders Tab -->
            <div id="cancelled-tab" class="tab-content hidden">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-gray-700">
                            <thead class="bg-red-500 text-white sticky top-0">
                                <tr>
                                    <th class="px-6 py-4 text-left font-semibold">Order ID</th>
                                    <th class="px-6 py-4 text-left font-semibold">Product</th>
                                    <th class="px-6 py-4 text-left font-semibold">Customer</th>
                                    <th class="px-6 py-4 text-left font-semibold">Contact</th>
                                    <th class="px-6 py-4 text-left font-semibold">Address</th>
                                    <th class="px-6 py-4 text-center font-semibold">Qty</th>
                                    <th class="px-6 py-4 text-left font-semibold">Total</th>
                                    <th class="px-6 py-4 text-left font-semibold">Date</th>
                                    <th class="px-6 py-4 text-left font-semibold">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($cancelled as $order)
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
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $order->created_at->timezone('Asia/Manila')->format('M d, Y') }}<br><span class="text-xs text-gray-500">{{ $order->created_at->timezone('Asia/Manila')->format('h:i A') }}</span></td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center gap-2 bg-red-100 text-red-800 px-4 py-2 rounded-full text-xs font-bold">
                                            ✕ Cancelled
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="px-6 py-12 text-center text-gray-500">No cancelled orders</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <script>
                function showTab(tabName) {
                    // Hide all tabs
                    document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
                    // Remove active class from all buttons
                    document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
                    
                    // Show selected tab
                    document.getElementById(tabName + '-tab').classList.remove('hidden');
                    // Add active class to clicked button
                    event.target.classList.add('active');
                }
            </script>
        </div>
    </div>
</div>
</body>
</html>
