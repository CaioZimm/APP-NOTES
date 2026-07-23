<div>
    @include('components.partials.navigation')

    <main class="w-full min-h-screen py-10 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="mb-8">
            <h1 class="font-bold text-3xl sm:text-4xl text-gray-900 dark:text-white">Dashboard</h1>
            <p class="text-gray-500 dark:text-gray-400 mt-2">Visão geral da sua produtividade.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            {{-- Stats Card 1 --}}
            <div class="bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-2xl p-6 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-note-sticky"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total de Anotações</p>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalNotes }}</h3>
                </div>
            </div>

            {{-- Stats Card 2 --}}
            <div class="bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-2xl p-6 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-calendar-week"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Criadas na Semana</p>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $notesThisWeek }}</h3>
                </div>
            </div>

            {{-- Stats Card 3 --}}
            <div class="bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-2xl p-6 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-yellow-100 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-star"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Anotações Favoritas</p>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $favoriteNotes }}</h3>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- Tags --}}
            <div class="bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-2xl p-6 shadow-sm">
                <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-6">Uso de Tags (Top 5)</h3>
                
                @if($tagsData->isEmpty())
                    <div class="text-center py-10">
                        <p class="text-gray-500 dark:text-gray-400">Nenhuma tag utilizada ainda.</p>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($tagsData as $tag)
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="font-medium text-gray-700 dark:text-gray-300">{{ $tag->name }}</span>
                                    <span class="text-gray-500">{{ $tag->notes_count }} notas</span>
                                </div>
                                <div class="w-full bg-gray-200 dark:bg-zinc-700 rounded-full h-2">
                                    <div class="h-2 rounded-full border dark:border-gray-400" style="width: {{ $totalNotes > 0 ? ($tag->notes_count / $totalNotes) * 100 : 0 }}%; background-color: {{ $tag->color }}"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Resumo Pomodoro --}}
            <div class="bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-2xl p-6 shadow-sm flex flex-col justify-center items-center text-center">
                <div class="w-20 h-20 bg-red-50 dark:bg-red-900/10 rounded-full flex items-center justify-center mb-4">
                    <i class="fa-solid fa-stopwatch text-4xl text-red-500"></i>
                </div>
                <h3 class="font-bold text-xl text-gray-900 dark:text-white mb-2">Pomodoro Integrado</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6 max-w-sm">
                    Mantenha o foco em suas anotações e estudos usando a técnica Pomodoro.
                </p>
                <a wire:navigate href="{{ route('stopwatch') }}" class="px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors shadow-sm shadow-red-600/30">
                    Ir para Pomodoro
                </a>
            </div>
        </div>
    </main>
</div>
