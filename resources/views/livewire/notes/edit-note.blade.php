<div x-data="{ open: true }">
    <div x-show="open" x-transition class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-55">
        <div class="bg-white rounded-lg shadow-lg w-[40rem] h-[25rem] p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold">Editar Anotação</h2>
                <button @click="open = false" href='/notes' wire:navigate class="text-2xl text-gray-600 hover:text-gray-900">
                    <i class="fa-solid fa-xmark text-3xl"></i>
                </button>
            </div>

            <form wire:submit.prevent='update'>
                <div class="flex flex-col items-start w-full">
                    <label class="text-xl items-center mt-2 font-semibold">Título</label>
                    <input wire:model='title' type="text" placeholder="{{ $note->title }}"
                    class="placeholder:font-normal placeholder:text-[18px] outline-none bg-transparent h-8 pl-1 mt-1 text-xl text-blue-950 border-b border-black w-[95%]">
                    <div>
                        @error('title') 
                            <span class="text-red-600 text-sm">{{ $message }}</span> 
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col items-start w-full">
                    <label class="text-xl items-center mt-2 font-semibold">Descrição</label>
                    <input wire:model='description' type="text" placeholder="Insira uma breve descrição"
                    class="placeholder:font-normal placeholder:text-gray-700 placeholder:text-[18px] outline-none bg-transparent h-8 pl-1 mt-1 text-xl text-blue-950 border-b border-black w-[95%]">
                    <div>
                        @error('description')
                            <span class="text-red-600 text-sm">{{ $message }}</span> 
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col items-start w-full">
                    <label class="text-xl items-center mt-2 font-semibold">Data</label>
                    <input wire:model='date' type="date" placeholder="{{ $note->date }}"
                    class="placeholder:font-normal placeholder:text-gray-700 placeholder:text-[18px] outline-none bg-transparent h-8 pl-1 mt-1 text-xl text-blue-950 border-b border-black w-[30%]">
                    <div>
                        @error('date')
                            <span class="text-red-600 text-sm">{{ $message }}</span> 
                        @enderror
                    </div>
                </div>

                <div class="flex justify-start mt-7">
                    <button type="submit" class="bg-blue-500 text-white font-semibold w-44 px-4 py-2 rounded-lg hover:bg-blue-700">
                        Atualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>