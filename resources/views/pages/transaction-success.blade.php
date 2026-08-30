@extends('layouts.app')
@section('content')
    <x-layout.transaction-success.navbar/>

    <div class="order-success-page">
        {{-- Success icon --}}
        <div class="order-success-icon-wrapper">
            <div class="order-success-icon-ring">
                <svg xmlns="http://www.w3.org/2000/svg" class="order-success-icon-check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
            </div>
        </div>

        {{-- Heading --}}
        <h1 class="order-success-title">Pesanan Berhasil!</h1>
        <p class="order-success-subtitle">
            Terima kasih atas pesanan Anda. Kami akan segera memproses permintaan jastip Anda.
        </p>

        {{-- Order detail card --}}
        <div class="order-success-card">
            <h2 class="order-success-card-title">Detail Transaksi</h2>

            <div class="order-success-card-row">
                <span class="order-success-card-label">Order ID</span>
                <span class="order-success-card-value">#{{ $orderId }}</span>
            </div>

            <div class="order-success-card-row">
                <span class="order-success-card-label">Sub Harga</span>
                <span class="order-success-card-value">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
            </div>

            <div class="order-success-card-row">
                <span class="order-success-card-label">Ongkir</span>
                <span class="order-success-card-value">Rp {{ number_format($shippingFee, 0, ',', '.') }}</span>
            </div>

            <div class="order-success-card-divider"></div>

            <div class="order-success-card-row">
                <span class="order-success-card-label">Total Pembayaran</span>
                <span class="order-success-card-value-primary">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
        </div>

        {{-- CTA --}}
        <a href="{{ route('order-history') }}" class="order-success-btn">
            Lihat Riwayat Pesanan
        </a>
    </div>

    {{-- Script untuk mengosongkan keranjang di localStorage setelah checkout berhasil --}}
    <script type="module">
        import Cart from '{{ Vite::asset('resources/js/cart.js') }}';
        
        // Hapus semua data keranjang belanja
        Cart.clear();
    </script>
@endsection