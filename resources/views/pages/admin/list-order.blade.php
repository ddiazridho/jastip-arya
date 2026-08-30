@extends('layouts.app')
@section('content')

<x-layout.Admin.navbar :shop-name="$shopName"/>
<x-layout.Admin.sidebar />

<main class="max-w-[1200px] mx-auto px-4 md:px-16 py-6 pt-20 md:pt-24">

    {{-- Header --}}
    <header class="mb-6 md:mb-8">
        <h1 class="text-2xl md:text-3xl font-bold text-slate-800">List Orders</h1>
        <p class="text-slate-500 mt-1">Kelola pesanan berdasarkan status.</p>
    </header>

    {{-- Filter Tabs --}}
    <div class="status-tabs mb-6">
        <div class="status-tabs__group overflow-x-auto">
            <a href="{{ route('list-orders.index', ['status' => 'pending']) }}"
               class="status-tab {{ request('status', 'pending') === 'pending' ? 'status-tab--active' : '' }}">
                Pending
            </a>
            <a href="{{ route('list-orders.index', ['status' => 'accepted']) }}"
               class="status-tab {{ request('status') === 'accepted' ? 'status-tab--active' : '' }}">
                Accepted
            </a>
            <a href="{{ route('list-orders.index', ['status' => 'cancelled']) }}"
               class="status-tab {{ request('status') === 'cancelled' ? 'status-tab--active' : '' }}">
                Cancelled
            </a>
        </div>
    </div>

    {{-- Orders List --}}
    <div class="order-list grid grid-cols-1 gap-6">
        @forelse ($orders as $order)
            <div class="order-card order-card--{{ $order->status }} rounded-xl border border-slate-100 shadow-sm bg-white">
                {{-- Card Header: Avatar + Identitas utama --}}
                <div class="order-card__body">
                    <div class="order-avatar" aria-hidden="true">
                        @php
                            $fullName = optional($order->shipping)->full_name ?? '';
                            $initials = collect(explode(' ', trim($fullName)))
                                ->filter()
                                ->map(function ($n) { return mb_substr($n, 0, 1); })
                                ->take(2)
                                ->implode('');
                        @endphp
                        {{ $initials ?: 'OD' }}
                    </div>

                    <div class="order-info">
                        <div class="order-info__top">
                            <h3 class="order-info__name">{{ $fullName ?: ('Order #' . $order->id) }}</h3>
                            <span class="order-status-label order-status-label--{{ $order->status }}">{{ ucfirst($order->status) }}</span>
                        </div>
                        @if(optional($order->shipping)->whatsapp_number)
                            <a href="tel:{{ $order->shipping->whatsapp_number }}" class="order-info__phone">
                                {{ $order->shipping->whatsapp_number }}
                            </a>
                        @endif
                        <p class="order-info__code">Order #{{ $order->id }}</p>
                    </div>
                </div>

                
                {{-- Shipping Details --}}
                @if($order->shipping)
                <div class="order-section order-section--shipping">
                    <h4 class="order-section__title">Shipping Details</h4>
                    <div class="shipping-grid">
                        <div class="shipping-grid__row">
                            <span class="shipping-grid__label">Nama Penerima</span>
                            <span class="shipping-grid__value">{{ $order->shipping->full_name }}</span>
                        </div>
                        <div class="shipping-grid__row">
                            <span class="shipping-grid__label">WhatsApp</span>
                            <span class="shipping-grid__value"><a href="tel:{{ $order->shipping->whatsapp_number }}">{{ $order->shipping->whatsapp_number }}</a></span>
                        </div>
                        <div class="shipping-grid__row">
                            <span class="shipping-grid__label">Alamat</span>
                            <span class="shipping-grid__value">{{ $order->shipping->full_address }}</span>
                        </div>
                        <div class="shipping-grid__row">
                            <span class="shipping-grid__label">Pickup Point</span>
                            <span class="shipping-grid__value">{{ $order->shipping->pickup_point }}</span>
                        </div>
                        <div class="shipping-grid__row">
                            <span class="shipping-grid__label">Catatan</span>
                            <span class="shipping-grid__value">{{ $order->shipping->delivery_note }}</span>
                        </div>
                    </div>
                </div>
                @endif
                
                {{-- Ringkasan Order --}}
                <div class="order-section order-section--summary border-t border-slate-100">
                    <h4 class="order-section__title">Ringkasan</h4>
                    <div class="order-summary">
                        <div class="order-summary__row">
                            <span class="order-summary__label">Subtotal</span>
                            <span class="order-summary__value">Rp {{ number_format((float) $order->subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="order-summary__row">
                            <span class="order-summary__label">Ongkir</span>
                            <span class="order-summary__value">Rp {{ number_format((float) $order->ongkir, 0, ',', '.') }}</span>
                        </div>
                        <div class="order-summary__row order-summary__row--total">
                            <span class="order-summary__label">Total</span>
                            <span class="order-summary__value">Rp {{ number_format((float) $order->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <div class="order-section order-section--items border-t border-slate-100">
                    <h4 class="order-section__title">Order Items</h4>
                    @forelse($order->items as $item)
                    @php
                    $prod = $item->product;
                    $name = $item->product_name ?: optional($prod)->name;
                    $image = optional($prod)->image_url;
                    $lineTotal = (float)$item->price * (int)$item->qty;
                    @endphp
                    <div class="order-item">
                        <div class="order-item__media">
                            @if($image)
                            <img
                            src="{{ asset('storage/' . $image) }}"
                            alt="{{ $name }}"
                            class="order-item__img"
                            loading="lazy"
                            />
                                @else
                                    <div class="order-item__placeholder" aria-hidden="true">IMG</div>
                                @endif
                            </div>
                            <div class="order-item__info">
                                <div class="order-item__top">
                                    <span class="order-item__name">{{ $name }}</span>
                                    <span class="order-item__qty">x{{ (int) $item->qty }}</span>
                                </div>
                                <div class="order-item__meta">
                                    <span class="order-item__price">Rp {{ number_format((float) $item->price, 0, ',', '.') }}</span>
                                    <span class="order-item__total">Rp {{ number_format($lineTotal, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="order-items__empty">Tidak ada item.</p>
                    @endforelse
                </div>

                {{-- Payment --}}
                <div class="order-section order-section--payment border-t border-slate-100">
                    <h4 class="order-section__title">Payment</h4>
                    @if($order->payment)
                        <div class="payment-grid">
                            <div class="payment-grid__row">
                                <span class="payment-grid__label">Metode</span>
                                <span class="payment-grid__value">{{ strtoupper($order->payment->method) }}</span>
                            </div>
                            <div class="payment-grid__row">
                                <span class="payment-grid__label">Status</span>
                                <span class="payment-grid__value">{{ ucfirst($order->payment->status) }}</span>
                            </div>
                            <div class="payment-grid__row">
                                <span class="payment-grid__label">Amount</span>
                                <span class="payment-grid__value">Rp {{ number_format((float) $order->payment->amount, 0, ',', '.') }}</span>
                            </div>
                            @if($order->payment->paid_at)
                            <div class="payment-grid__row">
                                <span class="payment-grid__label">Paid At</span>
                                <span class="payment-grid__value">{{ $order->payment->paid_at->format('d M Y H:i') }}</span>
                            </div>
                            @endif
                            @if($order->payment->qris_url)
                            <div class="payment-grid__row payment-grid__row--qris">
                                <span class="payment-grid__label">QRIS</span>
                                <span class="payment-grid__value">
                                    <img src="{{ asset('storage/' . $order->payment->qris_url) }}" alt="QRIS {{ $order->id }}" class="payment-qris__img"/>
                                </span>
                            </div>
                            @endif
                        </div>
                    @else
                        <p class="payment__empty">Belum ada data pembayaran.</p>
                    @endif
                </div>

                {{-- Footer Actions / Status --}}
                @if ($order->status === 'pending')
                    <div class="order-card__footer flex items-center justify-end gap-3 p-4 border-t border-slate-100 bg-slate-50">
                        
                        <form action="{{ route('list-orders.cancel', $order) }}" method="POST" class="order-action-form flex-1">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn-order btn-order--cancel w-full">
                                <svg class="btn-order__icon" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15 5L5 15M5 5L15 15" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                                Cancel
                            </button>
                        </form>

                        <form action="{{ route('list-orders.accept', $order) }}" method="POST" class="order-action-form flex-1">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn-order btn-order--confirm w-full">
                                <svg class="btn-order__icon" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 10.5L8 14.5L16 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Confirm
                            </button>
                        </form>
                    </div>
                @else
                    <div class="order-card__footer order-card__footer--readonly p-4 border-t border-slate-100 bg-slate-50">
                        <span class="order-status-label order-status-label--{{ $order->status }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                @endif
            </div>
        @empty
            <div class="order-empty">
                <p class="order-empty__title">Belum ada order {{ request('status', 'pending') }}</p>
                <p class="order-empty__desc">Order dengan status ini akan muncul di sini.</p>
            </div>
        @endforelse
    </div>

    @if (method_exists($orders, 'links'))
        <div class="order-pagination">
            {{ $orders->links() }}
        </div>
    @endif

</main>
@endsection