<?php

namespace App\Http\Livewire\Expendio;

use App\Models\Geri\Actores\ActorAgente;
use App\Models\Geri\Actor;
use App\Models\User;
use Livewire\Component;

class ExpendioComponent extends Component
{
    public $actores;
    public $registros;

    public function render()
    {
        $this->actores = Actor::join('actor_agentes','actor_agentes.actor_id','actors.id')
        ->join('plan_alimentario_actors','plan_alimentario_actors.actor_id','actor_agentes.id')
        ->join('plan_alimentarios','plan_alimentarios.id','plan_alimentario_actors.plan_id')
        ->join('menu_plans','menu_plans.plan_id','plan_alimentarios.id')
        ->join('menus','menus.id','menu_plans.plan_id')
        ->get();
        // dd($this->actores);
        
        $this->registros = Actor::join('plan_alimentario_actors','plan_alimentario_actors.actor_id','actors.id')
        ->join('plan_alimentarios','plan_alimentarios.id','plan_alimentario_actors.plan_id')
        ->join('menu_plans','menu_plans.plan_id','plan_alimentarios.id')
        ->join('menus','menus.id','menu_plans.menu_id')
        ->join('momentos_del_dias','momentos_del_dias.id','menu_plans.momento_dia_id')
        ->join('dias_de_la_semanas','dias_de_la_semanas.id','menu_plans.dia')
        ->orderby('menu_plans.momento_dia_id')
        ->orderby('nombreactor')
        ->select('actors.nombre as nombreactor','plan_alimentarios.nombre as nombreplan','nombremenu','momentos_del_dias.descripcion')
        ->where('menu_plans.dia','=',2)
        ->get();
        return view('livewire.expendio.expendio-component')->extends('layouts.adminlte');
    }
}
