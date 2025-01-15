<div>
    @include('components.partials.navigation')

    <main class="w-full h-full">
        <h1 class="text-center font-bold text-4xl mt-8">Minhas anotações</h1>

        <livewire:notes.order-by />

        @if($notes->isEmpty())
            <p class="text-center text-xl text-gray-600 mt-12">Você não tem nenhuma anotação</p>
        @else

        <div class="mt-4 justify-items-center grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-6 pb-4">
            @foreach ($notes as $note)
                {{-- Cards --}}
                <div class="w-[23rem] h-[25rem] p-4 border border-gray-800 bg-zinc-300 rounded-lg shadow flex items-center justify-between flex-col">
                    <h5 class="mt-3 text-2xl font-bold tracking-tight text-gray-900 text-center break-words max-w-[100%] max-h-16 line-clamp-2 text-ellipsis">
                        {{ $note->title }}
                    </h5>

                    <div class="flex items-center flex-col">
                        <h6 class="font-semibold pb-2">Descrição</h6>
                        <p class="mb-10 font-normal text-gray-600 text-center break-words w-[22rem] line-clamp-6 text-ellipsis">
                            {{ $note->description ?: 'Sem descrição' }}
                        </p>
                    </div>

                    <p class="mb-1 font-medium text-lg text-center text-gray-800"> 
                        {{ Carbon\Carbon::parse($note->date)->format('d/m/Y') }} 
                    </p>
                    
                    <div class="w-full flex items-center justify-end gap-2">
                        <button wire:navigate href='/notes/{{ $note->id }}' @click="open = true" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-500 rounded-lg hover:bg-blue-900">
                            Editar <i class="fa-solid fa-pen-to-square text-lg pl-1"></i>
                        </button>
                        
                        {{-- Botão - Exlcluir --}}
                        <div x-data="{ open: false }">
                            <button @click="open = true" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-500 rounded-lg hover:bg-red-900">
                                Excluir <i class="fa-solid fa-trash text-lg pl-1"></i>
                            </button>
                        
                            <div x-show="open" x-transition>
                                <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-55">
                                    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                                        <div class="w-full h-full">
                                            <h2 class="text-xl font-bold mb-4"> Exclusão </h2>
                        
                                            <p class="text-gray-700 mb-6">Tem certeza que deseja excluir esta anotação?</p>
                        
                                            <div class="flex gap-4 justify-start">
                                                <button @click="open = false" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-900">
                                                    Cancelar
                                                </button>
                        
                                                <button wire:click="deleteNote({{ $note->id }})" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-800">
                                                    Confirmar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            @endforeach
        </div>

        <x-toaster-hub />

        @endif
    </main>
</div>