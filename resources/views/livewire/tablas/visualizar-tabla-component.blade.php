<div>
    <x-titulo>Informes</x-titulo>
    <x-slot name="header">
        <div class="flex">
            <!-- //Comienza en submenu de encabezado -->

            <!-- Navigation Links -->
            {{-- @livewire('submenu') --}}
        </div>

    </x-slot>
    <div class="content-center flex">
        <div class="bg-white p-2 text-center rounded-lg shadow-lg w-full">
            <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
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
        @if ($isModalOpen)
            @include('livewire.tablas.createtablas')
        @endif
        @if (session('AsignacionOk')) 
            <div class="alert alert-success">{{ session('AsignacionOk') }}
        @endif
    </div>
    <div style="display: block">

        <div class="flex h-full">
            <span wire:loading>
				<div class="inset-0 fixed">
					<div class="absolute flex justify-center w-full mt-6 p-18">
						<div class=" bg-gray-400 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-2 shadow-lg my-2" role="dialog">
							<div class=" bg-gray-400 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
								Espere unos segundos mientras se procesa la información ingresada...
							</div>
						</div>
					</div>
				</div>
			</span>
            <div class="block w-1/4">
                <h3>Informes Habilitados</h3>
                <table class="table-fixed table-striped w-full ml-3" style="background-color: lightblue;">
                    <tbody>
                        @if(count($ListadeTablas)>=1)
                            @foreach ($ListadeTablas as $tabla)
                                <div class="flex">
                                    <button class="col-8" wire:click="Visualizar('{{ $tabla['name'] }}')" style="background-color: lightskyblue; width: 90%; height: 60px; margin-top: 10px; border-radius: 7px 0px 0px 7px; margin-right: 2px; box-shadow: 4px 4px 12px rgba(0,0,0,0.42);">
                                    {{ $tabla['name'] }}
                                    </button>
                                    
									<a class="col-4" href="{{ URL::to('pdf/informes/'.$tabla['name']) }}" target="_blank">
                                        {{-- <a class="col-4" href="{{ URL::to('pdf/informes/'.session('empresa_id').'/'. $tabla['name']) }}" target="_blank"> --}}
                                        <button style="background-color: lightskyblue; width: 90%; height: 60px;     margin-top: 10px; border-radius: 0px 7px 7px 0px; box-shadow: 4px 4px  12px rgba(0,0,0,0.42);">
                                            {{-- <button wire:click="PDF('{{ $tabla['name'] }}')" style="background-color: lightskyblue; width: 90%; height: 60px;     margin-top: 10px; border-radius: 0px 7px 7px 0px; box-shadow: 4px 4px  12px rgba(0,0,0,0.42);"> --}}
                                            PDF
                                        </button>
                                    </a>
                                </div>
                                {{-- <tr wire:click="Visualizar('{{ $tabla['name'] }}')" style="height: 60px;">
                                    <td>
                                        {{ $tabla['name'] }}
                                    </td>
                                </tr> --}}

                                {{-- <div class="p-2 shadow-lg" style="background:linear-gradient(90deg, lightblue 20%, white 50%); width:93%; height:100px; display: flex; margin: 1.25rem; border-radius: 10px;" wire:click="Visualizar('{{ $tabla['name'] }}')">
                                    <div>
                                        <div style="width:100%; display: flex">
                                            <p class="shadow-md m-1 w-full" style="font-size: 18px; background-color: rgb(226, 230, 230); border-radius: 10px; padding: 3px;">{{ $tabla['name'] }}</p>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- @endif --}}
                            @endforeach
                        @else
                            @if($ListadeTablas==[])
                                <tr>
                                    <td>
                                        Seleccione un usuario            
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td>
                                        Ningún informe habilitado
                                    </td>
                                </tr>
                            @endif
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="block">
                <h3>Vista Previa</h3>
                <div class="p-2 shadow-lg" style="background:linear-gradient(90deg, lightblue 20%, white 50%); width:93%; height:100%; display: flex; margin: 1.25rem; border-radius: 10px;" style="width: 100%;">
                    {!! $visualizar !!} 
                </div>
            </div>
        </div>
    </div>
</div>
