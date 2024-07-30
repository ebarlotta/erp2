<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0" style="background-color: beige; ">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
        <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle col-7 sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <form>
                <!-- Controles -->
                <h3>Datos Adicionales</h3>
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div style="display:flex; flex-wrap:wrap;">
                        <div class="mb-2 col-12" style="display:flex; flex-wrap:wrap;">

                            <!-- Agente -->
                            @if($tipopersona_id==1)
                            <div class="mb-2 col-3">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Fecha de Ingreso</label>
                                <input type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Fecha de ingreso" wire:model="fingreso">
                                @error('fingreso') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-2 col-3">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Fecha de Egreso</label>
                                <input type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Fecha de egreso" wire:model="fegreso">
                                @error('fegreso') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-2 col-3">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Alias</label>
                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Sobrenombre" wire:model="alias">
                                @error('alias') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-2 col-3">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Peso</label>
                                <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="peso del agente" wire:model="peso">
                                @error('peso') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-2 col-3">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Referente</label>
                                <select name="referente_id" id="" wire:model="referente_id">
                                    <option value="">-</option>
                                    @foreach($referentes as $referente)
                                        <option value="{{ $referente->id }}">{{ $referente->name}}</option>
                                    @endforeach
                                </select>
                                @error('referente_id') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-2 col-3">
                                
                                <label class="block text-gray-700 text-sm font-bold mb-2">Cama</label>
                                <select name="cama_id" id="" wire:model="cama_id">
                                    <option value="">-</option>
                                    @foreach($camas22 as $cama)
                                        <option value="{{ $cama->id }}">Hab. {{ $cama->NroHabitacion }} - Cama: {{ $cama->NroCama }}</option>
                                    @endforeach
                                </select>
                                @error('cama_id') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            @endif

                            <!-- Referente -->
                            @if($tipopersona_id==2)
                                <div class="mb-2 col-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Vínculo con el agente</label>
                                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Vínculo" wire:model="vinculo">
                                    @error('vinculo') <span class="text-red-500">{{ $message }}</span>@enderror
                                </div>
                                <div class="mb-2 col-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">ultimaocupacion</label>
                                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="ultimaocupacion" wire:model="ultimaocupacion">
                                    @error('ultimaocupacion') <span class="text-red-500">{{ $message }}</span>@enderror
                                </div>
                                <div class="mb-2 col-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Vivienda Propia</label>
                                    <select name="viviendapropia" id="" wire:model="viviendapropia">
                                        <option value="">-</option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                    </select>
                                    @error('viviendapropia') <span class="text-red-500">{{ $message }}</span>@enderror
                                </div>
                                
                                <div class="mb-2 col-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Cant. hijos varones</label>
                                    <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Cantidad de hijos varones" wire:model="canthijosvarones">
                                    @error('canthijosvarones') <span class="text-red-500">{{ $message }}</span>@enderror
                                </div>
                                <div class="mb-2 col-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Cant. hijas mujeres</label>
                                    <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Cantidad de hijas mujeres" wire:model="canthijasmujeres">
                                    @error('canthijasmujeres') <span class="text-red-500">{{ $message }}</span>@enderror
                                </div>
                                <div class="mb-2 col-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Activo</label>
                                    <select name="activo" id="" wire:model="activo">
                                        <option value="">-</option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                    </select>
                                    @error('activo') <span class="text-red-500">{{ $message }}</span>@enderror
                                </div>
                            @endif

                            <!-- Proveedor -->
                            @if($tipopersona_id==4 or $tipopersona_id==5 or $tipopersona_id==6)
                            <div class="mb-2 col-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Tipo de IVA</label>
                                <select name="iva_id" id="" wire:model="iva_id">
                                    <option value="">-</option>
                                    @foreach($ivas as $iva)
                                        <option value="{{ $iva->id }}">{{ $iva->descripcioniva}}</option>
                                    @endforeach
                                </select>
                                @error('iva_id') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            @endif
                        </div>                        
                    </div>                    

                </div>
                <!-- Botones -->
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    {{-- <x-guardar></x-guardar> --}}
                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        <button wire:click.prevent="storeAdicionalActor()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-300 text-base leading-6 font-bold text-white-900 shadow-sm hover:bg-red-400 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Guardar
                        </button>
                    </span>
                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                        <button wire:click="closeModalPopoverAdicionales()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-yellow-300 text-base leading-6 font-bold text-gray-700 shadow-sm hover:bg-yellow-400 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Cerrar
                        </button>
                    </span>
                </div>
                @if (session()->has('message'))
                        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                            role="alert">
                            <div class="flex">
                                <div>
                                    <p class="text-xm bg-lightgreen">{{ session('message') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
            </form>
        </div>
    </div>
</div>