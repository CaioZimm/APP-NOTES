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
              @error('name')
                <span class="text-red-600">{{ $message }}</span>
              @enderror
            </div>

            <div class="flex flex-col justify-start mt-4">
              <label class="font-medium text-lg"> Email </label>
              <input wire:model="email" type="text" placeholder="{{ $user->email }}" 
              class="border border-black w-[80%] rounded-md h-8 outline-none p-1 font-normal text-lg placeholder:text-xl placeholder:text-gray-500">
              @error('email')
                <span class="text-red-600">{{ $message }}</span>
              @enderror
            </div>

            <button type="submit" class="mt-6 border border-black p-2 rounded-lg w-[13rem] bg-blue-600 font-bold text-yellow-50 transition hover:bg-blue-950">
              Salvar 
            </button>

            @if (session()->has('sucessPersonal'))
              <div class="text-green-600 font-bold mt-4">
                  {{ session('sucessPersonal') }}
              </div>
            @endif
        </form>
      </div>

      <livewire:profile.upload-photo />
    </div>

    <div class="w-[80%] mt-8">
      <form wire:submit='updatePassword'>
          <h2 class="font-semibold text-xl underline">Atualizar senha</h2>

          <div class="flex flex-col justify-start mt-4">
            <label class="font-medium text-lg"> Senha atual </label>
            <input wire:model='password' type="password" placeholder="Digite sua senha atual"
            class="border border-black xs:w-[48%] w-[13rem] rounded-md h-8 outline-none p-1 font-normal text-lg placeholder:text-base placeholder:text-gray-500">
            @error('password')
              <span class="text-red-600">{{ $message }}</span>
            @enderror
          </div>

          <div class="flex flex-col justify-start mt-4">
            <label class="font-medium text-lg"> Nova senha </label>
            <input wire:model='new_password' type="password" placeholder="Digite sua nova senha"
            class="border border-black xs:w-[48%] w-[13rem] rounded-md h-8 outline-none p-1 font-normal text-lg placeholder:text-base placeholder:text-gray-500">
          </div>

          <div class="flex flex-col justify-start mt-4">
            <label class="font-medium text-lg"> Confirmar senha </label>
            <input wire:model='new_password_confirmation' type="password" placeholder="Confirme sua nova senha"
            class="border border-black xs:w-[48%] w-[13rem] rounded-md h-8 outline-none p-1 font-normal text-lg placeholder:text-base placeholder:text-gray-500">
            @error('new_password')
              <span class="text-red-600">{{ $message }}</span>
            @enderror
          </div>

          <div>
            @error('samepassword')
                <span class="text-red-600 font-bold mt-4">{{ $message }}</span>
            @enderror
          </div>

          <div>
            @error('otherpassword')
                <span class="text-red-600 font-bold mt-4">{{ $message }}</span>
            @enderror
          </div>

          <button type="submit" class="mt-6 border border-black p-2 rounded-lg w-[13rem] bg-blue-600 font-bold text-yellow-50 transition hover:bg-blue-950">
            Atualizar 
          </button>

          @if (session()->has('successPassword'))
            <div class="text-green-600 font-bold mt-4">
                {{ session('successPassword') }}
            </div>
          @endif
      </form>
    </div>

    <div class="w-[80%] mt-6 mb-4">
      <h2 class="font-semibold text-xl underline"> Deletar conta </h2>
      <p class="text-base mt-1">Uma vez que sua conta é deletada, todos os seus dados serão permanentemente deletados também.</p>

      <button wire:click='delete({{ $user->id }})' class="mt-6 border border-black p-2 rounded-lg w-[13rem] bg-red-600 font-bold text-yellow-50 hover:bg-red-900"> 
        Excluir 
      </button>
    </div>

    <x-toaster-hub />
  </main>
</div>
