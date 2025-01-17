<?php

namespace App\Http\Livewire\Empresa;

use App\Models\Empresa;
use App\Models\EmpresaUsuario;
use Livewire\Component;
use App\Models\EmpresaModulo;
use App\Models\Modulo;
use App\Charts\Graficos;
use App\Charts\Graficos\Chart;
use ArielMejiaDev\LarapexCharts\LarapexChart;



class EmpresaComponent extends Component
{
    public $empresas;
    public $empresa_id;

    public $compras, $ventas;

    public function render()
    {
        if(isset(auth()->user()->id)) {
            $userid=auth()->user()->id;
            //$empresas_usuario = EmpresaUsuario::where('user_id',$userid)->get('id');
            //$this->empresas=Empresa::find($empresas_usuario);
            //$this->empresas=EmpresaUsuario::where('user_id',$userid)->get('id');
            $empresas_usuario = EmpresaUsuario::where('user_id',$userid)->get();
            foreach($empresas_usuario as $empresa) {
                $this->empresas[] = Empresa::find($empresa->empresa_id);
            }

            //Compras
            $this->compras = [
                'labels' => ['January', 'February', 'March', 'April', 'May'],
                'data' => [65, 59, 80, 81, 56],
                // 'data' => [
                    
                //         'label' => 'AQUI DOS LINEAS',
                //         'data'=> [12, 19, 3, 5, 2, 3],
                //         'backgroundColor' => 'rgba(255, 99, 132, 0.2)',    
                //         'borderWidth'=> 1
                // ],
                //         [
                //         'label' => 'Xxxx',
                //         'data' => [22, 29, 33, 55, 52, 33],
                //         'backgroundColor' => 'rgba(255, 99, 132, 0.2)',    
                //         'borderWidth' => 1
                //         ]
            ];
            //Ventas
            $this->ventas = [
                'labels' => ['November', 'February', 'March', 'April', 'May'],
                'data' => [15, 39, 22, 55, 16]
            ];
    // dd($this->compras);
    // dd(auth()->user());
            // return view('home');
            return view('livewire.empresa.empresa-component')->extends('layouts.adminlte');
        }
        else {
            return redirect(route('login'));
        }
    }

    public function cargamodulos($id) {
        // dd($id);
        // Establece el id de la empresaa modo global
        session(['empresa_id' => $id]);
        //sleep(2);
        $this->empresa_id=$id;

        $a = Empresa::find($id);
        session(['nombre_empresa' => $a->name]);
        session(['url_logo_empresa' => $a->imagen]);
        
        //dd(session('empresa_id'));
        ////$empresa_modulos = EmpresaModulo::where('empresa_id',$this->empresa_id)->get('modulo_id');
        // $modulos=Modulo::find($empresa_modulos);
        //return view('livewire.modulo.modulo-component',$empresa_modulos);
        return redirect('modulos');
    }

    public function configurarempresa($id) {
        $this->empresa_id=$id;
        return redirect('empresausuarios');
    }
    
    // public static function login() {
    //     $userid=auth()->user()->id;
    //     $empresas_usuario = EmpresaUsuario::where('user_id',$userid)->get();
    //     foreach($empresas_usuario as $empresa) {
    //         $empresas_del_usuario[] = Empresa::find($empresa->empresa_id);
    //     }
    //     return view('livewire.empresa.empresa-component',compact(['empresas'=>$empresas_del_usuario]));
    //     //return $empresas_del_usuario;
    // }

}
