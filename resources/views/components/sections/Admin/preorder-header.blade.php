@props(['deadline'])

<section class="preorder-section admin-preorder-section">
    <h1 class="preorder-title">Jastip by Arya Athoillah</h1>

    <div class="mt-6">
        <x-features.countdown-timer :deadline="$deadline" />
    </div>
    <form action="{{ route('admin-catalog.time.update') }}" method="POST" class="deadline-form">
        @csrf
        @method('PUT')

        <input
            type="datetime-local"
            name="deadline"
            value="{{ $deadline?->format('Y-m-d\TH:i') }}"
            class="deadline-input"
            required
        >

        <button type="submit" class="deadline-button">
            Set Deadline
        </button>
    </form>
</section>
