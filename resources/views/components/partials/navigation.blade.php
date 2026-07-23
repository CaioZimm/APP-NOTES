<header class="sticky top-0 z-50 w-full backdrop-blur transition-colors duration-500 bg-white/80 dark:bg-zinc-900/80 border-b border-gray-200 dark:border-zinc-800">
    <nav class="flex items-center justify-between px-4 sm:px-6 lg:px-8 h-16 max-w-7xl mx-auto">
        <div class="flex items-center gap-4">
            <a wire:navigate href="/" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                <i class="fa-solid fa-home text-lg"></i>
            </a>
        </div>
        
        <div class="hidden sm:flex items-center gap-6">
            <a wire:navigate href="{{ route('stopwatch') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                <i class="fa-solid fa-stopwatch mr-1"></i> Cronômetro
            </a>

            @guest
                <a wire:navigate href="{{ route('login') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                    Entrar
                </a>
                <a wire:navigate href="{{ route('register') }}" class="text-sm font-medium px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Cadastrar
                </a>
            @endguest

            @auth
                <a wire:navigate href="{{ route('dashboard') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                   <i class="fa-solid fa-share-nodes mr-1"></i> Dashboard
                </a>
                <a wire:navigate href="{{ route('notes') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                    <i class="fa-solid fa-note-sticky mr-1"></i> Notas
                </a>
                <a wire:navigate href="{{ route('profile') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                    <i class="fa-solid fa-user mr-1"></i> Perfil
                </a>
                <button wire:click='logout' class="text-sm font-medium text-red-600 dark:text-red-400 hover:text-white hover:bg-red-600 dark:hover:text-red-300 transition-colors py-2 px-4 rounded-lg bg-red-500/20">
                    <i class="fa-solid fa-sign-out-alt mr-1"></i> Sair
                </button>
            @endauth

            <button @click="darkMode = !darkMode" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-zinc-800 px-3 py-1.5 rounded-full transition-colors focus:outline-none">
                <i class="fa-solid fa-moon" x-show="!darkMode"></i>
                <i class="fa-solid fa-sun" x-show="darkMode" x-cloak></i>
            </button>
        </div>

        <div class="sm:hidden flex items-center gap-2" x-data="{ mobileMenuOpen: false }">
            <button @click="darkMode = !darkMode" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-zinc-800 p-2 rounded-full transition-colors focus:outline-none">
                <i class="fa-solid fa-moon" x-show="!darkMode"></i>
                <i class="fa-solid fa-sun" x-show="darkMode" x-cloak></i>
            </button>
            
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-900 dark:text-white p-2">
                <i class="fa-solid fa-bars text-xl"></i>
            </button>

            <div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false" class="absolute top-full right-4 mt-2 w-48 bg-white dark:bg-zinc-800 rounded-lg shadow-xl border border-gray-100 dark:border-zinc-700 py-2 flex flex-col" x-transition>
                <a wire:navigate href="{{ route('stopwatch') }}" class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-zinc-700">Cronômetro</a>
                @guest
                    <a wire:navigate href="{{ route('login') }}" class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-zinc-700">Entrar</a>
                    <a wire:navigate href="{{ route('register') }}" class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-zinc-700">Cadastrar</a>
                @endguest
                @auth
                    <a wire:navigate href="{{ route('dashboard') }}" class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-zinc-700">Dashboard</a>
                    <a wire:navigate href="{{ route('notes') }}" class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-zinc-700">Notas</a>
                    <a wire:navigate href="{{ route('profile') }}" class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-zinc-700">Perfil</a>
                    <button wire:click='logout' class="w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-50 dark:hover:bg-zinc-700">Sair</button>
                @endauth
            </div>
        </div>
    </nav>
</header>