@extends('layouts.app')

@section('title', 'Home')

@section('content')

<!-- ========================= -->
<!-- HERO SECTION (Modern) -->
<!-- ========================= -->
<section class="relative bg-gradient-to-br from-blue-600 to-purple-700 text-white pt-24 pb-32 overflow-hidden">
    <div class="absolute inset-0 opacity-20 bg-[url('https://www.toptal.com/designers/subtlepatterns/uploads/double-bubble-outline.png')]"></div>

    <div class="max-w-6xl mx-auto px-5 relative z-10 text-center">

        @if($profile->photo ?? false)
        <img src="{{ asset('storage/' . $profile->photo) }}"
             alt="{{ $profile->name }}"
             class="w-36 h-36 rounded-full mx-auto mb-6 ring-4 ring-white shadow-xl object-cover">
        @endif

        <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight drop-shadow-sm">
            {{ $profile->name ?? 'Nama Anda' }}
        </h1>

        <p class="text-xl md:text-2xl opacity-90 mt-4 font-light">
            {{ $profile->title ?? 'Web Developer' }}
        </p>

        <div class="mt-10 flex flex-wrap justify-center gap-4">
            <a href="{{ route('contact') }}"
               class="px-8 py-3 rounded-xl font-semibold bg-white text-blue-700 shadow hover:bg-gray-100 transition-all">
               Hubungi Saya
            </a>

            @if($profile->cv_path ?? false)
            <a href="{{ asset('storage/' . $profile->cv_path) }}"
               class="px-8 py-3 rounded-xl font-semibold border-2 border-white text-white hover:bg-white hover:text-blue-700 transition-all">
               Download CV
            </a>
            @endif
        </div>
    </div>

    <!-- Decorative Blur Balls -->
    <div class="absolute top-10 right-10 w-40 h-40 bg-white/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-10 left-10 w-48 h-48 bg-purple-400/30 rounded-full blur-3xl"></div>
</section>


<!-- ========================= -->
<!-- FEATURED PROJECTS -->
<!-- ========================= -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">

        <h2 class="text-3xl font-bold text-center mb-14">
            Proyek Unggulan
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            @forelse($featuredProjects as $project)
            <div class="group bg-white rounded-2xl shadow-lg overflow-hidden transform transition-all hover:-translate-y-2 hover:shadow-2xl">

                @if($project->image)
                <img src="{{ asset('storage/' . $project->image) }}"
                     class="w-full h-48 object-cover group-hover:scale-105 transition-all duration-500">
                @endif

                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">{{ $project->title }}</h3>
                    <p class="text-gray-600 mb-4">{{ Str::limit($project->description, 100) }}</p>

                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach($project->technologies as $tech)
                        <span class="bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-lg">
                            {{ $tech }}
                        </span>
                        @endforeach
                    </div>

                    <a href="{{ route('projects.show', $project->id) }}"
                       class="text-blue-600 font-medium hover:underline">
                       Lihat Detail →
                    </a>
                </div>
            </div>
            @empty
            <p class="text-gray-500 text-center col-span-3">Belum ada data proyek.</p>
            @endforelse
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('projects') }}"
               class="px-8 py-3 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-700 transition">
               Lihat Semua Proyek
            </a>
        </div>
    </div>
</section>



<!-- ========================= -->
<!-- FEATURED BOOKS -->
<!-- ========================= -->
@if($featuredBooks->count() > 0)
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">

        <h2 class="text-3xl font-bold text-center mb-12">
            Buku Unggulan
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

            @foreach($featuredBooks as $book)
            <div class="relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all overflow-hidden group">

                @if($book->has_discount)
                <span class="absolute top-3 right-3 bg-red-600 text-white text-sm px-3 py-1 rounded-md z-10">
                    -{{ $book->discount_percentage }}%
                </span>
                @endif

                <img src="{{ $book->cover_image ? asset('storage/' . $book->cover_image) : '/images/book-placeholder.jpg' }}"
                     class="w-full h-52 object-cover group-hover:scale-105 transition-all">

                <div class="p-5">
                    <h3 class="font-bold text-lg mb-1 line-clamp-2">{{ $book->title }}</h3>
                    <p class="text-gray-600 text-sm mb-3">oleh {{ $book->author }}</p>

                    <div class="flex items-center justify-between mb-4">
                        @if($book->has_discount)
                        <div>
                            <span class="text-green-600 font-bold text-lg">
                                Rp {{ number_format($book->discount_price,0,',','.') }}
                            </span>
                            <span class="line-through text-gray-400 text-sm">
                                Rp {{ number_format($book->price,0,',','.') }}
                            </span>
                        </div>
                        @else
                        <span class="text-gray-900 font-semibold text-lg">
                            Rp {{ number_format($book->price,0,',','.') }}
                        </span>
                        @endif
                    </div>

                    <a href="{{ route('books.show', $book) }}"
                       class="block w-full text-center bg-blue-600 text-white py-2 rounded-xl font-semibold hover:bg-blue-700 transition">
                       Lihat Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-10 text-center">
            <a href="{{ route('books.index') }}"
               class="px-8 py-3 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-700 transition">
               Jelajahi Semua Buku
            </a>
        </div>

    </div>
</section>
@endif



<!-- ========================= -->
<!-- RECENT BOOKS -->
<!-- ========================= -->
@if($recentBooks->count() > 0)
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">

        <h2 class="text-3xl font-bold text-center mb-12">
            Buku Terbaru
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">

            @foreach($recentBooks as $book)
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all overflow-hidden flex">

                <img src="{{ $book->cover_image ? asset('storage/' . $book->cover_image) : '/images/book-placeholder.jpg' }}"
                     class="w-1/3 h-full object-cover">

                <div class="p-5 w-2/3">
                    <h3 class="font-semibold text-lg line-clamp-2">{{ $book->title }}</h3>
                    <p class="text-gray-600 text-sm mb-2">oleh {{ $book->author }}</p>

                    <div class="mt-3 mb-4">
                        @if($book->has_discount)
                        <span class="text-green-600 font-bold text-lg">Rp {{ number_format($book->discount_price,0,',','.') }}</span>
                        <span class="text-gray-400 line-through text-sm">Rp {{ number_format($book->price,0,',','.') }}</span>
                        @else
                        <span class="text-gray-900 font-bold text-lg">Rp {{ number_format($book->price,0,',','.') }}</span>
                        @endif
                    </div>

                    <a href="{{ route('books.show', $book) }}"
                       class="text-blue-600 hover:text-blue-800 text-sm font-semibold">
                        Lihat Detail →
                    </a>
                </div>

            </div>
            @endforeach
        </div>

        @if($recentBooks->count() >= 6)
        <div class="text-center mt-12">
            <a href="{{ route('books.index') }}"
               class="px-8 py-3 bg-gray-900 text-white rounded-xl font-semibold hover:bg-black transition">
               Lihat Lebih Banyak Buku
            </a>
        </div>
        @endif

    </div>
</section>
@endif




<!-- ========================= -->
<!-- CTA SECTION -->
<!-- ========================= -->
<section class="py-20 bg-gradient-to-r from-blue-600 to-purple-600 text-white text-center">
    <div class="max-w-3xl mx-auto px-6">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Tertarik dengan Karya Saya?</h2>
        <p class="text-lg md:text-xl opacity-90 mb-8">Mari berkolaborasi atau eksplorasi karya terbaru saya</p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('contact') }}"
               class="px-8 py-3 bg-white text-blue-700 rounded-xl font-semibold hover:bg-gray-100 transition">
               Hubungi Saya
            </a>

            <a href="{{ route('books.index') }}"
               class="px-8 py-3 border-2 border-white rounded-xl font-semibold hover:bg-white hover:text-blue-600 transition">
               Lihat Koleksi Buku
            </a>
        </div>
    </div>
</section>

@endsection


@section('head')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection
