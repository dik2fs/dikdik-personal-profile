@extends('layouts.app')

@section('title', $book->title)

@section('head')
<style>
    .book-detail-image {
        max-height: 500px;
        object-fit: contain;
    }
    .category-tag {
        @apply inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium;
    }
</style>
@endsection

@section('content')
<section class="py-12 bg-white">
    <div class="max-w-6xl mx-auto px-4">
        <!-- Breadcrumb -->
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 text-sm">
                <li>
                    <a href="{{ route('home') }}" class="text-gray-500 hover:text-gray-700">Home</a>
                </li>
                <li class="flex items-center">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <a href="{{ route('books.index') }}" class="ml-2 text-gray-500 hover:text-gray-700">Buku</a>
                </li>
                <li class="flex items-center">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="ml-2 text-gray-900 font-medium">{{ Str::limit($book->title, 30) }}</span>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Book Image -->
            <div class="flex justify-center">
                <div class="relative">
                    <img src="{{ $book->cover_image ? asset('storage/' . $book->cover_image) : '/images/book-placeholder.jpg' }}" 
                         alt="{{ $book->title }}" 
                         class="book-detail-image rounded-lg shadow-lg w-full">
                    @if($book->discount_price && $book->discount_price < $book->price)
                    <div class="absolute top-4 right-4 bg-red-500 text-white px-3 py-1 rounded-lg font-bold text-lg">
                        -{{ round((($book->price - $book->discount_price) / $book->price) * 100) }}%
                    </div>
                    @endif
                </div>
            </div>

            <!-- Book Details -->
            <div class="space-y-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $book->title }}</h1>
                    <p class="text-xl text-gray-600 mb-4">oleh <span class="font-semibold">{{ $book->author }}</span></p>
                    
                    <!-- Categories -->
                    <div class="flex flex-wrap gap-2 mb-4">
                        @if(is_array($book->categories))
                            @foreach($book->categories as $category)
                            <span class="category-tag">
                                {{ $category }}
                            </span>
                            @endforeach
                        @else
                            <span class="category-tag">
                                {{ $book->categories }}
                            </span>
                        @endif
                    </div>

                    <!-- Price -->
                    <div class="flex items-center space-x-4 mb-4">
                        @if($book->discount_price && $book->discount_price < $book->price)
                        <span class="text-3xl font-bold text-green-600">Rp {{ number_format($book->discount_price, 0, ',', '.') }}</span>
                        <span class="text-xl text-gray-500 line-through">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                        @else
                        <span class="text-3xl font-bold text-gray-900">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                        @endif
                    </div>

                    <!-- Book Type Badge -->
                    <div class="mb-6">
                        @if($book->is_ebook)
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full font-semibold">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            E-Book
                        </span>
                        @else
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full font-semibold">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            Buku Fisik
                        </span>
                        @endif
                    </div>
                </div>

                <!-- Book Info -->
                <div class="grid grid-cols-2 gap-4 text-sm">
                    @if($book->publisher)
                    <div>
                        <span class="font-semibold text-gray-700">Penerbit:</span>
                        <p class="text-gray-600">{{ $book->publisher }}</p>
                    </div>
                    @endif
                    
                    @if($book->pages)
                    <div>
                        <span class="font-semibold text-gray-700">Halaman:</span>
                        <p class="text-gray-600">{{ number_format($book->pages) }} halaman</p>
                    </div>
                    @endif
                    
                    @if($book->published_date)
                    <div>
                        <span class="font-semibold text-gray-700">Tanggal Terbit:</span>
                        <p class="text-gray-600">{{ \Carbon\Carbon::parse($book->published_date)->format('d F Y') }}</p>
                    </div>
                    @endif
                    
                    <div>
                        <span class="font-semibold text-gray-700">Bahasa:</span>
                        <p class="text-gray-600">{{ $book->language }}</p>
                    </div>

                    @if($book->isbn)
                    <div>
                        <span class="font-semibold text-gray-700">ISBN:</span>
                        <p class="font-mono text-gray-600">{{ $book->isbn }}</p>
                    </div>
                    @endif

                    @if(!$book->is_ebook)
                    <div>
                        <span class="font-semibold text-gray-700">Stok:</span>
                        <p class="text-gray-600 {{ $book->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $book->stock > 0 ? 'Tersedia (' . $book->stock . ')' : 'Habis' }}
                        </p>
                    </div>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="space-y-4 pt-6 border-t border-gray-200">
                    @if($book->is_available && ($book->is_ebook || $book->stock > 0))
                    <!-- Order Modal Trigger -->
                    <button onclick="openOrderModal()" 
                            class="w-full bg-green-600 text-white text-center py-3 px-6 rounded-lg hover:bg-green-700 font-semibold text-lg transition-colors">
                        <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.867-.273 0-.42.463-.977.463-.556 0-.768-.463-.977-.463-.21 0-1.733.718-2.03.867-.298.15-.472.44-.472.762s.174.612.472.762c.297.149 1.758.867 2.03.867.273 0 .42-.463.977-.463.556 0 .768.463.977.463.21 0 1.733-.718 2.03-.867.298-.15.472-.44.472-.762s-.174-.612-.472-.762zm-5.5-2.382h-2v-1h2v1zm7.5 0v1h-2v-1h2zm-14 0h2v1h-2v-1z"/>
                            <path d="M12 2c-4.418 0-8 3.582-8 8s3.582 8 8 8 8-3.582 8-8-3.582-8-8-8zm0 14.5c-3.59 0-6.5-2.91-6.5-6.5s2.91-6.5 6.5-6.5 6.5 2.91 6.5 6.5-2.91 6.5-6.5 6.5z"/>
                        </svg>
                        Pesan via WhatsApp
                    </button>
                    @else
                    <div class="bg-yellow-100 border border-yellow-400 text-yellow-800 px-4 py-3 rounded">
                        <p class="font-semibold">Maaf, buku ini sedang tidak tersedia</p>
                    </div>
                    @endif

                    <!-- Share Buttons -->
                    <div class="flex space-x-2 justify-center">
                        <span class="text-gray-700 font-semibold">Bagikan:</span>
                        <a href="#" class="text-blue-600 hover:text-blue-800">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-blue-400 hover:text-blue-600">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723 10.016 10.016 0 01-3.127 1.195A4.92 4.92 0 0011.9 8.034a13.98 13.98 0 01-10.15-5.144 4.929 4.929 0 001.523 6.57 4.903 4.903 0 01-2.23-.616v.062a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.937 4.937 0 004.6 3.42 9.868 9.868 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.99 13.99 0 007.557 2.213c9.054 0 13.999-7.496 13.999-13.986 0-.209 0-.42-.015-.63a9.936 9.936 0 002.46-2.543l-.047-.02z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Description Section -->
        <div class="mt-12">
            <h2 class="text-2xl font-bold mb-4">Deskripsi Buku</h2>
            <div class="bg-gray-50 p-6 rounded-lg">
                <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $book->description }}</p>
            </div>
        </div>

        <!-- Related Books -->
        @if(isset($relatedBooks) && $relatedBooks->count() > 0)
        <div class="mt-12">
            <h2 class="text-2xl font-bold mb-6">Buku Lainnya</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedBooks as $relatedBook)
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:scale-105">
                    <a href="{{ route('books.show', $relatedBook) }}">
                        <img src="{{ $relatedBook->cover_image ? asset('storage/' . $relatedBook->cover_image) : '/images/book-placeholder.jpg' }}" 
                             alt="{{ $relatedBook->title }}" 
                             class="w-full h-48 object-cover">
                    </a>
                    <div class="p-4">
                        <h3 class="font-semibold text-lg mb-2 line-clamp-2">
                            <a href="{{ route('books.show', $relatedBook) }}" class="hover:text-blue-600">
                                {{ $relatedBook->title }}
                            </a>
                        </h3>
                        <p class="text-gray-600 text-sm mb-2">oleh {{ $relatedBook->author }}</p>
                        <div class="flex items-center justify-between">
                            @if($relatedBook->discount_price && $relatedBook->discount_price < $relatedBook->price)
                            <span class="font-bold text-green-600">Rp {{ number_format($relatedBook->discount_price, 0, ',', '.') }}</span>
                            <span class="text-xs text-red-500 font-semibold">-{{ round((($relatedBook->price - $relatedBook->discount_price) / $relatedBook->price) * 100) }}%</span>
                            @else
                            <span class="font-bold text-green-600">Rp {{ number_format($relatedBook->price, 0, ',', '.') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>

<!-- Order Modal -->
<div id="orderModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold">Pesan Buku</h3>
            <button onclick="closeOrderModal()" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <form id="orderForm" action="{{ route('orders.store') }}" method="POST">
            @csrf
            <input type="hidden" name="book_id" value="{{ $book->id }}">
            
            <div class="space-y-4">
                <!-- Book Info -->
                <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg">
                    <img src="{{ $book->cover_image ? asset('storage/' . $book->cover_image) : '/images/book-placeholder.jpg' }}" 
                         alt="{{ $book->title }}" 
                         class="w-16 h-20 object-cover rounded">
                    <div>
                        <h4 class="font-semibold">{{ $book->title }}</h4>
                        <p class="text-green-600 font-bold">
                            Rp {{ number_format($book->discount_price && $book->discount_price < $book->price ? $book->discount_price : $book->price, 0, ',', '.') }}
                        </p>
                        <p class="text-sm text-gray-600">{{ $book->is_ebook ? 'E-book' : 'Buku Fisik' }}</p>
                    </div>
                </div>
                
                <!-- Customer Information -->
                <div class="space-y-3">
                    <h4 class="font-semibold text-gray-900">Informasi Pemesan</h4>
                    
                    <div>
                        <label for="customer_name" class="block text-sm font-medium text-gray-700">Nama Lengkap *</label>
                        <input type="text" id="customer_name" name="customer_name" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="customer_phone" class="block text-sm font-medium text-gray-700">Nomor WhatsApp *</label>
                        <input type="tel" id="customer_phone" name="customer_phone" required
                               placeholder="628123456789"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="customer_email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="customer_email" name="customer_email"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    @if(!$book->is_ebook)
                    <div>
                        <label for="customer_address" class="block text-sm font-medium text-gray-700">Alamat Pengiriman *</label>
                        <textarea id="customer_address" name="customer_address" rows="3" required
                                  class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Alamat lengkap untuk pengiriman"></textarea>
                    </div>
                    @endif

                    <div>
                        <label for="quantity" class="block text-sm font-medium text-gray-700">Jumlah *</label>
                        <select id="quantity" name="quantity" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            @for($i = 1; $i <= ($book->is_ebook ? 10 : min($book->stock, 10)); $i++)
                                <option value="{{ $i }}">{{ $i }} {{ $book->is_ebook ? 'E-book' : 'Buku' }}</option>
                            @endfor
                        </select>
                    </div>

                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700">Catatan (opsional)</label>
                        <textarea id="notes" name="notes" rows="2"
                                  class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Pertanyaan atau catatan khusus..."></textarea>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full bg-green-600 text-white py-3 px-4 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 font-semibold transition-colors">
                    <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.867-.273 0-.42.463-.977.463-.556 0-.768-.463-.977-.463-.21 0-1.733.718-2.03.867-.298.15-.472.44-.472.762s.174.612.472.762c.297.149 1.758.867 2.03.867.273 0 .42-.463.977-.463.556 0 .768.463.977.463.21 0 1.733-.718 2.03-.867.298-.15.472-.44.472-.762s-.174-.612-.472-.762zm-5.5-2.382h-2v-1h2v1zm7.5 0v1h-2v-1h2zm-14 0h2v1h-2v-1z"/>
                        <path d="M12 2c-4.418 0-8 3.582-8 8s3.582 8 8 8 8-3.582 8-8-3.582-8-8-8zm0 14.5c-3.59 0-6.5-2.91-6.5-6.5s2.91-6.5 6.5-6.5 6.5 2.91 6.5 6.5-2.91 6.5-6.5 6.5z"/>
                    </svg>
                    Lanjutkan ke WhatsApp
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openOrderModal() {
        document.getElementById('orderModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    
    function closeOrderModal() {
        document.getElementById('orderModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
    
    // Close modal when clicking outside
    document.getElementById('orderModal').addEventListener('click', function(e) {
        if (e.target.id === 'orderModal') {
            closeOrderModal();
        }
    });

    // Prevent body scroll when modal is open
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeOrderModal();
        }
    });

    // Form submission handler
    document.getElementById('orderForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const phone = document.getElementById('customer_phone').value;
        const name = document.getElementById('customer_name').value;
        const quantity = document.getElementById('quantity').value;
        const bookTitle = "{{ $book->title }}";
        const price = {{ $book->discount_price && $book->discount_price < $book->price ? $book->discount_price : $book->price }};
        const total = price * quantity;
        
        const message = `Halo, saya ingin memesan buku:\n\n` +
                       `📚 *${bookTitle}*\n` +
                       `💰 Harga: Rp ${price.toLocaleString('id-ID')}\n` +
                       `📦 Jumlah: ${quantity}\n` +
                       `💵 Total: Rp ${total.toLocaleString('id-ID')}\n\n` +
                       `*Data Pemesan:*\n` +
                       `Nama: ${name}\n` +
                       `WhatsApp: ${phone}`;
        
        const whatsappUrl = `https://wa.me/6281311203436?text=${encodeURIComponent(message)}`;
        window.open(whatsappUrl, '_blank');
        
        closeOrderModal();
    });
</script>
@endsection