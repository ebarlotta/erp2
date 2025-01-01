<?php

namespace App\Http\Livewire\Geri;

use Livewire\Component;
use App\Models\Geri\Menu;
use App\Models\Geri\MenuPlan;
use App\Models\Geri\PlanAlimentario;


class PlanAlimentarioComponent extends Component
{
    public $isModalOpen = false, $isModalOpenGestionar = false;
    public $planalimentario, $planalimentario_id, $plan_nombre;
    public $planesalimentarios, $nombre;
    public $selectcategoria=null;
    public $selectunidad=null;
    public $descripcion, $desde, $hasta, $activo=true, $cantidad=1, $menu_elegido, $dia;
    public $listadomenues, $listadomenuesenelplan;

    public $empresa_id;

    public function render()
    {
        $this->empresa_id=session('empresa_id');
        // $this->categorias = Categorias::where('empresa_id', $this->empresa_id)->get();
        // $this->unidades = Unidad::where('empresa_id', $this->empresa_id)->get();
        $this->planesalimentarios = PlanAlimentario::where('empresa_id', $this->empresa_id)->get();
        //dd($this->planesalimentarios->categorias['nombrecategoria']);
        return view('livewire.geri.plan-alimentario.plan-alimentario-component',['datos'=> PlanAlimentario::where('empresa_id', $this->empresa_id)->paginate(7),])->extends('layouts.adminlte');
    }

    public function create()
    {
        $this->resetCreateForm();   
        $this->openModalPopover();
        $this->isModalOpen=true;
        return view('livewire.geri.plan-alimentario.createplanalimentario')->with('isModalOpen', $this->isModalOpen)->with('nombre', $this->nombre);
    }

    public function openModalPopover() { $this->isModalOpen = true; }
    public function closeModalPopover() { $this->isModalOpen = false; $this->isModalOpenGestionar = false; }
    // public function closeModalGestionar() { $this->isModalOpenGestionar = false; }
    
    public function show($plan_id) {
        $plan = PlanAlimentario::find($plan_id);
        $this->plan_nombre = $plan->nombre;
        $this->planalimentario_id = $plan_id; 
        $this->listadomenues = Menu::where('empresa_id','=',session('empresa_id'))->orderby('nombremenu')->get();
        $this->CargarRelaciones();

        // dd($this->listadomenuesenelplan);
        // dd($this->listadomenues);
        $this->isModalOpenGestionar = true; 
    }

    public function CargarRelaciones() {
        $this->listadomenuesenelplan = MenuPlan::where('plan_id','=',$this->planalimentario_id)->orderby('dia')
        ->join('menus','menu_plans.menu_id','menus.id')
        ->get(['menu_plans.id','menu_id','plan_id','dia','activo','cantidad','nombremenu','tiempopreparacion']);
    }

    private function resetCreateForm(){ $this->planalimentario_id = ''; $this->nombre = ''; }
    
    public function store()
    {
        //dd($this->unidades);
        $this->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);
        PlanAlimentario::updateOrCreate(['id' => $this->planalimentario_id], [
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'desde' => $this->desde,
            'hasta' => $this->hasta,
            'activo' => $this->activo,
            'empresa_id' => $this->empresa_id,
        ]);

        session()->flash('message', $this->planalimentario_id ? 'Plan Alimentario Actualizado.' : 'Plan Alimentario Creado.');

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function storeDetalle()
    {
        //dd($this->unidades);
        $this->validate([
            'menu_elegido' => 'required',
            'planalimentario_id' => 'required',
            'dia' => 'required',
            'cantidad' => 'required',
        ]);

        $menu_plan = new MenuPlan;
        $menu_plan->plan_id = $this->planalimentario_id;
        $menu_plan->menu_id = $this->menu_elegido;
        $menu_plan->dia = $this->dia;
        $menu_plan->cantidad = $this->cantidad;
        $menu_plan->save();

        session()->flash('message', $this->planalimentario_id ? 'Plan Actualizado.' : 'Plan Creado.');

        // $this->closeModalPopover();
        $this->CargarRelaciones();
        // $this->listadomenuesenelplan = MenuPlan::where('plan_id','=',$this->planalimentario_id)->orderby('dia')
        // ->join('menus','menu_plans.menu_id','menus.id')
        // ->get();
        // $this->resetCreateForm();
    }

    public function edit($id)
    {
        $planalimentario = PlanAlimentario::findOrFail($id);
        // $this->planalimentario_id=$id;
        $this->nombre = $planalimentario->nombre;
        $this->descripcion = $planalimentario->descripcion;
        $this->desde = $planalimentario->desde;
        $this->hasta = $planalimentario->hasta;
        $this->activo = $planalimentario->activo;
        
        $this->openModalPopover();
    }
    
    public function delete($id)
    {
        PlanAlimentario::find($id)->delete();
        session()->flash('message', 'Plan Alimentario Eliminado.');
    }

    public function habilitar($plan_id, $estado) {
        PlanAlimentario::where('id', $plan_id)->update(['activo' => !$estado]);
        session()->flash('message', 'Plan Alimentario Hebilitado/Desabilitado.');
    }

    public function habilitarMenuPlan($menu_plan_id, $estado) {
        // dd($estado);
        MenuPlan::where('id', $menu_plan_id)->update(['activo' => !$estado]);
        $this->CargarRelaciones();
        // $this->listadomenuesenelplan = MenuPlan::where('plan_id','=',$this->planalimentario_id)->orderby('dia')
        // ->join('menus','menu_plans.menu_id','menus.id')
        // ->get();
        // dd($this->listadomenuesenelplan);
        session()->flash('message', 'Plan Alimentario Hebilitado/Desabilitado.');
    }

    public function deletemenuadherido($id) { 
        MenuPlan::where('id','=',$id)->delete(); 
        $this->CargarRelaciones();
        // $this->listadomenuesenelplan = MenuPlan::where('plan_id','=',$this->planalimentario_id)->orderby('dia')
        // ->join('menus','menu_plans.menu_id','menus.id')
        // ->get();
        // dd($this->listadomenuesenelplan);

    }
}
