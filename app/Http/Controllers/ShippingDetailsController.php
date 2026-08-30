<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\ShippingDetail;
use Illuminate\Http\Request;

class ShippingDetailsController extends Controller
{
    /**
     * Tampilkan halaman Shipping Details.
     */
    public function index()
    {
        $paymentMethods = collect([
            (object) ['value' => 'cash', 'label' => 'Cash', 'icon' => 'payments'],
            (object) ['value' => 'qris', 'label' => 'QRIS', 'icon' => 'qr_code_scanner'],
        ]);

        return view('pages.shipping-details', compact(
            'paymentMethods',
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'whatsapp_number' => 'required|string|max:50',
            'address' => 'required|string',
            'pickup' => 'required|string|max:255',
            'delivery_note' => 'nullable|string',
            'payment_method' => 'required|in:cash,qris',
            'qris_image' => 'required_if:payment_method,qris|image|mimes:jpg,jpeg,png,webp|max:2048',
            'shipping_fee' => 'required|numeric|min:0|max:999999999',
            'cart_items' => 'required|string',
            'cart_total' => 'required|numeric|min:0',
        ]);

        // qris image handling
        $qrisUrl = null;
        if ($request->hasFile('qris_image')) {
            $qrisUrl = $request->file('qris_image')->store('qris', 'public');
        }

        // Ubah json cart items ke php 
        $items = json_decode($validated['cart_items'], true);
        if (!is_array($items) || count($items) === 0) {
            return back()->withInput()->withErrors(['cart_items' => 'Keranjang tidak valid atau kosong.']);
        }

        // mapping 
        $orderItems = collect($items)
            ->map(function ($item) {
                return [
                    'product_id' => $item['id'] ?? null,
                    'product_name' => $item['name'] ?? 'Produk',
                    'price' => isset($item['price']) ? (float) $item['price'] : 0,
                    'qty' => isset($item['qty']) ? (int) $item['qty'] : 0,
                ];
            })
            ->filter(fn ($item) => $item['qty'] > 0 && $item['price'] >= 0);

        if ($orderItems->isEmpty()) {
            return back()->withInput()->withErrors(['cart_items' => 'Keranjang tidak valid atau kosong.']);
        }

        $subtotal = $orderItems->reduce(function ($sum, $item) {
            return $sum + ($item['price'] * $item['qty']);
        }, 0);

        // Utama
        $order = Order::create([
            'status' => 'pending',
            'subtotal' => $subtotal,
            'ongkir' => $validated['shipping_fee'],
            'total_price' => $subtotal + $validated['shipping_fee'],
        ]);

        // Simpan order ID ke session untuk history
        session()->push('order_ids', $order->id);

        // Per item looping
        foreach ($orderItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'product_name' => $item['product_name'],
                'price' => $item['price'],
                'qty' => $item['qty'],
            ]);
        }

        // Informasi pembeli
        ShippingDetail::create([
            'order_id' => $order->id,
            'full_name' => $validated['full_name'],
            'whatsapp_number' => $validated['whatsapp_number'],
            'full_address' => $validated['address'],
            'pickup_point' => $validated['pickup'],
            'delivery_note' => $validated['delivery_note'] ?? null,
        ]);

        Payment::create([
            'order_id' => $order->id,
            'method' => $validated['payment_method'],
            'status' => $validated['payment_method'] === 'qris'
                ? 'paid'
                : 'unpaid',
            'amount' => $order->total_price,
            'qris_url' => $qrisUrl,   
        ]);

        return redirect()
        ->route('transaction.success', ['orderId' => $order->id])
        ->with('success', 'Pesanan berhasil dikirim.');
    }
}