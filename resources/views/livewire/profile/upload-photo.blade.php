<div class="flex flex-col items-center justify-center w-full relative" x-data="{ open: @entangle('dropdownOpen') }">
    @error('photo')
        <div class="text-sm text-red-500 font-medium mb-3 flex items-center gap-1.5">
            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
        </div>
    @enderror

    <div class="relative group">
        @if ($user->photo)
            <img src="{{ url("storage/{$user->photo}") }}" alt="Foto de Perfil" 
                 class="w-32 h-32 rounded-full border border-gray-200 dark:border-zinc-700 object-cover shadow-md transition-transform duration-300 group-hover:scale-105" >
        @else
            @php
                $initials = collect(explode(' ', trim($user->name)))
                    ->map(fn($word) => mb_substr($word, 0, 1, 'UTF-8'))
                    ->take(2)
                    ->implode('');
            @endphp
            <div class="w-32 h-32 rounded-full border-2 border-white dark:border-zinc-800 bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-md transition-all duration-300 group-hover:scale-105 select-none text-white font-bold text-4xl uppercase">
                {{ $initials }}
            </div>
        @endif
        
        <button @click="open = !open" 
                class="absolute bottom-0 right-0 w-9 h-9 flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white rounded-full shadow-lg transition-all duration-200 hover:scale-110 active:scale-95 focus:outline-none border border-white dark:border-zinc-800">
            <i class="fa-solid fa-camera text-sm"></i>
        </button>
    </div>

    <!-- Dropdown / Painel de Edição -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 translate-y-2 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-2 scale-95"
         @click.outside="open = false"
         class="absolute top-full mt-4 w-56 bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-xl shadow-xl z-20 p-4 space-y-3"
         x-cloak>
        
        <form wire:submit="uploadPhoto" class="space-y-3">
            <label class="block">
                <span class="sr-only">Escolher foto</span>
                <input type="file" wire:model.change="photo" 
                       class="block w-full text-xs text-gray-500 dark:text-gray-400
                              file:mr-2 file:py-1.5 file:px-3
                              file:rounded-lg file:border-0
                              file:text-xs file:font-semibold
                              file:bg-blue-50 file:text-blue-700
                              hover:file:bg-blue-100
                              dark:file:bg-zinc-700 dark:file:text-zinc-300
                              cursor-pointer" />
            </label>

            <button type="submit" 
                    class="w-full py-1.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs rounded-lg shadow-md transition-colors"
                    wire:loading.attr="disabled">
                <span wire:loading.remove>Atualizar foto</span>
                <span wire:loading><i class="fa-solid fa-spinner fa-spin"></i> Salvando...</span>
            </button>
        </form>

        @if ($user->photo)
            <div class="border-t border-gray-100 dark:border-zinc-700 pt-2">
                <form wire:submit='removePhoto'>
                    <button type="submit" 
                            class="w-full py-1.5 bg-red-50 hover:bg-red-100 dark:bg-red-950/20 dark:hover:bg-red-950/30 text-red-600 dark:text-red-400 font-semibold text-xs rounded-lg transition-colors">
                        Remover foto
                    </button>
                </form>
            </div>
        @endif
    </div>
</div>