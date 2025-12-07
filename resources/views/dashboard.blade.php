@extends('layouts.app')

@section('title', 'Dashboard')
@vite(['resources/css/app.css', 'resources/js/app.js'])

<x-layout>
    <div class="pt-20">
        <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-red-500">
                    <h2 class="text-2xl font-bold mb-4">Your Orders</h2>

                    @if($orders->isEmpty())
                    <p>You have not placed any orders yet.</p>
                    @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($orders as $order)
                        <div class="border p-4 rounded shadow bg-white">
                            <h3 class="font-bold text-lg">{{ $order->product_name }}</h3>
                            <p class="text-black">Quantity: {{ $order->quantity }}</p>
                            <p class="text-black">Total: ₱{{ number_format($order->total_price, 2) }}</p>
                            <p class="text-black text-sm mt-1">Ordered on {{ $order->created_at->timezone('Asia/Manila')->format('M d, Y h:i A') }}</p>
                            <div class="mt-3">
                                @if($order->status === 'pending')
                                    <span class="inline-block bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold">Pending</span>
                                @elseif($order->status === 'ready')
                                    <span class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">Order is ready. Claim it at the cashier</span>
                                @elseif($order->status === 'completed')
                                    <span class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">Completed</span>
                                @elseif($order->status === 'cancelled')
                                    <span class="inline-block bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">Cancelled</span>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layout>