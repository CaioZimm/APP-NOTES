<div>
    <div x-data="{ open: false }">
        <button @click="open = true" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-500 rounded-lg hover:bg-blue-900">
            Editar <i class="fa-solid fa-pen-to-square text-lg pl-1"></i>
        </button>

        <div x-show="open" x-transition>
          <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-55">
            
            <div class="border border-black bg-slate-200 h-[35rem] w-[45rem] flex items-center justify-between flex-col rounded-lg">
                <div class="flex justify-end w-full">
                    <button @click="open = false" class="mr-2">
                        <i class="fa-solid fa-xmark text-3xl"></i>
                    </button>
                </div>
    
                <div class="w-full h-full">
                    <form wire:submit='update' class="flex items-center justify-center flex-col">
                        <h1 class="text-4xl m-2 font-bold">Editar anotação</h1>
    
                        <div class="flex flex-col items-start w-full pl-6 mt-4">
                            <label class="text-xl items-center mt-2 font-semibold">Título</label>
                            <input wire:model='title' type="text" placeholder="{{ $note->title }}" 
                            class="placeholder:font-normal placeholder:text-[18px] outline-none bg-transparent h-8 text-xl text-blue-950 border-b border-black w-[95%]">
                            @error('title')
                                <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
    
                        <div class="flex flex-col items-start w-full pl-6 mt-4">
                            <label class="text-xl items-center mt-2 font-semibold">Descrição</label>
                            <input wire:model='description' type="text" placeholder="{{ $note->description }}" 
                            class="placeholder:font-normal placeholder:text-[18px] outline-none bg-transparent h-8 text-xl text-blue-950 border-b border-black w-[95%]">
                            @error('description')
                                <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
    
                        <div class="flex flex-col items-start w-full pl-6 mt-4">
                            <label class="text-xl items-center mt-2 font-semibold">Data</label>
                            <input wire:model='date' type="date" placeholder="{{ $note->date }}" 
                            class="placeholder:font-normal placeholder:text-[18px] outline-none bg-transparent h-8 text-xl text-blue-950 border-b border-black w-[32%]">
                            @error('date')
                                <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="flex flex-col items-start w-full pl-6 mt-20">
                            <button type="submit" class="hover:bg-gray-400 hover:text-black
                            border border-black p-3 w-[14rem] bg-slate-900 rounded-2xl font-semibold text-xl text-yellow-50 ease-in duration-200 cursor-pointer">
                                Atualizar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
          </div>
        </div>
    </div> 
</div>
