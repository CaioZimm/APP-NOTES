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
              class="border border-black w-[80%] rounded-md h-8 outline-none p-1 font-normal text-lg placeholder:text-sm xs:placeholder:text-xl placeholder:text-gray-500">
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
      </form>
    </div>

    <div class="w-[80%] mt-8">
      <h2 class="font-semibold text-xl underline">Modificar horário</h2>

        <label class="block mb-2 text-base mt-4">Altere o fuso horário de seu relógio aqui</label>
        <select wire:model.live="timezone" class="text-base outline-none w-48 px-1 cursor-pointer border-b border-black">
          <option value="America/Los_Angeles">Los Angeles</option>
          <option value="America/New_York">Nova Iorque</option>
          <option value="America/Mexico_City">Cidade do México</option>
          <option value="America/Sao_Paulo">Brasília</option>
          <option value="Europe/London">Londres</option>
          <option value="Europe/Paris">Paris</option>
          <option value="Africa/Lagos">Lagos</option>
          <option value="Africa/Cairo">Cairo</option>
          <option value="Europe/Moscow">Moscou</option>
          <option value="Asia/Dubai">Dubai</option>
          <option value="Asia/Hong_Kong">Hong Kong</option>
          <option value="Asia/Bangkok">Bangkok</option>
          <option value="Asia/Singapore">Singapura</option>
          <option value="Asia/Tokyo">Tóquio</option>
          <option value="Australia/Sydney">Sydney</option>
        </select>
    </div>

    <div class="w-[80%] mt-8 mb-4">
      <h2 class="font-semibold text-xl underline"> Deletar conta </h2>
      <p class="text-base mt-1">Uma vez que sua conta é deletada, todos os seus dados serão permanentemente deletados também.</p>

      <button wire:click='delete({{ $user->id }})' class="mt-6 border border-black p-2 rounded-lg w-[13rem] bg-red-600 font-bold text-yellow-50 hover:bg-red-900"> 
        Excluir 
      </button>
    </div>

    <x-toaster-hub />
  </main>
</div>
