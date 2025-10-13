<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('book')->latest()->paginate(15);
        
        $stats = [
            'total' => Order::count(),
            'pending' => Order::pending()->count(),
            'completed' => Order::completed()->count(),
            'revenue' => Order::completed()->sum('amount')
        ];

        return view('admin.orders.index', compact('orders', 'stats'));
    }

    public function show(Order $order)
    {
        $order->load('book');
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,processing,completed,cancelled'
        ]);

        $order->update(['status' => $validated['status']]);

        return back()->with('success', 'Status pesanan berhasil diperbarui!');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Pesanan berhasil dihapus!');
    }
}