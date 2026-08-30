<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Carbon;
use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
    /**
     * Tampilkan halaman katalog produk untuk user (tanpa login).
     */
    public function index(): View
    {
        $deadline = Cache::rememberForever(
            'catalog_deadline',
            fn () => now()->addDays(2)->addHours(14)->addMinutes(45)->toDateTimeString()
        );
        $deadline = Carbon::parse($deadline);

        $images = ['header.webp', 'header 3.webp', 'header 2.webp'];

        return view('pages.catalog', [
            'shopName' => config('app.name'),
            'deadline' => $deadline,
            'products' => Product::latest()->get(),
            'whatsappNumber' => config('services.whatsapp.number'),
            'images' => $images,
        ]);
    }
}
    