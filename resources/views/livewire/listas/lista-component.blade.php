<div>
    <x-titulo>Listas</x-titulo>
    <x-slot name="header">
        <div class="flex">
            <!-- //Comienza en submenu de encabezado -->

            <!-- Navigation Links -->
            {{-- @livewire('submenu') --}}
        </div>

    </x-slot>

    <div class="content-center flex">
        <div class="bg-white p-2 text-center rounded-lg shadow-lg w-full">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-1">
                
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
                
                    <div class="flex justify-around">
                        {{-- @if(session('listas.Agregar')) --}}
                        @can('listas.Agregar')
                            <x-crear>Nueva Lista</x-crear>
                            @if ($isModalOpen)
                                @include('livewire.listas.createlistas')
                            @endif
                        @endcan
                        {{-- @endif --}}
                        <div class="w-1/2 justify-end">{{ $listas->links() }}</div>
                    </div>
                    <div style="display: block">
                        <table class="table-fixed table-striped w-full">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2">Nombre del Lista</th>
                                    <th class="px-4 py-2">Porcentaje</th>
                                    <th class="px-4 py-2">Activo</th>
                                    <th class="px-4 py-2">Desde</th>
                                    <th class="px-4 py-2">Hasta</th>
                                    <th class="px-4 py-2">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($listas)
                                    @foreach ($listas as $lista)
                                        <tr style="height: 0;">
                                            <td class="border px-4 py-2 text-left">{{ $lista->name }}</td>
                                            <td class="border px-4 py-2 text-left">{{ $lista->porcentaje }} %</td>
                                            <td class="border px-4 py-2 text-left">
                                            @if($lista->activo) 
                                                <div class="flex justify-center">
                                                    <span class="border rounded-full border-grey bg-green-400 flex items-center cursor-pointer w-12 justify-start" wire:click="habilitar({{ $lista->id}}, {{ $lista->activo }})">
                                                        <span class="rounded-full border w-6 h-6 border-grey shadow-inner bg-white shadow">
                                                        </span>
                                                    </span>
                                                </div>
                                            @else
                                                <div class="flex justify-center">
                                                    <span class="border rounded-full border-grey bg-red-400 flex items-center cursor-pointer w-12 bg-red justify-end" wire:click="habilitar({{ $lista->id}}, {{ $lista->activo }})">
                                                        <span class="rounded-full border w-6 h-6 border-grey shadow-inner bg-white shadow">
                                                        </span>
                                                    </span>
                                                </div>
                                            @endif

                                            {{-- <td class="border px-4 py-2 text-left">{{ $lista->activo }}</td> --}}
                                            <td class="border px-4 py-2 text-left">{{ $lista->vigenciahasta }}</td>
                                            <td class="border px-4 py-2 text-left">{{ $lista->vigenciahasta }}</td>
                                            <td class="border px-4 py-2">
                                                <div class="flex justify-center">
                                                    @can('listas.Modificar')
                                                        {{-- @if(session('listas.Modificar')) --}}
                                                            <!-- Editar  -->
                                                            <x-editar id="{{ $lista->id }}"></x-editar>
                                                        {{-- @endif --}}
                                                    @endcan
                                                    @can('listas.Eliminar')
                                                    {{-- @if(session('listas.Eliminar')) --}}
                                                        <!-- Eliminar -->
                                                        <x-eliminar id="{{ $lista->id }}"></x-eliminar>
                                                    {{-- @endif --}}
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>