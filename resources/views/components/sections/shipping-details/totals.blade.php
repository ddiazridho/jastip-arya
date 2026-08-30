<div class="jc-card">
    <h2 class="jc-card__title">Total Price</h2>

    <div class="space-y-4">
        <div id="shipping-order-items" class="space-y-2 mb-2">
            <p class="text-sm text-slate-500" id="shipping-order-empty">
                Keranjangmu kosong. Kembali ke halaman keranjang untuk memilih produk.
            </p>
        </div>

        <div class="jc-summary-row">
            <span class="jc-summary-row__label">Total Item Price</span>
            <span class="jc-summary-row__value">
                <span id="cart-total">Rp 0</span>
            </span>
        </div>

        <div class="jc-field">
            <label class="jc-label" for="shippingFee">Ongkir (isi seikhlasnya)</label>
            <div class="jc-input-wrap">
                <input
                    type="number"
                    id="shippingFee"
                    name="shipping_fee"
                    min="0"
                    max="999999999"
                    inputmode="numeric"
                    value="{{ old('shipping_fee', '') }}"
                    placeholder="0"
                    required
                    class="jc-input @error('shipping_fee') jc-input--error @enderror"
                >
            </div>
            @error('shipping_fee')
                <p class="jc-error-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="jc-summary-total">
            <span class="jc-summary-total__label">Total Bayar</span>
            <span class="jc-summary-total__value" id="grandTotal">
                Rp 0
            </span>
        </div>
    </div>
</div>