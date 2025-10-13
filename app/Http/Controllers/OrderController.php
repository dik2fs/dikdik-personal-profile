<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Book;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'nullable|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'nullable|string|max:500',
            'quantity' => 'required|integer|min:1|max:10',
            'type' => 'required|in:ebook,physical',
            'notes' => 'nullable|string|max:1000'
        ]);

        $book = Book::findOrFail($validated['book_id']);
        
        // Validasi stok untuk buku fisik
        if ($validated['type'] === 'physical' && $book->stock < $validated['quantity']) {
            return back()->with('error', 'Maaf, stok buku tidak mencukupi.');
        }

        $orderData = [
            'order_number' => Order::generateOrderNumber(),
            'book_id' => $book->id,
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'],
            'customer_address' => $validated['customer_address'],
            'amount' => $book->final_price * $validated['quantity'],
            'quantity' => $validated['quantity'],
            'type' => $validated['type'],
            'notes' => $validated['notes'],
            'status' => 'pending'
        ];

        $order = Order::create($orderData);

        // Kurangi stok jika buku fisik
        if ($validated['type'] === 'physical') {
            $book->decrement('stock', $validated['quantity']);
        }

        // Generate WhatsApp message
        $whatsappMessage = $this->generateWhatsAppMessage($order, $book);

        return redirect()->away($whatsappMessage)
            ->with('success', 'Silakan lanjutkan pemesanan via WhatsApp!');
    }

    private function generateWhatsAppMessage(Order $order, Book $book)
    {
        $phoneNumber = '6281311203436'; // Ganti dengan nomor WhatsApp Anda
        
        $message = "Halo, saya ingin memesan buku:\n";
        $message .= "📚 *{$book->title}* \n";
        $message .= "✍️ Penulis: {$book->author}\n";
        $message .= "💰 Harga: Rp " . number_format($order->amount, 0, ',', '.') . "\n";
        $message .= "📦 Jumlah: {$order->quantity} " . ($order->type === 'ebook' ? 'E-book' : 'Buku Fisik') . "\n";
        $message .= "👤 Pemesan: {$order->customer_name}\n";
        $message .= "📞 WhatsApp: {$order->customer_phone}\n";
        
        if ($order->customer_email) {
            $message .= "📧 Email: {$order->customer_email}\n";
        }
        
        if ($order->type === 'physical' && $order->customer_address) {
            $message .= "🏠 Alamat: {$order->customer_address}\n";
        }
        
        $message .= "\nOrder ID: {$order->order_number}\n";
        $message .= "Silakan konfirmasi ketersediaan dan cara pembayaran.";

        return "https://wa.me/{$phoneNumber}?text=" . urlencode($message);
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }
}