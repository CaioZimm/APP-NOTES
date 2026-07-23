<div>
    @include('components.partials.navigation')

    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">
        <!-- Header -->
        <div class="border-b border-gray-200 dark:border-zinc-800 pb-6">
            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">Configurações de Conta</h1>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Gerencie suas informações pessoais, senha, fuso horário e preferências.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Navegação Interna / Info rápida -->
            <div class="space-y-4">
                <div class="bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-2xl p-6 flex flex-col items-center text-center">
                    <livewire:profile.upload-photo />
                    <h3 class="mt-4 font-bold text-lg text-gray-900 dark:text-white">{{ $user->name }}</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $user->email }}</p>
                </div>
            </div>

            <!-- Formulários -->
            <div class="md:col-span-2 space-y-6">

                <!-- Informações Pessoais -->
                <section class="bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-2xl p-6 shadow-sm">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-user text-blue-600"></i> Informações Pessoais
                    </h2>
                    <form wire:submit='update' class="space-y-4">
                        <div>
                            <x-ui.label for="name" class="mb-1">Nome Completo</x-ui.label>
                            <x-ui.input wire:model='name' id="name" type="text" placeholder="{{ $user->name }}" :error="$errors->has('name')" />
                            @error('name')
                                <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <x-ui.label for="email" class="mb-1">E-mail</x-ui.label>
                            <x-ui.input wire:model="email" id="email" type="email" placeholder="{{ $user->email }}" :error="$errors->has('email')" />
                            @error('email')
                                <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="pt-2">
                            <div class="w-36">
                                <x-ui.button>Salvar</x-ui.button>
                            </div>
                        </div>

                        @if (session()->has('sucessPersonal'))
                            <div class="text-sm text-green-600 font-bold mt-2 flex items-center gap-1.5">
                                <i class="fa-solid fa-circle-check"></i> {{ session('sucessPersonal') }}
                            </div>
                        @endif
                    </form>
                </section>

                <!-- Atualizar Senha -->
                <section class="bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-2xl p-6 shadow-sm">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-shield-halved text-blue-600"></i> Segurança (Senha)
                    </h2>
                    <form wire:submit='updatePassword' class="space-y-4">
                        <div>
                            <x-ui.label for="password" class="mb-1">Senha Atual</x-ui.label>
                            <x-ui.input wire:model='password' id="password" type="password" placeholder="Digite sua senha atual" :error="$errors->has('password')" />
                            @error('password')
                                <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <x-ui.label for="new_password" class="mb-1">Nova Senha</x-ui.label>
                                <x-ui.input wire:model='new_password' id="new_password" type="password" placeholder="Nova senha" :error="$errors->has('new_password')" />
                            </div>
                            <div>
                                <x-ui.label for="new_password_confirmation" class="mb-1">Confirmar Senha</x-ui.label>
                                <x-ui.input wire:model='new_password_confirmation' id="new_password_confirmation" type="password" placeholder="Confirmar nova senha" />
                            </div>
                        </div>
                        @error('new_password')
                            <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                        @enderror

                        @error('samepassword')
                            <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                        @enderror

                        @error('otherpassword')
                            <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                        @enderror

                        <div class="pt-2">
                            <div class="w-36">
                                <x-ui.button>Atualizar</x-ui.button>
                            </div>
                        </div>
                    </form>
                </section>

                <!-- Fuso Horário -->
                <section class="bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-2xl p-6 shadow-sm">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-clock text-blue-600"></i> Fuso Horário
                    </h2>
                    <div class="space-y-4">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Configure o fuso horário da sua região para ajustar as estatísticas e os timers.</p>
                        <div>
                            <select wire:model.live="timezone" class="w-full h-11 px-4 bg-transparent text-gray-900 dark:text-white border border-gray-400 dark:border-zinc-700 outline-none rounded-lg transition-colors focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 cursor-pointer dark:bg-zinc-800 dark:border-zinc-600 dark:text-white">
                                <option value="America/Los_Angeles">Los Angeles (PST)</option>
                                <option value="America/New_York">Nova Iorque (EST)</option>
                                <option value="America/Mexico_City">Cidade do México (CST)</option>
                                <option value="America/Sao_Paulo">Brasília (BRT)</option>
                                <option value="Europe/London">Londres (GMT)</option>
                                <option value="Europe/Paris">Paris (CET)</option>
                                <option value="Africa/Lagos">Lagos (WAT)</option>
                                <option value="Africa/Cairo">Cairo (EET)</option>
                                <option value="Europe/Moscow">Moscou (MSK)</option>
                                <option value="Asia/Dubai">Dubai (GST)</option>
                                <option value="Asia/Hong_Kong">Hong Kong (HKT)</option>
                                <option value="Asia/Bangkok">Bangkok (ICT)</option>
                                <option value="Asia/Singapore">Singapura (SGT)</option>
                                <option value="Asia/Tokyo">Tóquio (JST)</option>
                                <option value="Australia/Sydney">Sydney (AEST)</option>
                            </select>
                        </div>
                    </div>
                </section>

                <!-- Excluir Conta -->
                <section x-data="{ showConfirm: false }" class="bg-red-50/50 dark:bg-red-950/10 border border-red-200 dark:border-red-900/30 rounded-2xl p-6 shadow-sm">
                    <h2 class="text-lg font-bold text-red-700 dark:text-red-400 mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-triangle-exclamation"></i> Zona de Perigo
                    </h2>
                    <p class="text-sm text-gray-650 dark:text-gray-400">Excluir sua conta removerá permanentemente todas as suas anotações, histórico de timer e dados do servidor. Esta ação é irreversível.</p>
                    <div class="pt-4">
                        <button type="button" @click="showConfirm = true" class="px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-xl font-bold transition-all duration-200 flex items-center gap-2 shadow-lg shadow-red-500/10">
                            <i class="fa-solid fa-trash-can"></i> Excluir minha conta
                        </button>
                    </div>

                    <!-- Modal de Confirmação de Exclusão -->
                    <div x-show="showConfirm" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-zinc-950/60 backdrop-blur-sm"
                         x-cloak>
                        
                        <div x-show="showConfirm"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                             x-transition:leave-end="opacity-0 translate-y-4 scale-95"
                             @click.outside="showConfirm = false"
                             class="relative w-full max-w-md bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-2xl shadow-2xl p-6 text-center">
                            
                            <div class="w-14 h-14 bg-red-50 dark:bg-red-950/20 text-red-600 dark:text-red-400 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fa-solid fa-triangle-exclamation text-2xl"></i>
                            </div>
                            
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Deseja realmente excluir sua conta?</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Esta ação apagará permanentemente todos os seus dados e anotações vinculadas. <br> Não há como reverter esta operação.</p>
                            
                            <div class="flex items-center justify-center gap-3 mt-6">
                                <button type="button" @click="showConfirm = false" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 dark:bg-zinc-700 dark:hover:bg-zinc-650 text-gray-700 dark:text-gray-300 rounded-xl font-semibold transition-colors">
                                    Cancelar
                                </button>
                                <button type="button" wire:click='delete({{ $user->id }})' class="px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-xl font-bold transition-all duration-200">
                                    Sim, Excluir
                                </button>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <x-toaster-hub />
    </main>
</div>