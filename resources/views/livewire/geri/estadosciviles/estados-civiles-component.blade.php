<div>
    <x-titulo>Estados Civiles</x-titulo>
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
            @can('estadosciviles.Agregar')
                <x-crear>Nuevo Estado Civil</x-crear>
                @if ($isModalOpen)
                    @include('livewire.geri.estadosciviles.createestadosciviles')
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
                    @foreach ($estadosciviles as $estadocivil)
                        <tr>
                            <td class="border px-4 py-2">{{ $estadocivil->estadocivil }}</td>
                            <td class="border px-4 py-2">
                                <div class="flex justify-center">
                                    @can('estadosciviles.Modificar')
                                        <!-- Editar  -->
                                        <x-editar id="{{$estadocivil->id}}"></x-editar>
                                    @endcan
                                    @can('estadosciviles.Eliminar')
                                        <!-- Eliminar -->
                                        <x-eliminar id="{{$estadocivil->id}}"></x-eliminar>
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