@props(['momento','cerrado','titulo'])
<div>
    <div class="card direct-chat direct-chat-primary">
        <div class="card-header ui-sortable-handle flex" style="cursor: move; justify-content: space-between;">
            <h3 class="card-title ml-3" style="justify-content: right;width: 10%;"><b>{{ $titulo }}</b>
            @php
                if($cerrado=='true') { echo '<br><input type="text" style="text-align: center; background-color: lightgreen; border-radius: 5px; padding: 0px 5px 0px 5px; margin-left: 7px; width: 100%; height: 22px;" value="Cerrado" disabled>'; }
            @endphp

            @php
                if($cerrado=='false') { echo '<br><input type="text" style="text-align: center; background-color: lightcoral; border-radius: 5px; padding: 0px 5px 0px 5px; margin-left: 7px; width: 100%; height: 22px;" value="Abierto" disabled>'; }
            @endphp
            </h3> 
            <div style="justify-content: right;width: 75%;display: flex;">
              <input type="button" class="btn ml-4 hover:scale-105 h-5" value="Cerrar Servicio" style="margin: 6px 30px;padding: 0px 20px;background-color: beige;box-shadow: 3px 3px 3px grey;" wire:click="PreguntarSiCerrar('{{ $momento }}')" @if($cerrado=='true') disabled title="Tooltip on top" @endif>
            </div>
            <div class="card-tools" style="margin-top: 18px; width: 5%;">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" style="border: 1px black solid">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body" style="display: block;">
            <div class="card sm:col-11 shadow-md rounded-l-md transform transition duration-500 hover:scale-105 mx-2"
                style="margin: 10px 10px; box-shadow: 10px 5px 5px gray; height: max-content; border: lightgray; border-style: ridge; border-width: thin;">
                <div class="card-body" style="height: 100%; padding: 0.25rem;">
                    <table class="table table-striped">
                        <tr>
                            <td><b>Usuarios</b></td>
                            <td><b>Plan</b></td>
                            <td><b>Menú</b></td>
                            <td><b>Momento</b></td>
                            <td><b>Está ?</b></td>
                        </tr>
                        @php
                           switch ($momento) {
                            case '1': $regs = $this->registros_desayuno; break;
                            case '2': $regs = $this->registros_almuerzo; break;
                            case '3': $regs = $this->registros_mediatarde; break;
                            case '4': $regs = $this->registros_cena; break;
                        }
                        @endphp
                        
                        @foreach ($regs as $registro)
                        {{-- {{ var_dump($registro) }} --}}
                            <tr wire:click="CambiarCondicionMenu('{{ $momento.'-'.$registro['indice'].'-'.$registro['actor_id'].'-'.$registro['menu_id'] }}')">
                                {{-- <td>{{ $registro->indice }}</td> --}}
                                <td>{{ $registro['nombreactor'] }}</td>
                                <td>{{ $registro['nombreplan'] }}</td>
                                <td>{{ $registro['nombremenu'] }}</td>
                                <td>{{ $registro['descripcion'] }}</td>
                                {{-- <td><input style="width: 20px;height: 20px;" type="checkbox"  @if($registro->presente) checked @endif></td> --}}
                                <td><input style="width: 20px;height: 20px;" type="checkbox"  @if($registro['presente']) checked @endif></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
  