<div class="flex justify-start items-center ml-5 mt-8">
    <i class="fa-solid fa-filter text-2xl"></i>

    <select wire:model.live='orderBy' class="text-base outline-none w-40 px-1 cursor-pointer border-b border-black rounded-sm">
        <option value="">Ordenar por: </option>
        <option value="alphabetical">Ordem alfabética</option>
        <option value="newest">Mais recente</option>
        <option value="oldest">Mais antiga</option>
    </select>
</div>