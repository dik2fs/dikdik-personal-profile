<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'description',
        'isbn',
        'price',
        'discount_price',
        'stock',
        'cover_image',
        'book_file',
        'categories',
        'pages',
        'publisher',
        'published_date',
        'language',
        'is_available',
        'is_featured',
        'is_ebook'
    ];

    protected $casts = [
        'categories' => 'array',
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'is_available' => 'boolean',
        'is_featured' => 'boolean',
        'is_ebook' => 'boolean',
        'published_date' => 'date'
    ];

    // Accessor untuk harga diskon
    public function getFinalPriceAttribute()
    {
        return $this->discount_price ?? $this->price;
    }

    // Accessor untuk status diskon
    public function getHasDiscountAttribute()
    {
        return !is_null($this->discount_price) && $this->discount_price < $this->price;
    }

    // Accessor untuk persentase diskon
    public function getDiscountPercentageAttribute()
    {
        if (!$this->has_discount) return 0;
        
        return round((($this->price - $this->discount_price) / $this->price) * 100);
    }

    // Scope untuk buku yang tersedia
    public function scopeAvailable($query)
    {
        return $query->where('is_available', true)
                    ->where(function($q) {
                        $q->where('is_ebook', true)
                          ->orWhere('stock', '>', 0);
                    });
    }

    // Scope untuk buku featured
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Scope untuk ebook
    public function scopeEbooks($query)
    {
        return $query->where('is_ebook', true);
    }

    // Scope untuk physical books
    public function scopePhysical($query)
    {
        return $query->where('is_ebook', false);
    }
}