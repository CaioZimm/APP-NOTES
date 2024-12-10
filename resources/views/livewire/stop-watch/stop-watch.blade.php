<div class="h-full w-full flex justify-between items-center flex-col py-10 my-6">
    <div>
        <div wire:poll.990ms='count'></div>
        <h1 class="text-8xl font-semibold"> {{ $formatted }} </h1>
    </div>

    <div>
        @if($isRun)
            <div class="flex justify-normal items-start text-center mt-[11vh] gap-[8vh]">
                <button wire:click="pause" class="bg-slate-200 p-10 w-40 rounded-md items-center justify-center text-center flex h-20 border border-black transition-all hover:bg-blue-500">
                    <i class="fa-solid fa-pause text-xl"></i>
                </button>

                <button wire:click="restart" class="bg-slate-200 p-10 w-40 rounded-md items-center justify-center text-center flex h-20 border border-black transition-all hover:bg-blue-500">
                    <i class="fa-solid fa-rotate-left text-xl"></i>
                </button>
            </div>
        @else
            <button wire:click='play' class="bg-blue-600 p-10 rounded-full items-center justify-center text-center flex w-36 h-36 mt-10 border border-black">
                <i class="fa-solid fa-play text-white text-5xl pl-3"></i>
            </button>
        @endif
    </div>
</div>