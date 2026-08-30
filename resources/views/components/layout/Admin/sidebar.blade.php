<div x-data="{ open: false }"
    @admin-menu-toggle.window="open = !open"
    @keydown.escape.window="open = false">

    {{-- Backdrop overlay (mobile) --}}
    <div
        x-show="open"
        x-cloak
        x-transition:enter="transition-opacity duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-30 bg-black/50 backdrop-blur-[2px]"
        @click="open = false"
        aria-hidden="true"
    ></div>

    {{-- Drawer --}}
    <aside id="admin-sidebar-menu" class="sidebar"
        x-show="open"
        x-cloak
        x-transition:enter="transition transform duration-300"
        x-transition:enter-start="-translate-x-full opacity-0"
        x-transition:enter-end="translate-x-0 opacity-100"
        x-transition:leave="transition transform duration-200"
        x-transition:leave-start="translate-x-0 opacity-100"
        x-transition:leave-end="-translate-x-full opacity-0"
        :class="{ 'sidebar-open': open }"
        role="dialog"
        aria-modal="true"
        aria-label="Menu admin">

        <div class="sidebar-brand">
            <span class="sidebar-brand-text">JastipArya Admin</span>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ route('admin-catalog.index') }}"
                class="sidebar-link {{ request()->routeIs('admin-catalog.*') ? 'sidebar-link-active' : '' }}"
                @click="open = false">
                <svg xmlns="http://www.w3.org/2000/svg" class="sidebar-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
                <span>Home</span>
            </a>

            <a href="{{ route('list-orders.index') }}"
                class="sidebar-link {{ request()->routeIs('list-orders.*') ? 'sidebar-link-active' : '' }}"
                @click="open = false">
                <svg xmlns="http://www.w3.org/2000/svg" class="sidebar-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 3v5h5"></path>
                    <path d="M3.05 13A9 9 0 1 0 6 5.3L3 8"></path>
                    <path d="M12 7v5l4 2"></path>
                </svg>
                <span>List Order</span>
            </a>

            <a href="{{ route('admin-profile.admin') }}"
                class="sidebar-link {{ request()->routeIs('admin-profile.admin') ? 'sidebar-link-active' : '' }}"
                @click="open = false">
                <svg xmlns="http://www.w3.org/2000/svg" class="sidebar-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                <span>Admin Profile</span>
            </a>
        </nav>
    </aside>
</div>