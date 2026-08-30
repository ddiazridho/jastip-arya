@props(['deadline'])

<div
    x-data="{
        deadline: new Date('{{ \Illuminate\Support\Carbon::parse($deadline)->toIso8601String() }}').getTime(),
        days: '00',
        hours: '00',
        minutes: '00',
        tick() {
            const diff = Math.max(this.deadline - Date.now(), 0);
            this.days = String(Math.floor(diff / 86400000)).padStart(2, '0');
            this.hours = String(Math.floor((diff % 86400000) / 3600000)).padStart(2, '0');
            this.minutes = String(Math.floor((diff % 3600000) / 60000)).padStart(2, '0');
        }
    }"
    x-init="tick(); setInterval(() => tick(), 60000)"
    class="timer-container"
>
    <div class="timer-box">
        <span class="timer-value" x-text="days"></span>
        <span class="timer-label">DAYS</span>
    </div>

    <div class="timer-box">
        <span class="timer-value" x-text="hours"></span>
        <span class="timer-label">HRS</span>
    </div>

    <div class="timer-box">
        <span class="timer-value" x-text="minutes"></span>
        <span class="timer-label">MIN</span>
    </div>
</div>
