<div>
    @include('components.partials.navigation')

    <main class="w-full min-h-screen py-10 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="font-bold text-3xl text-gray-900 dark:text-white">Editar Anotação</h1>
                <p class="text-gray-500 dark:text-gray-400">Modifique o conteúdo e as tags da sua anotação.</p>
            </div>
            <a wire:navigate href="{{ route('notes') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 dark:bg-zinc-800 dark:hover:bg-zinc-700 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg transition-colors">
                Voltar
            </a>
        </div>

        <form wire:submit.prevent="update" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2 space-y-4">
                    {{-- Title --}}
                    <div>
                        <x-ui.label for="title" text="Título da anotação" />
                        <x-ui.input wire:model="title" id="title" type="text" placeholder="Ex: Reunião de Planejamento" required />
                    </div>

                    {{-- Markdown Editor Side-by-Side --}}
                    <div x-data="{ 
                            content: @entangle('description'), 
                            compiledMarkdown: '',
                            init() {
                                // Load marked.js dynamically if not loaded
                                if (typeof marked === 'undefined') {
                                    const script = document.createElement('script');
                                    script.src = 'https://cdn.jsdelivr.net/npm/marked/marked.min.js';
                                    script.onload = () => { this.updatePreview() };
                                    document.head.appendChild(script);
                                } else {
                                    this.updatePreview();
                                }
                                $watch('content', value => this.updatePreview());
                            },
                            updatePreview() {
                                if (typeof marked !== 'undefined') {
                                    this.compiledMarkdown = marked.parse(this.content || '');
                                }
                            }
                        }" 
                        class="border border-gray-200 dark:border-zinc-700 rounded-lg overflow-hidden bg-white dark:bg-zinc-900 flex flex-col md:flex-row shadow-sm min-h-[500px] h-[70vh] md:h-[500px]"
                    >
                        {{-- Editor --}}
                        <div class="w-full md:w-1/2 flex flex-col border-b md:border-b-0 md:border-r border-gray-200 dark:border-zinc-700">
                            <div class="bg-gray-50 dark:bg-zinc-800 px-4 py-2 border-b border-gray-200 dark:border-zinc-700 text-sm font-medium text-gray-600 dark:text-gray-300">
                                Markdown (Editor)
                            </div>
                            <textarea 
                                x-model="content"
                                class="flex-1 w-full p-4 bg-transparent border-none resize-none focus:ring-0 text-gray-800 dark:text-gray-200 font-mono text-sm"
                                placeholder="Digite usando sintaxe Markdown..."
                            ></textarea>
                        </div>
                        
                        {{-- Preview --}}
                        <div class="w-full md:w-1/2 flex flex-col bg-gray-50/50 dark:bg-zinc-900/50">
                            <div class="bg-gray-50 dark:bg-zinc-800 px-4 py-2 border-b border-gray-200 dark:border-zinc-700 text-sm font-medium text-gray-600 dark:text-gray-300">
                                Preview
                            </div>
                            <div 
                                class="flex-1 w-full p-4 overflow-y-auto prose prose-sm dark:prose-invert max-w-none break-words"
                                x-html="compiledMarkdown"
                            >
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="space-y-6">
                    <div class="bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-2xl p-5 shadow-sm">
                        <h3 class="font-medium text-gray-900 dark:text-white mb-4">Configurações</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <x-ui.label for="date" text="Data da anotação" />
                                <x-ui.input wire:model="date" id="date" type="date" required />
                            </div>

                            <div>
                                <x-ui.label text="Tags" />
                                @if($availableTags->isEmpty())
                                    <p class="text-sm text-gray-500">Nenhuma tag cadastrada.</p>
                                @else
                                    <div class="flex flex-wrap gap-2 mt-2">
                                        @foreach($availableTags as $tag)
                                            <label class="inline-flex items-center cursor-pointer">
                                                <input type="checkbox" wire:model="selectedTags" value="{{ $tag->id }}" class="hidden peer">
                                                <span 
                                                    class="px-3 py-1 text-xs font-medium rounded-full text-white border border-black/20 dark:border-white/20 transition-all duration-200 
                                                           opacity-50 hover:opacity-80 hover:scale-105 
                                                           peer-checked:opacity-100 peer-checked:scale-105 peer-checked:ring-2 peer-checked:ring-offset-2 peer-checked:ring-blue-500 dark:peer-checked:ring-offset-zinc-800"
                                                    style="background-color: {{ $tag->color }}; text-shadow: 0px 0px 3px rgba(0,0,0,0.8);"
                                                >
                                                    {{ $tag->name }}
                                                </span>
                                            </label>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="mt-3">
                                    <a wire:navigate href="{{ route('tags.index') }}" class="text-xs text-blue-600 dark:text-blue-400 hover:underline">Gerenciar Tags</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4">
                        <x-ui.button type="submit">
                            <span class="text-lg">Atualizar Anotação</span>
                        </x-ui.button>
                    </div>
                </div>
            </div>
        </form>
    </main>
</div>