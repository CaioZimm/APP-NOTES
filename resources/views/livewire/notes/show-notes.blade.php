<div>
    @include('components.partials.navigation')

    <main class="w-full min-h-screen py-10 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
            <div>
                <h1 class="font-bold text-3xl sm:text-4xl text-gray-900 dark:text-white">Minhas Anotações</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-1">Gerencie e organize suas ideias.</p>
            </div>
        </div>

        {{-- Search + Filters --}}
        <div class="flex flex-col sm:flex-row gap-3 mb-6 items-center">
            
            {{-- Barra de Busca --}}
            <div class="relative flex-1 w-full">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                <input 
                    wire:model.live.debounce.350ms="search" 
                    id="search-notes"
                    type="text" 
                    placeholder="Buscar anotações..." 
                    class="w-full pl-9 pr-4 py-2.5 text-sm rounded-lg bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-600 transition"
                >
                <div wire:loading wire:target="search" class="absolute right-3 top-1/2 -translate-y-1/2">
                    <i class="fa-solid fa-circle-notch fa-spin text-blue-500 text-xs"></i>
                </div>
            </div>
            
            {{-- Botão Favoritos --}}
            <button 
                wire:click="$toggle('favoritesOnly')"
                class="flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-medium rounded-lg border transition-colors w-full sm:w-auto {{ $favoritesOnly ? 'bg-yellow-400 border-yellow-400 text-yellow-900' : 'bg-white dark:bg-zinc-800 border-gray-200 dark:border-zinc-700 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-zinc-700' }}"
            >
                <i class="fa-solid fa-star {{ $favoritesOnly ? 'text-yellow-800' : 'text-yellow-400' }}"></i>
                Favoritos
            </button>
            
            {{-- Filtro de Ordenação (Trazido para cá e estilizado) --}}
            <div class="relative w-full sm:w-auto">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <i class="fa-solid fa-filter text-gray-400 text-sm"></i>
                </div>
                <select 
                    wire:model.live='orderBy' 
                    class="w-full sm:w-48 pl-9 pr-8 py-2.5 text-sm rounded-lg bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 text-gray-700 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-600 appearance-none cursor-pointer transition"
                >
                    <option value="">Ordenar por...</option>
                    <option value="alphabetical">Ordem alfabética</option>
                    <option value="newest">Mais recente</option>
                    <option value="oldest">Mais antiga</option>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <i class="fa-solid fa-chevron-down text-gray-400 text-xs"></i>
                </div>
            </div>
        </div>

        {{-- Empty State --}}
        @if($notes->isEmpty())
            <div class="text-center py-20 bg-white dark:bg-zinc-800 rounded-2xl border border-gray-200 dark:border-zinc-700 shadow-sm">
                <i class="fa-solid fa-{{ $search ? 'search' : 'folder-open' }} text-6xl text-gray-300 dark:text-zinc-600 mb-4"></i>
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                    {{ $search ? 'Nenhuma anotação encontrada para "' . $search . '"' : 'Nenhuma anotação ainda' }}
                </h3>
                <p class="text-gray-500 dark:text-gray-400 mt-2">
                    {{ $search ? 'Tente uma busca diferente.' : 'Crie sua primeira anotação para começar a se organizar.' }}
                </p>
            </div>
        @else

            {{-- Grid de Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 pb-4">
                @foreach ($notes as $note)
                    <div class="bg-white dark:bg-zinc-800 border {{ $note->is_favorite ? 'border-yellow-300 dark:border-yellow-700' : 'border-gray-200 dark:border-zinc-700' }} rounded-2xl p-5 hover:shadow-lg hover:shadow-gray-200/50 dark:hover:shadow-none transition-all duration-300 flex flex-col h-[22rem] group relative">
                        
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-xs font-medium px-2 py-1 bg-gray-100 dark:bg-zinc-700 text-gray-600 dark:text-gray-300 rounded-md">
                                {{ Carbon\Carbon::parse($note->date)->format('d M, Y') }}
                            </span>
                            
                            {{-- Ações --}}
                            <div class="flex items-center gap-1">
                                {{-- Favorito --}}
                                <button 
                                    wire:click="toggleFavorite({{ $note->id }})"
                                    wire:loading.attr="disabled"
                                    wire:target="toggleFavorite({{ $note->id }})"
                                    class="p-1.5 rounded-md transition-colors {{ $note->is_favorite ? 'text-yellow-500' : 'text-gray-300 dark:text-zinc-600 opacity-0 group-hover:opacity-100 hover:text-yellow-400' }}"
                                    title="{{ $note->is_favorite ? 'Remover dos favoritos' : 'Adicionar aos favoritos' }}"
                                >
                                    <i class="fa-{{ $note->is_favorite ? 'solid' : 'regular' }} fa-star"></i>
                                </button>

                                {{-- Editar --}}
                                <a wire:navigate href='/notes/{{ $note->id }}' class="p-1.5 text-gray-500 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400 rounded-md hover:bg-blue-50 dark:hover:bg-blue-900/30 transition-colors opacity-0 group-hover:opacity-100">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                
                                {{-- Excluir --}}
                                <div x-data="{ open: false }" class="relative">
                                    <button @click="open = true" class="p-1.5 text-gray-500 hover:text-red-600 dark:text-gray-400 dark:hover:text-red-400 rounded-md hover:bg-red-50 dark:hover:bg-red-900/30 transition-colors opacity-0 group-hover:opacity-100">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                
                                    <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/60 backdrop-blur-sm px-4" x-transition.opacity>
                                        <div @click.away="open = false" class="bg-white dark:bg-zinc-800 p-6 rounded-2xl shadow-2xl max-w-sm w-full border border-gray-200 dark:border-zinc-700" x-transition.scale.origin.bottom>
                                            <div class="w-12 h-12 bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 rounded-full flex items-center justify-center mb-4 text-xl">
                                                <i class="fa-solid fa-triangle-exclamation"></i>
                                            </div>
                                            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Excluir Anotação</h2>
                                            <p class="text-gray-600 dark:text-gray-400 mb-6 text-sm">Tem certeza que deseja excluir esta anotação? Esta ação não pode ser desfeita.</p>
                                            
                                            <div class="flex gap-3 justify-end w-full">
                                                <button @click="open = false" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-zinc-700 rounded-lg transition-colors">
                                                    Cancelar
                                                </button>
                                                <button wire:click="deleteNote({{ $note->id }})" class="px-4 py-2 text-sm font-medium bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors shadow-sm shadow-red-600/30">
                                                    Excluir
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Tags --}}
                        @if($note->tags->isNotEmpty())
                            <div class="flex flex-wrap gap-1.5 mb-2">
                                @foreach($note->tags as $tag)
                                    <span 
                                        class="text-[10px] font-medium px-2 py-0.5 rounded-full text-white shadow-sm border border-black/20 dark:border-white/20" 
                                        style="background-color: {{ $tag->color }}; text-shadow: 0px 0px 3px rgba(0,0,0,0.8);"
                                    >
                                        {{ $tag->name }}
                                    </span>
                                @endforeach
                            </div>
                        @endif

                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 line-clamp-2 leading-tight">
                            {{ $note->title }}
                        </h3>

                        <p class="text-sm text-gray-600 dark:text-gray-400 flex-1 line-clamp-6 leading-relaxed break-words">
                            {{ \Illuminate\Support\Str::limit(strip_tags(str()->markdown($note->description ?: 'Sem descrição')), 250) }}
                        </p>
                        
                        <div class="mt-4 pt-4 border-t border-gray-100 dark:border-zinc-700/50 flex items-center justify-between text-xs text-gray-500 dark:text-gray-500">
                            <span>{{ auth()->user()->name }}</span>
                            @if($note->is_favorite)
                                <span class="flex items-center gap-1 text-yellow-500">
                                    <i class="fa-solid fa-star text-xs"></i> Favorito
                                </span>
                            @endif
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