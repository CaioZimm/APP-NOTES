<div>
    @include('components.partials.navigation')

    <main class="w-full min-h-screen py-10 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="font-bold text-3xl text-gray-900 dark:text-white">Gerenciar Tags</h1>
                <p class="text-gray-500 dark:text-gray-400">Crie tags coloridas para organizar suas anotações.</p>
            </div>
            <button x-data @click="window.history.length > 1 ? window.history.back() : window.location.href='{{ route('notes') }}'" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 dark:bg-zinc-800 dark:hover:bg-zinc-700 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg transition-colors">
                Voltar
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            {{-- Formulario --}}
            <div class="md:col-span-1 space-y-6">
                <div class="bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-2xl p-5 shadow-sm">
                    <h3 class="font-medium text-gray-900 dark:text-white mb-4">{{ $editingId ? 'Editar Tag' : 'Nova Tag' }}</h3>
                    
                    <form wire:submit.prevent="save" class="space-y-4">
                        <div>
                            <x-ui.label for="name" text="Nome" />
                            <x-ui.input wire:model="name" id="name" type="text" placeholder="Ex: Importante" required />
                        </div>
                        <div>
                            <x-ui.label for="color" text="Cor" />
                            <div class="flex items-center gap-2">
                                <input wire:model="color" id="color" type="color" class="h-10 w-14 rounded cursor-pointer bg-transparent border-0 p-0" required />
                                <span class="text-sm text-gray-500 font-mono" x-data x-text="$wire.color"></span>
                            </div>
                            @error('color') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="flex flex-col gap-2 pt-2">
                            <x-ui.button type="submit">
                                <span class="text-lg">{{ $editingId ? 'Atualizar' : 'Criar' }}</span>
                            </x-ui.button>
                            @if($editingId)
                                <button type="button" wire:click="cancel" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 dark:bg-zinc-700 dark:hover:bg-zinc-600 text-gray-700 dark:text-gray-300 rounded-lg text-sm font-medium transition-colors">
                                    Cancelar
                                </button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            {{-- Listagem --}}
            <div class="md:col-span-2">
                <div class="bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-2xl overflow-hidden shadow-sm">
                    @if($tags->isEmpty())
                        <div class="p-8 text-center">
                            <p class="text-gray-500 dark:text-gray-400">Você ainda não tem nenhuma tag.</p>
                        </div>
                    @else
                        <ul class="divide-y divide-gray-100 dark:divide-zinc-700/50">
                            @foreach($tags as $tag)
                                <li wire:key="tag-{{ $tag->id }}" class="flex items-center justify-between p-4 hover:bg-gray-50 dark:hover:bg-zinc-700/50 transition-colors">
                                    <div class="flex items-center gap-3">
                                        <div class="w-4 h-4 rounded-full border border-gray-300 dark:border-gray-700" style="background-color: {{ $tag->color }}"></div>
                                        <span class="font-medium text-gray-900 dark:text-gray-100">{{ $tag->name }}</span>
                                        <span class="text-xs text-gray-400 ml-2 mt-1">{{ $tag->notes()->count() }} notas</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button wire:click="edit({{ $tag->id }})" class="p-1.5 text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors" title="Editar">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        <div x-data="{ confirm: false }" class="relative">
                                            <button @click="confirm = true" class="p-1.5 text-gray-400 hover:text-red-600 dark:hover:text-red-400 transition-colors" title="Excluir">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>

                                            {{-- Fixed overlay modal to avoid overflow-hidden clipping --}}
                                            <div
                                                x-show="confirm"
                                                x-cloak
                                                class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/50 backdrop-blur-sm px-4"
                                                x-transition.opacity
                                            >
                                                <div
                                                    @click.away="confirm = false"
                                                    class="bg-white dark:bg-zinc-800 shadow-2xl border border-gray-200 dark:border-zinc-700 rounded-2xl p-6 flex flex-col gap-4 max-w-xs w-full"
                                                    x-transition.scale.origin.center
                                                >
                                                    <div class="flex items-center gap-3">
                                                        <div class="w-10 h-10 bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 rounded-full flex items-center justify-center text-lg shrink-0">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </div>
                                                        <div>
                                                            <p class="font-semibold text-gray-900 dark:text-white text-sm">Excluir Tag?</p>
                                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Esta ação não pode ser desfeita.</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex gap-2 justify-end">
                                                        <button @click="confirm = false" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 dark:bg-zinc-700 dark:hover:bg-zinc-600 text-gray-800 dark:text-gray-200 text-sm font-medium rounded-lg transition-colors">Cancelar</button>
                                                        <button @click="confirm = false" wire:click="delete({{ $tag->id }})" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors">Excluir</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
        
    </main>
</div>