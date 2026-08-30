<div class="checkout-main-col">
    <div class="checkout-card">
        <h3 class="checkout-card-title">
            Items (<span id="cart-item-count">0</span>)
        </h3>
        <hr class="checkout-divider">

        {{-- container kosong, diisi JS dari localStorage --}}
        <div id="cart-items-list" class="divide-y divide-slate-100">
            <p id="cart-empty-msg" class="text-slate-400 text-sm py-6 text-center hidden">
                Keranjang kamu masih kosong.
            </p>
        </div>
    </div>
</div>