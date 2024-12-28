<div>
    <main class="w-full h-screen flex items-center justify-center">
        <form wire:submit='resetNewPassword'
            class="bg-slate-300 flex items-center justify-between flex-col border border-black w-[30rem] h-[37rem] p-4 rounded-md shadow-md shadow-slate-600 mx-2">
            <h1 class="text-4xl font-bold mt-4">Redefinir Senha</h1>

            <div class="flex flex-col items-start w-full pl-6">
                <label class="text-xl items-center mt-1"> Código</label>
                <input wire:model='token' type="number" placeholder="Digite o código recebido"
                    class="placeholder:text-gray-500 placeholder:font-light placeholder:text-[16px]
            w-[90%] h-10 bg-transparent text-blue-950 text-xl outline-none border-b border-black">
                @error('token')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col items-start w-full pl-6">
                <label class="w-[90%] text-xl items-center mt-2"> Nova senha</label>
                <input wire:model='newpassword' type="password" placeholder="Digite sua nova senha"
                    class="placeholder:text-gray-500 placeholder:font-light placeholder:text-[16px]
                w-[90%] h-10 bg-transparent text-blue-950 text-xl outline-none border-b border-black">
                @error('newpassword')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col items-start w-full pl-6">
                <label class="w-[90%] text-xl items-center mt-2"> Confirme a nova senha</label>
                <input wire:model='newpassword_confirmation' type="password" placeholder="Confirme sua senha"
                    class="placeholder:text-gray-500 placeholder:font-light placeholder:text-[16px]
                w-[90%] h-10 bg-transparent text-blue-950 text-xl outline-none border-b border-black">
            </div>

            <button type="submit" class="hover:bg-gray-400 hover:text-black mt-8 border border-black w-[90%] h-14 rounded-lg font-bold text-xl text-white bg-slate-800 transition">
                Redefinir Senha
            </button>

            <p class="mt-1 w-[90%] text-center"> 
                Email não chegou?
                <a wire:navigate href="{{ route('reset-password') }}" class="text-blue-700 underline"> Tentar novamente </a>
            </p>
        </form>

        <x-toaster-hub />

    </main>
</div>

