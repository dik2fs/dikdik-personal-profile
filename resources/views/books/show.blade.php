@extends('layouts.app')

@section('title', $book->title)

@section('head')
<style>
    .book-img {
        transition: all .35s ease;
    }
    .book-img:hover {
        transform: scale(1.05);
    }
    .discount-badge {
        position: absolute;
        top: 16px;
        right: 16px;
        background: #ef4444;
        color: white;
        padding: 6px 12px;
        font-weight: 700;
        font-size: 14px;
        border-radius: 8px;
        box-shadow: 0 3px 8px rgba(0,0,0,.3);
    }
</style>
@endsection

@section('content')

<!-- HEADER -->
<section class="bg-gradient-to-br from-blue-700 to-purple-700 text-white py-20 mb-10">
    <div class="max-w-5xl mx-auto px-6">
        <a href="{{ route('books.index') }}" 
           class="inline-flex items-center text-white/80 hover:text-white mb-6">
            <i class="fas fa-chevron-left mr-2 text-sm"></i> Kembali ke Buku
        </a>

        <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mb-4">
            {{ $book->title }}
        </h1>

        <p class="text-lg opacity-90">
            oleh <strong>{{ $book->author }}</strong>
        </p>
    </div>
</section>


<!-- MAIN DETAILS -->
<section class="pb-20">
    <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-12">

        <!-- Book Image -->
        <div class="relative flex justify-center">
            <div class="relative bg-white p-6 rounded-2xl shadow-xl w-full max-w-md">
                <img src="{{ $book->cover_image ? asset('storage/'.$book->cover_image) : '/images/book-placeholder.jpg' }}"
                     class="book-img w-full h-[430px] object-contain rounded-xl"
                     alt="{{ $book->title }}">

                @if($book->discount_price && $book->discount_price < $book->price)
                <div class="discount-badge">
                    -{{ round((($book->price - $book->discount_price) / $book->price) * 100) }}%
                </div>
                @endif
            </div>
        </div>


        <!-- Book Information -->
        <div class="space-y-6">

            <!-- Title -->
            <div>
                <h2 class="text-3xl font-bold mb-2">{{ $book->title }}</h2>
                <p class="text-lg text-gray-600">oleh {{ $book->author }}</p>
            </div>

            <!-- Categories -->
            <div class="flex flex-wrap gap-2">
                @foreach($book->categories as $category)
                <span class="px-3 py-1 text-sm bg-blue-100 text-blue-700 rounded-full">
                    {{ $category }}
                </span>
                @endforeach
            </div>

            <!-- Price -->
            <div class="flex items-center gap-4">
                @if($book->discount_price)
                <span class="text-4xl font-bold text-green-600">
                    Rp {{ number_format($book->discount_price, 0, ',', '.') }}
                </span>
                <span class="text-xl text-gray-400 line-through">
                    Rp {{ number_format($book->price, 0, ',', '.') }}
                </span>
                @else
                <span class="text-4xl font-bold text-gray-900">
                    Rp {{ number_format($book->price, 0, ',', '.') }}
                </span>
                @endif
            </div>

            <!-- Type Badge -->
            <div>
                @if($book->is_ebook)
                <span class="px-4 py-2 bg-blue-100 text-blue-700 rounded-full font-semibold">
                    📘 E-Book
                </span>
                @else
                <span class="px-4 py-2 bg-green-100 text-green-700 rounded-full font-semibold">
                    📗 Buku Fisik
                </span>
                @endif
            </div>

            <!-- Book Metadata -->
            <div class="grid grid-cols-2 gap-4 bg-gray-50 p-6 rounded-xl">
                @if($book->publisher)
                <div>
                    <p class="font-semibold text-gray-700">Penerbit</p>
                    <p class="text-gray-600">{{ $book->publisher }}</p>
                </div>
                @endif

                <div>
                    <p class="font-semibold text-gray-700">Bahasa</p>
                    <p class="text-gray-600">{{ $book->language }}</p>
                </div>

                @if($book->pages)
                <div>
                    <p class="font-semibold text-gray-700">Halaman</p>
                    <p class="text-gray-600">{{ $book->pages }} halaman</p>
                </div>
                @endif

                @if($book->published_date)
                <div>
                    <p class="font-semibold text-gray-700">Terbit</p>
                    <p class="text-gray-600">
                        {{ \Carbon\Carbon::parse($book->published_date)->format('d F Y') }}
                    </p>
                </div>
                @endif

                @if($book->isbn)
                <div>
                    <p class="font-semibold text-gray-700">ISBN</p>
                    <p class="text-gray-600 font-mono">{{ $book->isbn }}</p>
                </div>
                @endif

                @if(!$book->is_ebook)
                <div>
                    <p class="font-semibold text-gray-700">Stok</p>
                    <p class="{{ $book->stock > 0 ? 'text-green-600' : 'text-red-600' }} font-semibold">
                        {{ $book->stock > 0 ? 'Tersedia ('.$book->stock.')' : 'Habis' }}
                    </p>
                </div>
                @endif
            </div>

            <!-- ACTION BUTTON -->
            <div class="pt-4">
                @if($book->is_available && ($book->is_ebook || $book->stock > 0))
                    <button onclick="openOrderModal()"
                            class="w-full text-lg font-semibold bg-green-600 text-white py-4 rounded-xl hover:bg-green-700 transition">
                        <i class="fab fa-whatsapp mr-2"></i> Pesan via WhatsApp
                    </button>
                @else
                    <div class="p-4 bg-yellow-100 text-yellow-700 rounded-xl text-center font-semibold">
                        Buku tidak tersedia
                    </div>
                @endif
            </div>

        </div>
    </div>
</section>


<!-- DESCRIPTION SECTION -->
<section class="py-16 bg-gray-50">
    <div class="max-w-5xl mx-auto px-6">
        <h2 class="text-2xl font-bold mb-4">Deskripsi Buku</h2>
        <div class="bg-white p-6 rounded-xl shadow">
            <p class="text-gray-700 leading-relaxed whitespace-pre-line">
                {{ $book->description }}
            </p>
        </div>
    </div>
</section>


<!-- RELATED BOOKS -->
@if(isset($relatedBooks) && $relatedBooks->count() > 0)
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-2xl font-bold mb-10">Buku Lainnya</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">

            @foreach($relatedBooks as $related)
            <a href="{{ route('books.show', $related) }}"
               class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition">
                <img src="{{ $related->cover_image ? asset('storage/'.$related->cover_image) : '/images/book-placeholder.jpg' }}"
                     class="w-full h-56 object-cover">
                <div class="p-4">
                    <h3 class="font-semibold text-lg mb-1">{{ $related->title }}</h3>
                    <p class="text-sm text-gray-600">oleh {{ $related->author }}</p>
                </div>
            </a>
            @endforeach

        </div>
    </div>
</section>
@endif


<!-- MODAL UNTUK ORDER -->
<div id="orderModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl p-6 max-w-md w-full mx-4">

        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold">Pesan Buku</h3>
            <button onclick="closeOrderModal()" class="text-gray-600 hover:text-black">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <form id="orderForm">
            @csrf

            <div class="space-y-4">

                <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl">
                    <img src="{{ $book->cover_image ? asset('storage/'.$book->cover_image) : '' }}"
                         class="w-16 h-20 object-cover rounded">

                    <div>
                        <p class="font-semibold">{{ $book->title }}</p>

                        <p class="font-bold text-green-600">
                            Rp {{ number_format($book->discount_price ?: $book->price, 0, ',', '.') }}
                        </p>
                    </div>
                </div>

                <input type="text" id="name" placeholder="Nama lengkap"
                       class="w-full p-3 border rounded-lg" required>

                <input type="text" id="phone" placeholder="Nomor WhatsApp"
                       class="w-full p-3 border rounded-lg" required>

                @if(!$book->is_ebook)
                <textarea id="address" rows="3" placeholder="Alamat lengkap"
                          class="w-full p-3 border rounded-lg" required></textarea>
                @endif
            </div>

            <button type="submit"
                    class="mt-6 w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700">
                Kirim ke WhatsApp
            </button>
        </form>

    </div>
</div>

<script>
    function openOrderModal() {
        document.getElementById('orderModal').classList.remove('hidden');
    }

    function closeOrderModal() {
        document.getElementById('orderModal').classList.add('hidden');
    }

    document.getElementById('orderForm').onsubmit = function (e) {
        e.preventDefault();

        const name = document.getElementById('name').value;
        const phone = document.getElementById('phone').value;

        const message = `Halo, saya ingin memesan buku:\n` +
                        `Judul: {{ $book->title }}\n` +
                        `Nama: ${name}\n` +
                        `WA: ${phone}`;

        const url = "https://wa.me/6281311203436?text=" + encodeURIComponent(message);
        window.open(url, "_blank");

        closeOrderModal();
    }
</script>

@endsection
