// resources/js/cart.js
// Modul sederhana untuk mengelola keranjang belanja via localStorage.
// Bisa dipanggil dari halaman catalog (tombol +) maupun halaman order-summary (render & checkout).

const CART_KEY = 'jastiparyo_cart';

function resolveImageUrl(image) {
    if (!image) return '';
    if (image.startsWith('http://') || image.startsWith('https://') || image.startsWith('/')) {
        return image;
    }

    return `/storage/${image}`;
}

const Cart = {

    /**
     * Ambil semua item di keranjang.
     * Format tiap item: { id, name, description, image, price, qty }
     */
    getItems() {
        const raw = localStorage.getItem(CART_KEY);
        if (!raw) return [];

        try {
            const items = JSON.parse(raw);
            if (!Array.isArray(items)) return [];

            // Bersihkan data lama/tidak lengkap agar UI tidak menampilkan "undefined".
            return items
                .filter(item => item && item.id != null)
                .map(item => ({
                    id: item.id,
                    name: item.name || 'Produk',
                    image: resolveImageUrl(item.image || item.image_url || ''),
                    price: Number(item.price) || 0,
                    qty: Math.max(Number(item.qty) || 1, 1),
                }));
        } catch {
            localStorage.removeItem(CART_KEY);
            return [];
        }
    },

    /**
     * Simpan ulang seluruh array item ke localStorage.
     */
    _save(items) {
        localStorage.setItem(CART_KEY, JSON.stringify(items));
        // broadcast event supaya komponen lain (misal navbar cart-badge) bisa auto update
        window.dispatchEvent(new CustomEvent('cart:updated', { detail: items }));
    },

    /**
     * Tambah item. Kalau id sudah ada, qty-nya ditambah (bukan duplikat baris).
     */
    addItem(product, qty = 1) {
        const items = this.getItems();
        const existing = items.find(i => i.id === product.id);

        if (existing) {
            existing.qty += qty;
        } else {
            items.push({
                id: product.id,
                name: product.name,
                image: resolveImageUrl(product.image || product.image_url || ''),
                price: product.price, // angka mentah, bukan "¥5,500"
                qty: qty,
            });
        }

        this._save(items);
    },

    /**
     * Update qty item tertentu. Kalau qty <= 0, item dihapus.
     */
    updateQty(id, qty) {
        let items = this.getItems();

        if (qty <= 0) {
            items = items.filter(i => i.id !== id);
        } else {
            const item = items.find(i => i.id === id);
            if (item) item.qty = qty;
        }

        this._save(items);
    },

    removeItem(id) {
        const items = this.getItems().filter(i => i.id !== id);
        this._save(items);
    },

    clear() {
        localStorage.removeItem(CART_KEY);
        window.dispatchEvent(new CustomEvent('cart:updated', { detail: [] }));
    },

    /**
     * Total harga (Yen, sebelum konversi IDR).
     */
    getTotal() {
        return this.getItems().reduce((sum, i) => sum + (i.price * i.qty), 0);
    },

    getItemCount() {
        return this.getItems().reduce((sum, i) => sum + i.qty, 0);
    },
};

export default Cart;
