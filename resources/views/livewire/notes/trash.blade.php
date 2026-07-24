<div>
    @include('components.partials.navigation')

    <main class="w-full min-h-screen py-10 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
            <div>
                <h1 class="font-bold text-3xl sm:text-4xl text-gray-900 dark:text-white">Lixeira</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-2">Anotações excluídas recentemente. Itens são apagados automaticamente após 30 dias.</p>
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

        @php
            $expiringSoon = $notes->filter(function($note) {
                return Carbon\Carbon::parse($note->deleted_at)->diffInDays(now()) >= 23;
            });
        @endphp

        @if($expiringSoon->isNotEmpty())
            <div class="mb-6 flex items-start gap-3 bg-amber-50 dark:bg-amber-900/20 border border-amber-300 dark:border-amber-700/50 rounded-2xl p-4 shadow-sm">
                <div class="shrink-0 w-9 h-9 rounded-full bg-amber-100 dark:bg-amber-800/40 flex items-center justify-center text-amber-600 dark:text-amber-400 text-base mt-0.5">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <div>
                    <p class="font-semibold text-amber-800 dark:text-amber-300 text-sm">
                        {{ $expiringSoon->count() }} {{ $expiringSoon->count() === 1 ? 'anotação expira' : 'anotações expiram' }} em breve!
                    </p>
                    <p class="text-amber-700 dark:text-amber-400 text-xs mt-0.5">
                        Restaure-as antes que sejam excluídas permanentemente. Itens na lixeira são apagados automaticamente após 30 dias.
                    </p>
                    <ul class="mt-2 flex flex-wrap gap-2">
                        @foreach($expiringSoon as $expiringNote)
                            @php
                                $daysLeft = max(0, 30 - (int) Carbon\Carbon::parse($expiringNote->deleted_at)->diffInDays(now()));
                            @endphp
                            <li class="inline-flex items-center gap-1.5 text-xs font-medium px-2.5 py-1 rounded-lg bg-amber-100 dark:bg-amber-800/30 text-amber-800 dark:text-amber-300 border border-amber-200 dark:border-amber-700/40">
                                <i class="fa-regular fa-clock"></i>
                                <span class="max-w-[120px] truncate">{{ $expiringNote->title }}</span>
                                <span class="font-bold text-red-600 dark:text-red-400">
                                    — {{ $daysLeft === 0 ? 'expira hoje' : "expira em {$daysLeft}d" }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 pb-4">
            @foreach ($notes as $note)
                @php
                    $daysSinceDelete = (int) Carbon\Carbon::parse($note->deleted_at)->diffInDays(now());
                    $daysLeft = max(0, 30 - $daysSinceDelete);
                    $isExpiringSoon = $daysLeft <= 7;
                @endphp
                <div wire:key="trash-{{ $note->id }}" class="bg-gray-50 dark:bg-zinc-800/80 border {{ $isExpiringSoon ? 'border-amber-300 dark:border-amber-700/50' : 'border-gray-200 dark:border-zinc-700' }} rounded-2xl p-5 hover:shadow-lg transition-all duration-300 flex flex-col h-[22rem] group relative opacity-75 hover:opacity-100">
                    <div class="flex justify-between items-start mb-3">
                        <span class="text-xs font-medium px-2 py-1 bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 rounded-md">
                            Excluída em {{ Carbon\Carbon::parse($note->deleted_at)->format('d M, Y') }}
                        </span>
                        @if($isExpiringSoon)
                            <span class="text-xs font-bold px-2 py-1 rounded-md bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 flex items-center gap-1 animate-pulse">
                                <i class="fa-regular fa-clock"></i>
                                {{ $daysLeft === 0 ? 'Expira hoje!' : "Expira em {$daysLeft}d" }}
                            </span>
                        @endif
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
                                        <i class="fa-solid fa-trash"></i>
                                    </div>
                                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Exclusão Permanente</h2>
                                    <p class="text-gray-600 dark:text-gray-400 mb-6 text-sm">Esta ação é irreversível. Tem certeza que deseja apagar permanentemente?</p>
                                    
                                    <div class="flex gap-3 justify-end w-full">
                                        <button @click="open = false" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-zinc-700 rounded-lg transition-colors">
                                            Cancelar
                                        </button>
                                        <button @click="open = false" wire:click="forceDelete({{ $note->id }})" class="px-4 py-2 text-sm font-medium bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors shadow-sm shadow-red-600/30">
                                            Sim, Excluir
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
        
    </main>
</div>