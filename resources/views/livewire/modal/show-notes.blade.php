<div x-data="{ open: false }">
    @guest
        <button @click="open = true" class="group flex items-center w-full sm:w-auto px-6 py-3 bg-white dark:bg-zinc-800 hover:bg-gray-50 dark:hover:bg-zinc-700/80 text-gray-700 dark:text-gray-200 rounded-xl font-medium border border-gray-200 dark:border-zinc-700 shadow-sm transition-all duration-200 hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-2">
            <i class="fa-solid fa-folder-open text-gray-400"></i>
            Ver Minhas Anotações
        </button>

        <div x-show="open" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-zinc-950/40 backdrop-blur-sm"
             x-cloak>
            
            <div class="relative w-full max-w-sm bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-2xl shadow-2xl p-6 text-center">
                <button @click="open = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition-colors">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
                
                <div class="my-6">
                    <div class="w-16 h-16 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-lock text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Acesso Restrito</h3>
                    <p class="text-sm text-gray-550 dark:text-gray-400 mt-2">Para visualizar suas anotações, você precisa estar autenticado no sistema.</p>
                </div>

                <div class="space-y-3">
                    <a href="{{ route('login') }}" class="block w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-medium transition-colors">
                        Entrar na Conta
                    </a>
                    <button @click="open = false" class="block w-full py-2.5 bg-gray-100 dark:bg-zinc-700 text-gray-700 dark:text-gray-350 hover:bg-gray-200 dark:hover:bg-zinc-600 dark:text-white rounded-xl font-medium transition-colors">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    @endguest

    @auth
        <a wire:navigate href="{{ route('notes') }}" class="w-full sm:w-auto px-6 py-3 bg-white dark:bg-zinc-800 hover:bg-gray-50 dark:hover:bg-zinc-700/80 text-gray-700 dark:text-gray-200 rounded-xl font-medium border border-gray-200 dark:border-zinc-700 shadow-sm transition-all duration-200 hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-2">
            <i class="fa-solid fa-folder-open text-gray-450 dark:text-zinc-500"></i>
            Ver Minhas Anotações
        </a>
    @endauth
</div>
