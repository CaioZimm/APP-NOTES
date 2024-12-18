<div>
    @include('components.partials.navigation')

    <main class="flex justify-center items-center flex-col w-full h-[80vh]">

      <livewire:live-timer />
      
      <livewire:modal.create-notes />

      <livewire:modal.show-notes />

      <x-toaster-hub />
    </main>
</div>
