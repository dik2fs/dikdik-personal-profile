@extends('admin.layouts.app')

@section('title', 'Kelola Buku')
@section('header', 'Kelola Buku')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Daftar Buku</h2>
        <p class="text-gray-600">Kelola koleksi buku Anda</p>
    </div>
    <a href="{{ route('admin.books.create') }}" 
       class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 font-semibold">
        <i class="fas fa-plus mr-2"></i>
        Tambah Buku
    </a>
</div>

<!-- Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white p-4 rounded-lg shadow border-l-4 border-blue-500">
        <p class="text-2xl font-bold text-gray-900">{{ $books->total() }}</p>
        <p class="text-sm text-gray-600">Total Buku</p>
    </div>
    <div class="bg-white p-4 rounded-lg shadow border-l-4 border-green-500">
        <p class="text-2xl font-bold text-gray-900">{{ $books->where('is_available', true)->count() }}</p>
        <p class="text-sm text-gray-600">Tersedia</p>
    </div>
    <div class="bg-white p-4 rounded-lg shadow border-l-4 border-yellow-500">
        <p class="text-2xl font-bold text-gray-900">{{ $books->where('is_featured', true)->count() }}</p>
        <p class="text-sm text-gray-600">Unggulan</p>
    </div>
    <div class="bg-white p-4 rounded-lg shadow border-l-4 border-purple-500">
        <p class="text-2xl font-bold text-gray-900">{{ $books->where('is_ebook', true)->count() }}</p>
        <p class="text-sm text-gray-600">E-Book</p>
    </div>
</div>

<div class="bg-white rounded-lg shadow-md">
    <div class="p-6">
        @if($books->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Cover</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Judul Buku</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Penulis</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Harga</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Stok</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($books as $book)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <img src="{{ $book->cover_image ? asset('storage/' . $book->cover_image) : '/images/book-placeholder.jpg' }}" 
                                 alt="{{ $book->title }}" 
                                 class="w-12 h-16 object-cover rounded border">
                        </td>
                        <td class="px-4 py-3">
                            <div>
                                <p class="font-semibold text-gray-900">{{ $book->title }}</p>
                                <div class="flex flex-wrap gap-1 mt-1">
                                    @foreach(array_slice($book->categories, 0, 2) as $category)
                                    <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">{{ $category }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <p class="text-gray-900">{{ $book->author }}</p>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex flex-col">
                                @if($book->has_discount)
                                <span class="font-bold text-green-600">Rp {{ number_format($book->discount_price, 0, ',', '.') }}</span>
                                <span class="text-sm text-gray-500 line-through">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                                @else
                                <span class="font-bold text-gray-900">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            @if($book->is_ebook)
                            <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">E-Book</span>
                            @else
                            <span class="{{ $book->stock > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} text-xs px-2 py-1 rounded">
                                {{ $book->stock }}
                            </span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex flex-col space-y-1">
                                @if($book->is_available)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Tersedia
                                </span>
                                @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Tidak Tersedia
                                </span>
                                @endif
                                
                                @if($book->is_featured)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-star mr-1"></i>Unggulan
                                </span>
                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.books.edit', $book) }}" 
                                   class="text-blue-600 hover:text-blue-800"
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('books.show', $book) }}" 
                                   target="_blank"
                                   class="text-green-600 hover:text-green-800"
                                   title="Lihat">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.books.destroy', $book) }}" 
                                      method="POST" 
                                      class="inline"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-800"
                                            title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $books->links() }}
        </div>
        @else
        <div class="text-center py-12">
            <i class="fas fa-book-open text-4xl text-gray-300 mb-4"></i>
            <p class="text-gray-500 text-lg">Belum ada buku</p>
            <p class="text-gray-400 mt-2">Mulai dengan menambahkan buku pertama Anda</p>
            <a href="{{ route('admin.books.create') }}" 
               class="inline-block mt-4 bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 font-semibold">
                <i class="fas fa-plus mr-2"></i>
                Tambah Buku Pertama
            </a>
        </div>
        @endif
    </div>
</div>
@endsection