<div class="w-full max-w-sm flex flex-col items-center justify-center space-y-10"
     x-data="{
        time: 300,
        isRun: false,
        isPause: false,
        interval: null,
        formattedInput: '05:00',
        init() {
            this.$watch('formattedInput', (val) => {
                if (this.isRun || this.isPause) return;
                
                let parts = val.split(':');
                if (parts.length === 3) {
                    this.time = (parseInt(parts[0]||0) * 3600) + (parseInt(parts[1]||0) * 60) + parseInt(parts[2]||0);
                } else if (parts.length === 2) {
                    this.time = (parseInt(parts[0]||0) * 60) + parseInt(parts[1]||0);
                } else if (!isNaN(val) && val !== '') {
                    this.time = parseInt(val||0);
                }
            });
        },
        get formattedDisplay() {
            const h = Math.floor(this.time / 3600);
            const m = Math.floor((this.time % 3600) / 60);
            const s = this.time % 60;
            if (h > 0) return String(h).padStart(2, '0') + ':' + String(m).padStart(2, '0') + ':' + String(s).padStart(2, '0');
            return String(m).padStart(2, '0') + ':' + String(s).padStart(2, '0');
        },
        start() {
            if (this.time <= 0) {
                this.time = 300;
                this.formattedInput = '05:00';
            }
            this.isRun = true;
            this.isPause = false;
            this.interval = setInterval(() => {
                if (this.time > 0) {
                    this.time--;
                } else {
                    this.isRun = false;
                    clearInterval(this.interval);
                }
            }, 1000);
        },
        pause() {
            this.isRun = false;
            this.isPause = true;
            clearInterval(this.interval);
        },
        resume() {
            this.start();
        },
        restart() {
            this.isRun = false;
            this.isPause = false;
            clearInterval(this.interval);
            this.time = 300;
            this.formattedInput = '05:00';
        },
        setPomodoro() {
            this.time = 1500;
            this.formattedInput = '25:00';
            this.isRun = false;
            this.isPause = false;
            clearInterval(this.interval);
        },
        setBreak() {
            this.time = 300;
            this.formattedInput = '05:00';
            this.isRun = false;
            this.isPause = false;
            clearInterval(this.interval);
        }
     }">
    
    <div class="flex flex-col items-center w-full">

        <!-- Input / Display do Cronômetro -->
        <div class="w-full flex items-center justify-center">
            <template x-if="!isRun && !isPause">
                <input x-model.debounce.800ms="formattedInput" placeholder="05:00" inputmode="numeric" required 
                       class="text-7xl sm:text-8xl bg-transparent font-black font-mono border-b-2 border-gray-300 dark:border-zinc-700 outline-none w-full max-w-[280px] text-center placeholder:text-gray-400 dark:text-white focus:border-blue-500 transition-colors" />
            </template>
            <template x-if="isRun || isPause">
                <h1 class="text-7xl sm:text-8xl font-black font-mono tracking-tight text-gray-900 dark:text-white select-none text-center" x-text="formattedDisplay"></h1>
            </template>
        </div>
        
        <!-- Presets Pomodoro (Apenas se parado) -->
        <template x-if="!isRun && !isPause">
            <div class="flex gap-3 mt-6">
                <button @click="setPomodoro()" class="px-4 py-2 bg-red-50 text-red-600 hover:bg-red-100 dark:bg-red-950/20 dark:text-red-400 dark:hover:bg-red-950/30 rounded-xl text-xs font-bold transition-colors flex items-center gap-1.5 border border-red-100 dark:border-red-950/30">
                    <i class="fa-solid fa-brain"></i> Pomodoro (25:00)
                </button>
                <button @click="setBreak()" class="px-4 py-2 bg-green-50 text-green-600 hover:bg-green-100 dark:bg-green-950/20 dark:text-green-400 dark:hover:bg-green-950/30 rounded-xl text-xs font-bold transition-colors flex items-center gap-1.5 border border-green-100 dark:border-green-950/30">
                    <i class="fa-solid fa-mug-hot"></i> Pausa (05:00)
                </button>
            </div>
        </template>
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
            <button @click="start()" class="w-32 h-32 flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white rounded-full shadow-lg shadow-blue-500/20 transition-all hover:scale-105 active:scale-95 focus:outline-none">
                <i class="fa-solid fa-play text-4xl pl-2"></i>
            </button>
        </template>
        
    </div>
</div>