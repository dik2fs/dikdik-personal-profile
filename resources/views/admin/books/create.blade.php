@extends('admin.layouts.app')

@section('title', 'Tambah Buku')
@section('header', 'Tambah Buku Baru')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6">
        <form method="POST" action="{{ route('admin.books.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Basic Information -->
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-gray-900 border-b pb-2">Informasi Dasar</h3>
                    
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Judul Buku *</label>
                        <input type="text" 
                               id="title" 
                               name="title" 
                               value="{{ old('title') }}"
                               required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Judul buku">
                    </div>

                    <div>
                        <label for="author" class="block text-sm font-medium text-gray-700">Penulis *</label>
                        <input type="text" 
                               id="author" 
                               name="author" 
                               value="{{ old('author') }}"
                               required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Nama penulis">
                    </div>

                    <div>
                        <label for="isbn" class="block text-sm font-medium text-gray-700">ISBN</label>
                        <input type="text" 
                               id="isbn" 
                               name="isbn" 
                               value="{{ old('isbn') }}"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                               placeholder="ISBN buku (opsional)">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700">Harga Normal *</label>
                            <input type="number" 
                                   id="price" 
                                   name="price" 
                                   value="{{ old('price') }}"
                                   min="0"
                                   step="0.01"
                                   required
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="0">
                        </div>

                        <div>
                            <label for="discount_price" class="block text-sm font-medium text-gray-700">Harga Diskon</label>
                            <input type="number" 
                                   id="discount_price" 
                                   name="discount_price" 
                                   value="{{ old('discount_price') }}"
                                   min="0"
                                   step="0.01"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="0 (opsional)">
                        </div>
                    </div>

                    <div>
                        <label for="publisher" class="block text-sm font-medium text-gray-700">Penerbit</label>
                        <input type="text" 
                               id="publisher" 
                               name="publisher" 
                               value="{{ old('publisher') }}"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Nama penerbit">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="pages" class="block text-sm font-medium text-gray-700">Jumlah Halaman</label>
                            <input type="number" 
                                   id="pages" 
                                   name="pages" 
                                   value="{{ old('pages') }}"
                                   min="1"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="0">
                        </div>

                        <div>
                            <label for="language" class="block text-sm font-medium text-gray-700">Bahasa *</label>
                            <select id="language" 
                                    name="language" 
                                    required
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="Indonesia" {{ old('language') == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                                <option value="English" {{ old('language') == 'English' ? 'selected' : '' }}>English</option>
                                <option value="Sunda" {{ old('language') == 'Sunda' ? 'selected' : '' }}>Sunda</option>
                                <option value="Jawa" {{ old('language') == 'Jawa' ? 'selected' : '' }}>Jawa</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="published_date" class="block text-sm font-medium text-gray-700">Tanggal Terbit</label>
                        <input type="date" 
                               id="published_date" 
                               name="published_date" 
                               value="{{ old('published_date') }}"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <!-- Media & Categories -->
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-gray-900 border-b pb-2">Media & Kategori</h3>
                    
                    <!-- Cover Image -->
                    <div>
                        <label for="cover_image" class="block text-sm font-medium text-gray-700">Cover Buku</label>
                        <input type="file" 
                               id="cover_image" 
                               name="cover_image"
                               accept="image/*"
                               class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <p class="mt-1 text-sm text-gray-500">Format: JPG, PNG, WEBP. Maksimal: 2MB</p>
                    </div>

                    <!-- Book File (for e-book) -->
                    <div>
                        <label for="book_file" class="block text-sm font-medium text-gray-700">File Buku (E-book)</label>
                        <input type="file" 
                               id="book_file" 
                               name="book_file"
                               accept=".pdf,.epub"
                               class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <p class="mt-1 text-sm text-gray-500">Format: PDF, EPUB. Maksimal: 10MB</p>
                    </div>

                    <!-- Categories -->
                    <div>
                        <label for="categories" class="block text-sm font-medium text-gray-700">Kategori *</label>
                        <div id="categories-container" class="mt-2 space-y-2">
                            <div class="flex space-x-2">
                                <input type="text" 
                                       name="categories[]" 
                                       placeholder="Contoh: Pemrograman"
                                       required
                                       class="flex-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <button type="button" 
                                        onclick="addCategoryField()"
                                        class="px-3 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <p class="mt-1 text-sm text-gray-500">Tekan tombol + untuk menambah kategori</p>
                    </div>

                    <!-- Stock -->
                    <div id="stock-field">
                        <label for="stock" class="block text-sm font-medium text-gray-700">Stok *</label>
                        <input type="number" 
                               id="stock" 
                               name="stock" 
                               value="{{ old('stock', 0) }}"
                               min="0"
                               required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Status Options -->
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <input type="checkbox" 
                                   id="is_ebook" 
                                   name="is_ebook" 
                                   value="1"
                                   {{ old('is_ebook') ? 'checked' : '' }}
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                   onchange="toggleStockField()">
                            <label for="is_ebook" class="ml-2 block text-sm text-gray-700">
                                Ini adalah E-book
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" 
                                   id="is_available" 
                                   name="is_available" 
                                   value="1"
                                   {{ old('is_available', true) ? 'checked' : '' }}
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="is_available" class="ml-2 block text-sm text-gray-700">
                                Tersedia untuk dijual
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" 
                                   id="is_featured" 
                                   name="is_featured" 
                                   value="1"
                                   {{ old('is_featured') ? 'checked' : '' }}
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="is_featured" class="ml-2 block text-sm text-gray-700">
                                Tandai sebagai unggulan
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="mt-6">
                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi Buku *</label>
                <textarea id="description" 
                          name="description" 
                          rows="6"
                          required
                          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                          placeholder="Deskripsi lengkap tentang buku...">{{ old('description') }}</textarea>
            </div>

            <!-- Submit Buttons -->
            <div class="mt-8 flex justify-end space-x-4">
                <a href="{{ route('admin.books.index') }}" 
                   class="bg-gray-300 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-400 font-semibold">
                    Batal
                </a>
                <button type="submit" 
                        class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 font-semibold">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Buku
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function addCategoryField() {
        const container = document.getElementById('categories-container');
        const newField = document.createElement('div');
        newField.className = 'flex space-x-2';
        newField.innerHTML = `
            <input type="text" 
                   name="categories[]" 
                   placeholder="Contoh: Bisnis"
                   class="flex-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            <button type="button" 
                    onclick="removeCategoryField(this)"
                    class="px-3 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                <i class="fas fa-minus"></i>
            </button>
        `;
        container.appendChild(newField);
    }

    function removeCategoryField(button) {
        if (document.querySelectorAll('#categories-container .flex.space-x-2').length > 1) {
            button.parentElement.remove();
        }
    }

    function toggleStockField() {
        const isEbook = document.getElementById('is_ebook').checked;
        const stockField = document.getElementById('stock-field');
        
        if (isEbook) {
            stockField.style.display = 'none';
            document.getElementById('stock').value = 0;
        } else {
            stockField.style.display = 'block';
        }
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        toggleStockField();
    });
</script>
@endsection