<div>
    @include('components.partials.navigation')

    <main class="flex justify-center items-center flex-col w-full h-[80vh]">

      <livewire:live-timer />
      
      <livewire:modal.create-notes />

      <livewire:modal.show-notes />

      @if (session('message'))
        <div class="text-red-600">
            {{ session('message') }}
        </div>
      @endif
    </main>
</div>
