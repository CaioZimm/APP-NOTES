<div>
    @include('components.partials.navigation')

    <main class="flex justify-between items-center flex-col w-full h-[70vh]">
        {{-- PÁGINAS --}}
        @if($screen === 'timer')
            <div class="w-2/5 items-center flex justify-center gap-[14vh] mt-14">
                <button wire:click='timer' class="border border-black bg-blue-400 py-5 w-56 rounded-2xl font-semibold text-base hover:bg-slate-400 transition-all">
                    Temporizador
                </button>
            
                <button wire:click='stopwatch' class="border border-black py-5 w-56 rounded-2xl font-semibold text-base hover:bg-slate-400 transition-all">
                    Cronômetro
                </button>
            </div>

            <livewire:stop-watch.timer />

        @elseif($screen === 'stopwatch')
            <div class="w-2/5 items-center flex justify-center gap-[14vh] mt-14">
                <button wire:click='timer' class="border border-black py-5 w-56 rounded-2xl font-semibold text-base hover:bg-slate-400 transition-all">
                    Temporizador
                </button>
            
                <button wire:click='stopwatch' class="border border-black bg-blue-400 py-5 w-56 rounded-2xl font-semibold text-base hover:bg-slate-400 transition-all">
                    Cronômetro
                </button>
            </div>

            <livewire:stop-watch.stop-watch />
        @endif
    </main>
</div>