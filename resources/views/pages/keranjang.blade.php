<!-- resources/views/order-summary.blade.php -->
@extends('layouts.app')
@section('content')
    <x-layout.keranjang.top-bar />

    <div class="checkout-page">
        <x-sections.keranjang.header-section />

        <div class="checkout-grid">

            {{-- LEFT: item list, di-render lewat JS --}}
            <x-sections.keranjang.item-list/>


            {{-- RIGHT: ringkasan, juga dari JS --}}
            <x-sections.keranjang.payment-summary/>

        </div>
    </div>

    <script type="module">
        import Cart from '{{ Vite::asset('resources/js/cart.js') }}';

        function formatIdr(n) {
            return 'Rp ' + n.toLocaleString('id-ID');
        }

        function render() {
            const items = Cart.getItems();
            const listEl = document.getElementById('cart-items-list');
            const summaryEl = document.getElementById('cart-summary-rows');
            const emptyMsg = document.getElementById('cart-empty-msg');
            const checkoutBtn = document.getElementById('checkout-btn');

            document.getElementById('cart-item-count').textContent = items.length;

            // kosongkan lalu render ulang
            listEl.querySelectorAll('.checkout-item').forEach(el => el.remove());
            summaryEl.innerHTML = '';

            if (items.length === 0) {
                emptyMsg.classList.remove('hidden');
                checkoutBtn.disabled = true;
            } else {
                emptyMsg.classList.add('hidden');
                checkoutBtn.disabled = false;
            }

            items.forEach(item => {
                // baris di list kiri
                const row = document.createElement('div');
                row.className = 'checkout-item';
                row.innerHTML = `
                    ${item.image ? `<img src="${item.image}" alt="${item.name}" class="checkout-item-image">` : ''}
                    <div class="checkout-item-body">
                        <p class="checkout-item-name">${item.name}</p>
                        <p class="checkout-item-qty">
                            Jumlah:
                            <button type="button" class="qty-btn" data-id="${item.id}" data-delta="-1">−</button>
                            ${item.qty}
                            <button type="button" class="qty-btn" data-id="${item.id}" data-delta="1">+</button>
                        </p>
                    </div>
                    <div class="checkout-item-price">${formatIdr(item.price * item.qty)}</div>
                `;
                listEl.appendChild(row);

                // baris ringkasan kanan
                const sumRow = document.createElement('div');
                sumRow.className = 'checkout-summary-row';
                sumRow.innerHTML = `<span>${item.name} × ${item.qty}</span><span>${formatIdr(item.price * item.qty)}</span>`;
                summaryEl.appendChild(sumRow);
            });

            const total = Cart.getTotal();
            document.getElementById('cart-total').textContent = formatIdr(total);

            // bind tombol qty +/-
            listEl.querySelectorAll('.qty-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const id = btn.dataset.id;
                    const delta = Number(btn.dataset.delta);
                    const item = Cart.getItems().find(i => i.id === id);
                    if (item) Cart.updateQty(id, item.qty + delta);
                });
            });
        }

        // re-render otomatis tiap kali cart berubah (dari tab ini atau tab lain)
        window.addEventListener('cart:updated', render);
        window.addEventListener('storage', render); // sinkron antar tab
        document.addEventListener('DOMContentLoaded', render);

        // Klik "Continue to Payment" -> baru di sini data di-POST ke server & disimpan ke DB
        document.getElementById('checkout-btn').addEventListener('click', () => {
            const items = Cart.getItems();
            if (items.length === 0) return;

            window.location.href = '/shipping-details';
        });
    </script>

@endsection
