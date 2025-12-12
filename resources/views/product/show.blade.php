@extends('layouts.app')

@section('title', $product->name . ' - MCC Store')

@section('content')
<div class="max-w-4xl mx-auto mt-20 pt-10">
    <!-- Back Button -->
    <a href="{{ route('products.index') }}" class="inline-flex items-center text-red-600 hover:text-red-700 mb-6">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Back to Products
    </a>

    <!-- Product Detail Card -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="md:flex">
            <!-- Product Image -->
            <div class="md:w-1/2">
                @if($product->image)
                    <img src="{{ asset('images/products/' . $product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-96 object-cover">
                @else
                    <div class="w-full h-96 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-400 text-xl">No Image Available</span>
                    </div>
                @endif
            </div>

            <!-- Product Information -->
            <div class="md:w-1/2 p-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $product->name }}</h1>
                
                <div class="mb-6">
                    <p class="text-4xl font-bold text-red-600">₱{{ number_format($product->price, 2) }}</p>
                </div>

                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-gray-700 mb-2">Description</h2>
                    <p class="text-gray-600 leading-relaxed">{{ $product->description }}</p>
                </div>

                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-gray-700 mb-2">Product Details</h2>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Available for order
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Fast processing
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Secure payment
                        </li>
                    </ul>
                </div>

                <!-- Action Buttons -->
                <div class="flex sm:flex-row gap-4">
                    <a href="{{ route('order.form', $product->id) }}" 
                       class="flex align-center justify-center bg-red-600 text-white text-center px-6 py-3 rounded-lg font-semibold hover:bg-red-700 transition duration-200">
                        Order Now
                    </a>
                    <a href="{{ route('products.index') }}" 
                       class="flex-1 border-2 border-gray-300 text-gray-700 text-center px-6 py-3 rounded-lg font-semibold hover:border-gray-400 transition duration-200">
                        Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    </div>

    
</div>
@endsection
