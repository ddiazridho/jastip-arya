<div class="jc-card">
    <h2 class="jc-card__title">Contact &amp; Address</h2>

    <div class="space-y-4">
        <div class="jc-field">
            <label class="jc-label" for="fullName">Nama Lengkap</label>
            <div class="jc-input-wrap">
                <input
                    type="text"
                    id="fullName"
                    name="full_name"
                    value="{{ old('full_name', '') }}"
                    placeholder="Arya Athoillah"
                    required
                    class="jc-input @error('full_name') jc-input--error @enderror"
                >
            </div>
            @error('full_name')
                <p class="jc-error-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="jc-field">
            <label class="jc-label" for="whatsapp">Nomor Whatsapp</label>
            <div class="jc-input-wrap">
                <input
                    type="tel"
                    id="whatsapp"
                    name="whatsapp_number"
                    value="{{ old('whatsapp_number', '') }}"
                    placeholder="088134506789"
                    required
                    class="jc-input @error('whatsapp_number') jc-input--error @enderror"
                >
            </div>
            @error('whatsapp_number')
                <p class="jc-error-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="jc-field">
            <label class="jc-label" for="address">Alamat</label>
            <div class="jc-input-wrap">
                <textarea
                    id="address"
                    name="address"
                    rows="2"
                    placeholder="Cari lokasi..."
                    required
                    class="jc-textarea @error('address') jc-textarea--error @enderror"
                >{{ old('address', '') }}</textarea>
            </div>
            @error('address')
                <p class="jc-error-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="jc-field">
            <label class="jc-label" for="address">Tempat Pengambilan</label>
            <div class="jc-input-wrap">
                <textarea
                    id="pickup"
                    name="pickup"
                    placeholder="Contoh : COD di Simpang Lima"
                    rows='1'
                    required
                    class="jc-textarea @error('pickup') jc-textarea--error @enderror"
                ></textarea>
            </div>
            @error('pickup')
                <p class="jc-error-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="jc-field">
            <label class="jc-label" for="deliveryNote">Catatan (Opsional)</label>
            <div class="jc-input-wrap">
                <textarea
                    id="deliveryNote"
                    name="delivery_note"
                    rows='1'
                    placeholder=""
                    class="jc-textarea"
                >{{ old('delivery_note', '') }}</textarea>
            </div>
        </div>
    </div>
</div>