<div>
    <div class="w-full min-h-screen flex items-center justify-center bg-gray-50 dark:bg-zinc-900 transition-colors duration-300">
        <main class="w-full max-w-md px-6 py-8 bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-2xl shadow-xl shadow-gray-200/50 dark:shadow-none mx-4">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Bem-vindo!</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Acesse sua conta para continuar</p>
            </div>

            <form wire:submit='login' class="space-y-6">
                @error('rate_limit')
                    <div class="p-3 bg-red-100 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-400 rounded-lg flex items-center gap-3">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <span class="text-sm font-medium">{{ $message }}</span>
                    </div>
                @enderror
                
                <div>
                    <x-ui.label for="email" class="mb-1">E-mail</x-ui.label>
                    <x-ui.input wire:model='email' id="email" type="email" placeholder="nome@gmail.com" :error="$errors->has('email')" required autofocus />
                    @error('email')
                        <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div x-data="{ show: false }">
                    <div class="flex items-center justify-between mb-1">
                        <x-ui.label for="password">Senha</x-ui.label>
                        <a wire:navigate href="{{ route('reset-password') }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">
                            Esqueceu a senha?
                        </a>
                    </div>
                    <div class="relative">
                        <x-ui.input wire:model='password' id="password" x-bind:type="show ? 'text' : 'password'" placeholder="••••••••" :error="$errors->has('password')" required />
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors">
                            <i class="fa-solid fa-eye" x-show="!show"></i>
                            <i class="fa-solid fa-eye-slash" x-show="show" x-cloak></i>
                        </button>
                    </div>
                    @error('password')
                        <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input wire:model="remember" id="remember" type="checkbox" class="sr-only peer">
                        <div class="w-10 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-zinc-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300 select-none">Lembrar-me</span>
                    </label>
                </div>

                <x-ui.button class="w-full">
                    Entrar
                </x-ui.button>
                
                <p class="text-center text-sm text-gray-600 dark:text-gray-400">
                    Não tem uma conta? 
                    <a href="{{ route('register') }}" class="text-blue-600 dark:text-blue-400 hover:underline font-medium">Cadastre-se</a>
                </p>
            </form>
        </main>

    </div>
</div>