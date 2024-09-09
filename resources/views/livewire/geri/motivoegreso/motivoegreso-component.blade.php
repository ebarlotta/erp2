<div>
    <x-titulo>Motivos de Egresos</x-titulo>
    {{-- <x-slot name="header">
        <div class="flex">
            <!-- //Comienza en submenu de encabezado -->

            <!-- Navigation Links -->
            @livewire('submenu')
        </div>

    </x-slot> --}}
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
            @can('motivoegreso.Agregar')
                <x-crear>Nuevo Motivo</x-crear>
                @if ($isModalOpen)
                    @include('livewire.geri.motivoegreso.createmotivoegreso')
                @endif
            @endcan
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">Descripción</th>
                        <th class="px-4 py-2">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($motivos as $motivo)
                    <tr>
                        <td class="border px-4 py-2">{{ $motivo->motivoegresoDescripcion }}</td>
                        <td class="border px-4 py-2">
                            <div class="flex justify-center">
                                @can('motivoegreso.Modificar')
                                    <!-- Editar  -->
                                    <x-editar id="{{$motivo->id}}"></x-editar>
                                @endcan
                                @can('motivoegreso.Eliminar')
                                    <!-- Eliminar -->
                                    <x-eliminar id="{{$motivo->id}}"></x-eliminar>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>