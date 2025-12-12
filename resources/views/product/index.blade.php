@extends('layouts.app')

@section('title', 'MCC Store')

@section('content')
<div class="max-w-4xl mx-auto mt-20 pt-10">
    <h1 class="text-3xl font-bold mb-6">Products</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach ($products as $product)
            <div class="p-4 border rounded shadow bg-white">
                @if($product->image)
                    <img src="{{ asset('images/products/' . $product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-48 object-cover rounded mb-4">
                @endif

                <h2 class="font-bold text-lg">{{ $product->name }}</h2>
                <p class="text-gray-600 text-sm">{{ Str::limit($product->description, 60) }}</p>
                <p class="mt-2 font-semibold">₱{{ number_format($product->price, 2) }}</p>

                <div class="mt-3 flex gap-2">
                    <a href="{{ route('product.show', $product->id) }}"
                       class="flex-1 text-center bg-gray-600 text-white px-3 py-1 rounded hover:bg-gray-700 text-sm">
                       View Details
                    </a>
                    <a href="{{ route('order.form', $product->id) }}"
                       class="flex-1 text-center bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-sm">
                       Order Now
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

