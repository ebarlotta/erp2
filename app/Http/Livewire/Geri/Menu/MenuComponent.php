<?php

namespace App\Http\Livewire\Geri\Menu;

use App\Models\Geri\Menu;
use App\Models\Geri\Ingredientes;
use App\Models\Geri\Menuingrediente;
use App\Models\Elementos\ElementoIngrediente;
use App\Models\Elementos\Elemento;

use Livewire\Component;

class MenuComponent extends Component
{
    public $isModalOpen = false;
    public $isModalOpenGestionar = false;
    public $menu, $menu_id;
    public $menues, $nombremenu, $menuactivo=true, $tiempopreparacion;
    public $ingredientesdelmenu, $ingredientes, $ingredientea, $cantidad, $ingrediente_gestionar_id; 
    
    public $empresa_id;
    
    public function render()
    {
        $this->empresa_id=session('empresa_id');
        $this->menues = Menu::where('empresa_id', $this->empresa_id)->orderby('nombremenu')->get();

        $this->ingredientes = ElementoIngrediente::join('elementos', 'elementos.id','elemento_ingredientes.elemento_id')->orderby('elementos.name')->get();

        $this->CargarIngredientesDelMenu();
        // dd($this->ingredientes);

        // $this->ingredientes = Ingredientes::where('empresa_id', $this->empresa_id)->orderby('nombreingrediente')->get();

        return view('livewire.geri.menu.menu-component',['datos'=> Menu::where('empresa_id', $this->empresa_id)->paginate(3),])->extends('layouts.adminlte');
    }

    public function CargarIngredientesDelMenu() {
        $this->ingredientesdelmenu = Elemento::join('elemento_ingredientes','elementos.id','elemento_ingredientes.elemento_id')
        ->join('menuingredientes','menuingredientes.elemento_id','elemento_ingredientes.elemento_id')
        ->join('menus','menus.id','menuingredientes.menu_id')
        ->join('unidads','elementos.unidad_id','unidads.id')
        ->select('elementos.name as nombre_elemento', 'cantidad', 'unidads.name as nombre_unidad','menus.id as menu_id','elemento_ingredientes.elemento_id as elemento_id')
        ->where('menu_id','=',$this->menu_id)
        ->where('elementos.empresa_id','=',session('empresa_id'))
        ->get();
    }

    public function create()
    {
        $this->resetCreateForm();   
        $this->openModalPopover();
        $this->isModalOpen=true;
        return view('livewire.geri.menu.createmenu')->with('isModalOpen', $this->isModalOpen)->with('menu', $this->menu);
    }

    public function show($id)
    {
        $this->openModalPopoverGestionar();
        $menu = Menu::where('id',$id)->get();
        $this->menu = $menu;
        $this->menu_id = $id;

        $this->CargarIngredientesDelMenu();

        return view('livewire.geri.menu.gestionarmenu')->with('isModalOpen', $this->isModalOpen)->with('menu', $menu);
    }

    public function openModalPopoverGestionar() { $this->isModalOpenGestionar = true; }
    public function closeModalPopoverGestionar() { $this->isModalOpenGestionar = false; }
    public function openModalPopover() { $this->isModalOpen = true; }
    public function closeModalPopover() { $this->isModalOpen = false; }
    private function resetCreateForm(){ $this->menu_id = $this->tiempopreparacion = $this->nombremenu = ''; }
    
    public function store()
    {
        $this->validate([
            'nombremenu' => 'required',
        ]);
        Menu::updateOrCreate(['id' => $this->menu_id], [
            'nombremenu' => $this->nombremenu,
            'tiempopreparacion' => $this->tiempopreparacion,
            'menuactivo' => $this->menuactivo,
            'empresa_id' =>$this->empresa_id,
        ]);

        session()->flash('message', $this->menu_id ? 'Menu Actualizadao.' : 'Menu Creadao.');

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $this->menu_id=$id;
        $this->nombremenu = $menu->nombremenu;
        $this->tiempopreparacion = $menu->tiempopreparacion;
        $this->menuactivo = $menu->menuactivo;
        
        $this->openModalPopover();
    }
    
    public function EliminarRelacionMenuIngrediente($menu_id,$elemento_id){
        // dd($menu_id . ' ' .$elemento_id);
        menuingrediente::where('menu_id','=',$menu_id)
        ->where('elemento_id','=',$elemento_id)
        ->delete();
        $this->CargarIngredientesDelMenu();
    }

    public function delete($id)
    {
        Menu::find($id)->delete();
        session()->flash('message', 'Menu Eliminado.');
    }

    public function AgregarElementoAlMenu() {
        //Si Cantidad es numerico, si es positivo, si no es nulo
        $this->validate([
            'cantidad' => 'required|min:0.00001|numeric',
            // 'ingrediente_gestionar_id' => 'required|unique:menuingredientes,elemento_id,menu_id',
        ]);
        if(is_null($this->ingrediente_gestionar_id)) {
            session()->flash('message', 'Debe seleccionar un ingrediente');
        } else {
            Menuingrediente::create([
                'menu_id' => $this->menu_id,
                'elemento_id' => $this->ingrediente_gestionar_id,
                'cantidad' => $this->cantidad,
            ]);

            $this->CargarIngredientesDelMenu();
        //     $this->ingredientesdelmenu = Ingredientes::where('menu_id',$this->menu_id)
        // ->where('ingredientes.empresa_id',session('empresa_id'))
        // ->join('menuingredientes','ingredientes.id','=','menuingredientes.elemento_id')
        // ->join('unidads','ingredientes.unidad_id','=','unidads.id')
        // ->get();
            session()->flash('message', 'Se agregó el ingrediente');
        }
    }

    public function habilitar($id,$estado)
    {
        $menu = Menu::find($id);
        if($estado) { $menu->menuactivo = 0; } else { $menu->menuactivo = 1; }
        $menu->save();
    }
}
