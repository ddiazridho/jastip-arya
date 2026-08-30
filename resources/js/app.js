import Alpine from 'alpinejs';
import Cart from './cart.js';

// expose ke window supaya bisa dipakai langsung di Blade tanpa import manual
window.Cart = Cart;
window.Alpine = Alpine;

// Listener global: setiap ada $dispatch('cart:add', {...}) dari mana pun
// (tombol di catalog, quick-add di modal, dll), tangani di sini.
window.addEventListener('cart:add', (event) => {
    const product = event.detail;
    Cart.addItem(product, 1);

    // opsional: kasih notifikasi ringan
    console.log(`${product.name} ditambahkan ke keranjang`);
});

Alpine.start();

// Sidebar icon active effect
document.addEventListener('DOMContentLoaded', () => {
    const icons = document.querySelectorAll('.sidebar-icon');
    icons.forEach((el) => {
        el.addEventListener('click', () => {
            icons.forEach(i => i.classList.remove('is-active'));
            el.classList.add('is-active');
        });
    });
});
