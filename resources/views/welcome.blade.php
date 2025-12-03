@extends('layouts.app')

@section('title', 'MCC Store')

@section('content')
    <!-- HERO SECTION -->
    <div class="relative px-6 pt-32 lg:px-8">
        <div class="max-w-2xl mx-auto text-center py-28 sm:py-48">

            <h1 class="text-5xl sm:text-7xl font-semibold text-red-500 tracking-tight">
                MCC Store
            </h1>

            <p class="mt-8 text-lg text-red-400 max-w-xl mx-auto">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt.
            </p>

            <div class="mt-10 flex justify-center gap-x-6">
                <a href="{{ route('products.index') }}"
                   class="bg-red-500 text-white px-6 py-3 rounded-md font-semibold hover:bg-red-600">
                   View Products
                </a>
            </div>
        </div>
    </div>
@endsection
