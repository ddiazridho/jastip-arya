@props(['admin', 'stats', 'reviews'])

{{-- Profile Header --}}
<section class="profile-header">
    <div class="profile-avatar-ring">
        <img
            src="{{ asset('storage/' . $admin->avatar_url) }}"
            alt="{{ $admin->name }}"
            class="profile-avatar"
        >
    </div>

    <h1 class="profile-name">{{ $admin->name }}</h1>

    <div class="profile-location">
        <span class="material-symbols-outlined !text-[16px]">location_on</span>
        <span>{{ $admin->city }}</span>
    </div>
</section>

{{-- Tagline --}}
@if($admin->tagline)
    <section class="profile-tagline">
        "{{ $admin->tagline }}"
    </section>
@endif

{{-- Contact buttons --}}
<section class="profile-contact-actions">
    @if($admin->whatsapp_url)
        <a href="{{ $admin->whatsapp_url }}" target="_blank" rel="noopener" class="btn-contact btn-contact--whatsapp">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5">
                <path
                    fill="#25D366"
                    d="M12 2a10 10 0 0 0-8.66 15L2 22l5.17-1.32A10 10 0 1 0 12 2zm0 18a8 8 0 0 1-4.1-1.13l-.29-.17-3.07.78.82-2.99-.19-.31A8 8 0 1 1 12 20zm4.37-5.97c-.24-.12-1.42-.7-1.64-.78-.22-.08-.38-.12-.54.12-.16.24-.62.78-.76.94-.14.16-.28.18-.52.06-.24-.12-1-.37-1.9-1.18-.7-.62-1.18-1.39-1.32-1.63-.14-.24-.01-.37.1-.49.1-.1.24-.28.36-.42.12-.14.16-.24.24-.4.08-.16.04-.3-.02-.42-.06-.12-.54-1.3-.74-1.78-.2-.47-.4-.41-.54-.42h-.46c-.16 0-.42.06-.64.3-.22.24-.84.82-.84 2s.86 2.32.98 2.48c.12.16 1.69 2.58 4.1 3.62.57.25 1.01.4 1.36.51.57.18 1.09.15 1.5.09.46-.07 1.42-.58 1.62-1.14.2-.56.2-1.04.14-1.14-.06-.1-.22-.16-.46-.28z"
                />
            </svg>
        </a>
    @endif

    @if($admin->tiktok_url)
        <a href="{{ $admin->tiktok_url }}" target="_blank" rel="noopener" class="btn-contact btn-contact--tiktok">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path d="M16.6 5.82c-1.02-.9-1.6-2.2-1.6-3.62h-3.14v13.4c0 1.57-1.28 2.86-2.86 2.86a2.86 2.86 0 0 1-2.86-2.86 2.86 2.86 0 0 1 2.86-2.86c.28 0 .55.04.8.12v-3.2a6.08 6.08 0 0 0-.8-.05A6 6 0 0 0 3 15.6a6 6 0 0 0 6 6 6 6 0 0 0 6-6V9.4a8.8 8.8 0 0 0 5 1.55V7.83a5.4 5.4 0 0 1-3.4-2.01z"/>
            </svg>
        </a>
    @endif

    @if($admin->instagram_url)
        <a href="{{ $admin->instagram_url }}" target="_blank" rel="noopener" class="btn-contact btn-contact--instagram">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5">
                <defs>
                    <linearGradient id="instagram-gradient" x1="0%" y1="100%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#FFD600"/>
                        <stop offset="35%" stop-color="#FF7A00"/>
                        <stop offset="65%" stop-color="#FF0069"/>
                        <stop offset="100%" stop-color="#D300C5"/>
                    </linearGradient>
                </defs>

                <path
                    fill="url(#instagram-gradient)"
                    d="M7.8 2h8.4A5.8 5.8 0 0 1 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8A5.8 5.8 0 0 1 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2zm0 2A3.8 3.8 0 0 0 4 7.8v8.4A3.8 3.8 0 0 0 7.8 20h8.4a3.8 3.8 0 0 0 3.8-3.8V7.8A3.8 3.8 0 0 0 16.2 4H7.8zm8.7 1.5a1.3 1.3 0 1 1 0 2.6 1.3 1.3 0 0 1 0-2.6zM12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm0 2a3 3 0 1 0 0 6 3 3 0 0 0 0-6z"
                />
            </svg>
        </a>
    @endif
</section>

{{-- Stats Bar --}}
<section class="profile-stats">
    <div class="profile-stat">
        <span class="profile-stat-value">{{ $stats['orders'] }}+</span>
        <span class="profile-stat-label">Orders</span>
    </div>
    <div class="profile-stat">
        <span class="profile-stat-value">{{ $stats['customers'] }}+</span>
        <span class="profile-stat-label">Customers</span>
    </div>
    <div class="profile-stat">
        <span class="profile-stat-value profile-stat-value--rating">
            {{ number_format($stats['rating'], 1) }}
            <span class="material-symbols-outlined material-symbols-outlined--filled text-[20px]">star</span>
        </span>
        <span class="profile-stat-label">Rating</span>
    </div>
</section>

{{-- About Me --}}
@if($admin->about)
    <section class="profile-section">
        <div class="profile-section-header">
            <h2 class="profile-section-title">About Me</h2>
        </div>
        <div class="profile-about-card">
            <p class="profile-about-text">{{ $admin->about }}</p>
        </div>
    </section>
@endif

{{-- Customer Reviews --}}
<section class="profile-section">
    <div class="profile-section-header">
        <h2 class="profile-section-title">Customer Review</h2>
    </div>
    <div class="review-list pt-6 grid gap-4">
        @forelse($reviews as $review)
            <article class="review-card rounded-xl border border-slate-100 bg-white p-4 shadow-sm">
                <div class="review-card-top">
                    <div class="review-author flex items-start gap-3">
                        @php $initial = mb_strtoupper(mb_substr($review->name,0,1)); @endphp
                        <div class="h-9 w-9 rounded-full bg-teal-600 text-white flex items-center justify-center font-bold" aria-hidden="true">{{ $initial }}</div>
                        <div>
                            <h3 class="review-author-name font-semibold text-slate-800">{{ $review->name }}</h3>
                            <div class="review-stars flex text-amber-400" aria-label="Rating {{ (int)$review->rating }} of 5">
                                @for($i = 0; $i < 5; $i++)
                                    <span
                                        class="material-symbols-outlined text-[16px] {{ $i < $review->rating ? 'icon-star-filled' : '' }}"
                                    >star</span>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <span class="review-date text-slate-500 text-sm">{{ optional($review->created_at)->format('d M Y') }}</span>
                </div>
                <p class="review-comment text-slate-700 leading-relaxed mt-2">{{ $review->comment }}</p>
            </article>
        @empty
            <p class="profile-about-text">Belum ada review.</p>
        @endforelse
    </div>
</section>

{{-- Add Review Form --}}
<section class="profile-section">
    <div class="profile-section-header">
        <h2 class="profile-section-title">Add a Review</h2>
    </div>
 
    <form action="{{ route('admin-profile.store') }}" method="POST" class="profile-review-form max-w-xl">
        @csrf
 
        <div class="form-field">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-input" required>
            @error('name') <p class="form-error">{{ $message }}</p> @enderror
        </div>
 
        <div class="form-field" x-data="{ rating: {{ old('rating', 0) }}, hover: 0 }">
            <label class="form-label">Rating</label>
 
            <div class="flex items-center gap-1" role="radiogroup" aria-label="Rating">
                @for ($i = 1; $i <= 5; $i++)
                    <button
                        type="button"
                        role="radio"
                        :aria-checked="rating === {{ $i }}"
                        aria-label="{{ $i }} star{{ $i > 1 ? 's' : '' }}"
                        @click="rating = {{ $i }}"
                        @mouseenter="hover = {{ $i }}"
                        @mouseleave="hover = 0"
                        class="p-0.5"
                    >
                        <span
                            class="material-symbols-outlined text-[28px] text-amber-400"
                            :style="(hover || rating) >= {{ $i }} ? { fontVariationSettings: `'FILL' 1` } : { fontVariationSettings: `'FILL' 0` }"
                        >star</span>
                    </button>
                @endfor
            </div>
 
            <input type="hidden" name="rating" :value="rating">
            @error('rating') <p class="form-error">{{ $message }}</p> @enderror
        </div>
 
        <div class="form-field">
            <label class="form-label">Comment (optional)</label>
            <textarea name="comment" class="form-textarea" rows="3" placeholder="Your experience (optional)"></textarea>
            @error('comment') <p class="form-error">{{ $message }}</p> @enderror
        </div>
 
        <button type="submit" class="btn-contact">Submit Review</button>
    </form>
</section>
 