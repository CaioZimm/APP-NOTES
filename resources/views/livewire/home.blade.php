<div>
    <header>
        <nav class="flex border-b border-solid border-black">
          <div class="w-16 items-center	flex justify-center">
            <a wire:navigate href="/">
              home
            </a>
          </div>
      
          <div class="flex flex-1 items-center justify-end w-[20rem] gap-16 pr-8">
            <a wire:navigate href="">cronometro</a>
            <a wire:navigate href="">anotações</a>

            @guest
                <a wire:navigate href="/login">Entrar</a>
                <a wire:navigate href="/register">Registrar</a>
            @endguest

            @auth
                <a wire:navigate href="/profile">perfil</a>
                <button wire:click='logout' href="/">Logout</button>
            @endauth
            
          </div>
        </nav>
      </header>

      <main class="flex justify-center items-center flex-col w-full h-[90vh]">

        <h1> 12:34:42</h1>
      
        <button class="flex items-center justify-center w-[7rem] h-[7rem] border border-black p-8 mt-4 bg-sky-600 text-[90px] text-yellow-50 rounded-[10rem] font-medium ease-in duration-300"> 
          + 
        </button>
      
        <a wire:click='showNotes' href="" class="mt-[3rem] text-[20px] font-[sans-serif] underline"> 
          Ver minhas anotações 
        </a>
      </main>
</div>
