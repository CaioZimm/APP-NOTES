<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center w-full px-4 py-3 bg-blue-600 border border-transparent rounded-lg font-semibold text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-50 disabled:cursor-not-allowed']) }} wire:loading.attr="disabled">
    <span wire:loading.remove {{ $attributes->has('wire:target') ? 'wire:target="'.$attributes->get('wire:target').'"' : '' }}>
        {{ $slot }}
    </span>
    <span wire:loading {{ $attributes->has('wire:target') ? 'wire:target="'.$attributes->get('wire:target').'"' : '' }} class="flex items-center justify-center">
        <i class="fa-solid fa-circle-notch fa-spin mr-2"></i> Aguarde...
    </span>
</button>