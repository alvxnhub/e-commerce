<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MCC Store')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    {{-- Include Navigation --}}
    @include('layouts.navigation')

    {{-- Page Content --}}
    <main class="mt-20">
        @yield('content')
    </main>

    <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>
