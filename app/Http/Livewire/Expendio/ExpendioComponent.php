<?php

namespace App\Http\Livewire\Expendio;

use App\Models\Consumido;
use App\Models\Geri\Actores\ActorAgente;
use App\Models\Geri\Actor;
use App\Models\Geri\PlanAlimentario;
use App\Models\User;
use Livewire\Component;
use DateTime;
use Illuminate\Support\Facades\DB;

class ExpendioComponent extends Component
{
    public $fecha, $confirmacion, $servicioacerrar;
    public $registros_desayuno, $registros_almuerzo, $registros_mediatarde, $registros_cena;
    public $cerradoDesayuno, $regs, $diaDelCiclo, $otro;

    public function render() {
        // if(auth()->check() && auth()->user()->hasPermissionTo('expendio.Ver')) {
            if(session('empresa_id')) {
                $this->CargarMenues();
                return view('livewire.expendio.expendio-component')->extends('layouts.adminlte');
            } else { return view('livewire.seleccionarempresa')->extends('layouts.adminlte'); }
    }

    public function CargarMenues() {
        if(is_null($this->fecha)) $this->fecha = date('Y-m-d');
        $fechaInicio = new DateTime('2025-01-01');
        $fechaHoy = new DateTime($this->fecha);
        $diferencia = $fechaInicio->diff($fechaHoy);
        $diasTranscurridos = $diferencia->days;
        // $diaDelCiclo = ($diasTranscurridos % 14) + 1;   // Se modificó para probar con periodos de 7 días en lugar de 14
        $this->diaDelCiclo = ($diasTranscurridos % 7) + 1;

        $this->Cargar_Registros(1); // Desayuno
        $this->Cargar_Registros(2); // Almuerzo
        $this->Cargar_Registros(3); // Mediatarde
        $this->Cargar_Registros(4); // Cena
    }

    public function Cargar_Registros($momento) {
        $registros = DB::table('plan_alimentario_actors')
            ->join('actors', 'plan_alimentario_actors.actor_id', '=', 'actors.id')
            ->join('plan_alimentarios', 'plan_alimentarios.id', '=', 'plan_alimentario_actors.plan_id')
            ->join('menu_plans', 'menu_plans.plan_id', '=', 'plan_alimentarios.id')
            ->join('menus', 'menus.id', '=', 'menu_plans.menu_id')
            ->join('momentos_del_dias', 'momentos_del_dias.id', '=', 'menu_plans.momento_dia_id')
            ->selectRaw('
                actors.id as actor_id,
                plan_alimentarios.id as plan_id,
                menus.id as menu_id,
                actors.nombre as nombreactor,
                plan_alimentarios.nombre as nombreplan,
                menus.nombremenu,
                momentos_del_dias.descripcion,
                menu_plans.dia,
                IF(actors.id > 0, true, false) as presente
            ')
            ->where('menu_plans.momento_dia_id', '=', $momento) // parámetro de momento del día: 1:Desayuno, 2:Almuerzo, 3:Mediatarde, 4:Cena
            ->where('menu_plans.dia', '=', $this->diaDelCiclo)
            ->groupBy(
                'actors.id',
                'plan_alimentarios.id',
                'menus.id',
                'actors.nombre',
                'plan_alimentarios.nombre',
                'menus.nombremenu',
                'momentos_del_dias.descripcion',
                'menu_plans.dia'
            )
            ->orderBy('menu_plans.momento_dia_id')
            ->orderBy('nombreactor')
            ->get()
            ->map(function ($item, $index) {
                $itemArray = (array) $item;
                $itemArray['indice'] = $index;
                $itemArray['presente'] = (int) $item->presente; // asegurarse que sea int, no bool
                return $itemArray;
            })
            ->toArray();
            
            switch ($momento) {
                case 1: $this->registros_desayuno = $registros; break;
                case 2: $this->registros_almuerzo = $registros; break;
                case 3: $this->registros_mediatarde = $registros; break;
                case 4: $this->registros_cena = $registros; break;
            }
            $this->sincronizarConsumos($momento,$registros);

    }

    public function sincronizarConsumos($momento, $registros) {
        // En este procedimiento se crea un nuevo registro en la tabla de consumos si es que no se ha entrado nunca ese día
        foreach($registros as $reg) {
            Consumido::firstOrCreate([
                'fecha' => $this->fecha,
                'actor_id'=> $reg['actor_id'],
                'menu_id'=> $reg['menu_id'],
                'cantidad'=> 1,
                'momento_del_dia_id'=> $momento,
                'dia_de_la_semana'=> $this->diaDelCiclo,
                'empresa_id'=> session('empresa_id'),]
            );
        }
    }

    public function CambiarCondicionMenu($datos) {
        $valores = explode('-', $datos);
        $momento = $valores[0]; // Momento del día
        $registro = (int) $valores[1]; // índice del array
        $actor_id = (int) $valores[2]; // id del actor
        $menu_id = (int) $valores[3]; // id del menu
        $dia_semana = (int) $this->diaDelCiclo; // id del día del ciclo

        $a = Consumido::where('fecha',$this->fecha)
        ->where('actor_id',$actor_id)
        ->where('menu_id',$menu_id)
        ->where('momento_del_dia_id',$momento)
        ->where('dia_de_la_semana',$dia_semana)
        ->where('empresa_id',session('empresa_id'))
        ->get(['id','consumido']);

        if(!empty($a)) $b = Consumido::where('id',$a[0]['id'])->update(['consumido' => !$a[0]['consumido']]);
    }

    public function PreguntarSiCerrar($servicio) {
        $this->confirmacion = true;
        $this->servicioacerrar = $servicio;
    }
}
