<div>
    @include('components.partials.navigation')

    <main class="min-h-[calc(90vh-4rem)] flex items-center justify-center bg-gray-50 dark:bg-zinc-900 transition-colors duration-300 px-4 sm:px-6">
        <div class="w-full max-w-xl bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-3xl p-6 sm:p-12 shadow-xl shadow-gray-200/50 dark:shadow-none text-center space-y-8">

            <!-- Timer / Relógio -->
            <div class="py-4 bg-gray-50 dark:bg-zinc-900/40 rounded-2xl border border-gray-100 dark:border-zinc-750/30">
                <livewire:live-timer />
            </div>

            <!-- Botões de Ação Principal -->
            <div class="flex flex-col items-center justify-center gap-4 pt-4">
                <livewire:modal.create-notes />
                <livewire:modal.show-notes />
            </div>

        </div>
    </main>

</div>