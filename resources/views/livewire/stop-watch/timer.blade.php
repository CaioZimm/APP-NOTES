<div>
    @include('components.partials.navigation')

    <main class="flex justify-between items-center flex-col w-full h-[70vh] border border-red-500">
        <div class="w-2/5 items-center flex justify-center gap-[14vh] mt-14 border border-green-500">
            <button class="border border-black py-5 w-56 rounded-2xl font-semibold text-base hover:bg-slate-400 transition-all">
                Temporizador
            </button>

            <button class="border border-black py-5 w-56 rounded-2xl font-semibold text-base hover:bg-slate-400 transition-all">
                Cronômetro
            </button>
        </div>

        <div>
            <h1 class="text-8xl font-semibold border border-orange-600"> 05:00</h1>
        </div>

        <div>
            <button class="bg-blue-600 p-10 rounded-full items-center justify-center text-center flex w-36 h-36 mt-10 border border-black">
                <i class="fa-solid fa-play text-white text-5xl pl-3"></i>
            </button>
        </div>
    </main>
</div>
