<div>
    @include('components.partials.navigation')

    <main class="flex justify-center items-center flex-col w-full h-[80vh]">

      <livewire:live-timer />
      
      <livewire:modal.create-notes />

      <a wire:click='showNotes' href="{{ route('notes') }}" class="mt-[3rem] text-[20px] font-[sans-serif] underline"> 
        Ver minhas anotações
      </a>
    </main>
</div>
