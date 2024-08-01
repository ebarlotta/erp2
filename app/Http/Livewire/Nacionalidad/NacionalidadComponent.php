<?php

namespace App\Http\Livewire\Nacionalidad;

use App\Models\Nacionalidad;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class NacionalidadComponent extends Component
{
    
    public $nacionalidad_descripcion, $nacionalidad_id;
    public $nacionalidades;
    public $isModalOpen = false;

    public function render()
    {
        //dd(Nacionalidad::all());
        $this->nacionalidades = DB::table('nacionalidads')->get();
        return view('livewire.geri.nacionalidad.nacionalidad-component',['isModalOpen'=>$this->isModalOpen,'nacionalidades'=>$this->nacionalidades])->extends('layouts.adminlte');
        //return "Hola";
    }


    public function create()
    {
        $this->resetCreateForm();   
        $this->openModalPopover();
        $this->isModalOpen=true;
        return view('livewire.geri.nacionalidad.nacionalidad-component',['isModalOpen'=>$this->isModalOpen,'nacionalidad_descripcion'=>$this->nacionalidad_descripcion])->extends('layouts.adminlte');
    }

    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }

    public function closeModalPopover()
    {
        $this->isModalOpen = false;
    }

    private function resetCreateForm(){
        $this->nacionalidad_id = '';
        $this->nacionalidad_descripcion = '';
    }
    
    public function store()
    {
        $this->validate([
            'nacionalidad_descripcion' => 'required',
        ]);
    
        Nacionalidad::updateOrCreate(['id' => $this->nacionalidad_id], [
            'nacionalidad_descripcion' => $this->nacionalidad_descripcion,
        ]);

        session()->flash('message', $this->nacionalidad_id ? 'Nacionalidad Actualizada.' : 'Nacionalidad Creada.');

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $nacionalidad = Nacionalidad::findOrFail($id);
        $this->id = $id;
        $this->nacionalidad_id=$id;
        $this->nacionalidad_descripcion = $nacionalidad->nacionalidad_descripcion;
        
        $this->openModalPopover();
    }
    
    public function delete($id)
    {
        Nacionalidad::find($id)->delete();
        session()->flash('message', 'Nacionalidad Eliminada.');
    }
}

