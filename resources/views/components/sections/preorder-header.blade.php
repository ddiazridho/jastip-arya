@props(['deadline'])

<section class="preorder-section py-6 sm:py-12 mt-4 sm:mt-8 mb-5 text-center px-4" id='preorder-section'>
    <h1 class="preorder-title text-xl sm:text-2xl md:text-3xl">Jastip by Arya Athoillah</h1>

    <div class="mt-4 sm:mt-6">
        <x-features.countdown-timer :deadline="$deadline" />
    </div>
</section>
