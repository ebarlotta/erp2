<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center mt-24 pt-4 px-4 pb-20 text-center sm:block sm:p-0" style="background-color: beige; ">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <span class="hidden sm:inline-block sm:align-middle "></span>
        <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-1 sm:align-top sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <form>
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Descripción</label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Ingrese Descripcion" wire:model="name">
                            @error('name') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-12 flex">
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Porcentaje</label>
                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Ingrese Descripcion" wire:model="porcentaje" min=0 value="0">
                                @error('name') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Activo</label>
                                <input type="checkbox" class="shadow border rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Lista Activa/No activa" wire:model="activo">
                                @error('activo') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-12 flex">
                            <div class="mb-4 col-6">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Vigencia Desde</label>
                                <input type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Vigencia Hasta Descripcion" wire:model="vigenciadesde">
                                @error('vigenciadesde') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-4 col-6">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Vigencia Hasta</label>
                                <input type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Vigencia Hasta" wire:model="vigenciahasta">
                                @error('vigenciahasta') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <x-guardar></x-guardar>
                    <x-cerrar></x-cerrar>
                </div>
            </form>
        </div>
    </div>
</div>