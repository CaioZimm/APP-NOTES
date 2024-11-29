<div>
    <main class="w-full h-screen flex items-center justify-center border border-red-500">
        <form wire:submit='register'
            class="bg-slate-300 flex items-center justify-between flex-col border border-black w-[30rem] h-[650px] p-4 rounded-md shadow-md shadow-slate-600">
            <h1 class="text-4xl font-bold">Registrar</h1>

            <div class="flex flex-col items-start w-full pl-6">
                <label class="text-xl items-center mt-2"> Nome</label>
                <input wire:model='name' type="text" placeholder="Digite seu nome"
                    class="placeholder:text-gray-500 placeholder:font-light placeholder:text-[16px]
            w-[90%] h-10 bg-transparent text-blue-950 text-xl outline-none border-b border-black">
                @error('name')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <label class="w-[90%] text-xl items-center mt-3"> Email</label>
            <input wire:model='email' type="email" placeholder="Digite seu email"
                class="placeholder:text-gray-500 placeholder:font-light placeholder:text-[16px]
            w-[90%] h-10 bg-transparent text-blue-950 text-xl outline-none border-b border-black">
            @error('email')
                <span class="text-red-600">{{ $message }}</span>
            @enderror

            <label class="w-[90%] text-xl items-center mt-3"> Senha</label>
            <input wire:model='password' type="password" placeholder="Digite sua senha"
                class="placeholder:text-gray-500 placeholder:font-light placeholder:text-[16px]
            w-[90%] h-10 bg-transparent text-blue-950 text-xl outline-none border-b border-black">

            <label class="w-[90%] text-xl items-center mt-3"> Confirmar senha</label>
            <input wire:model='password_confirmation' type="password" placeholder="Confirme sua senha"
                class="placeholder:text-gray-500 placeholder:font-light placeholder:text-[16px]
            w-[90%] h-10 bg-transparent text-blue-950 text-xl outline-none border-b border-black">
            @error('password')
                <span class="text-red-600">{{ $message }}</span>
            @enderror

            <button type="submit"
                class="hover:bg-gray-400 hover:text-black
            mt-10 border border-black w-[90%] h-14 rounded-lg font-bold text-xl text-white bg-slate-800 transition">
                Registrar
            </button>

            <p class="mt-3 w-[90%] text-center">Já tem conta?
                <a wire:navigate href="{{ route('login') }}" class="text-blue-700 underline"> Entrar aqui</a>
            </p>
        </form>
    </main>
</div>
