<?php

namespace App\Http\Livewire\Geri\Tiposdepersonas;

use App\Models\Geri\TipoDePersona;

use Livewire\Component;
use Livewire\WithPagination;

class TiposDePersonasComponent extends Component
{

    public $tipodepersona,  $tipo_de_persona_id;
    public $isModalOpen = false;
    use WithPagination;
    //$tiposdepersonas, // Se pasa como array en la vista, por eso no hace falta declararla

    public function render()
    {
        ////$this->tiposdepersonas = TipoDePersona::paginate(2);
        //$coments = TipoDePersona::find(2)->interfaces;
        //dd($coments);
        //return view('livewire.tiposdepersonas.tipos-de-personas-component')->with('isModalOpen', $this->isModalOpen)->with('tiposdepersonas', $this->tiposdepersonas);
        return view('livewire.tiposdepersonas.tipos-de-personas-component', ['tiposdepersonas' => TipoDePersona::paginate(5),]);
    }


    public function create()
    {
        $this->resetCreateForm();   
        $this->openModalPopover();
        $this->isModalOpen=true;
        return view('livewire.tiposdepersonas.tipos-de-personas-component',['isModalOpen'=> $this->isModalOpen,'tiposdepersonas' => TipoDePersona::class]);
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
        $this->tipo_de_persona_id = '';
        $this->tipodepersona = '';
    }
    
    public function store()
    {
        $this->validate([
            'tipodepersona' => 'required',
        ]);
    
        TipoDePersona::updateOrCreate(['id' => $this->tipo_de_persona_id], [
            'tipodepersona' => $this->tipodepersona,
        ]);

        session()->flash('message', $this->tipo_de_persona_id ? 'Tipo de Perona Actualizado.' : 'Tipo de Perona Creado.');

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $tipodepersona = TipoDePersona::findOrFail($id);
        $this->id = $tipodepersona->id;
        $this->tipo_de_persona_id=$tipodepersona->id;
        $this->tipodepersona = $tipodepersona->tipodepersona;
        
        $this->openModalPopover();
    }
    
    public function delete($id)
    {
        TipoDePersona::find($id)->delete();
        session()->flash('message', 'Tipo de Perona Eliminado.');
    }

}