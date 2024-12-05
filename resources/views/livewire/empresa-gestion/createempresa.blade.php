<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center mt-24 pt-4 px-4 pb-20 text-center sm:block sm:p-0" style="background-color: beige; ">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <span class="hidden sm:inline-block sm:align-middle "></span>
        <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-1 sm:align-top sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline" style="max-width: 1000px">
            <form>
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex flex-wrap">
                        <div class="mb-4 mr-3">
                            <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Nombre</label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 pl-2 -mr-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" wire:model="name">
                            @error('name') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4 mr-3">
                            <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Dirección</label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 pl-2 -mr-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" wire:model="direccion">
                            @error('direccion') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4 mr-3">
                            <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Cuit</label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 pl-2 -mr-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" wire:model="cuit">
                            @error('cuit') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4 mr-3">
                            <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">IB</label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 pl-2 -mr-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" wire:model="ib">
                            @error('ib') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-4 mr-3">
                            <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Establecimiento</label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 pl-2 -mr-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" wire:model="establecimiento">
                            @error('establecimiento') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-4 mr-3">
                            <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Teléfono</label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 pl-2 -mr-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" wire:model="telefono">
                            @error('telefono') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4 mr-3">
                            <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">actividad</label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 pl-2 -mr-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" wire:model="actividad">
                            @error('actividad') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4 mr-3">
                            <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">actividad1</label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 pl-2 -mr-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" wire:model="actividad1">
                            @error('actividad1') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-4 mr-3">
                            <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Menú</label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 pl-2 -mr-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" wire:model="menu">
                            @error('menu') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4 mr-3">
                            <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 pl-2 -mr-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" wire:model="email">
                            @error('email') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>                        
                        <div class="mb-4 mr-3">
                            <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Nombre del Titular</label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 pl-2 -mr-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" wire:model="nombretitular">
                            @error('nombretitular') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4 mr-3">
                            <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">DNI Titular</label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 pl-2 -mr-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" wire:model="dnititular">
                            @error('dnititular') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4 mr-3">
                            <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Habilitada</label>
                            <input type="checkbox" class="shadow rounded form-control text-gray-700 leading-tight" wire:model="habilitada">
                            @error('habilitada') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        @if($imagen)
                            <div class="mb-4">
                                <div class="d-flex">
                                    <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Imágen</label>
                                    <img class="mx-3" src="images/{{ $imagen }}" width="70px;">
                                    <input value="Actualizar Imágen" type="button" class="btn btn-info">
                                    @error('imagen') <span class="text-red-500">{{ $message }}</span>@enderror
                                </div>  
                            </div>
                        @else
                            <div class="mb-4">
                                <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Imágen</label>
                                <input type="file" class="shadow appearance-none border rounded w-full py-2 pl-2 -mr-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" wire:model="imagen">
                                @error('imagen') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                        @endif
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    @can('empresagestion.Agregar')
                    {{-- @if(session('empresas.Agregar')) --}}
                        <span class="mt-3 flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                            <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-300 text-base leading-6 font-bold text-white-900 shadow-sm hover:bg-red-400 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                Guardar
                            </button>
                        </span>
                    {{-- @endif --}}
                    @endcan
                    {{-- <x-guardar></x-guardar> --}}
                    <x-cerrar></x-cerrar>
                </div>
            </form>
        </div>
    </div>
</div>