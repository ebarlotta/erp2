<div>
    <x-titulo>Planes Alimentarios</x-titulo>
    <style>
        /* Estilo para las celdas de la tabla */
        td {
            border: 1px solid #ddd;
            text-align: center;
            transition: background-color 0.3s ease; /* Suaviza el cambio de color */
        }

        /* Cambia el color de fondo al pasar el ratón por encima */
        td:hover {
            background-color: #f0f0f0; /* Color de fondo al hacer hover */
        }
    </style>
    <div class="content-center flex">
        <div class="bg-white p-2 text-center rounded-lg shadow-lg w-full">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                    @if (session()->has('message'))
                        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                            <div class="flex">
                                <div>
                                    <p class="text-xm bg-lightgreen">{{ session('message') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="flex justify-around">
                        {{-- @can('plans.Agregar') --}}
                            <x-crear>Nuevo Plan Alimentario</x-crear>
                            <a href="menu">
                                <button class="bg-green-300 hover:bg-green-400 text-white-900 font-bold py-2 px-4 rounded my-3">
                                    Volver a los menúes
                                </button>
                            </a>
                            @if ($isModalOpen)          @include('livewire.geri.plan-alimentario.createplanalimentario') @endif
                            @if ($isModalOpenGestionar) @include('livewire.geri.plan-alimentario.gestionarplanalimentario') @endif
                        {{-- @endcan --}}
                        <div class="w-1/2 justify-end">{{ $datos->links() }}</div>
                    </div>
                    <div style="display: block">
                        {{-- @foreach ($datos as $plan) --}}

                        <table class="table table-sm table-bordered">
                            {{-- <tr class="border-b dark:border-neutral-500">
                                <td colspan="2" align="left" class="whitespace-nowrap border-r px-6 py-4 font-medium dark:border-neutral-500">plans del menú</td>
                            </tr> --}}
                            <thead class="border-b font-medium dark:border-neutral-500">
                                <th class="col-2 border-r px-6 dark:border-neutral-500">Nombre</th>
                                <th class="col-8 border-r px-6 dark:border-neutral-500">Descripción</th>
                                <th class="col-1 border-r px-6 dark:border-neutral-500">Fecha Desde</th>
                                <th class="col-1 border-r px-6 dark:border-neutral-500">Fecha Hasta</th>
                                <th class="col-2 border-r px-6 dark:border-neutral-500">Activo</th>
                                <th class="col-1 border-r px-6 dark:border-neutral-500">Opciones</th>
                            </thead>
                            <tbody>
                                @if($datos)
                                    @foreach ($datos as $plan)
                                        <tr>
                                            <td style="vertical-align: middle;">{{$plan->nombre}}</td>
                                            <td class="text-left pl-2" style="vertical-align: middle;">{{$plan->descripcion}}</td>
                                            <td style="vertical-align: middle;">{{ date('d-m-Y', strtotime($plan->desde)) }}</td>
                                            <td style="vertical-align: middle;">{{ date('d-m-Y', strtotime($plan->hasta)) }}</td>
                                            <td style="vertical-align: middle;">
                                                <div class="flex justify-center">
                                                    @if($plan->activo==0)
                                                        <span class="border rounded-full border-grey bg-green-400 flex items-center cursor-pointer w-12 justify-start" wire:click="habilitar({{ $plan->id }}, {{ $plan->activo }})">
                                                            <span class="rounded-full border w-6 h-6 border-grey shadow-inner bg-white"></span>
                                                        </span>
                                                    @else
                                                        <!------- on ----->
                                                        <span class="border rounded-full border-grey bg-red-400 flex items-center cursor-pointer w-12 bg-red justify-end" wire:click="habilitar({{ $plan->id }}, {{ $plan->activo }})">
                                                            <span class="rounded-full border w-6 h-6 border-grey shadow-inner bg-white"></span>
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td style="width: 20%;">
                                                <div style="display: flex">
                                                    {{-- @can('plans.Gestionar') --}}
                                                        <!-- Gestionar  -->
                                                        <x-gestionar id="{{ $plan->id }}"></x-gestionar>
                                                    {{-- @endcan --}}
                                                    {{-- @can('plans.Modificar') --}}
                                                        <!-- Editar  -->
                                                        <x-editar id="{{ $plan->id }}"></x-editar>
                                                    {{-- @endcan --}}
                                                    {{-- @can('plans.Eliminar') --}}
                                                        <!-- Eliminar -->
                                                        <x-eliminar id="{{ $plan->id }}"></x-eliminar>
                                                    {{-- @endcan --}}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
