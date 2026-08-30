<button
    type="button"
    class="add-product-card flex min-h-[220px] w-full items-center justify-center rounded-3xl border p-6 transition duration-300"
    x-on:click="$dispatch('product:edit', {
        id: null,
        name: '',
        description: '',
        price: '',
        image_url: '',
        action: '{{ route('admin-catalog.store') }}',
        method: 'POST'
    })"
    aria-label="Tambah produk"
>
    <span class="material-symbols-outlined text-5xl select-none">add</span>
</button>
