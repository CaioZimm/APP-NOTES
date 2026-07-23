<div x-data="{ open: false }">
    
    <button @click="open = true" class="group flex items-center justify-center gap-2 px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-medium shadow-lg shadow-blue-500/20 transition-all duration-200 hover:-translate-y-0.5 active:translate-y-0 w-full sm:w-auto">
        <i class="fa-solid fa-plus text-lg transition-transform group-hover:rotate-90 duration-200"></i>
        Nova Anotação
    </button>

    @guest
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
                <div class="w-16 h-16 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-450 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-lock text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Acesso Restrito</h3>
                <p class="text-sm text-gray-550 dark:text-gray-400 mt-2">Para criar uma anotação, você precisa estar autenticado no sistema.</p>
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
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-zinc-950/60 backdrop-blur-sm"
         x-cloak>
        
        <div x-show="open"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 scale-95"
             @click.outside="open = false"
             class="relative w-full max-w-lg bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-2xl shadow-2xl overflow-hidden">
            
            <!-- Header do Modal -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-150 dark:border-zinc-700 bg-gray-50 dark:bg-zinc-800/50">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                    <i class="fa-solid fa-pen-to-square text-blue-600"></i>
                    Criar nova anotação
                </h2>
                <button @click="open = false" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-250 transition-colors">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <!-- Formulário -->
            <form wire:submit.prevent='create' class="p-6 space-y-4 text-left">
                <div>
                    <x-ui.label for="title" class="mb-1.5">Título</x-ui.label>
                    <x-ui.input wire:model='title' id="title" type="text" placeholder="Insira um título..." :error="$errors->has('title')" required />
                    @error('title')
                        <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <x-ui.label for="description" class="mb-1.5">Descrição</x-ui.label>
                    <textarea wire:model='description' id="description" placeholder="Insira uma breve descrição ou rascunho de nota..." 
                              class="w-full min-h-[100px] max-h-[250px] p-3 bg-transparent text-gray-900 dark:text-white border border-gray-400 dark:border-zinc-700 focus:border-blue-550 dark:focus:border-blue-500 rounded-lg transition-colors outline-none focus:ring-2 focus:ring-blue-500/20 {{ $errors->has('description') ? 'border-red-500 focus:border-red-500' : '' }}" 
                              required></textarea>
                    @error('description')
                        <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <x-ui.label for="date" class="mb-1.5">Data</x-ui.label>
                    <x-ui.input wire:model='date' id="date" type="date" :error="$errors->has('date')" required />
                    @error('date')
                        <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Rodapé / Botões -->
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-150 dark:border-zinc-700">
                    <button type="button" @click="open = false" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-250 dark:bg-zinc-700 dark:hover:bg-zinc-650 text-gray-700 dark:text-gray-300 rounded-xl font-semibold transition-colors">
                        Cancelar
                    </button>
                    <div class="w-32">
                        <x-ui.button>
                            Criar
                        </x-ui.button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endauth
</div>