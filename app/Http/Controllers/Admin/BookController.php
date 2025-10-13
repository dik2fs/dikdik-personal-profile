<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the books.
     */
    public function index()
    {
        $books = Book::latest()->paginate(10);
        return view('admin.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new book.
     */
    public function create()
    {
        return view('admin.books.create');
    }

    /**
     * Store a newly created book in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'isbn' => 'nullable|string|max:20',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'book_file' => 'nullable|file|mimes:pdf,epub|max:10240',
            'categories' => 'required|array|min:1',
            'categories.*' => 'string|max:50',
            'pages' => 'nullable|integer|min:1',
            'publisher' => 'nullable|string|max:255',
            'published_date' => 'nullable|date',
            'language' => 'required|string|max:50',
            'is_available' => 'boolean',
            'is_featured' => 'boolean',
            'is_ebook' => 'boolean'
        ], [
            'title.required' => 'Judul buku wajib diisi',
            'author.required' => 'Penulis buku wajib diisi',
            'description.required' => 'Deskripsi buku wajib diisi',
            'description.min' => 'Deskripsi minimal 10 karakter',
            'price.required' => 'Harga buku wajib diisi',
            'price.numeric' => 'Harga harus berupa angka',
            'price.min' => 'Harga tidak boleh negatif',
            'stock.required' => 'Stok buku wajib diisi',
            'stock.integer' => 'Stok harus berupa angka bulat',
            'stock.min' => 'Stok tidak boleh negatif',
            'cover_image.image' => 'File cover harus berupa gambar',
            'cover_image.mimes' => 'Format gambar harus jpeg, png, jpg, atau webp',
            'cover_image.max' => 'Ukuran gambar cover maksimal 2MB',
            'book_file.mimes' => 'Format file buku harus PDF atau EPUB',
            'book_file.max' => 'Ukuran file buku maksimal 10MB',
            'categories.required' => 'Minimal satu kategori harus dipilih',
            'categories.min' => 'Minimal satu kategori harus dipilih',
            'language.required' => 'Bahasa buku wajib diisi'
        ]);

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')->store('books/covers', 'public');
            $validated['cover_image'] = $coverPath;
        }

        // Handle book file upload (untuk ebook)
        if ($request->hasFile('book_file')) {
            $bookFilePath = $request->file('book_file')->store('books/files', 'public');
            $validated['book_file'] = $bookFilePath;
        }

        $validated['is_available'] = $request->has('is_available');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_ebook'] = $request->has('is_ebook');

        Book::create($validated);

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified book.
     */
    public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    /**
     * Update the specified book in storage.
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'isbn' => 'nullable|string|max:20',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'book_file' => 'nullable|file|mimes:pdf,epub|max:10240',
            'categories' => 'required|array|min:1',
            'categories.*' => 'string|max:50',
            'pages' => 'nullable|integer|min:1',
            'publisher' => 'nullable|string|max:255',
            'published_date' => 'nullable|date',
            'language' => 'required|string|max:50',
            'is_available' => 'boolean',
            'is_featured' => 'boolean',
            'is_ebook' => 'boolean'
        ], [
            'title.required' => 'Judul buku wajib diisi',
            'author.required' => 'Penulis buku wajib diisi',
            'description.required' => 'Deskripsi buku wajib diisi',
            'description.min' => 'Deskripsi minimal 10 karakter',
            'price.required' => 'Harga buku wajib diisi',
            'price.numeric' => 'Harga harus berupa angka',
            'price.min' => 'Harga tidak boleh negatif',
            'stock.required' => 'Stok buku wajib diisi',
            'stock.integer' => 'Stok harus berupa angka bulat',
            'stock.min' => 'Stok tidak boleh negatif',
            'cover_image.image' => 'File cover harus berupa gambar',
            'cover_image.mimes' => 'Format gambar harus jpeg, png, jpg, atau webp',
            'cover_image.max' => 'Ukuran gambar cover maksimal 2MB',
            'book_file.mimes' => 'Format file buku harus PDF atau EPUB',
            'book_file.max' => 'Ukuran file buku maksimal 10MB',
            'categories.required' => 'Minimal satu kategori harus dipilih',
            'categories.min' => 'Minimal satu kategori harus dipilih',
            'language.required' => 'Bahasa buku wajib diisi'
        ]);

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            // Delete old cover image
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $coverPath = $request->file('cover_image')->store('books/covers', 'public');
            $validated['cover_image'] = $coverPath;
        }

        // Handle book file upload
        if ($request->hasFile('book_file')) {
            // Delete old book file
            if ($book->book_file) {
                Storage::disk('public')->delete($book->book_file);
            }
            $bookFilePath = $request->file('book_file')->store('books/files', 'public');
            $validated['book_file'] = $bookFilePath;
        }

        $validated['is_available'] = $request->has('is_available');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_ebook'] = $request->has('is_ebook');

        $book->update($validated);

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil diperbarui!');
    }

    /**
     * Remove the specified book from storage.
     */
    public function destroy(Book $book)
    {
        // Delete files
        if ($book->cover_image) {
            Storage::disk('public')->delete($book->cover_image);
        }
        if ($book->book_file) {
            Storage::disk('public')->delete($book->book_file);
        }

        $book->delete();

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil dihapus!');
    }

    /**
     * Toggle featured status for a book.
     */
    public function toggleFeatured(Book $book)
    {
        $book->update([
            'is_featured' => !$book->is_featured
        ]);

        $status = $book->is_featured ? 'ditandai sebagai unggulan' : 'dihapus dari unggulan';
        
        return redirect()->route('admin.books.index')
            ->with('success', "Buku berhasil {$status}!");
    }

    /**
     * Toggle availability status for a book.
     */
    public function toggleAvailable(Book $book)
    {
        $book->update([
            'is_available' => !$book->is_available
        ]);

        $status = $book->is_available ? 'ditandai sebagai tersedia' : 'ditandai sebagai tidak tersedia';
        
        return redirect()->route('admin.books.index')
            ->with('success', "Buku berhasil {$status}!");
    }
}