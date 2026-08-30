@props(['products'])

<section class="product-section" id='product-section'>
    <div class="product-grid">
        @foreach($products as $product)
            <x-features.product-card :product="$product" />
        @endforeach
    </div>
</section>
