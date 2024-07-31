<!-- Modal -->
<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0" style="background-color: beige; ">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
        <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <form>
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="mb-1" style="display: grid;">
                        <label for="">Nombre del Informe </label>
                        <input type="text" class="form-control" placeholder="Nombre del Informe" wire:model="nombreinforme">
                        @error('nombreinforme') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                    <div class="mb-1" style="display: grid;">
                        <label for="">Periodo</label>
                        <select class="form-control" wire:model="periodo_id">
                            <option value="">-</option>
                            @foreach($periodos as $periodo)
                            <option value="{{$periodo->id}}">{{$periodo->nombreperiodo}}</option>
                            @endforeach
                        </select>
                        @error('periodo_id') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>

                    <div class="mb-1" style="display: grid;">
                        <label for="">Area</label>
                        <select class="form-control" wire:model="area_id">
                            <option value="">-</option>
                            @foreach($areas as $area)
                            <option value="{{$area->id}}">{{$area->areasdescripcion}}</option>
                            @endforeach
                        </select>
                        @error('area_id') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                    <div class="mb-1" style="display: grid;">
                        <label for="">Observaciones </label>
                        <input type="text" class="form-control" placeholder="Observaciones" wire:model="observaciones">
                        @error('observaciones') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <span class="mt-3 flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                    <button wire:click.prevent="store(3)" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-300 text-base leading-6 font-bold text-white-900 shadow-sm hover:bg-red-400 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        Guardar
                    </button>
                </span>
                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                        <button wire:click="ocultar(3)" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-yellow-300 text-base leading-6 font-bold text-gray-700 shadow-sm hover:bg-yellow-400 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Cerrar
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>

