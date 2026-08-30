@extends('layouts.app')
@section('content')
<x-layout.navbar :shop-name="$shopName" :cart-count="$cartCount ?? 0" />

@php
    $resolveProductImage = function (?string $image): string {
        if (!$image) {
            return '';
        }

        if (str_starts_with($image, 'http://') || str_starts_with($image, 'https://') || str_starts_with($image, '/')) {
            return $image;
        }

        return asset('storage/' . $image);
    };
@endphp

<div class="order-history-page mt-16">
    <h1 class="order-history-title">Riwayat Pesanan</h1>
    <p class="order-history-subtitle">Lacak status pesanan Anda.</p>

    @if($orders->isEmpty())
        {{-- ===== EMPTY STATE ===== --}}
        <div class="order-history-empty">
            <div class="order-history-empty-content">
                <span class="material-symbols-outlined order-history-empty-icon" aria-hidden="true">receipt_long</span>
                <div>
                    <p class="order-history-empty-text">Belum ada pesanan</p>
                    <p class="order-history-empty-description">Pesanan yang Anda buat akan muncul di sini.</p>
                </div>
            </div>
            <a href="{{ route('catalog') }}" class="order-history-empty-cta">
                Jelajahi katalog
                <span class="material-symbols-outlined" aria-hidden="true">arrow_forward</span>
            </a>
        </div>
    @else
        {{-- ===== LIST PESANAN ===== --}}
        <div class="order-history-list">
            @foreach($orders as $order)
                <div class="order-card" x-data="{ expanded: false }">
                    {{-- Header: kode order + badge status --}}
                    <div class="order-card-header">
                        <span class="order-card-code">#{{ strtoupper(substr($order->id, 0, 8)) }}</span>

                        @if($order->status === 'accepted')
                            <span class="order-status-badge order-status-completed">
                                ✓ Pesanan diterima
                            </span>
                        @elseif($order->status === 'pending')
                            <span class="order-status-badge order-status-processing">
                                ⟳ Pesanan belum dilihat admin
                            </span>
                        @elseif($order->status === 'cancelled')
                            <span class="order-status-badge order-status-cancelled">
                                ✕ Pesanan ditolak oleh admin
                            </span>
                        @endif
                    </div>

                    <p class="order-card-date">
                        {{ $order->created_at->translatedFormat('d M Y, H:i') }}
                    </p>

                    <hr class="order-card-divider">

                    {{-- Daftar Item (Expandable) --}}
                    @if($order->items->isNotEmpty())
                        @php 
                            $firstItem = $order->items->first(); 
                            $otherItems = $order->items->skip(1);
                        @endphp
                        <div class="order-card-item">
                            @php $firstImage = $resolveProductImage($firstItem->product->image_url ?? null); @endphp
                            @if($firstImage)
                                <img src="{{ $firstImage }}" alt="{{ $firstItem->product_name }}" class="order-card-item-image">
                            @else
                                <div class="order-card-item-image flex items-center justify-center">
                                    <span class="material-symbols-outlined text-gray-400">inventory_2</span>
                                </div>
                            @endif
                            
                            <div class="order-card-item-info">
                                <p class="order-card-item-name">{{ $firstItem->product_name }}</p>
                                <p class="order-card-item-more text-xs font-semibold text-slate-500 mb-1">{{ $firstItem->qty }} x Rp {{ number_format($firstItem->price, 0, ',', '.') }}</p>

                                @if($order->items_count > 1)
                                    <button type="button" @click="expanded = !expanded" class="text-sm font-semibold text-teal-600 hover:text-teal-800 transition-colors focus:outline-none flex items-center gap-1">
                                        <span x-text="expanded ? 'Tutup' : '+ {{ $order->items_count - 1 }} item lainnya'"></span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform" :class="expanded ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                @else
                                    <p class="order-card-item-more text-xs text-slate-500">1 item</p>
                                @endif
                            </div>
                        </div>

                        {{-- Item Lainnya (ditampilkan saat expanded = true) --}}
                        @if($order->items_count > 1)
                            <div x-show="expanded" x-transition x-cloak class="mt-4 flex flex-col gap-4 border-t border-slate-100 pt-4">
                                @foreach($otherItems as $item)
                                    <div class="order-card-item">
                                        @php $itemImage = $resolveProductImage($item->product->image_url ?? null); @endphp
                                        @if($itemImage)
                                            <img src="{{ $itemImage }}" alt="{{ $item->product_name }}" class="order-card-item-image !w-14 !h-14 sm:!w-16 sm:!h-16">
                                        @else
                                            <div class="order-card-item-image !w-14 !h-14 sm:!w-16 sm:!h-16 flex items-center justify-center">
                                                <span class="material-symbols-outlined text-gray-400 text-sm">inventory_2</span>
                                            </div>
                                        @endif
                                        
                                        <div class="order-card-item-info">
                                            <p class="order-card-item-name text-sm">{{ $item->product_name }}</p>
                                            <p class="order-card-item-more text-xs font-semibold text-slate-500">{{ $item->qty }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @else
                        <p class="order-card-item-empty">Detail item tidak tersedia.</p>
                    @endif

                    <hr class="order-card-divider">

                    {{-- Total --}}
                    <p class="order-card-total-label">Total Belanja</p>
                    <p class="order-card-total-value">
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </p>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection