@extends('layouts.app')

@section('title', 'Koleksi Buku')
@section('head')
<style>
    .book-card {
        transition: all 0.3s ease;
    }
    .book-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    .discount-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #ef4444;
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: bold;
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-purple-600 to-blue-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Koleksi Buku Saya</h1>
        <p class="text-xl md:text-2xl mb-8">Temukan buku-buku berkualitas untuk menambah wawasan Anda</p>
        <div class="flex justify-center space-x-4">
            <a href="#books" class="bg-white text-purple-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100">
                Jelajahi Buku
            </a>
            <a href="#categories" class="border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-purple-600">
                Lihat Kategori
            </a>
        </div>
    </div>
</section>

<!-- Featured Books -->
@if($featuredBooks->count() > 0)
<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-8">Buku Unggulan</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredBooks as $book)
            <div class="book-card bg-white rounded-lg shadow-md overflow-hidden">
                @if($book->has_discount)
                <div class="discount-badge">-{{ $book->discount_percentage }}%</div>
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
                    <a href="{{ route('books.show', $book) }}" 
                       class="block w-full bg-blue-600 text-white text-center py-2 rounded-lg hover:bg-blue-700 font-semibold">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Categories -->
<section id="categories" class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-8">Kategori Buku</h2>
        <div class="flex flex-wrap justify-center gap-3">
            @foreach($categories as $category)
            <a href="{{ route('books.byCategory', $category) }}" 
               class="bg-gray-100 text-gray-800 px-4 py-2 rounded-full hover:bg-blue-600 hover:text-white transition-colors">
                {{ $category }}
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- All Books -->
<section id="books" class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-8">Semua Buku</h2>
        
        <!-- Filter Options -->
        <div class="flex flex-wrap gap-4 mb-6 justify-center">
            <a href="{{ route('books.index') }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold">
                Semua
            </a>
            <a href="{{ route('books.index') }}?type=ebook" 
               class="bg-white text-gray-700 px-4 py-2 rounded-lg border hover:bg-gray-50 font-semibold">
                E-Book
            </a>
            <a href="{{ route('books.index') }}?type=physical" 
               class="bg-white text-gray-700 px-4 py-2 rounded-lg border hover:bg-gray-50 font-semibold">
                Buku Fisik
            </a>
        </div>

        @if($books->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($books as $book)
            <div class="book-card bg-white rounded-lg shadow-md overflow-hidden">
                @if($book->has_discount)
                <div class="discount-badge">-{{ $book->discount_percentage }}%</div>
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
                    </div>
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex flex-wrap gap-1">
                            @foreach(array_slice($book->categories, 0, 2) as $category)
                            <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">{{ $category }}</span>
                            @endforeach
                        </div>
                    </div>
                    <a href="{{ route('books.show', $book) }}" 
                       class="block w-full bg-blue-600 text-white text-center py-2 rounded-lg hover:bg-blue-700 font-semibold">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $books->links() }}
        </div>
        @else
        <div class="text-center py-12">
            <i class="fas fa-book-open text-4xl text-gray-300 mb-4"></i>
            <p class="text-gray-500 text-lg">Belum ada buku yang tersedia</p>
            <p class="text-gray-400 mt-2">Silakan check kembali lain waktu</p>
        </div>
        @endif
    </div>
</section>
<!-- Search Section -->
<section class="py-8 bg-white">
    <div class="max-w-4xl mx-auto px-4">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Cari Buku Favorit Anda</h2>
            <form method="GET" action="{{ route('books.index') }}" class="flex gap-4">
                <div class="flex-1">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Cari judul, penulis, atau kategori..."
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <button type="submit" 
                        class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-semibold">
                    <i class="fas fa-search mr-2"></i>Cari
                </button>
            </form>
        </div>
    </div>
</section>
<!-- Sorting Options -->
<div class="flex flex-wrap gap-4 mb-6 justify-between items-center">
    <div class="flex flex-wrap gap-4">
        <a href="{{ route('books.index') }}" 
           class="bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold">
            Semua
        </a>
        <a href="{{ route('books.index') }}?type=ebook" 
           class="bg-white text-gray-700 px-4 py-2 rounded-lg border hover:bg-gray-50 font-semibold">
            E-Book
        </a>
        <a href="{{ route('books.index') }}?type=physical" 
           class="bg-white text-gray-700 px-4 py-2 rounded-lg border hover:bg-gray-50 font-semibold">
            Buku Fisik
        </a>
    </div>
    
    <div class="flex items-center space-x-2">
        <span class="text-gray-700 font-semibold">Urutkan:</span>
        <select onchange="window.location.href = this.value" 
                class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="{{ route('books.index', ['sort' => 'newest'] + request()->except('sort')) }}" 
                    {{ request('sort', 'newest') == 'newest' ? 'selected' : '' }}>
                Terbaru
            </option>
            <option value="{{ route('books.index', ['sort' => 'title'] + request()->except('sort')) }}" 
                    {{ request('sort') == 'title' ? 'selected' : '' }}>
                Judul A-Z
            </option>
            <option value="{{ route('books.index', ['sort' => 'price_low'] + request()->except('sort')) }}" 
                    {{ request('sort') == 'price_low' ? 'selected' : '' }}>
                Harga Terendah
            </option>
            <option value="{{ route('books.index', ['sort' => 'price_high'] + request()->except('sort')) }}" 
                    {{ request('sort') == 'price_high' ? 'selected' : '' }}>
                Harga Tertinggi
            </option>
        </select>
    </div>
</div>
@endsection