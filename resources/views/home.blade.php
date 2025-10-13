@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<section class="hero-gradient text-white py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        @if($profile->photo ?? false)
        <img src="{{ asset('storage/' . $profile->photo) }}" 
             alt="{{ $profile->name }}" 
             class="w-32 h-32 rounded-full mx-auto mb-6 border-4 border-white">
        @endif
        <h1 class="text-4xl md:text-6xl font-bold mb-4">{{ $profile->name ?? 'Nama Anda' }}</h1>
        <p class="text-xl md:text-2xl mb-8">{{ $profile->title ?? 'Web Developer' }}</p>
        <div class="flex justify-center space-x-4">
            <a href="{{ route('contact') }}" class="btn-primary">
                Hubungi Saya
            </a>
            @if($profile->cv_path ?? false)
            <a href="{{ asset('storage/' . $profile->cv_path) }}" 
               class="border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition-all duration-300">
                Download CV
            </a>
            @endif
        </div>
    </div>
</section>

<!-- Featured Projects -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Proyek Unggulan</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($featuredProjects as $project)
            <div class="card-hover bg-gray-50 rounded-lg shadow-md overflow-hidden">
                @if($project->image)
                <img src="{{ asset('storage/' . $project->image) }}" 
                     alt="{{ $project->title }}" 
                     class="w-full h-48 object-cover">
                @endif
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">{{ $project->title }}</h3>
                    <p class="text-gray-600 mb-4">{{ Str::limit($project->description, 100) }}</p>
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach($project->technologies as $tech)
                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">{{ $tech }}</span>
                        @endforeach
                    </div>
                    <a href="{{ route('projects.show', $project->id) }}" 
                       class="text-blue-600 hover:text-blue-800 font-semibold">
                        Lihat Detail →
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-8">
                <p class="text-gray-500">Belum ada proyek unggulan</p>
            </div>
            @endforelse
        </div>
        <div class="text-center mt-8">
            <a href="{{ route('projects') }}" class="btn-primary">
                Lihat Semua Proyek
            </a>
        </div>
    </div>
</section>

<!-- Featured Books Section -->
@if($featuredBooks->count() > 0)
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900">Buku Unggulan</h2>
            <p class="text-xl text-gray-600 mt-4">Koleksi buku terbaik yang saya tulis</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredBooks as $book)
            <div class="book-card bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                @if($book->has_discount)
                <div class="absolute top-3 right-3 bg-red-500 text-white px-2 py-1 rounded text-sm font-bold z-10">
                    -{{ $book->discount_percentage }}%
                </div>
                @endif
                
                <div class="relative">
                    <img src="{{ $book->cover_image ? asset('storage/' . $book->cover_image) : '/images/book-placeholder.jpg' }}" 
                         alt="{{ $book->title }}" 
                         class="w-full h-48 object-cover">
                </div>
                
                <div class="p-4">
                    <h3 class="font-semibold text-lg mb-2 line-clamp-2">{{ $book->title }}</h3>
                    <p class="text-gray-600 text-sm mb-2">oleh {{ $book->author }}</p>
                    
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center space-x-2">
                            @if($book->has_discount)
                            <span class="text-lg font-bold text-green-600">Rp {{ number_format($book->discount_price, 0, ',', '.') }}</span>
                            <span class="text-sm text-gray-500 line-through">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                            @else
                            <span class="text-lg font-bold text-gray-900">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                            @endif
                        </div>
                        
                        @if($book->is_ebook)
                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">E-Book</span>
                        @else
                        <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">Physical</span>
                        @endif
                    </div>
                    
                    <div class="flex flex-wrap gap-1 mb-3">
                        @foreach(array_slice($book->categories, 0, 2) as $category)
                        <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">{{ $category }}</span>
                        @endforeach
                    </div>
                    
                    <a href="{{ route('books.show', $book) }}" 
                       class="block w-full bg-blue-600 text-white text-center py-2 rounded-lg hover:bg-blue-700 font-semibold transition-colors duration-300">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-8">
            <a href="{{ route('books.index') }}" class="btn-primary">
                <i class="fas fa-book mr-2"></i>
                Jelajahi Semua Buku
            </a>
        </div>
    </div>
</section>
@endif

<!-- Recent Books Section -->
@if($recentBooks->count() > 0)
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900">Buku Terbaru</h2>
            <p class="text-xl text-gray-600 mt-4">Koleksi buku terbaru yang tersedia</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($recentBooks as $book)
            <div class="book-card bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 border border-gray-200">
                <div class="flex">
                    <div class="w-1/3">
                        <img src="{{ $book->cover_image ? asset('storage/' . $book->cover_image) : '/images/book-placeholder.jpg' }}" 
                             alt="{{ $book->title }}" 
                             class="w-full h-40 object-cover">
                    </div>
                    
                    <div class="w-2/3 p-4">
                        <h3 class="font-semibold text-lg mb-2 line-clamp-2">{{ $book->title }}</h3>
                        <p class="text-gray-600 text-sm mb-2">oleh {{ $book->author }}</p>
                        
                        <div class="flex items-center justify-between mb-3">
                            @if($book->has_discount)
                            <div>
                                <span class="text-lg font-bold text-green-600">Rp {{ number_format($book->discount_price, 0, ',', '.') }}</span>
                                <span class="text-sm text-gray-500 line-through block">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                            </div>
                            @else
                            <span class="text-lg font-bold text-gray-900">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                            @endif
                        </div>
                        
                        <a href="{{ route('books.show', $book) }}" 
                           class="text-blue-600 hover:text-blue-800 font-semibold text-sm">
                            Lihat Detail →
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        @if($recentBooks->count() >= 6)
        <div class="text-center mt-8">
            <a href="{{ route('books.index') }}" class="bg-gray-800 text-white px-6 py-3 rounded-lg hover:bg-gray-900 font-semibold transition-colors duration-300">
                <i class="fas fa-arrow-right mr-2"></i>
                Lihat Lebih Banyak Buku
            </a>
        </div>
        @endif
    </div>
</section>
@endif

<!-- Call to Action Section -->
<section class="py-16 bg-gradient-to-r from-blue-600 to-purple-600 text-white">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Tertarik dengan Karya Saya?</h2>
        <p class="text-xl mb-8">Mari berkolaborasi dalam project menarik atau eksplorasi koleksi buku saya</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('contact') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors duration-300">
                <i class="fas fa-paper-plane mr-2"></i>
                Hubungi Saya
            </a>
            <a href="{{ route('books.index') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition-colors duration-300">
                <i class="fas fa-book mr-2"></i>
                Lihat Koleksi Buku
            </a>
        </div>
    </div>
</section>
@endsection

@section('head')
<style>
    .hero-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    .book-card {
        transition: all 0.3s ease;
    }
    .book-card:hover {
        transform: translateY(-5px);
    }
    .btn-primary {
        @apply bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-300 hover:bg-blue-700 hover:shadow-lg transform hover:-translate-y-1;
    }
</style>
@endsection