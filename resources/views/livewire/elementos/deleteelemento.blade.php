@props(['id'])
<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0" style="background-color: beige; ">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
        <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline" style="max-width: 60%">
            <form>
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="mb-3"><h2><b>Se eliminará el {{ $seleccionado }} seleccionado, seguro que quiere borrarlo?</b></h2></div>
                    <div class="flex flex-wrap">

                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    
                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        <button wire:click="destroy()" type="button" class="inline-flex justify-center w-full rounded-md border border-red-300 px-4 py-2 bg-red-300 text-base leading-6 font-bold text-gray-900 shadow-sm hover:bg-red-400 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Eliminar
                        </button>
                    </span>
                    <x-cerrar></x-cerrar>
                </div>
            </form>
        </div>
    </div>
</div>