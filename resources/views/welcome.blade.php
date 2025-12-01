<x-layout>

    <!-- NAVBAR -->
    <header class="absolute inset-x-0 top-0 z-50 bg-red-100 p-0">
        <nav class="max-w-7xl mx-auto flex items-center justify-between p-6 lg:px-8">
            <div class="flex flex-1">
                <a href="{{ route('welcome') }}" class="-m-1.5 p-1.5 flex items-center gap-2">
                    <img src="{{ asset('images/mcc-logo.png') }}" alt="MCC Logo" class="h-12 w-12 object-contain">
                    <span class="font-bold text-xl text-red-500">MCC Store</span> 
                </a>
            </div>

            <div class="hidden lg:flex gap-x-12 font-semibold">
                <a href="#" class="text-xl text-red-500">Products</a>
                <a href="#" class="text-xl text-red-500">Contacts</a>
            </div>

            <div class="hidden lg:flex flex-1 justify-end">
                @guest
                    <a href="{{ route('login') }}" 
                       class= "text-red-500 px-4 py-2 rounded-md font-semibold hover:text-red-600">
                       Log in
                    </a>
                @endguest

                @auth
                    <a href="{{ route('dashboard') }}" 
                       class=" text-xl text-red-500 px-4 py-2 rounded-md font-semibold hover:text-red-600">
                       {{ Auth::user()->name }}
                    </a>
                @endauth
            </div>
        </nav>
    </header>

    <!-- HERO TEXT -->
    <div class="relative px-6 pt-32 lg:px-8">
        <div class="max-w-2xl mx-auto text-center py-28 sm:py-48">

            <!-- Main title -->
            <h1 class="text-5xl sm:text-7xl font-semibold text-red-500 tracking-tight">
                MCC Store
            </h1>

            <!-- Subtitle -->
            <p class="mt-8 text-lg text-red-400 max-w-xl mx-auto">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            </p>

            <!-- Buttons -->
            <div class="mt-10 flex justify-center gap-x-6">
                <a href="#"
                   class="bg-red-500 text-white px-4 py-2.5 rounded-md font-semibold hover:bg-red-400">
                   Order Now
                </a>
            </div>
        </div>
    </div>

</x-layout>
