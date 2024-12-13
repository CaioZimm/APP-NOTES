<div x-data="{ open: false }" class="mt-[3rem] text-[20px] font-[sans-serif]">
    @guest
        <a @click="open = true" href="#" class="mt-[3rem] text-[20px] font-[sans-serif] underline"> 
            Ver minhas anotações
        </a>

        <div x-show="open" x-transition>
            <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-55">
                <div class="border border-black bg-slate-200 h-[20rem] w-[20rem] flex items-center justify-between flex-col rounded-lg">
                    <div class="flex justify-end w-full">
                        <button @click="open = false" class="mr-2">
                            <i class="fa-solid fa-xmark text-3xl"></i>
                        </button>
                    </div>
            
                    <div class="w-full h-full flex items-center justify-between flex-col">
                        <h1 class="font-semibold text-xl text-center mt-12">Para visualizar suas anotações você deve estar logado</h1>

                        <div class="flex items-center justify-center flex-col">
                            <h2> 
                                <a href="{{ route('login') }}" class="text-blue-600 font-medium underline text-xl">
                                    Clique aqui
                                </a>
                            </h2>

                            <h2 class="mb-20 text-xl">
                                para ser redirecionado.
                            </h2> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endguest

    @auth
        <a wire:click='showNotes' href="{{ route('notes') }}" class="mt-[3rem] text-[20px] font-[sans-serif] underline"> 
            Ver minhas anotações
        </a>
    @endauth
</div>
