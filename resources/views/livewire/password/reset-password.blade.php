<div>
<div class="w-full min-h-screen flex items-center justify-center bg-gray-50 dark:bg-zinc-900 transition-colors duration-300 py-10">
    <main class="w-full max-w-md px-6 py-8 bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-2xl shadow-xl shadow-gray-200/50 dark:shadow-none mx-4">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Redefinir Senha</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Insira o seu e-mail e enviaremos um código de acesso.</p>
        </div>

        <form wire:submit='resetPassword' class="space-y-6">
            <div>
                <x-ui.label for="email" class="mb-1">E-mail</x-ui.label>
                <x-ui.input wire:model='email' id="email" type="email" placeholder="nome@gmail.com" :error="$errors->has('email')" required autofocus />
                @error('email')
                    <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <x-ui.button class="w-full">
                Enviar código
            </x-ui.button>
            
            <p class="text-center text-sm text-gray-600 dark:text-gray-400 mt-4">
                Lembrou sua senha?
                <a wire:navigate href="{{ route('login') }}" class="text-blue-600 dark:text-blue-400 hover:underline font-medium">Voltar ao login</a>
            </p>
        </form>
    </main>

    <x-toaster-hub />
</div>
</div>
