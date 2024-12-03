<div x-data="{ open: false }">
    <button @click="open = true" class="mt-4 flex items-center justify-center bg-blue-500 border border-black w-[120px] h-[120px] rounded-full p-8 ease-in duration-300
    hover:bg-slate-500"> 
      <p class="flex items-center justify-center font-bold text-center text-white text-7xl pb-4 ease-in duration-300 hover:text-black"> + </p>
    </button>

    @guest
    <div x-show="open" x-transition>
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-55">
          
          <div class="border border-black bg-slate-200 h-[20rem] w-[20rem] flex items-center justify-between flex-col rounded-lg">
              <div class="flex justify-end w-full">
                  <button @click="open = false" class="mr-2">
                      <i class="fa-solid fa-xmark text-3xl"></i>
                  </button>
              </div>
  
              <div class="w-full h-full flex items-center justify-between flex-col">
                <h1 class="font-semibold text-2xl text-center mt-12">Para criar uma anotação você deve estar logado</h1>

                <div class="flex items-center justify-center flex-col">
                    <h2> 
                        <a href="{{ route('login') }}" class="text-blue-600 font-medium underline text-xl">
                            Clique aqui
                        </a>
                    </h2>

                    <h2 class="mb-20">
                        para ser redirecionado.
                    </h2> 
                </div>
              </div>
          </div>
        </div>
      </div>
    @endguest
     
    @auth
    <div x-show="open" x-transition>
      <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-55">
        
        <div class="border border-black bg-slate-200 h-[35rem] w-[45rem] flex items-center justify-between flex-col rounded-lg">
            <div class="flex justify-end w-full">
                <button @click="open = false" class="mr-2">
                    <i class="fa-solid fa-xmark text-3xl"></i>
                </button>
            </div>

            <div class="w-full h-full">
                <form wire:submit='create' class="flex items-center justify-center flex-col">
                    <h1 class="text-4xl m-2 font-bold">Criar nova anotação</h1>

                    <div class="flex flex-col items-start w-full pl-6 mt-4">
                        <label class="text-xl items-center mt-2 font-semibold">Título</label>
                        <input wire:model='title' type="text" placeholder="Insira um título" 
                        class="placeholder:font-normal placeholder:text-[18px] outline-none bg-transparent h-8 text-xl text-blue-950 border-b border-black w-[95%]">
                        @error('title')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col items-start w-full pl-6 mt-4">
                        <label class="text-xl items-center mt-2 font-semibold">Descrição</label>
                        <input wire:model='description' type="text" placeholder="Insira uma breve descrição" 
                        class="placeholder:font-normal placeholder:text-[18px] outline-none bg-transparent h-8 text-xl text-blue-950 border-b border-black w-[95%]">
                        @error('description')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col items-start w-full pl-6 mt-4">
                        <label class="text-xl items-center mt-2 font-semibold">Data</label>
                        <input wire:model='date' type="date" placeholder="" 
                        class="placeholder:font-normal placeholder:text-[18px] outline-none bg-transparent h-8 text-xl text-blue-950 border-b border-black w-[32%]">
                        @error('date')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="flex flex-col items-start w-full pl-6 mt-20">
                        <button type="submit" class="hover:bg-gray-400 hover:text-black
                        border border-black p-3 w-[14rem] bg-slate-900 rounded-2xl font-semibold text-xl text-yellow-50 ease-in duration-200 cursor-pointer">
                            Criar
                        </button>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
    @endauth
</div>