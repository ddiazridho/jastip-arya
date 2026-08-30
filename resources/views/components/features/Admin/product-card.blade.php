@props(['product'])

<div
    class="product-body"
    x-on:click="$dispatch('product:edit', @js([
        'id' => $product->id,
        'name' => $product->name,
        'description' => $product->description,
        'price' => $product->price,
        'image_url' => $product->image_url,
        'action'=> route('admin-catalog.update', $product),
        'method'=>'PUT'
    ]))"
>
    <div class='product-image-wrapper'>
        <img
            src="{{ asset('storage/' . $product->image_url) }}"
            alt="{{ $product->name }}"
            class="product-image"
            loading="lazy"
        >
    </div>  
    <div class="product-content">
        <p class="product-title">
            {{ $product->name }}
        </p>

        <p class="product-desc">
            {{ $product->description }}
        </p>
    </div>

    <div class="product-footer">
        <span class="product-price">
            Rp{{ number_format($product->price, 0) }}
        </span>

        <div class="product-actions">
            {{-- Edit --}}
            <button
                type="button"
                class="btn-edit-product"
                aria-label="Edit {{ $product->name }}"
                x-on:click.stop="$dispatch('product:edit', @js([
                    'id' => $product->id,
                    'name' => $product->name,
                    'description' => $product->description,
                    'price' => $product->price,
                    'image_url' => $product->image_url,
                    'action'=> route('admin-catalog.update', $product),
                    'method'=>'PUT'
                ]))"
            >
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 sm:h-5 sm:w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-9.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 8.5-8.5z"
                    />
                </svg>
            </button>

            {{-- Hapus --}}
            <form
                action="{{ route('admin-catalog.destroy', $product) }}"
                method="POST"
                onsubmit="return confirm('Yakin ingin menghapus produk ini?')"
                x-on:click.stop
            >
                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="btn-delete-product"
                    aria-label="Hapus {{ $product->name }}"
                >
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4 sm:h-5 sm:w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0h10"
                        />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>
