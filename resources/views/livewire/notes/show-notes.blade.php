<div>
    @include('components.partials.navigation')

    <main class="w-full h-full">
        <h1 class="text-center font-bold text-4xl mt-8">Minhas anotações</h1>

        <div class="flex justify-start items-center ml-5 mt-8 cursor-pointer">
            <button class="flex">
                <i class="fa-solid fa-filter text-2xl"></i>
                <p class="text-xl ml-3"> Ordenar por: </p>
            </button>
        </div>

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
                            @if(empty($note->description))
                                Sem descrição
                            @else
                                {{ $note->description }}
                            @endif
                        </p>
                    </div>

                    <p class="mb-1 font-medium text-lg text-center text-gray-800"> 
                        {{ Carbon\Carbon::parse($note->date)->format('d/m/Y') }} 
                    </p>
                    
                    <div class="w-full flex items-center justify-end gap-2">
                        <button wire:navigate href='/notes/{{ $note->id }}' @click="open = true" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-500 rounded-lg hover:bg-blue-900">
                            Editar <i class="fa-solid fa-pen-to-square text-lg pl-1"></i>
                        </button>

                        <button href="#" wire:click='deleteNote({{ $note->id }})' class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-500 rounded-lg hover:bg-red-900">
                            Excluir <i class="fa-solid fa-trash text-lg pl-1"></i>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
            @if(session()->has('sucesso'))
                <div class="text-green-700 font-bold bg-slate-400">
                    {{ session('sucesso') }}
                </div>
            @endif
        @endif
    </main>
</div>