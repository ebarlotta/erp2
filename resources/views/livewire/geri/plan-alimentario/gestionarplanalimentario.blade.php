<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">

    <style>
        .fondo-par {
            background-color: #ccc7c7; /* Gris claro */
        }
        .fondo-impar {
            background-color: #cec096; /* Blanco u otro color deseado */
        }
    </style>

    <div class="flex items-end justify-center mt-24 pt-4 px-4 pb-20 text-center sm:block sm:p-0"
        style="background-color: beige; ">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <span class="hidden sm:inline-block sm:align-middle "></span>
        <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-1 sm:align-top sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline" style="max-width: 70%">
            <form>
                <div class="bg-white px-4 pb-1 sm:p-6 sm:pb-1">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-md font-bold mb-2">{{ $plan_nombre }}</label>
                    </div>
                </div>
                <div class="bg-white px-4  pb-1 sm:pb-1 flex">
                    <div class="mb-4 col-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Menúes Disponibles</label>
                        <select class="form-control" wire:model="menu_elegido">
                            <option value="">-- Seleccione un menú --</option>
                            @foreach($listadomenues as $menu)
                                <option value="{{ $menu->id }}">{{ $menu->nombremenu}}</option>
                            @endforeach
                        </select>
                        @error('menu_elegido') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                    <div class="mb-4 col-2">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Día</label>
                        <select class="form-control" wire:model="dia">
                            <option value="">-- Seleccione un día --</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            
                        </select>
                        @error('menu_elegido') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                    <div class="mb-4 col-2">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Día</label>
                        <select class="form-control" wire:model="momento_dia_id">
                            <option value="">-- Seleccione un momento --</option>
                            @foreach($momentos as $momento)
                                <option value="{{ $momento->id }}">{{ $momento->descripcion}}</option>
                            @endforeach                            
                        </select>
                        @error('menu_elegido') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                    <div class="mb-4 col-2">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Cantidad</label>
                        <input class="form-control" type="text" wire:model="cantidad" value="1">
                        @error('menu_elegido') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="bg-white px-4 pb-1 sm:pb-1 flex">
                    <div class="mb-4 col-12">
                        <input type="button" class="hidden sm:flex bg-green-300 hover:bg-green-400 text-black-900 font-bold py-2 px-4 mr-2 rounded col-12" value="Agregar" wire:click="storeDetalle()">
                    </div>
                </div>
                <div class="bg-white px-4  pb-1 sm:pb-1">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Menúes Ligados al Plan</label>
                        
                        <table class="w-full">
                            <tr>
                                <td class="py-2"><b>Día</td>
                                <td><b>Descripción</b></td>
                                <td><b>Momento</b></td>
                                <td><b>Tiempo Prop</b>.</td>
                                <td><b>Cantidad</b></td>
                                <td><b>Activo</b></td>
                                <td><b>Opciones</b></td>
                            </tr>
                            @foreach($listadomenuesenelplan as $menuadherido)
                                @php // Determina la clase CSS según si el ID es par o impar
                                    $claseFondo = ($menuadherido->dia % 2 === 0) ? 'fondo-par' : 'fondo-impar';
                                @endphp
                                <tr class="{{ $claseFondo }}">
                                    <td class="col-1">{{ $menuadherido->dia . '-'.$menuadherido->dia+14 }}</td>
                                    <td class="text-left pl-2">{{ $menuadherido->nombremenu }}</td>
                                    <td class="text-left pl-2">{{ $menuadherido->descripcion }}</td>
                                    <td class="col-1">{{ $menuadherido->tiempopreparacion }}</td>
                                    <td class="col-1">{{ $menuadherido->cantidad}}</td>
                                    <td class="col-1">
                                        {{-- {{ $menuadherido }} --}}
                                        <div class="flex justify-center">
                                            @if($menuadherido->activo==0)
                                                <span class="border rounded-full border-grey bg-green-400 flex items-center cursor-pointer w-12 justify-start" wire:click="habilitarMenuPlan({{$menuadherido->id}}, {{ $menuadherido->activo }})">
                                                    <span class="rounded-full border w-6 h-6 border-grey shadow-inner bg-white"></span>
                                                </span>
                                            @else
                                                <!------- on ----->
                                                <span class="border rounded-full border-grey bg-red-400 flex items-center cursor-pointer w-12 bg-red justify-end" wire:click="habilitarMenuPlan({{$menuadherido->id}}, {{ $menuadherido->activo }})">
                                                    <span class="rounded-full border w-6 h-6 border-grey shadow-inner bg-white"></span>
                                                </span>
                                            @endif
                                        </div>

                                    </td>
                                    <td class="col-1">
                                        <div class="text-center" style="padding-left: 30%;">
                                            <input type="button" class="hidden sm:flex bg-red-300 hover:bg-red-400 text-black-900 font-bold py-2 px-4 mr-2 rounded col-6" value="X" wire:click="deletemenuadherido({{ $menuadherido->id }})">
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    {{-- <x-guardar></x-guardar> --}}
                    <x-cerrar></x-cerrar>
                </div>
            </form>
        </div>
    </div>
</div>
