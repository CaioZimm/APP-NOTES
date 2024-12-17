<div x-data="{ open: false }">
    <button @click="open = true" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-500 rounded-lg hover:bg-red-900">
        Excluir <i class="fa-solid fa-trash text-lg pl-1"></i>
    </button>

    <div x-show="open" x-transition>
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-55">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                <div class="w-full h-full">
                    <h2 class="text-xl font-bold mb-4"> Exclusão </h2>

                    <p class="text-gray-700 mb-6">Tem certeza que deseja excluir esta anotação?</p>

                    <div class="flex gap-4 justify-start">
                        <button @click="open = false" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-900">
                            Cancelar
                        </button>

                        <button wire:click="deleteNote" href='#' class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-800">
                            Confirmar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>