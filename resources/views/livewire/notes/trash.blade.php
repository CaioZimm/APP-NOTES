<div>
    @include('components.partials.navigation')

    <main class="w-full min-h-screen py-10 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
            <div>
                <h1 class="font-bold text-3xl sm:text-4xl text-gray-900 dark:text-white">Lixeira</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-2">Anotações excluídas recentemente.</p>
            </div>
            
            <div class="flex items-center gap-4">
                <a wire:navigate href="{{ route('notes') }}" class="px-4 py-2 bg-gray-100 dark:bg-zinc-800 hover:bg-gray-200 dark:hover:bg-zinc-700 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg transition-colors shadow-sm">
                    <i class="fa-solid fa-arrow-left mr-1"></i> Voltar às Anotações
                </a>
            </div>
        </div>

        @if($notes->isEmpty())
            <div class="text-center py-20 bg-white dark:bg-zinc-800 rounded-2xl border border-gray-200 dark:border-zinc-700 shadow-sm">
                <i class="fa-solid fa-trash-can-arrow-up text-6xl text-gray-300 dark:text-zinc-600 mb-4"></i>
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">A lixeira está vazia</h3>
                <p class="text-gray-500 dark:text-gray-400 mt-2">Nenhuma anotação foi excluída recentemente.</p>
            </div>
        @else

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 pb-4">
            @foreach ($notes as $note)
                <div class="bg-gray-50 dark:bg-zinc-800/80 border border-gray-200 dark:border-zinc-700 rounded-2xl p-5 hover:shadow-lg transition-all duration-300 flex flex-col h-[22rem] group relative opacity-75 hover:opacity-100">
                    <div class="flex justify-between items-start mb-3">
                        <span class="text-xs font-medium px-2 py-1 bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 rounded-md">
                            Excluída em {{ Carbon\Carbon::parse($note->deleted_at)->format('d M, Y') }}
                        </span>
                    </div>

                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 line-clamp-2 leading-tight line-through">
                        {{ $note->title }}
                    </h3>

                    <p class="text-sm text-gray-600 dark:text-gray-400 flex-1 line-clamp-6 leading-relaxed">
                        {{ $note->description ?: 'Sem descrição' }}
                    </p>
                    
                    <div class="mt-4 pt-4 border-t border-gray-200 dark:border-zinc-700/50 flex gap-2">
                        <button wire:click="restore({{ $note->id }})" class="flex-1 px-3 py-2 text-sm font-medium bg-blue-100 text-blue-700 hover:bg-blue-200 dark:bg-blue-900/30 dark:text-blue-400 dark:hover:bg-blue-900/50 rounded-lg transition-colors">
                            <i class="fa-solid fa-arrow-rotate-left mr-1"></i> Restaurar
                        </button>

                        <div x-data="{ open: false }" class="flex-1">
                            <button @click="open = true" class="w-full px-3 py-2 text-sm font-medium bg-red-100 text-red-700 hover:bg-red-200 dark:bg-red-900/30 dark:text-red-400 dark:hover:bg-red-900/50 rounded-lg transition-colors">
                                <i class="fa-solid fa-trash mr-1"></i> Excluir
                            </button>
                        
                            <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/60 backdrop-blur-sm px-4" x-transition.opacity>
                                <div @click.away="open = false" class="bg-white dark:bg-zinc-800 p-6 rounded-2xl shadow-2xl max-w-sm w-full border border-gray-200 dark:border-zinc-700" x-transition.scale.origin.bottom>
                                    <div class="w-12 h-12 bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 rounded-full flex items-center justify-center mb-4 text-xl">
                                        <i class="fa-solid fa-fire"></i>
                                    </div>
                                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Exclusão Permanente</h2>
                                    <p class="text-gray-600 dark:text-gray-400 mb-6 text-sm">Esta ação é irreversível. Tem certeza que deseja apagar permanentemente?</p>
                                    
                                    <div class="flex gap-3 justify-end w-full">
                                        <button @click="open = false" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-zinc-700 rounded-lg transition-colors">
                                            Cancelar
                                        </button>
                                        <button wire:click="forceDelete({{ $note->id }})" class="px-4 py-2 text-sm font-medium bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors shadow-sm shadow-red-600/30">
                                            Excluir p/ Sempre
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-10 mb-8 flex justify-center">
            {{ $notes->links() }}
        </div>

        @endif
        
        <x-toaster-hub />
    </main>
</div>
