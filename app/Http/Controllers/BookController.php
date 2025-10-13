<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index(Request $request)
{
    $query = Book::available();
    
    // Search functionality
    if ($request->has('search') && $request->search) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('author', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%")
              ->orWhereJsonContains('categories', $search);
        });
    }
    
    // Filter by type
    if ($request->has('type') && $request->type) {
        if ($request->type === 'ebook') {
            $query->where('is_ebook', true);
        } elseif ($request->type === 'physical') {
            $query->where('is_ebook', false);
        }
    }

    $books = $query->latest()->paginate(12);
    
    $featuredBooks = Book::available()
                        ->featured()
                        ->take(4)
                        ->get();
    
    $categories = Book::available()
                     ->get()
                     ->pluck('categories')
                     ->flatten()
                     ->unique()
                     ->values();

    return view('books.index', compact('books', 'featuredBooks', 'categories'));
}

    public function show(Book $book)
    {
        if (!$book->is_available) {
            abort(404);
        }

        $relatedBooks = Book::available()
                           ->where('id', '!=', $book->id)
                           ->where(function($query) use ($book) {
                               $query->whereJsonContains('categories', $book->categories[0] ?? '')
                                     ->orWhere('author', $book->author);
                           })
                           ->take(4)
                           ->get();

        return view('books.show', compact('book', 'relatedBooks'));
    }

    public function byCategory($category)
    {
        $books = Book::available()
                    ->whereJsonContains('categories', $category)
                    ->latest()
                    ->paginate(12);

        $categories = Book::available()
                         ->get()
                         ->pluck('categories')
                         ->flatten()
                         ->unique()
                         ->values();

        return view('books.category', compact('books', 'categories', 'category'));
    }
}