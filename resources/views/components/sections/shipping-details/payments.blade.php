@props(['payments' => collect()])

<div class="jc-card">
    <h2 class="jc-card__title">Pilih Metode Pembayaran</h2>

    <div class="jc-payment-grid">
        @foreach ($payments as $method)
            <label class="jc-payment-option">
                <input
                    type="radio"
                    name="payment_method"
                    value="{{ $method->value }}"
                    class="jc-payment-option__radio"
                    {{ old('payment_method', 'cash') === $method->value ? 'checked' : '' }}
                    required
                >
                <span class="material-symbols-outlined" style="color: var(--color-on-surface-variant);">
                    {{ $method->icon }}
                </span>
                <span class="jc-payment-option__label">{{ $method->label }}</span>
            </label>
        @endforeach
    </div>
    @error('payment_method')
        <p class="jc-error-text">{{ $message }}</p>
    @enderror

    <div id="qrisExtraFields" class="hidden space-y-4">
        <div class="jc-card">
            <h3 class="jc-card__title text-base">QRIS ARYA</h3>
            <img
                src="{{ asset('storage/qris/qris arya.webp') }}"
                alt="QRIS ARYA"
                class="mx-auto w-48 rounded-2xl border border-slate-200 object-contain"
            >
            <div class="jc-field">
                <label class="jc-label" for="qrisImage">Upload Bukti QRIS</label>
                <input
                    type="file"
                    id="qrisImage"
                    name="qris_image"
                    accept="image/*"
                    class="jc-file-input"
                >
            </div>
        </div>
    </div>
</div>