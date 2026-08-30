<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;



class ListOrderController extends Controller
{
    public function index(Request $request): View
    {

        $orders = Order::with([
            'payment',
            'shipping',
            'items',
        ])
        ->when($request->status ?? 'pending', function ($query, $status) {
            $query->where('status', $status);
        })
        ->get();

        return view('pages.admin.list-order', [
            'orders' => $orders,
            'shopName' => config('app.name'),

        ]);
    }

    public function accept(Order $order, ): RedirectResponse
    {
        $order->update([
            'status'=>'accepted'
        ]);

        return redirect()
            ->route('list-orders.index')
            ->with('success', "Product id \"{$order->id}\" accepted");
    }

    public function cancel(Order $order): RedirectResponse
    {
        $order->update([
            'status'=>'cancelled'
        ]);

        return redirect()
            ->route('list-orders.index')
            ->with('success', "Product id \"{$order->id}\" cancelled");
    }

}
