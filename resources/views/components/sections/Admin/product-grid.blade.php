@props(['products'])

<section
    class="product-section"
    x-data="{
        open: false,
        product: {
            id: null,
            name: '',
            description: '',
            price: '',
            image_url: '',
            action: '',
            method: 'POST'
        }
    }"
    x-on:product:edit.window="
        product = $event.detail;
        open = true;
    "
>
    <div class="product-grid">
        @foreach($products as $product)
            <x-features.Admin.product-card :product="$product" />
        @endforeach

        {{-- Add new product card --}}
        <x-features.Admin.add-card />



        {{-- MODAL EDIT PRODUCT --}}
        <div
            x-show="open"
            x-cloak
            class="fixed inset-0 z-50 flex items-end sm:items-center justify-center sm:p-4"
        >
            <div
                class="absolute inset-0 bg-black/50"
                x-on:click="open = false"
            ></div>

            <div
                class="relative w-full sm:max-w-sm rounded-t-2xl sm:rounded-xl bg-white p-5 pb-8 sm:p-6 shadow-xl max-h-[90dvh] overflow-y-auto"
                x-on:click.stop
            >
                {{-- Drag handle (mobile indicator) --}}
                <div class="flex justify-center mb-3 sm:hidden">
                    <div class="w-10 h-1 rounded-full bg-gray-300"></div>
                </div>
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-xl font-semibold">
                        Edit Produk
                    </h2>

                    <button
                        type="button"
                        x-on:click="open = false"
                        class="text-gray-500 hover:text-gray-700 w-9 h-9 flex items-center justify-center rounded-full hover:bg-gray-100"
                    >
                        ✕
                    </button>
                </div>

                <form
                    x-bind:action="product.action"
                    method="POST"
                    enctype="multipart/form-data"
                >
                    @csrf

                    <input
                        type="hidden"
                        name="_method"
                        x-bind:value="product.method"
                    >

                    <div class="mb-2">
                        <label class="mb-1 block text-sm font-medium">
                            Nama
                        </label>

                        <input
                            type="text"
                            name="name"
                            x-model="product.name"
                            required
                            class="w-full rounded-lg border px-3 py-2 text-sm"
                        >
                    </div>

                    <div class="mb-2">
                        <label class="mb-1 block text-sm font-medium">
                            Deskripsi
                        </label>

                        <textarea
                            name="description"
                            x-model="product.description"
                            rows="3"
                            class="w-full rounded-lg border px-3 py-2 text-sm"
                        ></textarea>
                    </div>

                    <div class="mb-2">
                        <label class="mb-1 block text-sm font-medium">
                            Harga
                        </label>

                        <input
                            type="number"
                            name="price"
                            x-model="product.price"
                            min="0"
                            required
                            class="w-full rounded-lg border px-3 py-2 text-sm"
                        >
                    </div>

                    <div class="mb-2">
                        <label class="mb-1 block text-sm font-medium">
                            Gambar
                        </label>

                        <input
                            type="file"
                            name="image"
                            accept="image/*"
                            class="w-full rounded-lg border px-3 py-2 text-sm"
                            x-bind:required="!product.image_url"
                        >

                        <template x-if="product.image_url">
                            <img
                                x-bind:src="`/storage/${product.image_url}`"
                                class="mt-3 h-16 w-16 rounded-lg object-cover"
                            >
                        </template>
                    </div>

                    <div class="flex justify-end gap-2">
                        <button
                            type="button"
                            x-on:click="open = false"
                            class="rounded-lg border px-3 py-1.5 text-sm"
                        >
                            Batal
                        </button>

                        <button
                            type="submit"
                            class="rounded-lg bg-black px-3 py-1.5 text-white text-sm"
                        >
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
