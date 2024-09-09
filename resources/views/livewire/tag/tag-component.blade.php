<div>
    <x-titulo>Etiquetas</x-titulo>
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
                        @can('tags.Agregar')
                        {{-- @if(session('Etiquetas.Agregar')) --}}
                            <x-crear>Nueva Etiqueta</x-crear>
                            @if ($isModalOpen)
                                @include('livewire.tag.createtag')
                            @endif
                        {{-- @endif --}}
                        @endcan
                        <input type="text" wire:model="search" placeholder="Introduzca Filtro" wire:keyup="Filtrar">
                        {{-- <div class="w-1/2 justify-end">{{ $tags->links() }}</div> --}}
                    </div>
                    <table class="table-fixed table-striped w-full mt-2">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2" style="background-color: rgb(164, 157, 157);">Nombre de la Etiqueta</th>
                                <th class="px-4 py-2" style="background-color: rgb(164, 157, 157);">Valor</th>
                                <th class="px-4 py-2" style="background-color: rgb(164, 157, 157);">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($tags)
                                @foreach ($tags as $tag)
                                    <tr>
                                        <td class="border px-4 py-2 text-left">{{ $tag->name }}</td>
                                        <td class="border px-4 py-2 text-left">{{ $tag->valor }}</td>
                                        <td class="border px-4 py-2">
                                            <div class="flex justify-center">
                                                @can('tags.Modificar')
                                                {{-- @if(session('Etiquetas.Editar')) --}}
                                                    <!-- Editar  -->
                                                    <x-editar id="{{ $tag->id }}"></x-editar>
                                                {{-- @endif --}}
                                                @endcan
                                                @can('tags.Eliminar')
                                                {{-- @if(session('Etiquetas.Eliminar')) --}}
                                                    <!-- Eliminar -->
                                                    <x-eliminar id="{{ $tag->id }}"></x-eliminar>
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
