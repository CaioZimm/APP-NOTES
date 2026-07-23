<div class="w-full max-w-sm flex flex-col items-center justify-center space-y-12"
     x-data="{
        time: 0,
        isRun: false,
        isPause: false,
        interval: null,
        get formatted() {
            const min = Math.floor(this.time / 60);
            const sec = this.time % 60;
            return String(min).padStart(2, '0') + ':' + String(sec).padStart(2, '0');
        },
        play() {
            this.isRun = true;
            this.isPause = false;
            this.interval = setInterval(() => {
                this.time++;
            }, 1000);
        },
        pause() {
            this.isRun = false;
            this.isPause = true;
            clearInterval(this.interval);
        },
        resume() {
            this.play();
        },
        restart() {
            this.isRun = false;
            this.isPause = false;
            clearInterval(this.interval);
            this.time = 0;
        }
     }">
    
    <!-- Relógio do Cronômetro -->
    <div class="text-center">
        <h1 class="text-7xl sm:text-8xl font-black font-mono tracking-tight text-gray-900 dark:text-white select-none" x-text="formatted">00:00</h1>
    </div>

    <!-- Controles -->
    <div class="w-full px-4 flex items-center justify-center">

        <!-- Rodando -->
        <template x-if="isRun">
            <div class="w-full flex gap-4">
                <button @click="pause()" class="flex-1 py-4 bg-yellow-500 hover:bg-yellow-600 text-white rounded-xl font-bold shadow-lg shadow-yellow-500/10 transition-all flex items-center justify-center gap-2">
                    <i class="fa-solid fa-pause text-lg"></i> Pausar
                </button>
                <button @click="restart()" class="flex-1 py-4 bg-gray-150 hover:bg-gray-200 dark:bg-zinc-800 dark:hover:bg-zinc-700 text-gray-700 dark:text-gray-300 rounded-xl font-bold transition-all flex items-center justify-center gap-2">
                    <i class="fa-solid fa-rotate-left text-lg"></i> Reiniciar
                </button>
            </div>
        </template>
        
        <!-- Pausado -->
        <template x-if="!isRun && isPause">
            <div class="w-full flex gap-4">
                <button @click="resume()" class="flex-1 py-4 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold shadow-lg shadow-blue-500/15 transition-all flex items-center justify-center gap-2">
                    <i class="fa-solid fa-play text-lg"></i> Retomar
                </button>
                <button @click="restart()" class="flex-1 py-4 bg-gray-150 hover:bg-gray-200 dark:bg-zinc-800 dark:hover:bg-zinc-700 text-gray-700 dark:text-gray-300 rounded-xl font-bold transition-all flex items-center justify-center gap-2">
                    <i class="fa-solid fa-rotate-left text-lg"></i> Reiniciar
                </button>
            </div>
        </template>
        
        <!-- Parado / Inicial -->
        <template x-if="!isRun && !isPause">
            <button @click="play()" class="w-32 h-32 flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white rounded-full shadow-lg shadow-blue-500/20 transition-all hover:scale-105 active:scale-95 focus:outline-none">
                <i class="fa-solid fa-play text-4xl pl-2"></i>
            </button>
        </template>
        
    </div>
</div>