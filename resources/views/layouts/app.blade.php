<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Profil Saya') - Portfolio & Book Collection</title>
    <meta name="description" content="@yield('description', 'Portfolio profesional dengan koleksi buku berkualitas. Web developer dengan pengalaman dalam Laravel, Vue.js, dan teknologi modern.')">
    <meta name="keywords" content="@yield('keywords', 'portfolio, web developer, buku, programming, laravel, vuejs')">
    <meta name="author" content="{{ $profile->name ?? 'Nama Anda' }}">
    
    <!-- Open Graph -->
    <meta property="og:title" content="@yield('title', 'Profil Saya') - Portfolio & Book Collection">
    <meta property="og:description" content="@yield('description', 'Portfolio profesional dengan koleksi buku berkualitas.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('images/og-image.jpg'))">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Profil Saya')">
    <meta name="twitter:description" content="@yield('description', 'Portfolio profesional dengan koleksi buku berkualitas.')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/og-image.jpg'))">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    @yield('head')
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
<nav class="bg-white shadow-lg sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <div class="text-2xl font-bold text-gray-800">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <i class="fas fa-code text-blue-600"></i>
                    <span>ProfilSaya</span>
                </a>
            </div>
            
            <!-- Desktop Menu -->
<div class="hidden md:flex space-x-8">
    <a href="{{ route('home') }}" 
       class="nav-link {{ request()->routeIs('home') ? 'text-blue-600 font-semibold' : 'text-gray-600' }}">
        <i class="fas fa-home mr-1"></i>Home
    </a>
    <a href="{{ route('about') }}" 
       class="nav-link {{ request()->routeIs('about') ? 'text-blue-600 font-semibold' : 'text-gray-600' }}">
        <i class="fas fa-user mr-1"></i>Tentang
    </a>
    <a href="{{ route('projects') }}" 
       class="nav-link {{ request()->routeIs('projects.*') ? 'text-blue-600 font-semibold' : 'text-gray-600' }}">
        <i class="fas fa-project-diagram mr-1"></i>Proyek
    </a>
    <a href="{{ route('books.index') }}" 
       class="nav-link {{ request()->routeIs('books.*') ? 'text-blue-600 font-semibold' : 'text-gray-600' }}">
        <i class="fas fa-book mr-1"></i>Buku
    </a>
    <a href="{{ route('contact') }}" 
       class="nav-link {{ request()->routeIs('contact') ? 'text-blue-600 font-semibold' : 'text-gray-600' }}">
        <i class="fas fa-envelope mr-1"></i>Kontak
    </a>
</div>
            
            <!-- Mobile Menu Button -->
            <button class="md:hidden mobile-menu-btn text-gray-600 hover:text-blue-600">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
    </div>
</nav>

    <!-- Mobile Menu -->
    <div class="mobile-menu md:hidden fixed top-0 left-0 w-full h-full bg-white transform -translate-x-full transition-transform duration-300 z-50">
        <div class="p-6">
            <div class="flex justify-between items-center mb-8">
                <div class="text-xl font-bold text-gray-800">Menu</div>
                <button class="mobile-menu-close text-gray-600 hover:text-red-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="space-y-6">
                <a href="{{ route('home') }}" class="block text-lg text-gray-600 hover:text-blue-600">Home</a>
                <a href="{{ route('about') }}" class="block text-lg text-gray-600 hover:text-blue-600">Tentang</a>
                <a href="{{ route('books.index') }}" class="block text-lg text-gray-600 hover:text-blue-600">Buku</a>
                <a href="{{ route('projects') }}" class="block text-lg text-gray-600 hover:text-blue-600">Proyek</a>
                <a href="{{ route('contact') }}" class="block text-lg text-gray-600 hover:text-blue-600">Kontak</a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>&copy; 2024 Profil Saya. All rights reserved.</p>
            <div class="mt-4 flex justify-center space-x-6">
                <a href="#" class="text-gray-300 hover:text-white transition-colors duration-300">
                    <i class="fab fa-linkedin fa-lg"></i>
                </a>
                <a href="#" class="text-gray-300 hover:text-white transition-colors duration-300">
                    <i class="fab fa-github fa-lg"></i>
                </a>
                <a href="#" class="text-gray-300 hover:text-white transition-colors duration-300">
                    <i class="fab fa-twitter fa-lg"></i>
                </a>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Mobile Menu Toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
            const mobileMenu = document.querySelector('.mobile-menu');
            const mobileMenuClose = document.querySelector('.mobile-menu-close');
            
            if (mobileMenuBtn && mobileMenu) {
                mobileMenuBtn.addEventListener('click', function() {
                    mobileMenu.classList.add('open');
                    mobileMenu.classList.remove('-translate-x-full');
                    document.body.style.overflow = 'hidden';
                });
                
                mobileMenuClose.addEventListener('click', function() {
                    mobileMenu.classList.remove('open');
                    mobileMenu.classList.add('-translate-x-full');
                    document.body.style.overflow = '';
                });
            }

            // Auto-hide alerts
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

         <!-- Back to Top Button -->
    <button id="backToTop" class="fixed bottom-8 right-8 bg-blue-600 text-white p-3 rounded-full shadow-lg opacity-0 invisible transition-all duration-300 hover:bg-blue-700 transform hover:scale-110 z-50">
        <i class="fas fa-chevron-up"></i>
    </button>

    <!-- JavaScript -->
    <script>
        // Mobile Menu Toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
            const mobileMenu = document.querySelector('.mobile-menu');
            const mobileMenuClose = document.querySelector('.mobile-menu-close');
            
            if (mobileMenuBtn && mobileMenu) {
                mobileMenuBtn.addEventListener('click', function() {
                    mobileMenu.classList.add('open');
                    mobileMenu.classList.remove('-translate-x-full');
                    document.body.style.overflow = 'hidden';
                });
                
                mobileMenuClose.addEventListener('click', function() {
                    mobileMenu.classList.remove('open');
                    mobileMenu.classList.add('-translate-x-full');
                    document.body.style.overflow = '';
                });
            }

            // Back to Top Button
            const backToTop = document.getElementById('backToTop');
            
            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    backToTop.classList.remove('opacity-0', 'invisible');
                    backToTop.classList.add('opacity-100', 'visible');
                } else {
                    backToTop.classList.remove('opacity-100', 'visible');
                    backToTop.classList.add('opacity-0', 'invisible');
                }
            });

            backToTop.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            // Auto-hide alerts
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
    @if(app()->environment('local'))
<div class="fixed bottom-4 left-4 bg-yellow-500 text-white px-3 py-1 rounded text-sm font-semibold z-50">
    Development Mode
</div>
@endif

    <!-- Google Analytics (Optional) -->
    @if(config('app.analytics_id'))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('app.analytics_id') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ config('app.analytics_id') }}');
    </script>
    @endif

    <!-- Custom JavaScript -->
    <script>
        // Track outbound links
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('a[href^="http"]').forEach(link => {
                link.addEventListener('click', function(e) {
                    if (!this.href.includes(window.location.hostname)) {
                        // Track external link click
                        console.log('Outbound link clicked:', this.href);
                    }
                });
            });
        });
    </script>
</body>
</html>
