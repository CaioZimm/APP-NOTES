<div>
    @include('components.partials.navigation')

    <main class="max-w-4xl mx-auto px-4 py-10 flex flex-col items-center min-h-[calc(100vh-4rem)] justify-center">

        <!-- Alternador de Telas -->
        <div class="flex items-center gap-3 p-1.5 bg-gray-100 dark:bg-zinc-800 rounded-xl w-full max-w-md shadow-inner">
            <button wire:click="timer" 
                    class="flex-1 py-3 text-center rounded-lg font-semibold text-sm transition-all duration-200 {{ $screen === 'timer' ? 'bg-white dark:bg-zinc-700 text-blue-600 dark:text-white shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white' }}">
                Temporizador
            </button>
            <button wire:click="stopwatch" 
                    class="flex-1 py-3 text-center rounded-lg font-semibold text-sm transition-all duration-200 {{ $screen === 'stopwatch' ? 'bg-white dark:bg-zinc-700 text-blue-600 dark:text-white shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white' }}">
                Cronômetro
            </button>
        </div>

        <!-- Conteúdo do Timer / Stopwatch -->
        <div class="w-full flex-1 flex items-center justify-center mt-8">
            @if($screen === 'timer')
                <livewire:stop-watch.timer />
            @elseif($screen === 'stopwatch')
                <livewire:stop-watch.stop-watch />
            @endif
        </div>
        
    </main>
</div>