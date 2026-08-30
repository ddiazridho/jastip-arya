<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

use Illuminate\Support\Carbon;

class ProductController extends Controller
{



    /**
     * Halaman manajemen produk di dashboard admin.
     */

    public function index(): View
    {
        $deadline = Cache::get('catalog_deadline');

        $deadline = $deadline
        ? Carbon::parse($deadline)
        : null;

        $images = ['header.webp', 'header 3.webp', 'header 2.webp'];


        return view('pages.admin.catalog', [
            'shopName' => config('app.name'),
            'deadline' => $deadline,
            'products' => Product::latest()->get(),
            'whatsappNumber' => config('services.whatsapp.number'),
            'images' => $images,
        ]);
    }

    /**
     * Simpan produk baru.
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {   

        $validated = $request->validated();

        // Path image ke storage public lokal
        $path = $request->file('image')->store('products', 'public');

        $validated['image_url'] = $path;

        unset($validated['image']);

        // name, description, image_url, price
        $product = Product::create($validated);

        return redirect()
            ->route('admin-catalog.index')
            ->with('success', "Produk \"{$product->name}\" berhasil ditambahkan.");
    }

    /**
     * Update produk — dipakai juga untuk inline edit di card produk.
     * Kalau request datang dari fetch/AJAX (inline edit), balikin JSON.
     * Kalau dari form biasa, redirect balik dengan flash message.
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        
        $validated = $request->validated();
        
        if (!empty($product->image_url)) {
        Storage::disk('public')->delete($product->image_url);
        }

        // apakah user update image 
        if ($request->hasFile('image')) {
        $path = $request->file('image')->store('products', 'public');


        $validated['image_url'] = $path;
        }

        unset($validated['image']);

        // update db
        $product->update($validated);

        return back()->with('success', "Produk \"{$product->name}\" berhasil diperbarui.");
    }

    /**
     * Hapus produk.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return back()->with('success', 'Produk berhasil dihapus.');
    }

    /**
     * Update preorder countdown deadline (no DB, cached).
     */
    public function updateDeadline(Request $request)
    {
        $validated = $request->validate([
            'deadline' => ['required', 'date', 'after:now'],
        ]);

        Cache::forever('catalog_deadline', $validated['deadline']);

        return back()->with('success', 'Deadline berhasil diperbarui.');
    }
}
