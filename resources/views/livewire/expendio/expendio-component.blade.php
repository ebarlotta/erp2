<div>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/fastbootstrap@2.2.0/dist/css/fastbootstrap.min.css" rel="stylesheet" integrity="sha256-V6lu+OdYNKTKTsVFBuQsyIlDiRWiOmtC8VQ8Lzdm2i4=" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </head>
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item" role="presentation">
          <a class="nav-link active" id="simple-tab-0" data-bs-toggle="tab" href="#simple-tabpanel-0" role="tab" aria-controls="simple-tabpanel-0" aria-selected="true">Menúes</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="simple-tab-1" data-bs-toggle="tab" href="#simple-tabpanel-1" role="tab" aria-controls="simple-tabpanel-1" aria-selected="false">Medicamentos</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="simple-tab-2" data-bs-toggle="tab" href="#simple-tabpanel-2" role="tab" aria-controls="simple-tabpanel-2" aria-selected="false">Descartables</a>
        </li>
      </ul>
      <div class="tab-content pt-5" id="tab-content">
        <div class="tab-pane active" id="simple-tabpanel-0" role="tabpanel" aria-labelledby="simple-tab-0">
            Menús Expedidos
            {{-- ============= --}}
            {{ $registros }}
            <div class="card sm:col-11 shadow-md rounded-l-md transform transition duration-500 hover:scale-105" style="margin: 1%;box-shadow: 10px 5px 5px gray; height: max-content; border: lightgray; border-style: ridge; border-width: thin;">
                <p>MENÚ MAÑANA</p>
                <div class="card-body" style="height: 100%; padding: 0.25rem;">                    
                    <table class="table table-striped">
                        <tr>
                            <td>Usuarios</td>
                            <td>Plan</td>
                            <td>Menú</td>
                            <td>Momento</td>
                            <td>Estuvo ?</td>
                        </tr>
                        @foreach ($registros as $registro)
                            <tr>
                                <td>{{ $registro->nombreactor }}</td>
                                <td>{{ $registro->nombreplan }}</td>
                                <td>{{ $registro->nombremenu }}</td>
                                <td>{{ $registro->descripcion }}</td>
                                <td><input type="checkbox" checked></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="simple-tabpanel-1" role="tabpanel" aria-labelledby="simple-tab-1">Medicamentos Expedidos</div>
        <div class="tab-pane" id="simple-tabpanel-2" role="tabpanel" aria-labelledby="simple-tab-2">Descartables Expedidos</div>
      </div>
</div>
