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
                    <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                    <a href="{{ route('books.index') }}" class="ml-2 text-gray-500 hover:text-gray-700">Buku</a>
                </li>
                <li class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
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
                         class="book-detail-image rounded-lg shadow-lg">
                    @if($book->has_discount)
                    <div class="absolute top-4 right-4 bg-red-500 text-white px-3 py-1 rounded-lg font-bold text-lg">
                        -{{ $book->discount_percentage }}%
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
                        @foreach($book->categories as $category)
                        <a href="{{ route('books.byCategory', $category) }}" class="category-tag hover:bg-blue-200">
                            {{ $category }}
                        </a>
                        @endforeach
                    </div>

                    <!-- Price -->
                    <div class="flex items-center space-x-4 mb-4">
                        @if($book->has_discount)
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
                            <i class="fas fa-file-pdf mr-1"></i>E-Book
                        </span>
                        @else
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full font-semibold">
                            <i class="fas fa-book mr-1"></i>Buku Fisik
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
                        <p class="text-gray-600">{{ $book->published_date->format('d F Y') }}</p>
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
            class="w-full bg-green-600 text-white text-center py-3 px-6 rounded-lg hover:bg-green-700 font-semibold text-lg">
        <i class="fab fa-whatsapp mr-2"></i>
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
            <i class="fab fa-facebook"></i>
        </a>
        <a href="#" class="text-blue-400 hover:text-blue-600">
            <i class="fab fa-twitter"></i>
        </a>
        <a href="#" class="text-red-500 hover:text-red-700">
            <i class="fab fa-pinterest"></i>
        </a>
    </div>
</div>

<!-- Order Modal -->
<div id="orderModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold">Pesan Buku</h3>
            <button onclick="closeOrderModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
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
                        <p class="text-green-600 font-bold">Rp {{ number_format($book->final_price, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-600">{{ $book->is_ebook ? 'E-book' : 'Buku Fisik' }}</p>
                    </div>
                </div>
                
                <!-- Order Type -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Pesanan</label>
                    <div class="grid grid-cols-2 gap-2">
                        <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="type" value="ebook" {{ $book->is_ebook ? 'checked' : '' }} class="text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm font-medium">E-book</span>
                        </label>
                        <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="type" value="physical" {{ !$book->is_ebook ? 'checked' : '' }} class="text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm font-medium">Buku Fisik</span>
                        </label>
                    </div>
                </div>

                <!-- Quantity -->
                <div>
                    <label for="quantity" class="block text-sm font-medium text-gray-700">Jumlah</label>
                    <select id="quantity" name="quantity" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @for($i = 1; $i <= ($book->is_ebook ? 10 : min($book->stock, 10)); $i++)
                            <option value="{{ $i }}">{{ $i }} {{ $book->is_ebook ? 'E-book' : 'Buku' }}</option>
                        @endfor
                    </select>
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

                    <div id="addressField" style="{{ $book->is_ebook ? 'display: none;' : '' }}">
                        <label for="customer_address" class="block text-sm font-medium text-gray-700">Alamat Pengiriman</label>
                        <textarea id="customer_address" name="customer_address" rows="3"
                                  class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Untuk pengiriman buku fisik"></textarea>
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
                        class="w-full bg-green-600 text-white py-3 px-4 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 font-semibold">
                    <i class="fab fa-whatsapp mr-2"></i>
                    Lanjutkan ke WhatsApp
                </button>
            </div>
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
    
    // Toggle address field based on order type
    document.querySelectorAll('input[name="type"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const addressField = document.getElementById('addressField');
            if (this.value === 'physical') {
                addressField.style.display = 'block';
                document.getElementById('customer_address').required = true;
            } else {
                addressField.style.display = 'none';
                document.getElementById('customer_address').required = false;
            }
        });
    });
    
    // Close modal when clicking outside
    document.getElementById('orderModal').addEventListener('click', function(e) {
        if (e.target.id === 'orderModal') {
            closeOrderModal();
        }
    });
</script>
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
        @if($relatedBooks->count() > 0)
        <div class="mt-12">
            <h2 class="text-2xl font-bold mb-6">Buku Lainnya</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedBooks as $relatedBook)
                <div class="book-card bg-white rounded-lg shadow-md overflow-hidden">
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
                            <span class="font-bold text-green-600">Rp {{ number_format($relatedBook->final_price, 0, ',', '.') }}</span>
                            @if($relatedBook->has_discount)
                            <span class="text-xs text-red-500 font-semibold">-{{ $relatedBook->discount_percentage }}%</span>
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

<!-- E-book Purchase Modal -->
@if($book->is_ebook)
<div id="purchase-ebook" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold">Beli E-Book</h3>
            <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="space-y-4">
            <div class="flex items-center space-x-4">
                <img src="{{ $book->cover_image ? asset('storage/' . $book->cover_image) : '/images/book-placeholder.jpg' }}" 
                     alt="{{ $book->title }}" 
                     class="w-16 h-20 object-cover rounded">
                <div>
                    <h4 class="font-semibold">{{ $book->title }}</h4>
                    <p class="text-green-600 font-bold">Rp {{ number_format($book->final_price, 0, ',', '.') }}</p>
                </div>
            </div>
            
            <div class="space-y-2">
                <p class="text-sm text-gray-600">Setelah pembayaran, ebook akan dikirim ke email Anda dalam format PDF.</p>
            </div>
            
            <div class="flex space-x-3">
                <a href="https://wa.me/6281234567890?text=Halo,%20saya%20ingin%20membeli%20ebook:%20{{ urlencode($book->title) }}" 
                   target="_blank"
                   class="flex-1 bg-green-600 text-white text-center py-2 px-4 rounded hover:bg-green-700 font-semibold">
                    <i class="fab fa-whatsapp mr-2"></i>WhatsApp
                </a>
                <button class="flex-1 bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 font-semibold">
                    <i class="fas fa-credit-card mr-2"></i>Transfer
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('purchase-ebook').classList.remove('hidden');
    }
    
    function closeModal() {
        document.getElementById('purchase-ebook').classList.add('hidden');
    }
    
    // Close modal when clicking outside
    document.getElementById('purchase-ebook').addEventListener('click', function(e) {
        if (e.target.id === 'purchase-ebook') {
            closeModal();
        }
    });
</script>
@endif
@endsection