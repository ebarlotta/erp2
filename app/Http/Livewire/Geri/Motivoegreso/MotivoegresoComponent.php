<?php

namespace App\Http\Livewire\Geri\Motivoegreso;

use App\Models\Geri\MotivosEgresos;

use Livewire\Component;

class MotivoegresoComponent extends Component
{

    public $motivoegresoDescripcion, $motivoegreso_id;
    public $motivos;
    public $isModalOpen = false;

    public function render()
    {
        $this->motivos = MotivosEgresos::all();
        return view('livewire.geri.motivoegreso.motivoegreso-component',['isModalOpen'=>$this->isModalOpen,'motivos'=>$this->motivos])->extends('layouts.adminlte');
    }


    public function create()
    {
        $this->resetCreateForm();
        $this->openModalPopover();
        $this->isModalOpen = true;
        return view('livewire.geri.motivoegreso.motivoegreso-component',['isModalOpen'=>$this->isModalOpen,'motivoegresoDescripcion'=>$this->motivoegresoDescripcion])->extends('layouts->adminlte');
    }

    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }

    public function closeModalPopover()
    {
        $this->isModalOpen = false;
    }

    private function resetCreateForm()
    {
        $this->motivoegreso_id = '';
        $this->motivoegresoDescripcion = '';
    }

    public function store()
    {
        $this->validate([
            'motivoegresoDescripcion' => 'required',
        ]);

        MotivosEgresos::updateOrCreate(['id' => $this->motivoegreso_id], [
            'motivoegresoDescripcion' => $this->motivoegresoDescripcion,
        ]);

        session()->flash('message', $this->motivoegreso_id ? 'Motivo Actualizado.' : 'Motivo Creado.');

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $motivo = MotivosEgresos::findOrFail($id);
        $this->id = $id;
        $this->motivoegreso_id = $id;
        $this->motivoegresoDescripcion = $motivo->motivoegresoDescripcion;
        
        $this->openModalPopover();
    }

    public function delete($id)
    {
        MotivosEgresos::find($id)->delete();
        session()->flash('message', 'Motivo Eliminado.');
    }
}
