@props(['product'])

<div class="product-body">
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

        {{-- Cart disimpan di frontend (localStorage), bukan tabel carts di DB.
             Event ini yang ditangkap store Alpine global buat nambahin item. --}}
        <button
            type="button"
            x-data="{ added: false, timer: null }"
            x-on:click="
                $dispatch('cart:add', @js([
                    'id'    => $product->id,
                    'name'  => $product->name,
                    'price' => $product->price,
                    'image' => $product->image_url,
                ]));
                added = true;
                clearTimeout(timer);
                timer = setTimeout(() => added = false, 900);
            "
            x-bind:class="{ 'btn-add-cart-success': added }"
            class="btn-add-cart"
            aria-label="Tambah {{ $product->name }} ke keranjang"
        >
            <svg xmlns="http://www.w3.org/2000/svg"
                x-show="!added"
                class="h-4 w-4 sm:h-5 sm:w-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2.5">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 4v16m8-8H4" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg"
                x-show="added"
                x-cloak
                class="h-5 w-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
        </button>
    </div>
</div>
