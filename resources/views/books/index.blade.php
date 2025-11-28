@extends('layouts.app')

@section('title', 'Koleksi Buku')

@section('head')
<style>
    .book-hover {
        transition: all .35s ease;
    }
    .book-hover:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 35px rgba(0,0,0,0.12);
    }
    .badge-discount {
        position: absolute;
        top: 12px;
        right: 12px;
        background: #ef4444;
        padding: 4px 10px;
        color: #fff;
        font-size: 12px;
        font-weight: 700;
        border-radius: 8px;
        box-shadow: 0 3px 8px rgba(239,68,68,.4);
    }
</style>
@endsection

@section('content')

<!-- HERO SECTION -->
<section class="bg-gradient-to-br from-purple-700 to-blue-700 text-white py-20">
    <div class="max-w-5xl mx-auto px-6 text-center">
        <h1 class="text-4xl md:text-6xl font-bold mb-4">Koleksi Buku</h1>
        <p class="text-lg md:text-xl opacity-95 mb-8">
            Jelajahi koleksi buku terbaik untuk meningkatkan wawasan dan kompetensi Anda.
        </p>

        <a href="#books" 
           class="inline-flex items-center bg-white text-blue-700 font-semibold px-8 py-3 rounded-xl hover:bg-gray-100 transition">
            Mulai Jelajah
        </a>
    </div>
</section>

<!-- SEARCH BAR -->
<section class="bg-white py-10 shadow-sm">
    <div class="max-w-4xl mx-auto px-6">
        <form action="{{ route('books.index') }}" method="GET" 
              class="flex gap-4 flex-col md:flex-row">
            
            <input type="text" 
                   name="search"
                   placeholder="Cari judul, penulis, kategori..."
                   value="{{ request('search') }}"
                   class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500">

            <button class="bg-blue-600 text-white px-8 py-3 rounded-xl hover:bg-blue-700 transition">
                <i class="fas fa-search mr-2"></i>
                Cari
            </button>
        </form>
    </div>
</section>

<!-- FILTERS -->
<section class="py-10 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 flex flex-wrap justify-between items-center gap-4">

        <div class="flex flex-wrap gap-3">
            <a href="{{ route('books.index') }}"
               class="px-4 py-2 rounded-lg font-semibold {{ !request('type') ? 'bg-blue-600 text-white' : 'bg-white border' }}">
                Semua
            </a>
            <a href="{{ route('books.index', ['type' => 'ebook']) }}"
               class="px-4 py-2 rounded-lg font-semibold {{ request('type') == 'ebook' ? 'bg-blue-600 text-white' : 'bg-white border' }}">
                E-Book
            </a>
            <a href="{{ route('books.index', ['type' => 'physical']) }}"
               class="px-4 py-2 rounded-lg font-semibold {{ request('type') == 'physical' ? 'bg-blue-600 text-white' : 'bg-white border' }}">
                Buku Fisik
            </a>
        </div>

        <div>
            <select onchange="window.location.href = this.value"
                    class="border px-4 py-2 rounded-lg shadow-sm focus:ring-blue-500">
                <option value="{{ route('books.index', ['sort' => 'newest'] + request()->except('sort')) }}"
                        {{ request('sort') == 'newest' ? 'selected' : '' }}>
                    Terbaru
                </option>

                <option value="{{ route('books.index', ['sort' => 'title'] + request()->except('sort')) }}"
                        {{ request('sort') == 'title' ? 'selected' : '' }}>
                    Judul A–Z
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
</section>

<!-- FEATURED BOOKS -->
@if($featuredBooks->count() > 0)
<section class="py-14 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-3xl font-bold text-center mb-10">Buku Unggulan</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
            
            @foreach($featuredBooks as $book)
            <div class="relative bg-white rounded-2xl shadow book-hover overflow-hidden">

                @if($book->has_discount)
                <div class="badge-discount">-{{ $book->discount_percentage }}%</div>
                @endif

                <img src="{{ $book->cover_image ? asset('storage/'.$book->cover_image) : '/images/book-placeholder.jpg' }}"
                     class="w-full h-60 object-cover">

                <div class="p-5">
                    <h3 class="font-bold text-lg mb-1">{{ $book->title }}</h3>
                    <p class="text-sm text-gray-500 mb-2">oleh {{ $book->author }}</p>

                    <div class="flex items-center gap-2 mb-3">
                        @if($book->has_discount)
                        <span class="font-bold text-green-600">Rp {{ number_format($book->discount_price, 0, ',', '.') }}</span>
                        <span class="text-gray-400 line-through">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                        @else
                        <span class="font-bold text-gray-900">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                        @endif
                    </div>

                    <a href="{{ route('books.show', $book) }}"
                       class="block bg-blue-600 text-white py-2 text-center rounded-lg hover:bg-blue-700 font-semibold">
                        Detail
                    </a>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
@endif


<!-- ALL BOOKS -->
<section id="books" class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">

        <h2 class="text-3xl font-bold text-center mb-12">Semua Buku</h2>

        @if($books->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10">

            @foreach($books as $book)
            <div class="relative bg-white rounded-2xl shadow book-hover overflow-hidden">

                @if($book->has_discount)
                <div class="badge-discount">-{{ $book->discount_percentage }}%</div>
                @endif

                <img src="{{ $book->cover_image ? asset('storage/'.$book->cover_image) : '/images/book-placeholder.jpg' }}"
                     class="w-full h-60 object-cover">

                <div class="p-5">
                    <h3 class="font-bold text-lg mb-1">{{ $book->title }}</h3>
                    <p class="text-sm text-gray-500 mb-2">oleh {{ $book->author }}</p>

                    <div class="flex items-center justify-between mb-3">
                        @if($book->has_discount)
                        <div>
                            <span class="font-bold text-green-600">Rp {{ number_format($book->discount_price, 0, ',', '.') }}</span>
                            <span class="text-gray-400 line-through text-xs">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                        </div>
                        @else
                        <span class="font-bold text-gray-900">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                        @endif
                    </div>

                    <div class="flex flex-wrap gap-1 mb-3">
                        @foreach(array_slice($book->categories, 0, 2) as $category)
                        <span class="text-xs bg-gray-100 px-2 py-1 rounded">{{ $category }}</span>
                        @endforeach
                    </div>

                    <a href="{{ route('books.show', $book) }}"
                       class="block bg-blue-600 text-white text-center py-2 rounded-lg hover:bg-blue-700 font-semibold">
                        Detail
                    </a>
                </div>
            </div>
            @endforeach

        </div>

        <div class="mt-10">
            {{ $books->links() }}
        </div>

        @else
        <div class="text-center py-20">
            <i class="fas fa-book-open text-gray-400 text-5xl mb-3"></i>
            <p class="text-gray-600 text-lg">Belum ada buku tersedia.</p>
        </div>
        @endif

    </div>
</section>

@endsection
