<?php

namespace App\Http\Livewire\Tiposdedocumentos;

use App\Models\TiposDocumentos;

use Livewire\Component;

class TiposDeDocumentosComponent extends Component
{

    public $tipodocumento, $tipodedocumento_id;
    public $isModalOpen = false;
    protected $tiposdedocumentos;

    public function render()
    {
        $this->tiposdedocumentos = TiposDocumentos::all();
        return view('livewire.geri.tiposdedocumentos.tipos-de-documentos-component',['isModalOpen' => $this->isModalOpen,'tiposdedocumentos'=> $this->tiposdedocumentos])->extends('layouts.adminlte');
        // return view('livewire.geri.tiposdedocumentos.tipos-de-documentos-component')->with('isModalOpen', $this->isModalOpen)->with('tiposdedocumentos', $this->tiposdedocumentos)->extends('layouts.adminlte');

    }
    public function create()
    {
        $this->resetCreateForm();   
        $this->openModalPopover();
        $this->isModalOpen=true;
        return view('livewire.geri.tiposdedocumentos.tipos-de-documentos-component')->with('isModalOpen', $this->isModalOpen)->with('tiposdedocumentos', $this->tiposdedocumentos)->extends('layouts.adminlte');
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
        $this->tipodedocumento_id = '';
        $this->tipodocumento = '';
    }
    
    public function store()
    {
        $this->validate([
            'tipodocumento' => 'required',
        ]);
    
        TiposDocumentos::updateOrCreate(['id' => $this->tipodedocumento_id], [
            'tipodocumento' => $this->tipodocumento,
        ]);

        session()->flash('message', $this->tipodedocumento_id ? 'Tipo de Documento Actualizado.' : 'Tipo de Documento Creado.');

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $tipodedocumento = TiposDocumentos::findOrFail($id);
        $this->id = $id;
        $this->tipodedocumento_id=$id;
        $this->tipodocumento = $tipodedocumento->tipodocumento;
        //dd($tipodedocumento->tipodocumento);
        
        $this->openModalPopover();
    }
    
    public function delete($id)
    {
        TiposDocumentos::find($id)->delete();
        session()->flash('message', 'Tipo de Documento Eliminado.');
    }

}
