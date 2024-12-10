<?php

namespace App\Http\Livewire\EmpresaModulos;

use App\Models\Empresa;
use App\Models\Modulo;
use App\Models\EmpresaModulo;
use App\Models\EmpresaUsuario;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class EmpresaModulosComponent extends Component
{

    use WithPagination;

    public $isModalOpen = false;

    public $name;

    // public $modulosglobales;
    public $modulosdelaempresa;
    //public $modulosdelaemp;
    public $modulosNOempresa;
    public $empresas;
    public $empresaseleccionada;
    public $seleccionado = 1;

    public $modulosnuevos; 

    public function render()
    {
        // if(!isset($this->modulosglobales)) { $this->modulosglobales = Modulo::all(); }
        //$this->empresas = Empresa::all()->sortBy('id');

        $userid=auth()->user()->id;
        $this->empresas= EmpresaUsuario::where('user_id',$userid)
            ->join('empresas','empresas.id','=','empresa_usuarios.empresa_id')
            ->get();
        // dd($this->empresas);

        return view('livewire.empresa-modulos.empresa-modulos-component',['datos'=>EmpresaUsuario::where('user_id',$userid)->join('empresas','empresas.id','=','empresa_usuarios.empresa_id')->paginate(5)])->extends('layouts.adminlte')
        ->section('content'); //enzo
    }
    public function mostrarmodal()
    {
        $this->isModalOpen = true;
    }
    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }

    public function closeModalPopover()
    {
        $this->isModalOpen = false;
    }

    public function CargarModulos($id)
    {
        $this->empresaseleccionada = Empresa::find($id);
        // dd($this->empresaseleccionada);
        $this->seleccionado = $id;
        $this->modulosdelaempresa = DB::table('modulos')->distinct()
            ->join('empresa_modulos', 'modulos.id', '=', 'empresa_modulos.modulo_id')
            ->join('empresas',  'empresas.id', '=', 'empresa_modulos.empresa_id',)
            ->where('empresas.id', $this->empresaseleccionada->id)
            ->select('modulos.*', 'empresas.name as empresa')
            ->orderby('name')
            ->get();
            // $this->modulosdelaemp = $this->modulosdelaempresa;
            // $array = json_decode($this->modulosdelaempresa, true);
            // $this->modulosdelaempresa = $array;
            //$this->modulosglobales = $array;
            // dd($this->modulosdelaempresa);
            //dd($array);
            // dd($this->modulosdelaempresa);
            $this->modulosdelaempresa=json_decode($this->modulosdelaempresa, true);
        $this->modulosNOempresa = Modulo::all();

        $this->modulosnuevos = DB::select("SELECT * FROM `modulos` left join empresa_modulos on modulos.id = empresa_modulos.modulo_id and empresa_modulos.empresa_id = " . $this->empresaseleccionada->id.' ORDER by name ASC'); 
        
        // dd($this->modulosnuevos);

    }

    public function AgregarModulo($modulo_id)
    {
        $a = EmpresaModulo::where('empresa_id', "=", $this->empresaseleccionada->id)
        ->where('modulo_id', "=", $modulo_id)->delete();
        // EmpresaModulo::create(['empresa_id' => $this->empresaseleccionada->id, 'modulo_id' => $modulo_id]);
        $this->closeModalPopover();
        $this->modulos = Modulo::all();
        $this->CargarModulos($this->empresaseleccionada->id);
        return view('livewire.empresa-modulos.empresa-modulos-component');
    }

    public function EliminarModulo($modulo_name)
    {
        $a = Modulo::where('name',$modulo_name)->get();
        $relacion = new EmpresaModulo;
        $relacion->empresa_id = $this->empresaseleccionada->id;
        $relacion->modulo_id = $a[0]->id;
        $relacion->save();
        // $a = EmpresaModulo::join('moduloss','empresa_modulos.modulo_id','=','modulos.id')
        // ->where('empresa_id', "=", $this->empresaseleccionada->id)
        // ->where('modulos.name','=',$modulo_name)->get();

        // dd($a);
        // $a = EmpresaModulo::where('empresa_id', "=", $this->empresaseleccionada->id)
        //     ->where('modulo_id', "=", $modulo_id)->delete();
        $this->closeModalPopover();
        $this->modulos = Modulo::all();
        $this->CargarModulos($this->empresaseleccionada->id);
        return view('livewire.empresa-modulos.empresa-modulos-component');
    }
}
