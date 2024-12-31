<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0" style="background-color: beige; ">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
        <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline" style="max-width: 60%">
            <form>
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="mb-3"><h2><b>Nuevo {{ $seleccionado }}</b></h2></div>
                    <div class="flex flex-wrap">
                        <div class="mb-4 col-3">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Nombre</label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Ingrese Nombre" wire:model="name">
                            @error('name') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4 col-2">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Existencia</label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Ingrese existencia" wire:model="existencia">
                            @error('existencia') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4 col-2">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Stock Mínimo</label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Ingrese stock mínimo" wire:model="stock_minimo">
                            @error('stock_minimo') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4 col-2">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Precio de compra</label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Ingrese precio de compra" wire:model="precio_compra">
                            @error('precio_compra') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4 col-3">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Unidad</label>
                            <select class="form-control round shadow-md" wire:model= "unidad_id" >
                                <option value="">Seleccione</option>
                                @foreach ($unidades as $unidad)
                                    <option value="{{ $unidad->id }}">{{ $unidad->name }}</option>
                                @endforeach
                            </select>
                            @error('unidad_id') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4 col-3">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Categoría</label>
                            <select class="form-control round shadow-md" wire:model= "categoria_id" >
                                <option value="">Seleccione</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombrecategoria }}</option>
                                @endforeach
                            </select>
                            @error('categoria_id') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4 col-3">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Vencimiento</label>
                            <input type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Ingrese vencimiento" wire:model="vencimiento">
                            @error('vencimiento') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4 col-3">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Imágen</label>
                            <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Ingrese imágen" wire:model="ruta">
                            @error('ruta') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        {{-- Variaciones --}}

                        {{-- Medicamentos --}}
                        {{-- ============ --}}

                        @if($seleccionado=='Medicamento') 
                            <div class="mb-4 col-3">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Pedir A:</label>
                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Ingrese a quién se pide el medicamento" wire:model="pedira">
                                @error('pedira') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-4 col-2">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Psiquiátrico</label>
                                <input type="checkbox" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Ingrese si el medicamento es de tipo psiquiátrico" wire:model="psiquiatrico">
                                @error('psiquiatrico') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                        @endif

                        {{-- Ingrediente --}}
                        {{-- =========== --}}

                        @if($seleccionado=='Ingrediente') 
                            <div class="mb-4 col-3">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Estado:</label>
                                <select class="form-control round shadow-md" wire:model= "estado_id" >
                                    <option value="">Seleccione</option>
                                    @foreach ($estados as $estado)
                                        <option value="{{ $estado->id }}">{{ $estado->name }}</option>
                                    @endforeach
                                </select>
                                @error('estado_id') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                        @endif
                        {{-- Producto --}}
                        {{-- ======== --}}
                        @if($seleccionado=='Producto') 
                            <div class="mb-4 col-2">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Código de Barra:</label>
                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Ingrese código de barra" wire:model="barra">
                                @error('barra') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-4 col-2">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Código QR:</label>
                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Ingrese código QR" wire:model="qr">
                                @error('qr') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-4 col-2">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Descuento (0 - 1)</label>
                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Ingrese porcentaje descuento" wire:model="descuento">
                                @error('descuento') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-4 col-2">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Descuento Especial(0-1)</label>
                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Ingrese porcentaje descuento especial" wire:model="descuento_especial">
                                @error('descuento_especial') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-4 col-2">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Calificacion</label>
                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Ingrese calificacionl" wire:model="calificacion">
                                @error('calificacion') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-4 col-2">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Precio de Venta</label>
                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Ingrese Precio de Venta" wire:model="precio_venta">
                                @error('precio_venta') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-4 col-2">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Lote</label>
                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Ingrese calificacionl" wire:model="lote">
                                @error('lote') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-4 col-3">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Proveedor</label>
                                <select class="form-control round shadow-md" wire:model= "proveedor_id" >
                                    <option value="">Seleccione</option>
                                    @foreach ($proveedores as $proveedor)
                                        <option value="{{ $proveedor->id }}">{{ $proveedor->name }}</option>
                                    @endforeach
                                </select>
                                @error('proveedor_id') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-4 col-3">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Estado:</label>
                                <select class="form-control round shadow-md" wire:model= "estado_id" >
                                    <option value="">Seleccione</option>
                                    @foreach ($estados as $estado)
                                        <option value="{{ $estado->id }}">{{ $estado->name }}</option>
                                    @endforeach
                                </select>
                                @error('pedira') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-4 col">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Descripción</label>
                                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" style="height: 2.4rem; width: 100%" wire:model="descripcion">{{ $descripcion }}</textarea>
                                {{-- <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Ingrese descripción" wire:model="descripcion"> --}}
                                @error('descripcion') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                        @endif

                        {{-- Descartable --}}
                        {{-- =========== --}}

                        @if($seleccionado=='Descartable') 
                            <div class="mb-4 col">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Descripción</label>
                                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" style="height: 2.4rem; width: 100%">{{ $descripcion }}</textarea>
                                @error('descripcion') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                        @endif

                        {{-- Artículo --}}
                        {{-- ======== --}}

                        @if($seleccionado=='Articulo') 
                            <div class="mb-4 col-2">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Marca</label>
                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Ingrese Marca" wire:model="marca">
                                @error('marca') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-4 col-2">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Precio de Venta</label>
                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Ingrese Precio de Venta" wire:model="precio_venta">
                                @error('precio_venta') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-4 col-2">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Lista</label>
                                <select class="form-control round shadow-md" wire:model= "lista_id" >
                                    <option value="">Seleccione</option>
                                    @foreach ($listas as $lista)
                                        <option value="{{ $lista->id }}">{{ $lista->name }}</option>
                                    @endforeach
                                </select>
                                @error('lista_id') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                        @endif
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <x-guardar></x-guardar>
                    <x-cerrar></x-cerrar>
                </div>
            </form>
        </div>
    </div>
</div>