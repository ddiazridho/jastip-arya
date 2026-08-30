@props(['shopName' => 'JastipArya', 'cartCount' => 0])

<nav class="navbar-admin" x-data>
    <button
    type="button"
    class="navbar-btn"
    @click="$dispatch('admin-menu-toggle')"
    aria-label="Toggle menu">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <h1 class="navbar-brand-admin">{{ $shopName }}</h1>
</nav>
