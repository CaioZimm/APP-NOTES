<div>
    <header>
        <nav class="flex border-b border-solid bg-slate-200 border-black w-screen h-12 shadow-2xl shadow-slate-400">
          <div class="w-20 items-center	flex justify-center">
            <a wire:navigate href="/">
              <i class="fa-solid fa-house text-2xl"></i>
            </a>
          </div>
      
          <div class="flex flex-1 items-center justify-end w-[20rem] gap-16 pr-8">
            <a wire:navigate href="">
              <i class="fa-solid fa-stopwatch text-2xl"></i>
            </a>
            <a wire:navigate href="">
              <i class="fa-solid fa-note-sticky text-2xl"></i>
            </a>

            @guest
                <a wire:navigate href="{{ route('login') }}">
                  <i class="fa-solid fa-right-to-bracket text-2xl"></i>
                </a>

                {{-- <a wire:navigate href="{{ route('register') }}">
                  <i class="fa-solid fa-user-plus text-2xl"></i>
                </a> --}}
            @endguest

            @auth
                <a wire:navigate href="{{ route('profile') }}">
                  <i class="fa-solid fa-user text-2xl"></i>
                </a>
                <button wire:click='logout' href="/login">
                  <i class="fa-solid fa-right-from-bracket text-2xl"></i>
                </button>
            @endauth
            
          </div>
        </nav>
      </header>

      <main class="flex justify-center items-center flex-col w-full h-[80vh]">

        <livewire:live-timer />
        
        <livewire:modal.create-notes />

        <a wire:click='showNotes' href="" class="mt-[3rem] text-[20px] font-[sans-serif] underline"> 
          Ver minhas anotações
        </a>
      </main>
</div>
