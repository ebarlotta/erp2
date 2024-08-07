<div>
    <x-titulo>Elementos</x-titulo>
    {{-- <x-slot name="header">
        <div class="flex">
            <!-- //Comienza en submenu de encabezado -->

            <!-- Navigation Links -->
            @livewire('submenu')
        </div>

    </x-slot> --}}

    <div class="content-center flex">
        <div class="bg-white p-2 text-center rounded-lg shadow-lg w-full">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
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
                        <x-crear>Nuevo Elemento</x-crear>

                        <div class="flex">
                            <div wire:click="cambiarSeleccion('Medicamento')" @if($seleccionado=='Medicamento') class="mt-1 mx-2 px-2 bg-red-300 rounded-md" @endif><input class="mr-2" type="radio" name="elements" value="Medicamento" checked><label class="mr-4" for="huey">Medicamento</label></div>
                            <div wire:click="cambiarSeleccion('Ingrediente')" @if($seleccionado=='Ingrediente') class="mt-1 mx-2 px-2 bg-red-300 rounded-md" @endif><input class="mr-2" type="radio" name="elements" value="Ingrediente"><label class="mr-4" for="huey">Ingrediente</label></div>
                            {{-- <div wire:click="cambiarSeleccion('Elemento')" @if($seleccionado=='Elemento') class="mt-1 mx-2 px-2 bg-red-300 rounded-md" @endif><input class="mr-2" type="radio" name="elements" value="Elemento"><label class="mr-4" for="huey">Elemento</label></div> --}}
                            <div wire:click="cambiarSeleccion('Descartable')" @if($seleccionado=='Descartable') class="mt-1 mx-2 px-2 bg-red-300 rounded-md" @endif><input class="mr-2" type="radio" name="elements" value="Descartable"><label class="mr-4" for="huey">Descartable</label></div>
                            <div wire:click="cambiarSeleccion('Producto')" @if($seleccionado=='Producto') class="mt-1 mx-2 px-2 bg-red-300 rounded-md" @endif><input class="mr-2" type="radio" name="elements" value="Producto"><label class="mr-4" for="huey">Producto</label></div>
                            <div wire:click="cambiarSeleccion('Articulo')" @if($seleccionado=='Articulo') class="mt-1 mx-2 px-2 bg-red-300 rounded-md" @endif><input class="mr-2" type="radio" name="elements" value="Artíulo"><label class="mr-4" for="huey">Artículo</label></div>
                        </div>
                        @if ($isModalOpen) @include('livewire.elementos.createelemento') @endif
                        @if ($isModalDelete) @include('livewire.elementos.deleteelemento') @endif
                        <div class="w-1/2 justify-end">{{ $datos->links() }}</div>
                    </div>
                    <div style="display: block">
                        <table class="table-fixed w-full">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2">Elemento</th>
                                    <th class="px-4 py-2">Existencia</th>
                                    <th class="px-4 py-2">Precio de Compra</th>
                                    <th class="px-4 py-2">Precio de Venta</th>
                                    <th class="px-4 py-2">Stock Mínimo</th>
                                    <th class="px-4 py-2">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($datos)
                                    @foreach ($datos as $elemento)
                                        <tr>
                                            <td class="border px-4 py-2">{{ $elemento->name }}</td>
                                            <td class="border px-4 py-2">{{ $elemento->existencia }}</td>
                                            <td class="border px-4 py-2">{{ $elemento->precio_compra }}</td>
                                            <td class="border px-4 py-2">{{ $elemento->precio_venta }}</td>
                                            <td class="border px-4 py-2">{{ $elemento->stock_minimo }}</td>
                                            <td class="border px-4 py-2">
                                                <div class="block justify-center flex" style="width: 20%; margin: auto; justify-content: space-around;align-items: center;">
                                                    <!-- Editar  -->
                                                    <x-editar id="{{ $elemento->elemento_id }}"></x-editar>
                                                    <!-- Eliminar -->
                                                    <button wire:click="delete({{ $elemento->elemento_id }})" class="lg:hidden bg-red-300 hover:bg-red-400 text-black-900 font-bold py-1 px-1 mt-1 rounded">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                        </svg>
                                                    </button>
                                                    <button wire:click="delete({{ $elemento->elemento_id }})" class="hidden lg:flex bg-red-300 hover:bg-red-400 text-black-900 font-bold py-2 px-4 rounded mt-1w">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                        </svg>
                                                        Eliminar
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    No hay elementos
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
