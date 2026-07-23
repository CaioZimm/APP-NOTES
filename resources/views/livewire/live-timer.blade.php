<div class="text-center" x-data="{ 
        currentTime: '{{ $currentTime }}', 
        timezone: '{{ $timezone }}',
        updateTime() {
            this.currentTime = new Date().toLocaleTimeString('pt-BR', { timeZone: this.timezone, hour12: false });
        }
    }" 
    x-init="setInterval(() => updateTime(), 1000)">
    <h1 class="text-4xl xs:text-5xl sm:text-7xl md:text-8xl font-black tracking-tight text-gray-900 dark:text-white font-mono select-none" x-text="currentTime"> {{ $currentTime }} </h1>
    <span class="inline-flex items-center gap-1.5 px-3 py-1 mt-3 text-xs font-semibold text-gray-500 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-full border border-gray-150 dark:border-zinc-700/60">
        <i class="fa-solid fa-earth-americas text-blue-500"></i>
        <span>{{ $timezone }}</span>
    </span>
</div>