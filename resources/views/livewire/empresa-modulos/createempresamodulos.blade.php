<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
	<div class="flex items-end justify-center mt-24 pt-4 px-4 pb-20 text-center sm:block sm:p-0"
		style="background-color: beige; ">
		<div class="fixed inset-0 transition-opacity">
			<div class="absolute inset-0 bg-gray-500 opacity-75"></div>
		</div>

		<span class="hidden sm:inline-block sm:align-middle "></span>
		<div class="ml-8 inline-block align-center bg-white rounded-3xl text-left overflow-hidden shadow-xl transform transition-all sm:my-1 sm:align-top sm:w-3/5" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
			<form>
				<div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
					<div class="">
						<div class="mb-4">
							<div style="width: 100%;background-color: bisque;border-radius: 20px;height: 5rem;justify-content: center;display: flex; margin: 4px;	align-items: center; text-align: center; padding-top:1px; font-size: 2rem;">
								{{ $empresaseleccionada->name }}
							</div>
							<div style="display: flex; flex-wrap: wrap; justify-content: center;">
								@foreach ($modulosNOempresa as $modulo)
									<div style="width: max-content;background-color: bisque;border-radius: 20px;height: 4rem;justify-content: center;display: block; margin: 4px; align-items: center; text-align: center; padding-top:1px; padding-left:2rem; padding-right:2rem;">
										<div style="position: inherit; justify-content: end; display: flex; margin-right: -21px; margin-top: 5px;" placeholder="Agregar" wire:click="AgregarModulo({{ $modulo->id }})">
											<img src="{{ asset('images/activo.jpg') }}" width="20" height="20">
										</div>
										<p style="margin-top: -10px;">{{ $modulo->name }}</p>
										<p style="margin-top: -14px;">{{ $modulo->email }}</p>
									</div>
								@endforeach
							</div>
							<div style="display: flex; flex-wrap: wrap; justify-content: center;">
								@if ($modulosdelaempresa)
									@foreach ($modulosdelaempresa as $modx)
										<div style="width: max-content; background-color: rgb(160, 233, 100);border-radius: 20px;height: 4rem;justify-content: center;display: block; margin: 4px; align-items: center; text-align: center; padding-top:1px; padding-left:2rem; padding-right:2rem;">
											<div style="position: inherit; justify-content: end; display: flex; margin-right: -21px; margin-top: 5px;" placeholder="Eliminar" wire:click="EliminarModulo({{ $modx['id'] }})">
												<img src="{{ asset('images/pasivo.jpg') }}" width="20" height="20">
											</div>
											<b>{{ $modx['name'] }}</b>
										</div>
									@endforeach
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
