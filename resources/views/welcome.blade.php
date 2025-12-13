@extends('layouts.app')

@section('title', 'MCC Store')

@section('content')

<!-- HERO SECTION -->
<div class="relative min-h-screen bg-cover bg-center bg-no-repeat"
     style="background-image: 
        linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
        url('{{ asset('images/products/mcc-background.jpg') }}');
        background-size: cover;
        background-position: center;">
    
    <!-- Content container -->
    <div class="relative px-6 pt-32 lg:px-8">
        <div class="max-w-2xl mx-auto text-center py-28 sm:py-48">

            <h1 class="text-5xl sm:text-7xl font-semibold text-white tracking-tight">
                MCC Store
            </h1>

            <p class="mt-8 text-lg text-white max-w-xl mx-auto">
                A school-based e-commerce platform created to help students easily purchase affordable and essential items within the campus.
            </p>

            <div class="mt-10 flex justify-center gap-x-6">
                <a href="{{ route('products.index') }}"
                   class="bg-red-500 text-white px-6 py-3 rounded-md font-semibold hover:bg-red-600">
                   View Products
                </a>
            </div>

        </div>
    </div>
</div>

@endsection
