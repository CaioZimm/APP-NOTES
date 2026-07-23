<div>
<div class="w-full min-h-screen flex items-center justify-center bg-gray-50 dark:bg-zinc-900 transition-colors duration-300 py-10">
    <main class="w-full max-w-md px-6 py-8 bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-2xl shadow-xl shadow-gray-200/50 dark:shadow-none mx-4">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Criar Conta</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Junte-se a nós para gerenciar suas anotações</p>
        </div>

        <form wire:submit='register' class="space-y-5">
            <div>
                <x-ui.label for="name" class="mb-1">Nome Completo</x-ui.label>
                <x-ui.input wire:model='name' id="name" type="text" placeholder="Seu nome" :error="$errors->has('name')" required autofocus />
                @error('name')
                    <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <x-ui.label for="email" class="mb-1">E-mail</x-ui.label>
                <x-ui.input wire:model='email' id="email" type="email" placeholder="nome@gmail.com" :error="$errors->has('email')" required />
                @error('email')
                    <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div class="relative" x-data="{ show: false }">
                <x-ui.label for="password" class="mb-1">Senha</x-ui.label>
                <div class="relative">
                    <x-ui.input wire:model='password' id="password" x-bind:type="show ? 'text' : 'password'" placeholder="••••••••" :error="$errors->has('password')" required />
                    <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors">
                        <i class="fa-solid fa-eye" x-show="!show"></i>
                        <i class="fa-solid fa-eye-slash" x-show="show" x-cloak></i>
                    </button>
                </div>
            </div>

            <div class="relative" x-data="{ show: false }">
                <x-ui.label for="password_confirmation" class="mb-1">Confirmar Senha</x-ui.label>
                <div class="relative">
                    <x-ui.input wire:model='password_confirmation' id="password_confirmation" x-bind:type="show ? 'text' : 'password'" placeholder="••••••••" :error="$errors->has('password')" required />
                    <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors">
                        <i class="fa-solid fa-eye" x-show="!show"></i>
                        <i class="fa-solid fa-eye-slash" x-show="show" x-cloak></i>
                    </button>
                </div>
                @error('password')
                    <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <x-ui.button class="w-full mt-2">
                Cadastrar-se
            </x-ui.button>
            
            <p class="text-center text-sm text-gray-600 dark:text-gray-400 mt-4">
                Já tem conta? 
                <a wire:navigate href="{{ route('login') }}" class="text-blue-600 dark:text-blue-400 hover:underline font-medium">Entrar aqui</a>
            </p>
        </form>
    </main>

    <x-toaster-hub />
</div>
</div>
