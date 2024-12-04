<div>
  @include('components.partials.navigation')

  <main class="w-full flex items-center justify-center flex-col pr-5 pl-5">
    <h1 class="mt-8 font-bold text-4xl">Meu perfil</h1>

    <div class="w-[80%] mt-6 flex">
      <div class="w-[60%]">
        <form wire:submit='update'>
            <h2 class="font-semibold text-xl underline">Informações pessoais</h2>

            <div class="flex flex-col justify-start mt-4">
              <label class="font-medium text-lg"> Nome </label>
              <input wire:model='name' type="text" placeholder="{{ $user->name }}" 
              class="border border-black w-[80%] rounded-md h-8 outline-none p-1 font-normal text-lg placeholder:text-xl placeholder:text-gray-500">
            </div>

            <div class="flex flex-col justify-start mt-4">
              <label class="font-medium text-lg"> Email </label>
              <input wire:model='email' type="text" placeholder="{{ $user->email }}" 
              class="border border-black w-[80%] rounded-md h-8 outline-none p-1 font-normal text-lg placeholder:text-xl placeholder:text-gray-500">
            </div>

            <button type="submit" class="mt-6 border border-black p-2 rounded-lg w-[13rem] bg-blue-500 font-bold text-yellow-50">
              Salvar 
            </button>
        </form>
      </div>

      <div class="flex items-center justify-center w-[40%] flex-col">
        <div class="relative">
          <img src="https://uploads.jovemnerd.com.br/wp-content/uploads/2021/12/pingu-episodio-dublado-fa-resultado-hilario.jpg" alt="Foto de Perfil" class="w-36 h-36 rounded-full border-2 border-black object-cover">

          <button type="button" class="absolute bottom-0 right-0 transform translate-y-1/2 bg-gray-300 border border-black text-base px-2 py-1 rounded-md shadow-sm">
            <i class="fa-solid fa-pen"></i> Editar
          </button>
        </div>
      </div>

    </div>

    <div class="w-[80%] mt-8">
      <form wire:submit=''>
          <h2 class="font-semibold text-xl underline">Atualizar senha</h2>

          <div class="flex flex-col justify-start mt-4">
            <label class="font-medium text-lg"> Senha atual </label>
            <input type="password" placeholder="Digite sua senha atual"
            class="border border-black w-[48%] rounded-md h-8 outline-none p-1 font-normal text-lg placeholder:text-xl placeholder:text-gray-500">
          </div>

          <div class="flex flex-col justify-start mt-4">
            <label class="font-medium text-lg"> Nova senha </label>
            <input type="password" placeholder="Digite sua nova senha"
            class="border border-black w-[48%] rounded-md h-8 outline-none p-1 font-normal text-lg placeholder:text-xl placeholder:text-gray-500">
          </div>

          <div class="flex flex-col justify-start mt-4">
            <label class="font-medium text-lg"> Confirmar senha </label>
            <input type="password" placeholder="Confirme sua nova senha"
            class="border border-black w-[48%] rounded-md h-8 outline-none p-1 font-normal text-lg placeholder:text-xl placeholder:text-gray-500">
          </div>

          <button type="submit" class="mt-6 border border-black p-2 rounded-lg w-[13rem] bg-blue-500 font-bold text-yellow-50">
            Atualizar 
          </button>
      </form>
    </div>

    <div class="w-[80%] mt-6 mb-4">
      <h2 class="font-semibold text-xl underline"> Deletar conta </h2>
      <p class="text-base mt-1">Uma vez que sua conta é deletada, todos os seus dados serão permanentemente deletados também.</p>

      <button wire:click='delete({{ $user->id }})' class="mt-6 border border-black p-2 rounded-lg w-[13rem] bg-red-600 font-bold text-yellow-50"> 
        Excluir 
      </button>
    </div>
  </main>
</div>
