<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Tampilkan halaman order history dari session.
     */
    public function index()
    {
        // Ambil order IDs dari session 
        $orderIds = session()->get('order_ids', []);
        
        // Ambil order data dari database
        $orders = Order::whereIn('id', $orderIds)
            ->with('items.product')  // Relasi items dan product untuk ambil gambar
            ->withCount('items') // Hitung jumlah items
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.order-history', [
            'orders' => $orders,
            'shopName' => config('app.name'),
        ]);
    }
}
