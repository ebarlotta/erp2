<?php

namespace App\Http\Livewire\Expendio;

use App\Models\Geri\Actores\ActorAgente;
use App\Models\Geri\Actor;
use App\Models\User;
use Livewire\Component;

class ExpendioComponent extends Component
{
    public $fecha, $confirmacion, $servicioacerrar;
    public $registros_desayuno, $registros_almuerzo, $registros_mediatarde, $registros_cena;
    public $cerradoDesayuno, $regs;

    public function render()
    {
        $this->fecha = date('Y-m-d');

        // $this->actores = Actor::join('actor_agentes','actor_agentes.actor_id','actors.id')
        // ->join('plan_alimentario_actors','plan_alimentario_actors.actor_id','actor_agentes.id')
        // ->join('plan_alimentarios','plan_alimentarios.id','plan_alimentario_actors.plan_id')
        // ->join('menu_plans','menu_plans.plan_id','plan_alimentarios.id')
        // ->join('menus','menus.id','menu_plans.plan_id')
        // ->get();
        // dd($this->actores);
        
        $this->registros_desayuno = Actor::join('plan_alimentario_actors','plan_alimentario_actors.actor_id','actors.id')
        ->join('plan_alimentarios','plan_alimentarios.id','plan_alimentario_actors.plan_id')
        ->join('menu_plans','menu_plans.plan_id','plan_alimentarios.id')
        ->join('menus','menus.id','menu_plans.menu_id')
        ->join('momentos_del_dias','momentos_del_dias.id','menu_plans.momento_dia_id')
        ->join('dias_de_la_semanas','dias_de_la_semanas.id','menu_plans.dia')
        ->orderby('menu_plans.momento_dia_id')
        ->orderby('nombreactor')
        ->select('actors.nombre as nombreactor','plan_alimentarios.nombre as nombreplan','nombremenu','momentos_del_dias.descripcion','menu_plans.dia')
        ->groupby('actors.nombre','plan_alimentarios.nombre','menus.nombremenu','momentos_del_dias.descripcion','menu_plans.dia')
        ->where('menu_plans.momento_dia_id','=',1)
        ->get();
        
        $this->registros_almuerzo = Actor::join('plan_alimentario_actors','plan_alimentario_actors.actor_id','actors.id')
        ->join('plan_alimentarios','plan_alimentarios.id','plan_alimentario_actors.plan_id')
        ->join('menu_plans','menu_plans.plan_id','plan_alimentarios.id')
        ->join('menus','menus.id','menu_plans.menu_id')
        ->join('momentos_del_dias','momentos_del_dias.id','menu_plans.momento_dia_id')
        ->join('dias_de_la_semanas','dias_de_la_semanas.id','menu_plans.dia')
        ->orderby('menu_plans.momento_dia_id')
        ->orderby('nombreactor')
        ->select('actors.nombre as nombreactor','plan_alimentarios.nombre as nombreplan','nombremenu','momentos_del_dias.descripcion','menu_plans.dia')
        ->groupby('actors.nombre','plan_alimentarios.nombre','menus.nombremenu','momentos_del_dias.descripcion','menu_plans.dia')
        ->where('menu_plans.momento_dia_id','=',2)
        ->get();

        $this->registros_mediatarde = Actor::join('plan_alimentario_actors','plan_alimentario_actors.actor_id','actors.id')
        ->join('plan_alimentarios','plan_alimentarios.id','plan_alimentario_actors.plan_id')
        ->join('menu_plans','menu_plans.plan_id','plan_alimentarios.id')
        ->join('menus','menus.id','menu_plans.menu_id')
        ->join('momentos_del_dias','momentos_del_dias.id','menu_plans.momento_dia_id')
        ->join('dias_de_la_semanas','dias_de_la_semanas.id','menu_plans.dia')
        ->orderby('menu_plans.momento_dia_id')
        ->orderby('nombreactor')
        ->select('actors.nombre as nombreactor','plan_alimentarios.nombre as nombreplan','nombremenu','momentos_del_dias.descripcion','menu_plans.dia')
        ->groupby('actors.nombre','plan_alimentarios.nombre','menus.nombremenu','momentos_del_dias.descripcion','menu_plans.dia')
        ->where('menu_plans.momento_dia_id','=',3)
        ->get();

        $this->registros_cena = Actor::join('plan_alimentario_actors','plan_alimentario_actors.actor_id','actors.id')
        ->join('plan_alimentarios','plan_alimentarios.id','plan_alimentario_actors.plan_id')
        ->join('menu_plans','menu_plans.plan_id','plan_alimentarios.id')
        ->join('menus','menus.id','menu_plans.menu_id')
        ->join('momentos_del_dias','momentos_del_dias.id','menu_plans.momento_dia_id')
        ->join('dias_de_la_semanas','dias_de_la_semanas.id','menu_plans.dia')
        ->orderby('menu_plans.momento_dia_id')
        ->orderby('nombreactor')
        ->select('actors.nombre as nombreactor','plan_alimentarios.nombre as nombreplan','nombremenu','momentos_del_dias.descripcion','menu_plans.dia')
        ->groupby('actors.nombre','plan_alimentarios.nombre','menus.nombremenu','momentos_del_dias.descripcion','menu_plans.dia')
        ->where('menu_plans.momento_dia_id','=',4)
        ->get();
        
        return view('livewire.expendio.expendio-component')->extends('layouts.adminlte');
    }

    public function PreguntarSiCerrar($servicio) {
        $this->confirmacion = true;
        $this->servicioacerrar = $servicio;
    }
}
