<?php

namespace App\Http\Livewire\Listas;

use Livewire\Component;

use App\Models\Lista;
use Livewire\WithPagination;

class ListaComponent extends Component
{

    public $isModalOpen = false;
    public $lista, $porcentaje, $lista_id, $name, $empresa_id, $vigenciadesde, $vigenciahasta, $activo;
    protected $listas;

    use WithPagination;

    public function render()
    {
        if(auth()->user()->hasPermissionTo('listas.Ver')) {
            $this->empresa_id=session('empresa_id');
            // $this->listas = Lista::where('empresa_id', $this->empresa_id)->get();
            $this->listas = Lista::where('empresa_id', '=', $this->empresa_id)->paginate(7);
            
            return view('livewire.listas.lista-component',['listas' => $this->listas])->extends('layouts.adminlte');
        } else {
            return view('SinPermiso')->extends('layouts.adminlte');
        }
    }

    public function create()
    {
        $this->resetCreateForm();   
        $this->openModalPopover();
        $this->isModalOpen=true;
        return view('livewire.listas.createlistas')->with('isModalOpen', $this->isModalOpen)->with('name', $this->name);
    }

    public function openModalPopover() { $this->isModalOpen = true; }
    public function closeModalPopover() { $this->isModalOpen = false; }

    private function resetCreateForm(){
        $this->lista_id = '';
        $this->name = '';
        $this->activo = '';
        $this->vigenciadesde = '';
        $this->vigenciahasta = '';
    }
    
    public function store()
    {
        $this->validate([
            'name' => 'required',
            'porcentaje' => 'required',
        ]);
        Lista::updateOrCreate(['id' => $this->lista_id], [
            'name' => $this->name,
            'porcentaje' => $this->porcentaje,
            'activo' => $this->activo,
            'vigenciadesde' => $this->vigenciadesde,
            'vigenciahasta' => $this->vigenciahasta,
            'empresa_id' => session('empresa_id'),
        ]);

        session()->flash('message', $this->lista_id ? 'Lista Actualizada.' : 'Lista Creada.');

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $lista = Lista::findOrFail($id);
        $this->lista_id=$id;
        $this->name = $lista->name;
        $this->porcentaje = $lista->porcentaje;
        $this->activo = $lista->activo;
        $this->vigenciadesde = $lista->vigenciadesde;
        $this->vigenciahasta = $lista->vigenciahasta;
        $this->openModalPopover();
    }
    
    public function delete($id)
    {
        Lista::find($id)->delete();
        session()->flash('message', 'Lista Eliminada.');
    }

    public function habilitar($id,$estado)
    {
        $lista = Lista::find($id);
        if($estado) { $lista->activo = 0; } else { $lista->activo = 1; }
        $lista->save();
    }
}