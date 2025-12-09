@extends('layouts.app')

@section('title', 'Users Management')
@vite(['resources/css/app.css', 'resources/js/app.js'])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body class="m-0 p-0 bg-gray-50">
    <div class="fixed top-0 left-0 right-0 z-40 bg-red-100 shadow-lg">
        <nav class="max-w-full px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/mcc-logo.png') }}" alt="MCC Logo" class="h-12 w-12 object-contain">
                <span class="font-bold text-2xl text-red-600">MCC Admin</span>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-gray-700 font-semibold">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 font-semibold transition">
                        Logout
                    </button>
                </form>
            </div>
        </nav>
    </div>
<div class="pt-10">
    <div class="pt-20 pb-8 px-6 min-h-screen bg-gray-50">
        <div class="max-w-full">
                <!-- Header Section -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-red-500 mb-2">Users Management</h1>
                <p class="text-red-400 ml-5">Manage and moderate all user accounts</p>
            </div>

            <!-- Success Message -->
            @if(session('success'))
            <div class="mb-6 p-4 bg-red-500 text-white rounded-lg shadow-lg border-l-4 border-green-700 flex items-center gap-3">
                <span>{{ session('success') }}</span>
            </div>
            @endif

            <!-- Table Container -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-gray-700">
                        <thead class="bg-red-600 text-white sticky top-0">
                            <tr>
                                <th class="px-6 py-4 text-left font-semibold">User ID</th>
                                <th class="px-6 py-4 text-left font-semibold">Name</th>
                                <th class="px-6 py-4 text-left font-semibold">Email</th>
                                <th class="px-6 py-4 text-left font-semibold">Role</th>
                                <th class="px-6 py-4 text-left font-semibold">Status</th>
                                <th class="px-6 py-4 text-left font-semibold">Created</th>
                                <th class="px-6 py-4 text-left font-semibold">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($users as $user)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 font-bold text-blue-600">#{{ $user->id }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $user->name }}</td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-700">{{ $user->email }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $user->role ?? 'user' }}</td>
                                <td class="px-6 py-4">
                                    @if(isset($user->suspended) && $user->suspended)
                                        <span class="inline-flex items-center gap-2 bg-red-100 text-red-800 px-4 py-2 rounded-full text-xs font-bold">
                                            <span class="w-2 h-2 bg-red-500"></span>
                                            Suspended
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-2 bg-green-100 text-green-800 px-4 py-2 rounded-full text-xs font-bold">
                                            <span class="w-2 h-2 bg-green-500"></span>
                                            Active
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $user->created_at->timezone('Asia/Manila')->format('M d, Y') }}<br><span class="text-xs text-gray-500">{{ $user->created_at->timezone('Asia/Manila')->format('h:i A') }}</span></td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-2">
                                        @if(!isset($user->suspended) || !$user->suspended)
                                        <form action="{{ route('admin.user.suspend', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-red-800 px-3 py-2 rounded text-xs font-bold transition-colors duration-200 whitespace-nowrap" onclick="return confirm('Suspend this user account?')">
                                                ⏸ Suspend
                                            </button>
                                        </form>
                                        @else
                                        <form action="{{ route('admin.user.unsuspend', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="bg-green hover:bg-green-500 text-orange-800 px-3 py-2 rounded text-xs font-bold transition-colors duration-200 whitespace-nowrap" onclick="return confirm('Unsuspend this user account?')">
                                                ▶️ Unsuspend
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="text-gray-500 text-lg">
                                        <svg class="mx-auto w-12 h-12 mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                        </svg>
                                        No users found.
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

                <!-- Pagination -->
                <div class="bg-gray-100 px-6 py-4 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-600">
                            Showing <span class="font-semibold text-gray-900">{{ $users->count() }}</span> users
                        </div>
                        <div class="text-gray-700">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
