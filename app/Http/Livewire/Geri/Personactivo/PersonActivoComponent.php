<?php

namespace App\Http\Livewire\Geri\Personactivo;

use App\Models\Geri\PersonActivo;

use Livewire\Component;

class PersonActivoComponent extends Component
{
    public $estado, $estados, $estado_id;
    public $isModalOpen = false;

    public function render()
    {
        $this->estados = PersonActivo::all();
        return view('livewire.geri.personactivo.person-activo-component',['isModalOpen'=> $this->isModalOpen, 'estados'=> $this->estados])->extends('layouts.adminlte');
    }
    public function create()
    {
        $this->resetCreateForm();   
        $this->openModalPopover();
        $this->isModalOpen=true;
        return view('livewire.geri.personactivo.person-activo-component',['isModalOpen'=> $this->isModalOpen, 'estados'=> $this->estados])->extends('layouts.adminlte');
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
        $this->estado_id = '';
        $this->estado = '';
    }
    
    public function store()
    {
        $this->validate([
            'estado' => 'required',
        ]);
    
        PersonActivo::updateOrCreate(['id' => $this->estado_id], [
            'estado' => $this->estado,
        ]);

        session()->flash('message', $this->estado_id ? 'Estado Actualizado.' : 'Estado Creado.');

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $estado = PersonActivo::findOrFail($id);
        $this->id = $id;
        $this->estado_id=$id;
        $this->estado = $estado->estado;
        
        $this->openModalPopover();
    }
    
    public function delete($id)
    {
        PersonActivo::find($id)->delete();
        session()->flash('message', 'Estado Eliminado.');
    }
}
