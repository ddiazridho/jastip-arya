@props(['images'])

<section class="bg-background mt-20 md:mt-32">
    <div class="mx-auto max-w-6xl px-4 sm:px-6 grid gap-8 md:gap-10 md:grid-cols-[1.5fr_1fr] md:items-center">

        <div class="max-w-xl">
            <h1 class="font-display text-2xl sm:text-3xl md:text-4xl font-semibold text-on-surface leading-tight">
                Kepercayaan dimulai dari kenyamanan
            </h1>

            <p class="font-body text-on-surface-variant mt-4 leading-relaxed">
                Semua pesanan dapat packing extra aman gratis, tanpa syarat minimum pembelian.
            </p>

            <a href="#preorder-section" class="font-body inline-block mt-6 rounded-full bg-primary text-on-primary px-6 py-2.5 text-sm font-medium hover:opacity-90 transition">
                SHOP NOW
            </a>
        </div>

        <div class="relative max-w-md justify-self-end w-full">
            <div class="flex gap-3 overflow-x-auto snap-x snap-mandatory scrollbar-hide pb-2">
                @foreach ($images as $image)
                    <div class="shrink-0 w-[80vw] sm:w-[70%] md:w-80 h-52 sm:h-60 md:h-64 rounded-2xl overflow-hidden bg-surface-container snap-center">
                        <img
                            src="{{ asset('storage/' . $image) }}"
                            alt="{{ $image->alt ?? '' }}"
                            class="w-full h-full object-cover"
                            loading="lazy"
                        >
                    </div>
                @endforeach
            </div>
            <div class="pointer-events-none absolute inset-y-0 right-0 w-12 bg-gradient-to-l from-white to-transparent"></div>
        </div>

    </div>
</section>