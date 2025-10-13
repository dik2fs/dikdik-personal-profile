<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'book_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'amount',
        'quantity',
        'status',
        'type',
        'notes',
        'payment_method'
    ];

    protected $casts = [
        'amount' => 'decimal:2'
    ];

    // Relationship dengan Book
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    // Generate order number
    public static function generateOrderNumber()
    {
        $prefix = 'ORD';
        $date = now()->format('Ymd');
        $lastOrder = self::where('order_number', 'like', "{$prefix}{$date}%")->latest()->first();
        
        $sequence = $lastOrder ? (int)substr($lastOrder->order_number, -4) + 1 : 1;
        
        return "{$prefix}{$date}" . str_pad($sequence, 4, '0', STR_PAD_LEFT);
    }

    // Accessor untuk status label
    public function getStatusLabelAttribute()
    {
        $statuses = [
            'pending' => ['label' => 'Menunggu', 'color' => 'yellow'],
            'confirmed' => ['label' => 'Dikonfirmasi', 'color' => 'blue'],
            'processing' => ['label' => 'Diproses', 'color' => 'purple'],
            'completed' => ['label' => 'Selesai', 'color' => 'green'],
            'cancelled' => ['label' => 'Dibatalkan', 'color' => 'red'],
        ];
        
        return $statuses[$this->status] ?? ['label' => 'Unknown', 'color' => 'gray'];
    }

    // Scope untuk filter status
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }
}