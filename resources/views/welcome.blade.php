<x-layout>

    <!-- NAVBAR -->
    <header class="absolute inset-x-0 top-0 z-50 bg-red-100 ">
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

            <div class="hidden lg:flex flex-1 justify-end items-center gap-2">
                @guest
                    <a href="{{ route('login') }}" 
                       class="text-red-500 px-4 py-2 rounded-md font-semibold hover:text-red-600">
                       Log in
                    </a>
                @endguest

                @auth
                    <!-- User Dropdown -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content" class="bg-white-500">
                            <!-- Profile Link -->
                            <x-dropdown-link :href="route('profile.edit')">
                                Profile
                            </x-dropdown-link>

                            <!-- Dashboard Link -->
                             <x-dropdown-link :href="route('dashboard')">
                                Dashboard
                            </x-dropdown-link>

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
