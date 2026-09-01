<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\ShippingDetailsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ListOrderController;

// Public catalog
Route::get('/', [ProductController::class, 'index'])->name('catalog');

Route::get('/admin-login', function() {
    return view('pages.admin.login');
}) -> name('login');
Route::post('/admin-login', [LoginController::class, 'store'])->name('admin-login.store');

Route::middleware('auth:admin')->group(function (){

    // NOTE ADMIN CATALOG
    //Index
    Route::get('/admin-catalog', [AdminProductController::class, 'index'])->name('admin-catalog.index');
    // Store, create product
    Route::post('/admin-catalog', [AdminProductController::class, 'store'])->name('admin-catalog.store');
    // Update
    Route::put('/admin-catalog/products/{product}', [AdminProductController::class, 'update'])->name('admin-catalog.update');
    // delete
    Route::delete('/admin-catalog/products/{product}', [AdminProductController::class, 'destroy'])->name('admin-catalog.destroy');

    // SET waktu
    Route::put('/catalog/deadline', [AdminProductController::class, 'updateDeadline'])
        ->name('admin-catalog.time.update');

    Route::get('/list-orders',[ListOrderController::class, 'index'])-> name('list-orders.index'); 
    Route::patch('/list-orders/{order}/cancel', [ListOrderController::class, 'cancel'])-> name('list-orders.cancel');  
    Route::patch('/list-orders/{order}/accept', [ListOrderController::class, 'accept'])-> name('list-orders.accept');  

    Route::get('/admin-profile-admin', [ProfileController::class, 'admin'])->name('admin-profile.admin');

});


Route::get('/keranjang', function() {
    return view('pages.keranjang');
}) -> name('keranjang');

Route::get('/shipping-details', [ShippingDetailsController::class, 'index'])->name('shipping-details');
Route::post('/shipping-details', [ShippingDetailsController::class, 'store'])->name('shipping-details.store');

Route::get('/transactions/{orderId}/success', [OrderController::class, 'success'])
    ->name('transaction.success');

Route::get('/order-history', [HistoryController::class, 'index'])->name('order-history');

Route::get('/admin-profile', [ProfileController::class, 'index'])->name('admin-profile.index');
Route::post('/admin-profile', [ProfileController::class, 'store'])->name('admin-profile.store');
Route::get('/reviews', [ProfileController::class, 'reviews'])->name('reviews.index');