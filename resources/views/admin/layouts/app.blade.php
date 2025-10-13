<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Panel</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        .sidebar {
            transition: all 0.3s ease;
        }
        .active-menu {
            @apply bg-blue-600 text-white;
        }
        .stat-card {
            @apply bg-white p-6 rounded-lg shadow-md border-l-4;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="sidebar bg-gray-800 text-white w-64 flex flex-col">
            <!-- Logo -->
            <div class="p-4 border-b border-gray-700">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-code text-blue-400 text-xl"></i>
                    <span class="text-xl font-bold">Admin Panel</span>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" 
                           class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-700 transition-colors {{ request()->routeIs('admin.dashboard') ? 'active-menu' : '' }}">
                            <i class="fas fa-tachometer-alt w-6"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.profile.edit') }}" 
                           class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-700 transition-colors {{ request()->routeIs('admin.profile.*') ? 'active-menu' : '' }}">
                            <i class="fas fa-user w-6"></i>
                            <span>Profil</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.projects.index') }}" 
                           class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-700 transition-colors {{ request()->routeIs('admin.projects.*') ? 'active-menu' : '' }}">
                            <i class="fas fa-project-diagram w-6"></i>
                            <span>Proyek</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.books.index') }}" 
                           class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-700 transition-colors {{ request()->routeIs('admin.books.*') ? 'active-menu' : '' }}">
                            <i class="fas fa-book w-6"></i>
                            <span>Buku</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.contacts.index') }}" 
                           class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-700 transition-colors {{ request()->routeIs('admin.contacts.*') ? 'active-menu' : '' }}">
                            <i class="fas fa-envelope w-6"></i>
                            <span>Pesan</span>
                            @php
                                $unreadCount = \App\Models\Contact::where('read', false)->count();
                            @endphp
                            @if($unreadCount > 0)
                            <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full">
                                {{ $unreadCount }}
                            </span>
                            @endif
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- User Menu -->
            <div class="p-4 border-t border-gray-700">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" 
                            class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-700 transition-colors w-full text-left">
                        <i class="fas fa-sign-out-alt w-6"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b">
                <div class="flex items-center justify-between p-4">
                    <h1 class="text-2xl font-semibold text-gray-800">@yield('header')</h1>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-600">Welcome, {{ Auth::user()->name }}</span>
                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-6">
                @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    {{ session('error') }}
                </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script>
        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.bg-green-100, .bg-red-100');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.transition = 'all 0.3s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 300);
                }, 5000);
            });
        });
    </script>

    @yield('scripts')
</body>
</html>