<header class="fixed inset-x-0 top-0 z-50 bg-red-100 shadow-md">
    <nav class="max-w-7xl mx-auto flex items-center justify-between p-4 lg:px-8">
        <!-- Logo -->
        <div class="flex items-center flex-1">
            <a href="{{ route('welcome') }}" class="flex items-center gap-3">
                <img src="{{ asset('images/mcc-logo.png') }}" 
                     alt="MCC Logo" 
                     class="h-14 w-14 object-contain">

                <span class="font-bold text-2xl text-red-600">MCC Store</span>
            </a>
        </div>

        <!-- MENU LINKS -->
        <div class="hidden lg:flex gap-x-8 font-semibold text-red-600 items-center">
            <a href="{{ route('welcome') }}" class="text-lg hover:text-red-700">
                Home
            </a>
            <a href="{{ route('products.index') }}" class="text-lg hover:text-red-700">
                Products
            </a>
        </div>

       <!-- Authentication Buttons -->
        <div class="hidden lg:flex flex-1 justify-end items-center gap-4">
            @guest
                <a href="{{ route('login') }}" 
                   class="px-4 py-2 rounded-md font-semibold text-red-600 hover:bg-red-50 hover:text-red-700 transition">
                    Log in
                </a>
            @endguest

            @auth
<x-dropdown align="right" width="48">
    <x-slot name="trigger">
        <button class="inline-flex items-center px-3 py-2 bg-white text-sm rounded-md text-gray-600 hover:text-gray-800 transition">
            <div>{{ Auth::user()->name }}</div>
            <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                      clip-rule="evenodd"/>
            </svg>
        </button>
    </x-slot>

    <x-slot name="content">
        <!-- Profile and Dashboard links -->
        <x-dropdown-link :href="route('profile.edit')">
            Profile
        </x-dropdown-link>
        @if(Auth::user()->role === 'user')
        <x-dropdown-link :href="route('dashboard')">
            Dashboard
        </x-dropdown-link>
        @endif
        @if(Auth::user()->role === 'admin')
        <div class="border-t border-gray-100"></div>
        <x-dropdown-link :href="route('admin.dashboard')">
            Admin Dashboard
        </x-dropdown-link>
        @endif

        <!-- <div class="border-t border-gray-100"></div> -->

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-dropdown-link :href="route('logout')"
                onclick="event.preventDefault(); this.closest('form').submit();">
                Logout
            </x-dropdown-link>
        </form>
    </x-slot>
</x-dropdown>
@endauth
        </div>
    </nav>
</header>
