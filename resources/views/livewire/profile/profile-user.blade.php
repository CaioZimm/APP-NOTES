<div>
    <nav class="flex border-b border-solid border-black">
        <div class="w-16 items-center	flex justify-center">
          <a wire:navigate href="/">
            home
          </a>
        </div>
    
        <div class="flex flex-1 items-center justify-end w-[20rem] gap-16 pr-8">
          <a wire:navigate href="">cronometro</a>
          <a wire:navigate href="">anotações</a>
          
          @auth
              <a wire:navigate href="/profile">perfil</a>
              <button wire:click='logout' href="/login">Logout</button>
          @endauth
        </div>
      </nav>

      <main>
        <h1>Meu perfil</h1>

        <form wire:submit='update'>
            <h2>Informações pessoais</h2>

            <label> Nome </label>
            <input wire:model='name' type="text" placeholder="{{ $user->name }}">

            <label> Email </label>
            <input wire:model='email' type="text" placeholder="{{ $user->email }}">

            <button type="submit"> Salvar </button>
        </form>

        <form wire:submit=''>
            <h2>Atualizar senha</h2>

            <label> Senha atual </label>
            <input type="text">

            <label> Nova Senha </label>
            <input type="text">

            <label> Confirmar nova Senha </label>
            <input type="text">

            <button type="submit"> Salvar </button>
        </form>

        <form>
            <label> Foto </label>
            <input type="file">
        </form>

        <p> Encerrar conta </p>
        <button wire:submit='delete'> Deletar conta </button>
      </main>
</div>
