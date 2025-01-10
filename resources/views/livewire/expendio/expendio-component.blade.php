<div>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/fastbootstrap@2.2.0/dist/css/fastbootstrap.min.css" rel="stylesheet"
            integrity="sha256-V6lu+OdYNKTKTsVFBuQsyIlDiRWiOmtC8VQ8Lzdm2i4=" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
    </head>
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="simple-tab-0" data-bs-toggle="tab" href="#simple-tabpanel-0" role="tab"
                aria-controls="simple-tabpanel-0" aria-selected="true">Menúes</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="simple-tab-1" data-bs-toggle="tab" href="#simple-tabpanel-1" role="tab"
                aria-controls="simple-tabpanel-1" aria-selected="false">Medicamentos</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="simple-tab-2" data-bs-toggle="tab" href="#simple-tabpanel-2" role="tab"
                aria-controls="simple-tabpanel-2" aria-selected="false">Descartables</a>
        </li>
    </ul>
    <div class="tab-content pt-5" id="tab-content">
      <div class="tab-pane active" id="simple-tabpanel-0" role="tabpanel" aria-labelledby="simple-tab-0">
        <div class="card direct-chat direct-chat-primary">
          <div class="card-header ui-sortable-handle" style="cursor: move; justify-content: space-between;">
              <h3 class="card-title ml-3">Datos de Expediciones</h3>
              <div class="flex ml-4" style="padding-left: 60px;">
                Fecha: <input type="date" wire:model="fecha" style="background-color: lightgreen; border-radius: 5px; padding: 0px 5px 0px 5px; margin-left: 7px;">
              </div>
          </div>
        </div>

        <x-expedirMomento momento="Desayuno" cerrado="true"></x-expedirMomento>
        <x-expedirMomento momento="Almuerzo" cerrado="false"></x-expedirMomento>
        <x-expedirMomento momento="Mediatarde" cerrado="false"></x-expedirMomento>
        <x-expedirMomento momento="Cena" cerrado="false"></x-expedirMomento>

      </div>

    </style>
      <x-dialog-modal  class="max-w-lg w-full mt-10" wire:model="confirmacion" style="margin-top: 100px">
        <x-slot name="title" style="margin-top: 100px; padding-top: 100px;">
            Cerrar Servicio
        </x-slot>
        <x-slot name="content">
            <x-label>Está seguro de que quiere cerrar el servicio de {{ $servicioacerrar }} del día {{date('d-m-Y', strtotime($fecha)) }}?</x-label>
        </x-slot>
        <x-slot name="footer">
            <x-button class="btn bg-yellow-300 btn-warning mr-2" wire:click="CambiarEstado()">Si, cerrar</x-button>
            <x-button class="btn btn-info" wire:click="$set('confirmacion',false)">Volver sin cerrar</x-button>
        </x-slot>
      </x-dialog-modal>       
      <div class="tab-pane" id="simple-tabpanel-1" role="tabpanel" aria-labelledby="simple-tab-1">Medicamentos Expedidos</div>
      <div class="tab-pane" id="simple-tabpanel-2" role="tabpanel" aria-labelledby="simple-tab-2">Descartables Expedidos</div>
    </div>

    {{-- <div class="fixed inset-0 flex items-center justify-center"> --}}
 
    {{-- </div> --}}
</div>
