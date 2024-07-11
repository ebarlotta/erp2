<?php

namespace App\Http\Livewire\GestionModulos;

use Livewire\Component;
use App\Models\Modulo as Modulos;
use Spatie\Permission\Models\Permission;
use Livewire\WithPagination;


class GestionModuloComponent extends Component
{
    public $name,$pagina,$imagen,$leyenda;
    public $modulos;
    public $permisos;
    public $nombre_permiso;
    public $idpermisoaeliminar;
    public $ShowButtonActualizar=false;

    public $buscar;

    public $modulo_id;

    use WithPagination;


    public function render()
    {
        if ($this->buscar) {
            $this->modulos = Modulos::where('name', 'LIKE', "%" . $this->buscar . "%")->get();

            return view('livewire.modulos.modulo-component',['datos'=> Modulos::where('name', 'LIKE', "%" . $this->buscar . "%")->orderby('name')->paginate(7),])->extends('layouts.adminlte');
        } else {
            $this->modulos = Modulos::where('id','>',0)->get();
            // dd($this->modulos);
            // $this->modulos = Modulos::all();
            return view('livewire.modulos.modulo-component',['datos'=> Modulos::where('id','>',0)->orderby('name')->paginate(7),])->extends('layouts.adminlte');
        }
    }

    public function showNew()
    {
        $this->reset('name');
    }

    public function showNewPermiso() {
        $this->reset('nombre_permiso');
    }

    public function ShowActualizar() {
        $this->ShowButtonActualizar = true;
    }

    public function showEdit($id)
    {
        $modulos = Modulos::find($id);
        $this->name = $modulos->name;
        $this->modulo_id = $id;
        $this->pagina = $modulos->pagina;
        $this->imagen = $modulos->imagen;
        $this->leyenda = $modulos->leyenda;
        $this->ShowButtonActualizar = false;
        
        //Cargar todos los permisos desponibles del módulo
        $this->permisos=Permission::where('name', 'LIKE', '%'. $modulos->name . '%')
        ->orwhere('name', 'LIKE', '%'. $modulos->pagina . '%')
        ->get();
    }

    public function showDelete($id)
    {
        $modulos = Modulos::find($id);
        $this->name = $modulos->name;
        $this->modulo_id = $id;
    }

    public function destroy($id)
    {
        Modulos::destroy($this->modulo_id);
        $this->reset('name');
        session()->flash('mensaje', 'Se eliminó el módulo.');
    }

    public function store()
    {
        if($this->modulo_id) {
            $this->validate([
                'name' => 'required|max:255',
                'pagina' => 'required',
                'imagen' => 'required',
                'leyenda' => 'required',
            ]);
        } else {
            $this->validate([
                'name' => 'required|unique:modulos|max:255',
                'pagina' => 'required',
                'imagen' => 'required',
                'leyenda' => 'required',
            ]);
        }
        Modulos::updateOrCreate(['id' => $this->modulo_id], [
            'name' => $this->name,
            'pagina' => $this->pagina,
            'imagen' => $this->imagen,
            'leyenda' => $this->leyenda,
        ]);
        $this->modulo_id = null;
        session()->flash('mensaje', 'Se guardó el módulo.');
    }

    public function storePermiso() {
        $this->validate([
            'nombre_permiso' => 'required|max:255',
        ]);

        $this->name = $this->reemplazaEspaciosAcentos($this->name);
        $name = $this->name.'.'.$this->nombre_permiso;
        $permission = Permission::create(['name' => $name]);

        $this->nombre_permiso = null;
        session()->flash('mensaje', 'Se guardó el Permiso.');
        $this->showEdit( $this->modulo_id);
    }

    public static function reemplazaEspaciosAcentos($name) {
        $bodytag = str_replace(" ", "", $name);
        $campo1 = str_replace(
            array("á","é","í","ó","ú","ñ"),
            array("a","e","i","o","u","n"),
            $bodytag
        );
        $campo2 = str_replace(" ","_",strtolower($campo1));
        return $campo2;
    }

    public function getPermisoaEliminar($id,$nombre_permiso) {
        $this->idpermisoaeliminar = $id;
        $this->nombre_permiso = $nombre_permiso;
    }

    public function destroyPermiso($id)
    {
        Permission::destroy($id);
        $this->reset('name');
        session()->flash('mensaje', 'Se eliminó el permiso.');
        $this->showEdit( $this->modulo_id);
    }
}
