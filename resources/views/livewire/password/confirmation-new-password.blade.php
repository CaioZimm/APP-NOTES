<div>
<div class="w-full min-h-screen flex items-center justify-center bg-gray-50 dark:bg-zinc-900 transition-colors duration-300 py-10">
    <main class="w-full max-w-md px-6 py-8 bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-2xl shadow-xl shadow-gray-200/50 dark:shadow-none mx-4">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Nova Senha</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Crie uma nova senha para sua conta</p>
        </div>

        <form wire:submit='resetNewPassword' class="space-y-5">
            <div>
                <x-ui.label for="token" class="mb-1">Código recebido</x-ui.label>
                <x-ui.input wire:model='token' id="token" type="text" inputmode="numeric" pattern="[0-9]*" maxlength="6" placeholder="000000" :error="$errors->has('token')" required autofocus class="tracking-widest" />
                @error('token')
                    <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div x-data="{ show: false }">
                <x-ui.label for="newpassword" class="mb-1">Nova senha</x-ui.label>
                <div class="relative">
                    <x-ui.input wire:model='newpassword' id="newpassword" x-bind:type="show ? 'text' : 'password'" placeholder="••••••••" :error="$errors->has('newpassword')" required class="pr-10" />
                    <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                        <i class="fa-solid fa-eye" x-show="!show"></i>
                        <i class="fa-solid fa-eye-slash" x-show="show" x-cloak></i>
                    </button>
                </div>
                @error('newpassword')
                    <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div x-data="{ show: false }">
                <x-ui.label for="newpassword_confirmation" class="mb-1">Confirmar nova senha</x-ui.label>
                <div class="relative">
                    <x-ui.input wire:model='newpassword_confirmation' id="newpassword_confirmation" x-bind:type="show ? 'text' : 'password'" placeholder="••••••••" :error="$errors->has('newpassword_confirmation')" required class="pr-10" />
                    <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                        <i class="fa-solid fa-eye" x-show="!show"></i>
                        <i class="fa-solid fa-eye-slash" x-show="show" x-cloak></i>
                    </button>
                </div>
            </div>

            <x-ui.button class="w-full mt-2">
                Redefinir Senha
            </x-ui.button>
            
            <p class="text-center text-sm text-gray-600 dark:text-gray-400 mt-4">
                Email não chegou?
                <a wire:navigate href="{{ route('reset-password') }}" class="text-blue-600 dark:text-blue-400 hover:underline font-medium">Tentar novamente</a>
            </p>
        </form>
    </main>

</div>