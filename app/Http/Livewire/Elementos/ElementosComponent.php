<?php

namespace App\Http\Livewire\Elementos;

use App\Models\Unidad;
use App\Models\Categorias;
use App\Models\Estado;
use App\Models\Proveedor;
use App\Models\Lista;

use App\Models\Elementos\Elemento;
use App\Models\Elementos\ElementoArticulo;
use App\Models\Elementos\ElementoMedicamento;
use App\Models\Elementos\ElementoProducto;
use App\Models\Elementos\ElementoDescartable;
use App\Models\Elementos\ElementoIngrediente;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

use Livewire\WithPagination;

class ElementosComponent extends Component
{
    // public $Elemento = Elemento::class;
    // public $ElementoArticulo = ElementoArticulo::class;
    protected $unidades, $categorias, $datos;
    public $seleccionado='Medicamento',$elemento_id;
    public $name, $existencia, $stock_minimo, $precio_compra, $categoria_id, $unidad_id, $vencimiento; //General
    public $pedira, $psiquiatrico; // Medicamento
    public $estados, $estado_id; //Ingrediente
    public $barra, $qr, $descuento, $descuento_especial, $descripcion, $calificacion, $precio_venta, $lote, $ruta, $proveedores, $proveedor_id; //producto
    public $marca, $listas, $lista_id; //Articulo
    public $isModalOpen=false, $isModalDelete=false;

    use WithPagination;
    

    public function render()
    {
        $this->estados = Estado::where('empresa_id','=',session('empresa_id'))->get();
        $this->proveedores = Proveedor::where('empresa_id','=',session('empresa_id'))->get();
        $this->listas = Lista::where('empresa_id','=',session('empresa_id'))->get();

        switch ($this->seleccionado) {
            case "Medicamento" : $this->datos = Elemento::join('elemento_medicamentos','elemento_medicamentos.elemento_id','=','elementos.id')->paginate(7); break;
            case "Ingrediente" : $this->datos = Elemento::join('elemento_ingredientes','elemento_ingredientes.elemento_id','=','elementos.id')->paginate(7); break;
            case "Producto" : $this->datos = Elemento::join('elemento_productos','elemento_productos.elemento_id','=','elementos.id')->paginate(7); break;
            case "Descartable" : $this->datos = Elemento::join('elemento_descartables','elemento_descartables.elemento_id','=','elementos.id')->paginate(7); break;
            case "Articulo" : $this->datos = Elemento::join('elemento_articulos','elemento_articulos.elemento_id','=','elementos.id')->paginate(7); break;
        }
        // dd($this->datos);
        $this->unidades = Unidad::where('empresa_id','=',session('empresa_id'))->get();
        // dd($this->unidades);
        $this->categorias = Categorias::where('empresa_id','=',session('empresa_id'))->get();
        return view('livewire..elementos.elementos-component',['datos'=>$this->datos, 'unidades'=>$this->unidades,'categorias'=>$this->categorias,'estados'=>$this->estados,'proveedores'=>$this->proveedores,'listas'=>$this->listas])->extends('layouts.adminlte');
    }

    public function closeModalPopover() { $this->isModalOpen = false; $this->isModalDelete=false; }
    public function delete($id) { $this->isModalDelete = true; $this->elemento_id = $id; }
    public function cambiarSeleccion($sel) { $this->seleccionado = $sel; }
    public function create() { $this->borrarDatos(); $this->isModalOpen = true; }
    
    public function borrarDatos() {
        $this->reset( 'elemento_id', 'name', 'existencia', 'stock_minimo', 'precio_compra', 'categoria_id', 'unidad_id', 'vencimiento', 'pedira', 'psiquiatrico', 'estados', 'estado_id', 'barra', 'qr', 'descuento', 'descuento_especial', 'descripcion', 'calificacion', 'precio_venta', 'lote', 'ruta', 'proveedores', 'proveedor_id', 'marca', 'listas', 'lista_id');    
    }

    public function store() {
        $this->validate([
            'name'=> 'required',
            'existencia'=> 'required|numeric|min:0',
            'stock_minimo'=> 'required|numeric|min:0',
            'precio_compra'=> 'required|numeric|min:0',
            'unidad_id'=> 'required',
            'categoria_id'=> 'required',
            'vencimiento'=> 'required',
        ]);

        if($this->ruta==NULL || $this->ruta=='sin_imagen.jpg') {
            $this->ruta = "sin_imagen.jpg";   
        } else
        {
            $nombreCompleto = basename($this->ruta) . time().'.jpg';
            $this->ruta = $nombreCompleto;
        }

        switch ($this->seleccionado) {
            case "Medicamento" : 
                $this->validate(['pedira'=> 'required',]); 
                break;
            case "Ingrediente" : 
                $this->validate(['estado_id'=> 'required',]); 
                break;
            case "Producto" : 
                $this->validate([
                    'barra'=> 'required|numeric|min:0',
                    'qr'=> 'required',
                    'descuento'=> 'required|numeric|min:0|max:1',
                    'descuento_especial'=> 'required|numeric|min:0|max:1',
                    'descripcion'=> 'required',
                    'calificacion'=> 'required|numeric|min:0',
                    'precio_venta'=> 'required|numeric|min:0',
                    'ruta'=> 'required',
                    'proveedor_id'=> 'required',
                ]); 
                break;
            case "Descartable" : 
                $this->validate(['descripcion'=> 'required',]);
                break;
            case "Articulo" : 
                $this->validate(['precio_venta'=> 'required|numeric|min:0','lista_id'=> 'required',]);
                break;
        }

        Elemento::updateOrCreate(['id' => $this->elemento_id], [
            'name'=> $this->name,
            'existencia'=> $this->existencia,
            'precio_compra'=> $this->precio_compra,
            'stock_minimo'=> $this->stock_minimo,
            'vencimiento'=> $this->vencimiento,
            'categoria_id'=> $this->categoria_id,
            'unidad_id'=> $this->unidad_id,
            'empresa_id'=> session('empresa_id'),
        ]);
        switch ($this->seleccionado) {
            case "Medicamento" : ElementoMedicamento::updateOrCreate(['elemento_id' => $this->elemento_id], ['pedira' => $this->pedira, 'elemento_id' => $this->elemento_id, 'psiquiatrico' => true,]); break;
            case "Ingrediente" : ElementoIngrediente::updateOrCreate(['elemento_id' => $this->elemento_id], ['estado_id' => $this->estado_id,'elemento_id' => $this->elemento_id,]); break;
            case "Producto" : 
                ElementoProducto::updateOrCreate(['elemento_id' => $this->elemento_id], [
                    'barra'=> $this->barra,
                    'qr'=> $this->qr,
                    'descuento'=> $this->descuento,
                    'descuento_especial'=> $this->descuento_especial,
                    'descripcion'=> $this->descripcion,
                    'calificacion'=> $this->calificacion,
                    'precio_venta'=> $this->precio_venta,
                    'lote'=> $this->lote,
                    'ruta'=> $this->ruta,
                    'elemento_id'=> $this->elemento_id,
                    'estado_id'=> $this->estado_id,
                    'proveedor_id'=> $this->proveedor_id,
                ]); 
                break;
            case "Descartable" : ElementoDescartable::updateOrCreate(['elemento_id' => $this->elemento_id], ['descripcion' => $this->descripcion,'elemento_id' => $this->elemento_id,'pendiente' => true,]); break;
            case "Articulo" : ElementoArticulo::updateOrCreate(['elemento_id' => $this->elemento_id], ['precioventa' => $this->precio_venta,'marca' => $this->marca, 'lista_id' =>$this->lista_id,'elemento_id' => $this->elemento_id,]); break;
        }
        session()->flash('message', $this->elemento_id ? $this->seleccionado . ' Actualizado.' : $this->seleccionado . ' Creado.');
        $this->elemento_id = null; // Borra de la memoria el Elemento con el que se estaba trabajando
        $this->closeModalPopover();
        $this->borrarDatos();
    }

    public function edit($id) {
        $datos = Elemento::find($id);
        $this->name = $datos->name;
        $this->existencia = $datos->existencia;
        $this->precio_compra = $datos->precio_compra;
        $this->stock_minimo = $datos->stock_minimo;
        $this->vencimiento = $datos->vencimiento;
        $this->categoria_id = $datos->categoria_id;
        $this->unidad_id = $datos->unidad_id;
        switch ($this->seleccionado) {
            case "Medicamento" : $datos = ElementoMedicamento::where('elemento_id','=',$id)->get(); 
                // dd($datos[0]);
                if($datos[0]->pedira<>null) $this->pedira = $datos[0]->pedira;
                $this->elemento_id = $datos[0]->elemento_id;
                $this->psiquiatrico = $datos[0]->psiquiatrico;
                break;
            case "Ingrediente" : $datos = ElementoIngrediente::where('elemento_id','=',$id)->get(); 
                $this->estado_id = $datos[0]->estado_id;
                $this->elemento_id = $datos[0]->elemento_id;
                break;
            case "Producto" : $datos = ElementoProducto::where('elemento_id','=',$id)->get();
                $this->barra = $datos[0]->barra;
                $this->qr = $datos[0]->qr;
                $this->descuento = $datos[0]->descuento;
                $this->descuento_especial = $datos[0]->descuento_especial;
                $this->descripcion = $datos[0]->descripcion;
                $this->calificacion = $datos[0]->calificacion;
                $this->precio_venta = $datos[0]->precio_venta;
                $this->lote = $datos[0]->lote;
                $this->ruta = $datos[0]->ruta;
                $this->elemento_id = $datos[0]->id;
                $this->estado_id = $datos[0]->estado_id;
                $this->proveedor_id = $datos[0]->proveedor_id;
                break;
            case "Descartable" : $datos = ElementoDescartable::where('elemento_id','=',$id)->get(); 
                $this->descripcion = $datos[0]->descripcion;
                $this->elemento_id = $datos[0]->pendiente;
                break;
            case "Articulo" : $datos = ElementoArticulo::where('elemento_id','=',$id)->get(); 
                $this->precio_venta = $datos[0]->precio_venta;
                $this->marca = $datos[0]->marca;
                $this->lista_id =$datos[0]->sta_id;
                $this->elemento_id = $datos[0]->id;
                break;
        }
 
        $this->elemento_id = $id;   // Setea el valor para no duplicar registros cueando ya se encuentre dado de alta
        
        $this->isModalOpen = true;

    }

    public function destroy() {
        
        switch ($this->seleccionado) {
            case "Medicamento" : DB::table('elemento_medicamentos')->where('elemento_id', '=', $this->elemento_id)->delete(); break;
            case "Ingrediente" : DB::table('elemento_ingredientes')->where('elemento_id', '=', $this->elemento_id)->delete(); break;
            case "Producto" :    DB::table('elemento_productos')->where('elemento_id', '=', $this->elemento_id)->delete(); break;
            case "Descartable" : DB::table('elemento_descartables')->where('elemento_id', '=', $this->elemento_id)->delete(); break;
            case "Articulo" :    DB::table('elemento_articulos')->where('elemento_id', '=', $this->elemento_id)->delete(); break;
        }
        
        Elemento::destroy($this->elemento_id);

        session()->flash('message', $this->elemento_id ? $this->seleccionado . ' Eliminado.' : $this->seleccionado . ' Creado.');

        $this->isModalDelete= false;
        $this->elemento_id = null;

    }
}