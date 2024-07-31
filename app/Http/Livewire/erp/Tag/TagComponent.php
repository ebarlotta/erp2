<?php

namespace App\Http\Livewire\erp\Tag;

use App\Models\erp\Tag;

use Livewire\Component;

class TagComponent extends Component
{
    public $isModalOpen = false;
    public $tag, $tag_id;
    protected $tags;
    public $valor, $name, $search;

    public $empresa_id;

    public function render()
    {
        $this->empresa_id=session('empresa_id');
        $this->tags = Tag::where('empresa_id', '=', $this->empresa_id)
        ->where('name', 'like', '%'.$this->search.'%')
        ->paginate(7);
        return view('livewire.tag.tag-component',['tags'=> $this->tags])->extends('layouts.adminlte');
        // return view('livewire.tag.tag-component',['datos'=> Tag::where('empresa_id', $this->empresa_id)->orderby('name')->paginate(7),])->extends('layouts.adminlte');
    }

    public function create()
    {
        $this->resetCreateForm();   
        $this->openModalPopover();
        $this->isModalOpen=true;
        return view('livewire.tag.createtag')->with('isModalOpen', $this->isModalOpen);
    }

    public function openModalPopover() { $this->isModalOpen = true; }
    public function closeModalPopover() { $this->isModalOpen = false; }

    public function Filtrar() { $this->tags = Tag::where('empresa_id', '=', $this->empresa_id)->where('name', 'like', '%'.$this->search.'%')->paginate(7); 
    }

    private function resetCreateForm(){
        $this->tag_id = '';

        $this->name = '';
        $this->valor = '';
    }
    
    public function store()
    {
        $this->validate([
            'name' => 'required',
        ]);
        Tag::updateOrCreate(['id' => $this->tag_id], [
            'name' => $this->name,
            'valor' => $this->valor,
            'empresa_id' =>$this->empresa_id,
        ]);

        session()->flash('message', $this->tag_id ? 'Etiqueta Actualizada.' : 'Etiqueta Creada.');

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        $this->id = $id;
        $this->tag_id=$id;
        $this->name = $tag->name;
        $this->valor = $tag->valor;
        
        $this->openModalPopover();
    }
    
    public function delete($id)
    {
        Tag::find($id)->delete();
        session()->flash('message', 'Etiqueta Eliminado.');
    }

}