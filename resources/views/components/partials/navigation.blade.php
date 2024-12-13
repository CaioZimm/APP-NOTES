<header>
    <nav class="flex border-b border-solid bg-slate-200 border-black w-full h-12 shadow-2xl shadow-slate-400">
      <div class="w-20 items-center	flex justify-center">
        <ul>
          <li>
            <a wire:navigate href="/">
              <i class="fa-solid fa-house text-2xl"></i>
            </a>
          </li>
        </ul>
      </div>
  
      <div class="hidden xs:flex flex-1 items-center justify-end w-[20rem] gap-16 pr-8">
        <ul class="flex flex-1 items-center justify-end gap-16">
          <li>
            <a wire:navigate href="{{ route('stopwatch') }}">
              <i class="fa-solid fa-stopwatch text-2xl"></i>
            </a>
          </li>
          
          @guest
          <li>           
              <a wire:navigate href="{{ route('login') }}">
                <i class="fa-solid fa-right-to-bracket text-2xl"></i>
              </a>
          </li>
          @endguest

          @auth
            <li>
              <a wire:navigate href="{{ route('notes') }}">
                <i class="fa-solid fa-note-sticky text-2xl"></i>
              </a>
            </li>

            <li>
              <a wire:navigate href="{{ route('profile') }}">
                <i class="fa-solid fa-user text-2xl"></i>
              </a>
            </li>

            <li>
              <button wire:click='logout' href="{{ route('login') }}">
                <i class="fa-solid fa-right-from-bracket text-2xl"></i>
              </button>
            </li>
          @endauth
        </ul>
      </div>
      
      <div class="xs:hidden flex w-full items-center justify-end px-4">
        <button type="button" class="relative group">
          <i class="fa-solid fa-bars text-2xl"></i>

          <div class="absolute right-0 top-full mt-2 hidden w-40 bg-white shadow-md border border-gray-300 rounded-md group-hover:flex flex-col gap-2 p-4 z-50">
            <ul class="flex flex-col items-start gap-4">
              @guest
                <li>
                  <a wire:navigate href="{{ route('stopwatch') }}">
                    <i class="fa-solid fa-stopwatch text-2xl"></i> Cronômetro
                  </a>
                </li>

                <li>        
                  <a wire:navigate href="{{ route('login') }}">
                    <i class="fa-solid fa-right-to-bracket text-2xl"></i> Login
                  </a>
                </li>
              @endguest

              @auth
                <li>
                  <a wire:navigate href="{{ route('stopwatch') }}">
                    <i class="fa-solid fa-stopwatch text-2xl"></i> Cronômetro
                  </a>
                </li>

                <li>
                  <a wire:navigate href="{{ route('notes') }}">
                    <i class="fa-solid fa-note-sticky text-2xl"></i> Notas
                  </a>
                </li>

                <li>
                  <a wire:navigate href="{{ route('profile') }}">
                    <i class="fa-solid fa-user text-2xl"></i> Perfil
                  </a>
                </li>

                <li>
                  <a wire:click='logout' href="{{ route('login') }}">
                    <i class="fa-solid fa-right-from-bracket text-2xl"></i> Sair
                  </a>
                </li>
              @endauth
            </ul>
          </div>
        </button>
    </nav>
</header>