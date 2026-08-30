@extends('layouts.app')
@section('content')
    <x-layout.keranjang.top-bar/>

    <main class="jc-page">

        <x-sections.shipping-details.header-section/>

        <form method="POST" action="{{ route('shipping-details.store') }}" class="jc-layout" enctype="multipart/form-data">
            @csrf

            {{-- ============ KOLOM KIRI: FORM ============ --}}
            <div class="jc-layout__form">

                {{-- Produk Pesanan --}}
                <x-sections.shipping-details.product-card/>

                {{-- Contact & Address --}}
                <x-sections.shipping-details.contact-address/>

                {{-- Payment Method --}}
                <x-sections.shipping-details.payments :payments="$paymentMethods" />
            </div>

            {{-- ============ KOLOM KANAN: RINGKASAN PESANAN ============ --}}
            <aside class="jc-layout__sidebar">
                <x-sections.shipping-details.totals />

                <div class="mt-4 md:mt-0">
                    <button type="submit" class="jc-btn-primary">
                        <span>Selesaikan pesanan</span>
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </button>
                </div>
            </aside>
        <input type="hidden" name="cart_items" id="cartItemsInput" value="{{ old('cart_items', '') }}">
        <input type="hidden" name="cart_total" id="cartTotalInput" value="{{ old('cart_total', 0) }}">

        </form>
    </main>

    <script type="module">
        import Cart from '{{ Vite::asset('resources/js/cart.js') }}';

        const cartItems = Cart.getItems();
        const cartItemsContainer = document.getElementById('shipping-cart-items');
        const cartEmptyMessage = document.getElementById('shipping-cart-empty');
        const orderItemsContainer = document.getElementById('shipping-order-items');
        const cartTotalValue = document.getElementById('cart-total');
        const cartItemsInput = document.getElementById('cartItemsInput');
        const cartTotalInput = document.getElementById('cartTotalInput');
        const shippingFeeInput = document.getElementById('shippingFee');
        const grandTotalEl = document.getElementById('grandTotal');
        const paymentRadios = document.querySelectorAll('input[name="payment_method"]');
        const qrisExtraFields = document.getElementById('qrisExtraFields');

        const formatRupiah = (value) =>
            'Rp ' + new Intl.NumberFormat('id-ID').format(value);

        const updateGrandTotal = (itemTotal) => {
            const shippingFee = parseInt(shippingFeeInput.value || '0', 10);
            grandTotalEl.textContent = formatRupiah(itemTotal + shippingFee);
        };

        const renderCartItems = () => {
            if (!cartItems.length) {
                cartEmptyMessage.classList.remove('hidden');
                orderItemsContainer.innerHTML = '<p class="text-sm text-slate-500">Keranjang masih kosong. Kembali ke halaman keranjang untuk memilih produk.</p>';
                cartTotalValue.textContent = formatRupiah(0);
                cartItemsInput.value = '';
                cartTotalInput.value = 0;
                updateGrandTotal(0);
                return;
            }

            cartEmptyMessage.classList.add('hidden');
            cartItemsContainer.innerHTML = '';
            orderItemsContainer.innerHTML = '';

            const preview = document.createElement('div');
            preview.className = 'space-y-4';

            cartItems.forEach(item => {
                const itemCard = document.createElement('div');
                itemCard.className = 'flex items-start gap-4';
                itemCard.innerHTML = `
                    ${item.image ? `<img src="${item.image}" alt="${item.name}" class="h-24 w-24 rounded-2xl border border-slate-200 object-cover">` : ''}
                    <div class="flex-1">
                        <p class="text-base font-medium">${item.name}</p>
                        <p class="text-sm text-slate-500">Jumlah: ${item.qty}</p>
                        <p class="mt-2 text-sm font-semibold">${formatRupiah(item.price * item.qty)}</p>
                    </div>
                `;
                preview.appendChild(itemCard);

                const summaryRow = document.createElement('div');
                summaryRow.className = 'flex justify-between text-sm';
                summaryRow.style.color = 'var(--color-on-surface-variant)';
                summaryRow.innerHTML = `<span>${item.name} × ${item.qty}</span><span>${formatRupiah(item.price * item.qty)}</span>`;
                orderItemsContainer.appendChild(summaryRow);
            });

            cartItemsContainer.appendChild(preview);

            const totalPrice = Cart.getTotal();
            cartTotalValue.textContent = formatRupiah(totalPrice);
            cartItemsInput.value = JSON.stringify(cartItems);
            cartTotalInput.value = totalPrice;
            updateGrandTotal(totalPrice);
        };

        shippingFeeInput.addEventListener('input', () => {
            shippingFeeInput.value = shippingFeeInput.value.replace(/\D/g, '').slice(0, 9);
            const totalPrice = Cart.getTotal();
            updateGrandTotal(totalPrice);
        });

        const updateQrisVisibility = () => {
            const selectedMethod = document.querySelector('input[name="payment_method"]:checked');
            if (selectedMethod?.value === 'qris') {
                qrisExtraFields.classList.remove('hidden');
            } else {
                qrisExtraFields.classList.add('hidden');
            }
        };

        paymentRadios.forEach((radio) => {
            radio.addEventListener('change', updateQrisVisibility);
        });

        renderCartItems();
        updateQrisVisibility();
    </script>
@endsection