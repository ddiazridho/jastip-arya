<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;


class OrderController extends Controller
{
    public function success(string $orderId)
    {
    // Replace with a real lookup once orders are persisted,
    // e.g. Order::where('order_code', $orderId)->firstOrFail();
    $order = Order::where('id', $orderId)->firstOrFail();
 
    return view('pages.transaction-success', [
        'orderId'  => $order->id,   // e.g. "JS-8821"
        'total' => $order->total_price,         // raw number, formatted in the Blade view
        'shippingFee' => $order->ongkir,
        'subtotal' => $order->subtotal
    ]);
    }
}
