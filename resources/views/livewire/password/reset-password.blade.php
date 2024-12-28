<div>
    <main class="w-full h-screen flex items-center justify-center">
        <form wire:submit='resetPassword' class="bg-slate-300 mx-2 flex items-center justify-start flex-col border border-black w-[30rem] h-[28rem] p-4 rounded-md shadow-md shadow-slate-600">
            <h1 class="text-4xl font-bold mb-[20px] mt-4">Redefinir Senha</h1>

            <div class="flex flex-col items-start w-full pl-6">
                <label class="w-[90%] text-base text-center">Insira o seu email e enviaremos um código para você voltar a acessar a sua conta.</label>
            </div>

            <div class="flex flex-col items-start w-full pl-6 mb-4 xs:mb-20">
                <label class="text-xl items-center mt-5"> Email</label>
                <input wire:model='email' type="email" placeholder="Digite seu email"
                class="placeholder:text-gray-500 placeholder:font-light placeholder:text-[16px]
                w-[90%] h-10 bg-transparent text-blue-950 text-2xl outline-none border-b border-black">
                @error('email')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>
            
            <button type="submit" class="hover:bg-gray-400 hover:text-black
            border border-black w-[90%] h-14 rounded-lg font-bold text-xl text-white bg-slate-800 transition">
                Enviar código
            </button>

            <p class="mt-4">Não tem conta ainda? 
                <a href="{{ route('register') }}" class="text-blue-700 underline"> Registrar aqui </a> 
            </p>
        </form>

        <x-toaster-hub />
        
    </main>
</div>
