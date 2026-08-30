@props(['shopName' => 'JastipArya', 'cartCount' => 0])

<nav class="navbar" x-data>
    <button
    type="button"
    class="navbar-btn"
    @click="$dispatch('menu-toggle')"
    aria-label="Toggle menu">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <h1 class="navbar-brand">{{ $shopName }}</h1>

    <a
        href="{{ route('keranjang') }}"
        class="relative navbar-btn"
        aria-label="Keranjang"
        x-data="{ count: {{ (int) $cartCount }}, pulse: false, timer: null }"
        x-init="count = window.Cart.getItemCount()"
        x-on:cart:updated.window="
            count = window.Cart.getItemCount();
            pulse = false;
            $nextTick(() => {
                pulse = true;
                clearTimeout(timer);
                timer = setTimeout(() => pulse = false, 500);
            });
        "
        x-bind:class="{ 'cart-icon-bump': pulse }"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
        </svg>

        <span
            x-show="count > 0"
            x-text="count > 99 ? '99+' : count"
            x-bind:class="{ 'cart-badge-pop': pulse }"
            class="cart-badge"
            x-cloak
        ></span>
    </a>
</nav>
