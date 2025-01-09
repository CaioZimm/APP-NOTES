<div class="flex items-center justify-center w-[40%] flex-col">
    @error('photo')
        <div class="text-red-600 font-medium">
            {{ $message }}
        </div>
    @enderror

    <div class="relative">
        @if ($user->photo)
            <img src="{{ url("storage/{$user->photo}") }}" alt="Foto de Perfil" 
            class="w-36 h-36 rounded-full border-2 border-black object-cover" >

            <div class="absolute bottom-0 right-0 transform translate-y-1/2">
                <button wire:click="dropdown" class="flex items-center justify-center bg-gray-300 border border-black text-base px-2 py-1 rounded-md shadow-sm cursor-pointer hover:bg-gray-400 focus:outline-none">
                    <i class="fa-solid fa-pen mr-2"></i> Editar
                </button>
            </div>

            @if ($dropdownOpen)
                <div class="absolute right-0 mt-5 w-44 bg-white border border-gray-300 rounded-lg shadow-md z-10">
                    <ul class="py-1 text-sm">
                        <li class="px-4 py-4 hover:bg-gray-200 border-b border-black">
                            <form wire:submit="uploadPhoto">
                                <input type="file" wire:model.change="photo" class="w-32 text-center flex items-center pl-2">
                                <button type="submit" class="w-36 h-7 mt-4 rounded-md border border-black font-semibold bg-blue-400"> Atualizar foto </button>
                            </form>
                        </li>

                        <li class="px-4 py-4 hover:bg-gray-200 text-center">
                            <form wire:submit='removePhoto'>
                                <button type="submit" class="w-36 h-7 border border-black rounded-md bg-red-600 hover:bg-red-800 text-white font-semibold"> Remover foto </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endif

        @else
            <img src="{{ url("storage/images/default.png") }}" alt="Foto de Perfil"
            class="w-36 h-36 rounded-full border-2 border-black object-cover" >

            <div class="absolute bottom-0 right-0 transform translate-y-1/2">
                <button wire:click="dropdown" class="flex items-center justify-center bg-gray-300 border border-black text-base px-2 py-1 rounded-md shadow-sm cursor-pointer hover:bg-gray-400 focus:outline-none">
                    <i class="fa-solid fa-pen mr-2"></i> Editar
                </button>
            </div>

            @if ($dropdownOpen)
                <div class="absolute right-0 mt-5 w-44 bg-white border border-gray-300 rounded-lg shadow-md z-10">
                    <ul class="py-1 text-sm">
                        <li class="px-4 py-4 hover:bg-gray-200">
                            <form wire:submit="uploadPhoto">
                                <input type="file" wire:model.change="photo" class="w-32 text-center flex items-center pl-[10px] cursor-pointer">

                                <button type="submit" class="w-36 h-7 mt-4 rounded-md border border-black font-semibold bg-blue-400"> 
                                    Atualizar foto 
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endif
            
        @endif
    </div>
</div>