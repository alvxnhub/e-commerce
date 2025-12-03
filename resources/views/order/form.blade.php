@extends('layouts.app')

@section('title', 'Order Form')

@section('content')
<div class = "pt-20">
<form action="{{ route('order.place', $product->id) }}" method="POST" class="max-w-md mx-auto bg-white p-6 rounded shadow">
    @csrf

    <h2 class="text-xl font-bold mb-4">{{ $product->name }}</h2>

    <p class="mb-4">{{ $product->description }}</p>
    <p class="mb-4 font-bold text-red-600">₱{{ number_format($product->price, 2) }}</p>

    <label for="quantity" class="block font-semibold mb-1">Quantity</label>
    <input type="number" name="quantity" id="quantity" value="1" min="1"
           class="w-full border p-2 rounded mb-4">

    <label for="customer_name" class="block font-semibold mb-1">Name</label>
    <input type="text" name="customer_name" id="customer_name" required
           class="w-full border p-2 rounded mb-4">

    <label for="email" class="block font-semibold mb-1">Email</label>
    <input type="email" name="email" id="email" required
           class="w-full border p-2 rounded mb-4">

    <label for="phone" class="block font-semibold mb-1">Phone</label>
    <input type="text" name="phone" id="phone" required
           class="w-full border p-2 rounded mb-4">

    <label for="address" class="block font-semibold mb-1">Address</label>
    <textarea name="address" id="address" required
              class="w-full border p-2 rounded mb-4"></textarea>

    <button type="submit" class="w-full bg-red-500 text-white py-2 rounded hover:bg-red-600">
        Place Order
    </button>
</form>
</div>

@endsection
