@extends('layouts.app')

@section('content')
<main class="max-w-[1200px] mx-auto px-4 md:px-16 py-6 pt-20 md:pt-24">
    <section class="profile-section">
        <div class="profile-section-header">
            <h1 class="profile-section-title">All Reviews</h1>
            <a href="{{ route('admin-profile.index') }}" class="profile-section-link">Back to Profile</a>
        </div>

        <div class="review-list pt-6">
            @forelse($reviews as $review)
                <article class="review-card">
                    <div class="review-card-top">
                        <div class="review-author">
                            <div>
                                <h3 class="review-author-name">{{ $review->name }}</h3>
                                <div class="review-stars">
                                    @for($i = 0; $i < 5; $i++)
                                        <span class="material-symbols-outlined {{ $i < (int) $review->rating ? 'material-symbols-outlined--filled' : '' }} text-[16px]">
                                            {{ $i < $review->rating ? 'star' : 'star_border' }}
                                        </span>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <span class="review-date">{{ $review->created_at }}</span>
                    </div>
                    @if($review->comment)
                        <p class="review-comment">"{{ $review->comment }}"</p>
                    @endif
                </article>
            @empty
                <p class="profile-about-text">Belum ada review.</p>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $reviews->links() }}
        </div>
    </section>
</main>
@endsection
