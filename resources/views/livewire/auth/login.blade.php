<div>
    <main class="w-full h-screen flex items-center justify-center">
        <form wire:submit='login' class="bg-slate-300 flex items-center justify-start flex-col border border-black w-[30rem] h-[33rem] p-4 rounded-md shadow-md shadow-slate-600 mx-2">
            <h1 class="text-4xl font-bold mb-[20px] mt-4">Login</h1>

            <label class="w-[90%] text-xl items-center mt-5">Email</label>
            <input wire:model='email' type="email" placeholder="Digite seu email" class="placeholder:text-gray-500 placeholder:font-light placeholder:text-[16px]
            w-[90%] h-10 bg-transparent text-blue-950 text-2xl outline-none border-b border-black">

            <label class="w-[90%] text-xl items-center mt-7">Senha</label>
            <input wire:model='password' type="password" placeholder="Digite sua senha" class="placeholder:text-gray-500 placeholder:font-light placeholder:text-[16px]
            w-[90%] h-10 bg-transparent text-xl outline-none text-blue-950 border-b border-black">
            <div>
                @error('erro')
                    <span class="text-red-600 font-bold mt-4">{{ $message }}</span>
                @enderror
            </div>

            <p class="mt-4 w-[90%]"> Esqueceu a senha? <a wire:navigate href="{{ route('reset-password') }}" class="text-blue-700 underline"> Clique aqui</a> </p>

            <button type="submit" class="hover:bg-gray-400 hover:text-black
            mt-16 border border-black w-[90%] h-14 rounded-lg font-bold text-xl text-white bg-slate-800 transition">
                Entrar 
            </button>

            <p class="mt-4">Não tem conta ainda? 
                <a href="{{ route('register') }}" class="text-blue-700 underline"> Registrar aqui </a> 
            </p>
        </form>

        <x-toaster-hub />
    </main>
</div>
