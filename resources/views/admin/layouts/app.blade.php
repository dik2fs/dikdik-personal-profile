<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Panel</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Custom Tailwind -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2563eb',
                        dark: '#1e1e2f',
                    },
                    boxShadow: {
                        soft: '0 4px 30px rgba(0,0,0,0.05)',
                    }
                }
            }
        }
    </script>

    <style>
        .sidebar-collapsed {
            width: 70px !important;
        }
        .sidebar-collapsed .menu-text {
            display: none;
        }
        .sidebar-collapsed .badge {
            display: none;
        }

        /* Smooth fade alerts */
        .fade-out {
            opacity: 0;
            transition: opacity .4s ease;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800">

    <!-- Wrapper -->
    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside id="sidebar"
            class="sidebar bg-dark text-gray-300 w-64 transition-all duration-300 flex flex-col shadow-xl">

            <!-- Logo -->
            <div class="p-5 flex items-center space-x-3 border-b border-gray-700">
                <i class="fas fa-layer-group text-primary text-xl"></i>
                <span class="text-xl font-semibold menu-text">Admin Panel</span>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 p-3 rounded-lg transition-all hover:bg-gray-700
                    {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-white shadow-soft' : '' }}">
                    <i class="fas fa-home w-6"></i>
                    <span class="menu-text">Dashboard</span>
                </a>

                <a href="{{ route('admin.profile.edit') }}"
                    class="flex items-center gap-3 p-3 rounded-lg transition-all hover:bg-gray-700
                    {{ request()->routeIs('admin.profile.*') ? 'bg-primary text-white shadow-soft' : '' }}">
                    <i class="fas fa-user w-6"></i>
                    <span class="menu-text">Profil</span>
                </a>

                <a href="{{ route('admin.projects.index') }}"
                    class="flex items-center gap-3 p-3 rounded-lg transition-all hover:bg-gray-700
                    {{ request()->routeIs('admin.projects.*') ? 'bg-primary text-white shadow-soft' : '' }}">
                    <i class="fas fa-diagram-project w-6"></i>
                    <span class="menu-text">Proyek</span>
                </a>

                <a href="{{ route('admin.books.index') }}"
                    class="flex items-center gap-3 p-3 rounded-lg transition-all hover:bg-gray-700
                    {{ request()->routeIs('admin.books.*') ? 'bg-primary text-white shadow-soft' : '' }}">
                    <i class="fas fa-book-open w-6"></i>
                    <span class="menu-text">Buku</span>
                </a>

                <a href="{{ route('admin.contacts.index') }}"
                    class="relative flex items-center gap-3 p-3 rounded-lg transition-all hover:bg-gray-700
                    {{ request()->routeIs('admin.contacts.*') ? 'bg-primary text-white shadow-soft' : '' }}">
                    <i class="fas fa-envelope w-6"></i>
                    <span class="menu-text">Pesan</span>

                    @php
                        $unread = \App\Models\Contact::where('read', false)->count();
                    @endphp

                    @if($unread > 0)
                    <span class="absolute right-3 top-3 bg-red-500 text-white text-xs px-2 py-1 rounded-full badge">
                        {{ $unread }}
                    </span>
                    @endif
                </a>
            </nav>

            <!-- User -->
            <div class="p-4 border-t border-gray-700">
                <button id="toggleSidebar"
                    class="mb-4 w-full bg-gray-700 hover:bg-gray-600 text-white py-2 rounded-lg transition">
                    <i class="fas fa-bars"></i>
                </button>

                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button class="w-full flex items-center gap-3 p-3 rounded-lg hover:bg-gray-700 transition">
                        <i class="fas fa-sign-out-alt w-6"></i>
                        <span class="menu-text">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">

            <!-- Header -->
            <header class="bg-white shadow-soft border-b p-4 flex justify-between items-center">
                <h1 class="text-2xl font-semibold">@yield('header')</h1>

                <div class="flex items-center gap-4">
                    <span class="text-gray-600">Hi, {{ Auth::user()->name }}</span>

                    <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center text-white shadow-soft">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                </div>
            </header>

            <!-- Alerts -->
            <div class="px-6 pt-4">
                @if(session('success'))
                <div id="alertSuccess"
                     class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 shadow-soft">
                     {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div id="alertError"
                     class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 shadow-soft">
                     {{ session('error') }}
                </div>
                @endif
            </div>

            <!-- Main Page Content -->
            <main class="flex-1 p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Fade alerts
        setTimeout(() => {
            const success = document.getElementById('alertSuccess');
            const error = document.getElementById('alertError');

            if (success) success.classList.add('fade-out');
            if (error) error.classList.add('fade-out');
        }, 3500);

        // Sidebar toggle
        document.getElementById('toggleSidebar').addEventListener('click', () => {
            document.getElementById('sidebar').classList.toggle('sidebar-collapsed');
        });
    </script>

    @yield('scripts')
</body>
</html>
