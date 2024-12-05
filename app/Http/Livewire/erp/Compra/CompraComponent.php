<?php

namespace App\Http\Livewire\erp\Compra;

use App\Models\EmpresaUsuario;

use App\Models\Area;
use App\Models\Cuenta;
use App\Models\Iva;
use App\Models\Proveedor;

use App\Models\erp\Comprobante;
use App\Models\erp\Producto;
use App\Models\erp\Compras_Productos;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

// use Afip;
// use ElectronicBilling;

class CompraComponent extends Component
{
    public $areas, $cuentas, $ivas, $proveedores;
    public $detalles=[];       // Globales
    public $detalle;
    public $productos;
    public $empresa_id; public $tabActivo=1; public $comprobante_id;
    
    //Comprobantes
    public $iva_value=0;
    public $isModalOpen = false;
    public $giva=1;
    public $ModalDelete, $ModalModify, $ModalAgregarDetalle;
    public $ModalCerrarLibro;
    public $gfecha,$gproveedor, $gcomprobante, $gcuenta, $gdetalle, $ganio, $gmes, $garea, $gpartiva, $gbruto, $giva2, $gexento, $gimpinterno, $gperciva, $gretgan, $gperib, $gneto, $gmontopagado, $gcantidad;
    public $gselect_productos, $gprecio_prod, $gcantidad_prod, $glistado_prod;
    //Variables del filtro
    public $gfmes, $gfproveedor, $gfparticipa, $gfiva, $gfdetalle, $gfarea, $gfcuenta, $gfanio, $fgascendente=true, $gfsaldo; //Comprobantes
    
    
    // Deuda Proveedores
    public $darea, $ddesde=0, $dhasta=0, $danio;
    public $DeudaProveedoresFiltro, $MostrarDeudaProveedores; 
    public $deudaPDF;

    // Crédito Proveedores
    public $carea, $cdesde, $chasta, $canio;
    public $CreditoProveedoresFiltro, $MostrarCreditoProveedores;

    // Cuentas Corrientes
    public $ccProveedores, $ccProveedor, $ccdesde, $cchasta, $detallesCC, $ccAgrupadoComp=true, $ccAgrupadoDeta=false, $saldo, $CuentasCorrientesHtml;

    // Libros de Iva
    public $lmes,$lanio;
    public $MostrarLibrosComponent, $LibroFiltro;

    //Listado de filtros
    public $filtro, $combodetalle;                // Comprobantes

    public function render() {

                
        if ( !Auth::check() ) { return view('welcome');  return route('dashboard'); }

        $anio = date("Y");
        if(is_null($this->gfanio)) { $this->gfanio = $anio; }; //La primara vez que inicia revisa si es nulo y en ese caso cambia al año actual, sino no lo toca más
    
        if ($this->ddesde==null || $this->dhasta==null || $this->cdesde==null || $this->chasta==null || $this->ccdesde==null || $this->cchasta==null ) { $anio = date("Y"); } 

        $this->ddesde = date($anio.'-01-01');
        $this->dhasta = date($anio.'-12-31');
        $this->cdesde = date($anio.'-01-01');
        $this->chasta = date($anio.'-12-31');
        $this->ccdesde = date($anio.'-01-01');
        $this->cchasta = date($anio.'-12-31');      
        
        if (!is_null(session('empresa_id'))) { $this->empresa_id = session('empresa_id'); } 
        else { 
            if(Auth::user()) {
                $userid = auth()->user()->id;
                $empresas= EmpresaUsuario::where('user_id',$userid)->get();
                return view('livewire.empresa.empresa-component')->with('empresas', $empresas); 
            } else {
                return view('empresas'); 

                // return redirect('https://stackoverflow.com/');
                // return Redirect::to('/')->with(['type' => 'error','message' => 'Your message']);
                // return redirect()->intended('http://heera.it');

                // return redirect('/')->with(Auth::logout());
                // $this->redirect('/dashboard'); 

                // // $this->redirect(Auth::login($user)); 
                // $this->redirect('/'); 
                // return redirect(route('areas'));
                // return view('dashboard'); 
                // return redirect()->route('areas'); 
                // return redirect()->intended('areas');
            }
        }
        $this->areas = Area::where('empresa_id', $this->empresa_id)->ORDERBY('name')->get();
        $this->cuentas = Cuenta::where('empresa_id', $this->empresa_id)->ORDERBY('name')->get();
        $this->proveedores = Proveedor::where('empresa_id', $this->empresa_id)->ORDERBY('name')->get();
        $this->ccProveedores = $this->proveedores;
        $this->ivas = Iva::where('id','>',1)->get();
        $this->productos = Producto::where('empresa_id', $this->empresa_id)->orderBy('name','asc')->get();
        
        return view('livewire.compra.compra-component')->extends('layouts.app2');
        // return view('livewire.erp.compra.compra-component')->extends('layouts.app2');
        // return view('livewire.compra.compra-component')->extends('layouts.adminlte');
    }
    
    // public function render2() {
    //     return view('livewire.compra.comprasimple');    
    // }

    public function openModalDelete() { $this->ModalDelete = true;  }
    public function closeModalDelete() { $this->ModalDelete = false;  }

    public function openModalCerrarLibro() { $this->ModalCerrarLibro = true;  }
    public function BackModalPopover() { $this->ModalCerrarLibro = false;  }

    public function openModalModify() { $this->ModalModify = true;  }
    public function closeModalModify() { $this->ModalModify = false;  }

    public function openModalAgregarDetalle() { $this->ModalAgregarDetalle = true; $this->listado_productos(); }
    public function closeModalAgregarDetalle() { $this->ModalAgregarDetalle = false;  }

    public function subfiltro() {  $this->ccAgrupadoComp=!$this->ccAgrupadoComp; $this->ccAgrupadoDeta=!$this->ccAgrupadoDeta; }
    public function ListarCuentasCorrientes() {
        
        $saldoFinal = 0;
        if($this->ccProveedor==0)  { $proveedor = ' comprobantes.proveedor_id >0 and '; }
        else { $proveedor = ' comprobantes.proveedor_id = '.$this->ccProveedor.' and '; }
        if($this->ccAgrupadoComp) {
            // Busca todos los registros que cumplen con los criterios de parámetros, de ahí toma los distintos números de comprobantes
            $subtotalesGenerales = DB::select('select comprobante, sum(NetoComp) as saldo FROM comprobantes join proveedors on proveedors.id = comprobantes.proveedor_id WHERE '. $proveedor .' comprobantes.fecha >= "'.$this->ccdesde.'" and comprobantes.fecha <= "'.$this->cchasta.'" and comprobantes.empresa_id = '. session('empresa_id') .' GROUP BY comprobante');
            // $subtotalesGenerales = DB::select('select detalle, comprobante, sum(NetoComp-MontoPagadoComp) as saldo, comprobantes.empresa_id, proveedor_id, proveedors.name FROM comprobantes join proveedors on proveedors.id = comprobantes.proveedor_id WHERE comprobantes.proveedor_id = '.$this->ccProveedor.' and comprobantes.fecha >= "'.$this->ccdesde.'" and comprobantes.fecha <= "'.$this->cchasta.'" and comprobantes.empresa_id = '. session('empresa_id') .' GROUP BY comprobante, detalle, empresa_id, proveedor_id, proveedors.namess');

            //Genera el encabezado principal de la tabla
            $html = '<div class="flex justify-center"><table class="table table-stripped" style="width:90%; font-size: 13px;"><thead><tr bgcolor="lightGray"><th align="center">Fecha</th><th align="center">Comp.</th><th>Proveedor</th><th>Detalle</th><th align="right">Monto Comprado</th><th align="right">Monto Pagado</th><th align="right">Saldo</th><th>Área</th><th>Cuenta</th></tr></thead><tbody style="height: 150px; overflow-y: scroll;">';

            $CantGeneral = count($subtotalesGenerales); // Cantidad de registros encontrados a nivel general

            // Commienza a iterar la cantidad de registros a nivel general que ha encontrado
            for($i=0; $CantGeneral>$i ; $i++) {
            
                //Busca todos los registros que tienen el mismo Nro de Comprobante y le falta el total de la cta cte
                $subParciales = DB::select('SELECT comprobantes.id, comprobantes.detalle, comprobantes.fecha, comprobantes.comprobante, comprobantes.NetoComp, comprobantes.MontoPagadoComp, a.name as area_name, c.name as cuenta_name, p.name as proveedor_name from comprobantes inner join areas as a on comprobantes.area_id=a.id inner join cuentas as c on comprobantes.cuenta_id=c.id inner join proveedors as p on comprobantes.proveedor_id=p.id WHERE '. $proveedor.' comprobantes.fecha >= "'.$this->ccdesde.'" and comprobantes.fecha <= "'.$this->cchasta.'" and comprobantes.empresa_id = '. session('empresa_id').' and comprobante="'.$subtotalesGenerales[$i]->comprobante.'" ORDER by comprobantes.fecha;');
  
                // Cantidad de registros encontrados a nivel detallado
                $CantParcial = count($subParciales); 
 
                // Cambia el recordset por un array
                $Parcial = $subParciales[0];
                // $Parcial = $subParciales[$i];

                // Imprime el registro inicial con el COMPROBANTE ORIGINARIO
                $html = $html ."<tr style=\"border-top: 4px solid;\"><td align=\"center\">".substr($Parcial->fecha,8,2).'-'.substr($Parcial->fecha,5,2).'-'.substr($Parcial->fecha,0,4)."</td><td>".$Parcial->comprobante."</td><td colspan=2>COMPROBANTE ORIGINARIO</td><td align=\"right\">".number_format($subtotalesGenerales[$i]->saldo, 2, ',', '.')."</td><td align=\"right\">-</td><td align=\"right\">".number_format($subtotalesGenerales[$i]->saldo, 2, ',', '.')."</td><td colspan=2></td></tr>";

                // Registra el saldoFinal
                $saldoFinal = $saldoFinal + $subtotalesGenerales[$i]->saldo;

                $saldo = $subtotalesGenerales[$i]->saldo;
                //Comienza a iterar en todos los registros a nivel detallado que encontró
                for($j=0; $CantParcial>$j ; $j++) {
                    // dd($subParciales[0]);
                    // $sub = $subParciales[$CantParcial]; // Convierte el registro en un array para poder utilizarlo más adelante
                    $sub = $subParciales[$j]; // Convierte el registro en un array para poder utilizarlo más adelante
                    // ".number_format($subParciales[$i]->saldo, 2, ',', '.')."
                    $saldo = $saldo - $sub->MontoPagadoComp;

                    // Registra el saldoFinal
                    $saldoFinal = $saldoFinal - $sub->MontoPagadoComp;

                    $html = $html ."<tr wire:click=\"gCargarRegistro(".$sub->id.")\"><td align=\"center\" style=\"padding: 0px;\">".substr($sub->fecha,8,2).'-'.substr($sub->fecha,5,2).'-'.substr($sub->fecha,0,4)."</td><td style=\"padding: 0px;\">".$sub->comprobante."</td><td style=\"padding: 0px;\">".$sub->proveedor_name."</td><td style=\"padding: 0px;\">".$sub->detalle."</td><td align=\"right\" style=\"padding: 0px;\">".number_format($sub->NetoComp, 2, ',', '.')."</td><td align=\"right\" style=\"padding: 0px;\">".number_format($sub->MontoPagadoComp, 2, ',', '.')."</td><td align=\"right\" style=\"padding: 0px;\">".number_format($saldo, 2, ',', '.')."</td><td style=\"padding: 0px 10px 0px 10px;\">".$sub->area_name."</td><td style=\"padding: 0px;\">".$sub->cuenta_name."</td></tr>"; 
                }
            }
        } else {
            // Busca todos los registros que cumplen con los criterios de parámetros, de ahí toma los distintos números de comprobantes
            $subtotalesGenerales = DB::select('select detalle, sum(NetoComp) as saldo FROM comprobantes join proveedors on proveedors.id = comprobantes.proveedor_id WHERE '. $proveedor.' comprobantes.fecha >= "'.$this->ccdesde.'" and comprobantes.fecha <= "'.$this->cchasta.'" and comprobantes.empresa_id = '. session('empresa_id') .' GROUP BY detalle');
            // $subtotalesGenerales = DB::select('select detalle, comprobante, sum(NetoComp-MontoPagadoComp) as saldo, comprobantes.empresa_id, proveedor_id, proveedors.name FROM comprobantes join proveedors on proveedors.id = comprobantes.proveedor_id WHERE comprobantes.proveedor_id = '.$this->ccProveedor.' and comprobantes.fecha >= "'.$this->ccdesde.'" and comprobantes.fecha <= "'.$this->cchasta.'" and comprobantes.empresa_id = '. session('empresa_id') .' GROUP BY detalle, comprobante, empresa_id, proveedor_id, proveedors.name');

            //Genera el encabezado principal de la tabla
            $html = '<div class="flex justify-center"><table class="table table-stripped w-75" style="font-size: 13px;"><thead><tr bgcolor="lightGray"><th align="center">Fecha</th><th align="center">Comp.</th><th>Proveedor</th><th>Detalle</th><th align="right">Monto Comprado</th><th align="right">Monto Pagado</th><th align="right">Saldo</th><th>Área</th><th>Cuenta</th></tr></thead><tbody style="height: 150px; overflow-y: scroll;">';

            $CantGeneral = count($subtotalesGenerales); // Cantidad de registros encontrados a nivel general

            // Commienza a iterar la cantidad de registros a nivel general que ha encontrado
            for($i=0; $CantGeneral>$i ; $i++) {

                //Busca todos los registros que tienen el mismo Nro de Comprobante y le falta el total de la cta cte
                $subParciales = DB::select('SELECT comprobantes.id, comprobantes.detalle, comprobantes.fecha, comprobantes.comprobante, comprobantes.NetoComp, comprobantes.MontoPagadoComp, a.name as area_name, c.name as cuenta_name, p.name as proveedor_name from comprobantes inner join areas as a on comprobantes.area_id=a.id inner join cuentas as c on comprobantes.cuenta_id=c.id inner join proveedors as p on comprobantes.proveedor_id=p.id WHERE '.$proveedor.' comprobantes.fecha >= "'.$this->ccdesde.'" and comprobantes.fecha <= "'.$this->cchasta.'" and comprobantes.empresa_id = '. session('empresa_id').' and detalle="'.$subtotalesGenerales[$i]->detalle.'" ORDER by comprobantes.fecha;');

                // Cantidad de registros encontrados a nivel detallado
                $CantParcial = count($subParciales); 

                // Cambia el recordset por un array
                $Parcial = $subParciales[0];
                // $Parcial = $subParciales[$i];

                // Imprime el registro inicial con el COMPROBANTE ORIGINARIO
                $html = $html ."<tr style=\"border-top: 4px solid;\"><td align=\"center\">".substr($Parcial->fecha,8,2).'-'.substr($Parcial->fecha,5,2).'-'.substr($Parcial->fecha,0,4)."</td><td>".$Parcial->comprobante."</td><td colspan=2>COMPROBANTE ORIGINARIO</td><td align=\"right\"><b>".number_format($subtotalesGenerales[$i]->saldo, 2, ',', '.')."</b></td><td align=\"right\">".number_format($Parcial->MontoPagadoComp, 2, ',', '.')."</td><td align=\"right\">-</td><td align=\"right\"></td><td colspan=2></td></tr>";

                // Registra el saldoFinal
                $saldoFinal = $saldoFinal + $subtotalesGenerales[$i]->saldo;

                $saldo = $subtotalesGenerales[$i]->saldo;
                //Comienza a iterar en todos los registros a nivel detallado que encontró
                for($j=0; $CantParcial>$j ; $j++) {
                    // dd($subParciales[0]);
                    // $sub = $subParciales[$CantParcial]; // Convierte el registro en un array para poder utilizarlo más adelante
                    $sub = $subParciales[$j]; // Convierte el registro en un array para poder utilizarlo más adelante
                    // ".number_format($subParciales[$i]->saldo, 2, ',', '.')."
                    $saldo = $saldo - $sub->MontoPagadoComp;

                    // Registra el saldoFinal
                    $saldoFinal = $saldoFinal - $sub->MontoPagadoComp;

                    $html = $html ."<tr wire:click=\"gCargarRegistro(".$sub->id.")\" style=\" height: 10px;\"><td align=\"center\" style=\"padding: 0px;\">".substr($sub->fecha,8,2).'-'.substr($sub->fecha,5,2).'-'.substr($sub->fecha,0,4)."</td><td style=\"padding: 0px;\">".$sub->comprobante."</td><td style=\"padding: 0px;\">".$sub->proveedor_name."</td><td style=\"padding: 0px;\">".$sub->detalle."</td><td align=\"right\" style=\"padding: 0px;\">0.00</td><td align=\"right\" style=\"padding: 0px;\">".number_format($sub->MontoPagadoComp, 2, ',', '.')."</td><td align=\"right\" style=\"padding: 0px;\">".number_format($saldo, 2, ',', '.')."</td><td style=\"padding: 0px 10px 0px 10px;\">".$sub->area_name."</td><td style=\"padding: 0px;\">".$sub->cuenta_name."</td></tr>"; 
                }
            }
        }
        $html = $html . '<tr><td colspan=9></td></tr><tr  bgcolor="lightGray" style="font-size:16px"><td colspan=7></td><td><b>Saldo Final</b></td><td><b>'.number_format($saldoFinal, 2, ',', '.') .'</b></td></tr>';
        $html = $html . ' </tbody></table></div>';
        $this->CuentasCorrientesHtml = $html;

                // dd($subtotales1);

            // $subtotales = DB::table('ListadoCuentasCorrientes')
            // ->groupByRaw('area_id')
            // ->get();

            // $subtotales = DB::select('SELECT * FROM ListadoCuentasCorrientes');
            

// create view ListadoCuentasCorrientes as
// SELECT comprobantes.fecha, 
// comprobantes.comprobante, 
// comprobantes.NetoComp, 
// comprobantes.MontoPagadoComp,
// comprobantes.empresa_id,
// comprobantes.proveedor_id,
// B.saldo 
// FROM 
// comprobantes, 
// (select comprobante, 
//   sum(NetoComp-MontoPagadoComp) as saldo, 
//   empresa_id, 
//   proveedor_id, 
//   area_id, 
//   cuenta_id 
// FROM comprobantes 
// GROUP BY
//   comprobante, empresa_id, proveedor_id) as B 
// WHERE 
// comprobantes.comprobante = B.comprobante and 
// comprobantes.empresa_id=B.empresa_id and 
// comprobantes.proveedor_id = B.proveedor_id and 
// comprobantes.area_id = B.area_id and 
// comprobantes.cuenta_id = B.cuenta_id
// ORDER by comprobantes.fecha;
        //     $subtotales = Comprobante::leftjoin('proveedors','comprobantes.proveedor_id','proveedors.id')
        //     ->leftjoin('cuentas1','comprobantes.cuenta_id','cuentas.id')
        //     ->leftjoin('areas','comprobantes.area_id','areas.id')
        //     ->where('comprobantes.proveedor_id','=',$this->ccProveedor)
        //     ->where('comprobantes.fecha','>=', $this->ccdesde)
        //     ->where('comprobantes.fecha','<=', $this->cchasta)
        //     ->where('comprobantes.empresa_id','=', session('empresa_id'))
        //     ->groupby('comprobante','comprobantes.proveedor_id','proveedors.id','comprobantes.fecha','comprobantes.NetoComp','comprobantes.MontoPagadoComp','proveedors.name','areas.name','cuentas.name')
        //     ->get(['fecha', 'comprobante', 'NetoComp', 'MontoPAgadoComp', 'proveedors.name as proveedor', 'areas.name as area', 'cuentas.name as cuenta']);

        //     $this->detallesCC = Comprobante::leftjoin('proveedors','comprobantes.proveedor_id','proveedors.id')
        //     ->leftjoin('cuentas','comprobantes.cuenta_id','cuentas.id')
        //     ->leftjoin('areas','comprobantes.area_id','areas.id')
        //     ->where('comprobantes.proveedor_id','=',$this->ccProveedor)
        //     ->where('comprobantes.fecha','>=', $this->ccdesde)
        //     ->where('comprobantes.fecha','<=', $this->cchasta)
        //     ->where('comprobantes.empresa_id','=', session('empresa_id'))
        //     ->orderby('fecha')
        //     ->orderby('comprobantes')
        //     ->get(['fecha', 'comprobante', 'NetoComp', 'MontoPAgadoComp', 'proveedors.name as proveedor', 'areas.name as area', 'cuentas.name as cuenta']);
        // } else {
        //     $this->detallesCC = Comprobante::leftjoin('proveedors','comprobantes.proveedor_id','proveedors.id')
        //     ->leftjoin('cuentas','comprobantes.cuenta_id','cuentas.id')
        //     ->leftjoin('areas','comprobantes.area_id','areas.id')
        //     ->where('comprobantes.proveedor_id','=',$this->ccProveedor)
        //     ->where('comprobantes.fecha','>=', $this->ccdesde)
        //     ->where('comprobantes.fecha','<=', $this->cchasta)
        //     ->where('comprobantes.empresa_id','=', session('empresa_id'))
        //     ->orderby('fecha')
        //     ->orderby('detalle')
        //     ->get(['fecha', 'comprobante', 'NetoComp', 'MontoPAgadoComp', 'proveedors.name as proveedor', 'areas.name as area', 'cuentas.name as cuenta']);
        // }

        // dd($a);


    }

    public function RellenarCamposVacios() {
        if(is_null($this->gfecha)) $this->gfecha=now();
        if(is_null($this->gbruto)) $this->gbruto=0.00;
        if(is_null($this->gexento)) $this->gexento=0.00;
        if(is_null($this->gimpinterno)) $this->gimpinterno=0.00;
        if(is_null($this->gperciva)) $this->gperciva=0.00;
        if(is_null($this->gperib)) $this->gperib=0.00;
        if(is_null($this->gretgan)) $this->gretgan=0.00;
        if(is_null($this->gneto)) $this->gneto=0.00;
        if(is_null($this->gbruto)) $this->gbruto=0.00;
        if(is_null($this->gmontopagado)) $this->gmontopagado=0.00;
        if(is_null($this->gcantidad)) $this->gcantidad=0.00;
        if(is_null($this->giva2)) $this->giva2=0.00;        
    }

    public function store() {
        $this->RellenarCamposVacios();            

        $this->validate([
            'gfecha'            => 'required|date',
            'gbruto'            => 'numeric',
            'gpartiva'          => 'required',
            'giva2'             => 'numeric',
            'gexento'           => 'numeric',
            'gimpinterno'       => 'numeric',
            'gperciva'          => 'numeric',
            'gperib'            => 'numeric',
            'gretgan'           => 'numeric',
            'gneto'             => 'numeric',
            'gmontopagado'      => 'numeric', 
            'gcantidad'         => 'numeric',
            'ganio'             => 'required|integer',
            'gmes'              => 'required',
            'giva'              => 'required|integer',
            'garea'             => 'required|integer',
            'gcuenta'           => 'required|integer',
            'gproveedor'        => 'required|integer',
        ]);
        $cerrado = Comprobante::where('PasadoEnMes','=',$this->gmes)
            ->where('Anio','=',$this->ganio)
            ->where('empresa_id','=',session('empresa_id'))
            ->where('Cerrado','>',0)
            ->get();

            // dd(count($cerrado));
        if(!count($cerrado) || (count($cerrado) && $this->gpartiva='Si')) {
            Comprobante::create([
                'fecha'             => $this->gfecha,
                'comprobante'       => $this->gcomprobante,
                'detalle'           => $this->gdetalle,
                'BrutoComp'         => $this->gbruto,
                'ParticIva'         => $this->gpartiva,
                'MontoIva'          => $this->giva2,
                'ExentoComp'        => $this->gexento,
                'ImpInternoComp'    => $this->gimpinterno,
                'PercepcionIvaComp' => $this->gperciva,
                'RetencionIB'       => $this->gperib,
                'RetencionGan'      => $this->gretgan,
                'NetoComp'          => $this->gneto,
                'MontoPagadoComp'   => $this->gmontopagado, 
                'CantidadLitroComp' => $this->gcantidad,
                'Anio'              => $this->ganio,
                'PasadoEnMes'       => $this->gmes,
                'iva_id'            => $this->giva,
                'area_id'           => $this->garea,
                'cuenta_id'         => $this->gcuenta,
                'user_id'           => auth()->user()->id,
                'empresa_id'        => session('empresa_id'),
                'proveedor_id'      => $this->gproveedor,
            ]);
            //updateOrCreate
            $this->gfiltro();
            session()->flash('message', 'Comprobante Creado.');    
        } else {
            session()->flash('message3', 'No se puede agragar un comprobante a un libro ya Cerrado.');
            }
        {
        }
    }

    public function edit() {
        $this->RellenarCamposVacios();
        $comp = Comprobante::find($this->comprobante_id);
        if ($comp->Cerrado) { 
            $this->closeModalModify();
            session()->flash('message3', 'No se puede modificar un comprobante que se encuentra en un libro cerrado.'); 
        } else {
            $this->validate([
                'gfecha'            => 'required|date',
                'gbruto'            => 'numeric',
                'gpartiva'          => 'required',
                'giva2'             => 'numeric',
                'gexento'           => 'numeric',
                'gimpinterno'       => 'numeric',
                'gperciva'          => 'numeric',
                'gperib'            => 'numeric',
                'gretgan'           => 'numeric',
                'gneto'             => 'numeric',
                'gmontopagado'      => 'numeric', 
                'gcantidad'         => 'numeric',
                'ganio'             => 'required|integer',
                'gmes'              => 'required',
                'giva'              => 'required|integer',
                'garea'             => 'required|integer',
                'gcuenta'           => 'required|integer',
                'gproveedor'        => 'required|integer',
            ]);
            //dd($this->gbruto. " " . $this->giva);
            $comp->update([
                'fecha'             => $this->gfecha,
                'comprobante'       => $this->gcomprobante,
                'detalle'           => $this->gdetalle,
                'BrutoComp'         => $this->gbruto,
                'ParticIva'         => $this->gpartiva,
                'MontoIva'          => $this->giva2,
                'ExentoComp'        => $this->gexento,
                'ImpInternoComp'    => $this->gimpinterno,
                'PercepcionIvaComp' => $this->gperciva,
                'RetencionIB'       => $this->gperib,
                'RetencionGan'      => $this->gretgan,
                'NetoComp'          => $this->gneto,
                'MontoPagadoComp'   => $this->gmontopagado, 
                'CantidadLitroComp' => $this->gcantidad,
                'Anio'              => $this->ganio,
                'PasadoEnMes'       => $this->gmes,
                'iva_id'            => $this->giva,
                'area_id'           => $this->garea,
                'cuenta_id'         => $this->gcuenta,
                'user_id'           => auth()->user()->id,
                'empresa_id'        => session('empresa_id'),
                'proveedor_id'      => $this->gproveedor,
            ]);
            //updateOrCreate
            $this->gfiltro();
            $this->closeModalModify();
            session()->flash('message2', $this->comprobante_id ? 'Comprobante Actualizado.' : 'No se pudo modificar.');
        }
    }

    public function delete() {
        //$this->comprobante_id = $id;
        $a = Comprobante::find($this->comprobante_id);
        if($a->Cerrado==0) { 
            $a->delete(); 
            $this->comprobante_id=null;
            $this->gfiltro();
            session()->flash('message3', 'Comprobante Eliminado.');
        } else {
            session()->flash('message3', 'No se puede eliminar un comprobante que se encuentra en un libro Cerrado.');
        }
        $this->closeModalDelete();
    }

    public function CambiarTab($id) {
        $this->tabActivo=$id;
    }

    public function gfiltro(){
        
        $sql = $this->ProcesaSQLFiltro('comprobantes'); // Procesa los campos a mostrar
        // if ($this->fgascendente) { $sql=$sql . " ASC"; } else { $sql=$sql . " DESC"; }
        // $registros = DB::select(DB::raw($sql));       // Busca el recordset
        $registros = DB::select($sql);       // Busca el recordset
        $sqlTemp = $sql;
        if($this->fgascendente) { 
            $sqlTemp = substr($sqlTemp,8,-27); 
            $sqlDetalle = 'SELECT DISTINCT detalle' . $sqlTemp . 'ORDER BY detalle';
        } else { 
            $sqlTemp = substr($sql,8,-38);
            // dd($sqlTemp); 
            $sqlDetalle = 'SELECT DISTINCT detalle' . $sqlTemp  . ' ORDER BY detalle';
            // dd($sqlDetalle);
        }

        // Extrae los distintos Detalles si es que los hay
        // $sqlDetalle = substr($sqlDetalle,0,-37);
        
        $this->detalles = DB::select($sqlDetalle);        
        // dd($this->detalles);
        //Dibuja el combo Detalles
        $this->combodetalle = '';
        foreach ($this->detalles as $detalle) {
            $this->combodetalle = $this->combodetalle . 
            '<option value="' . $detalle->detalle .'">'. $detalle->detalle . '</option>';
        }
			
        //dd($this->combodetalle);
        //dd($sql);
        //dd(json_encode($this->detalles)); 
        //Dibuja el filtro
        $Saldo=0;
        
        // <div class=\"table-responsive-sm\">word-wrap: anywhere;
        $this->filtro="
                <table class=\"table table-striped small\" style=\"font-size:12px; padding: 0.2rem .2rem;\">
                <thead>
                  <tr>
                    <th style=\"width: auto;\">Fecha</th>
                    <th scope=\"col\">Comprobante</th>
                    <th class=\"col d-none d-sm-table-cell\" scope=\"col\">Proveedor</th>
                    <th class=\"col d-none d-sm-table-cell\" scope=\"col\">Detalle</th>
                    <th class=\"scope=\"col\">Bruto</th>
                    <th class=\"scope=\"col\">Iva</th>
                    <th class=\"scope=\"col\">Exento</th>
                    <th class=\"col d-none d-sm-table-cell\" scope=\"col\">Imp.Interno</th>
                    <th class=\"col d-none d-sm-table-cell\" scope=\"col\">Percec.Iva</th>
                    <th class=\"col d-none d-sm-table-cell\" scope=\"col\">Retenc.IB</th>
                    <th class=\"col d-none d-sm-table-cell\" scope=\"col\">Retenc.Gan</th>
                    <th class=\"scope=\"col\">Neto</th>
                    <th class=\"scope=\"col\">Pagado</th>
                    <th class=\"col d-none d-sm-table-cell\" scope=\"col\">Saldo</th>
                    <th class=\"col d-none d-sm-table-cell\" scope=\"col\">Cant.Litros</th>
                    <th class=\"col d-none d-sm-table-cell\" scope=\"col\">Part.Iva</th>
                    <th class=\"col d-none d-sm-table-cell\" scope=\"col\">Mes</th>
                    <th class=\"col d-none d-sm-table-cell\" scope=\"col\">Area</th>
                    <th class=\"col d-none d-sm-table-cell\" scope=\"col\">Cuenta</th>
                  </tr>
                </thead>";
                
            $Cantidad = 0; $MontoPagado = 0; $Neto = 0; $RetGan = 0; $RetIB = 0; $PerIva = 0; $Exento = 0 ;$ImpInterno = 0; $Bruto = 0; $MontoIvaT =0; $NetoT = 0;
        foreach($registros as $registro) {
            //dd($registro);
            $Fecha = substr($registro->fecha,8,2) ."-". substr($registro->fecha,5,2) ."-". substr($registro->fecha,0,4);
            $Area=Area::find($registro->area_id);
            $Cuenta=Cuenta::find($registro->cuenta_id);
            $Iva=Iva::find($registro->iva_id);
            $Proveedor=Proveedor::find($registro->proveedor_id);
            //dd($Iva->monto);
            if($Iva->monto==0) { $MontoIva=0; } else {
                $MontoIva=($registro->BrutoComp*$Iva->monto/100);
            }
            //dd(number_format($MontoIva, 2,'.',''));
            $Neto = $Neto + $registro->NetoComp;
            //Sumatoria de los registros encontrados para subtotal
            $Bruto = $Bruto + $registro->BrutoComp;
            $MontoIvaT = $MontoIvaT + $registro->MontoIva;
            $Exento = $Exento + $registro->ExentoComp;
            $ImpInterno= $ImpInterno + $registro->ImpInternoComp;
            $PerIva = $PerIva + $registro->PercepcionIvaComp;
            $RetIB = $RetIB + $registro->RetencionIB;
            $RetGan = $RetGan + $registro->RetencionGan;
            $MontoPagado = $MontoPagado + $registro->MontoPagadoComp;
            $Saldo=$Saldo+$registro->NetoComp-$registro->MontoPagadoComp;
            $Cantidad=$Cantidad+$registro->CantidadLitroComp;
            $NetoT = $NetoT + $registro->NetoComp;
            $this->filtro=$this->filtro."
            <tr wire:click=\"gCargarRegistro(". $registro->id .")\">
                <td class=\"p-0 text-right\" style=\"width: auto;\">".substr($Fecha,0,6).substr($Fecha,8,2)."</td>
                <td class=\"p-0\">&nbsp;$registro->comprobante</td>
                <td class=\"p-0 col d-none d-sm-table-cell text-left\">&nbsp; $Proveedor->name</td>
                <td style=\"max-width:200px; width:200px; overflow: hidden;\" class=\"p-0 col d-none d-sm-table-cell text-left\">$registro->detalle</td>
                <td class=\"p-0 text-right\">".number_format($registro->BrutoComp, 2,'.','')."</td>
                <td class=\"p-0 text-right\">".number_format($MontoIva, 2,'.','')."</td>
                <td class=\"p-0 text-right\">".number_format($registro->ExentoComp, 2,'.','')."</td>
                <td class=\"p-0 col d-none d-sm-table-cell text-right\">".number_format($registro->ImpInternoComp, 2,'.','')."</td>
                <td class=\"p-0 col d-none d-sm-table-cell text-right\">".number_format($registro->PercepcionIvaComp, 2,'.','')."</td>
                <td class=\"p-0 col d-none d-sm-table-cell text-right\">".number_format($registro->RetencionIB, 2,'.','')."</td>
                <td class=\"p-0 col d-none d-sm-table-cell text-right\">".number_format($registro->RetencionGan, 2,'.','')."</td>
                <td class=\"p-0 text-right\">".number_format($registro->NetoComp, 2,'.','')."</td>
                <td class=\"p-0 text-right\">".number_format($registro->MontoPagadoComp, 2,'.','')."</td>
                <td class=\"p-0 col d-none d-sm-table-cell text-right\">".number_format($Saldo, 2,'.','')."</td>
                <td class=\"p-0 col d-none d-sm-table-cell text-right\">".number_format($registro->CantidadLitroComp, 2,'.','')."</td>
                <td class=\"p-0 col d-none d-sm-table-cell\">$registro->ParticIva</td>
                <td class=\"p-0 col d-none d-sm-table-cell text-right\">" . $this->ConvierteMesEnTexto($registro->PasadoEnMes) . "</td>
                <td class=\"p-0 col d-none d-sm-table-cell text-right\">$Area->name</td>
                <td class=\"p-0 col d-none d-sm-table-cell text-right\">$Cuenta->name</td>
                </tr>";
                // $this->filtro=$this->filtro."
                //     <div class=\"flex col-12 fse-1 md:fse-0\" wire:click=\"gCargarRegistro(". $registro->id .")\">
                //     <div class=\"xs:col-flex1 md:col-flex border border-secondary\"\">$Fecha</div>
                //     <div class=\"xs:col-flex1 md:col-flex border border-secondary\"\">$registro->comprobante</div>
                //     <div class=\"col-2 border border-secondary\"\">$Proveedor->name</div>
                //     <div class=\"xs:col-flex1 md:col-flex border border-secondary text-center hidden sm:hidden md:hidden lg:block xl:block \"\">$registro->detalle</div>
                //     <div class=\"col-2 border border-secondary\"\">".number_format($registro->BrutoComp, 2,'.','')."</div>
                //     <div class=\"xs:col-flex1 md:col-flex border border-secondary\"\">".number_format($MontoIva, 2,'.','')."</div>
                //     <div class=\"col-2 border border-secondary\"\">".number_format($registro->ExentoComp, 2,'.','')."</div>
                //     <div class=\"xs:col-flex1 md:col-flex border border-secondary hidden sm:hidden md:hidden lg:block xl:block \"\">".number_format($registro->ImpInternoComp, 2,'.','')."</div>
                //     <div class=\"xs:col-flex1 md:col-flex border border-secondary hidden sm:hidden md:hidden lg:block xl:block \"\">".number_format($registro->PercepcionIvaComp, 2,'.','')."</div>
                //     <div class=\"xs:col-flex1 md:col-flex border border-secondary hidden sm:hidden md:hidden lg:block xl:block \"\">".number_format($registro->RetencionIB, 2,'.','')."</div>
                //     <div class=\"xs:col-flex1 md:col-flex border border-secondary hidden sm:hidden md:hidden lg:block xl:block \"\">".number_format($registro->RetencionGan, 2,'.','')."</div>
                //     <div class=\"col-2 border border-secondary\"\">".number_format($registro->NetoComp, 2,'.','')."</div>
                //     <div class=\"xs:col-flex1 md:col-flex border border-secondary\"\">".number_format($registro->MontoPagadoComp, 2,'.','')."</div>
                //     <div class=\"xs:col-flex1 md:col-flex border border-secondary hidden sm:hidden md:hidden lg:block xl:block \"\">".number_format($Saldo, 2,'.','')."</div>
                //     <div class=\"xs:col-flex1 md:col-flex border border-secondary hidden sm:hidden md:hidden lg:block xl:block \"\">".number_format($registro->CantidadLitroComp, 2,'.','')."</div>
                //     <div class=\"xs:col-flex1 md:col-flex border border-secondary hidden sm:hidden md:hidden lg:block xl:block \"\">$registro->ParticIva</div>
                //     <div class=\"xs:col-flex1 md:col-flex border border-secondary hidden sm:hidden md:hidden lg:block xl:block \"\">" . $this->ConvierteMesEnTexto($registro->PasadoEnMes) . "</div>
                //     <div class=\"xs:col-flex1 md:col-flex border border-secondary hidden sm:hidden md:hidden lg:block xl:block \"\">$Area->name</div>
                //     <div class=\"xs:col-flex1 md:col-flex border border-secondary hidden sm:hidden md:hidden lg:block xl:block \"\">$Cuenta->name</div>
                // </div>";


                // $this->filtro=$this->filtro."<tr class=\"bg-red-200 hover:bg-red-100\" wire:click=\"gCargarRegistro(". $registro->id .")\"><td class=\"border border-green-600\">$Fecha</td><td class=\"border border-green-600 text-right\">$registro->comprobante</td><td class=\"border border-green-600\">$Proveedor->name</td><td class=\"border border-green-600 text-right\">$registro->detalle</td><td class=\"border border-green-600 text-right\">".number_format($registro->BrutoComp, 2,'.','')."</td><td class=\"border border-green-600 text-right\">".number_format($MontoIva, 2,'.','')."</td><td class=\"border border-green-600 text-right\">".number_format($registro->ExentoComp, 2,'.','')."</td><td class=\"border border-green-600 text-right\">".number_format($registro->ImpInternoComp, 2,'.','')."</td><td class=\"border border-green-600 text-right\">".number_format($registro->PercepcionIvaComp, 2,'.','')."</td><td class=\"border border-green-600 text-right\">".number_format($registro->RetencionIB, 2,'.','')."</td><td class=\"border border-green-600 text-right\">".number_format($registro->RetencionGan, 2,'.','')."</td><td class=\"border border-green-600 text-right\">".number_format($registro->NetoComp, 2,'.','')."</td><td class=\"text-red-600 border border-green-600 text-right\">".number_format($registro->MontoPagadoComp, 2,'.','')."</td><td class=\"border border-green-600 text-right\">".number_format($Saldo, 2,'.','')."</td><td class=\"border border-green-600 text-right\">".number_format($registro->CantidadLitroComp, 2,'.','')."</td><td class=\"border border-green-600\">$registro->ParticIva</td><td class=\"border border-green-600\">" . $this->ConvierteMesEnTexto($registro->PasadoEnMes) . "</td><td class=\"border border-green-600\">".$Area->name."</td><td class=\"border border-green-600\">".$Cuenta->name."</td></tr>
                // </tr>";
        }

        $this->filtro=$this->filtro."<tr>
        <td class=\"col d-none d-sm-table-cell\"></td>
        <td class=\"col d-none d-sm-table-cell\"></td>
        <td></td>
        <td><b>Totales</b></td>
        <td class=\"p-0 text-right\"><b>".number_format($Bruto, 2,'.','')."</b></td>
        <td class=\"p-0 text-right\"><b>".number_format($MontoIvaT, 2,'.','')."</b></td>
        <td class=\"p-0 text-right\"><b>".number_format($Exento, 2,'.','')."</b></td>
        <td class=\"p-0 d-none d-sm-table-cell text-right\"><b>".number_format($ImpInterno, 2,'.','')."</b></td>
        <td class=\"p-0 d-none d-sm-table-cell text-right\"><b>".number_format($PerIva, 2,'.','')."</b></td>
        <td class=\"p-0 d-none d-sm-table-cell text-right\"><b>".number_format($RetIB, 2,'.','')."</b></td>
        <td class=\"p-0 d-none d-sm-table-cell text-right\"><b>".number_format($RetGan, 2,'.','')."</b></td>
        <td class=\"p-0 text-right\"><b>".number_format($NetoT, 2,'.','')."</b></td>
        <td class=\"p-0 text-right\"><b>".number_format($MontoPagado, 2,'.','')."</b></td>
        <td class=\"p-0 d-none d-sm-table-cell text-right\"><b>".number_format($Saldo, 2,'.','')."</b></td>
        <td class=\"p-0 d-none d-sm-table-cell text-right\"><b>".number_format($Cantidad, 2,'.','')."</b></td>
        <td class=\"p-0 d-none d-sm-table-cell\"></td>
        <td class=\"p-0 d-none d-sm-table-cell\"></td>
        <td class=\"p-0 d-none d-sm-table-cell\"></td>
        <td class=\"p-0 d-none d-sm-table-cell\"></td>
        </tr> 
        </tbody>
        </table>    
        </div>";

        // $this->filtro=$this->filtro."
        // <div class=\"col-12 fse-1  md:fse-0 flex border table-auto w-full border border-green-800 border-collapse bg-gray-300 rounded-md\">
            
        //         <div class=\"xs:col-flex1 md:col-flex border\"></div>
        //         <div class=\"xs:col-flex1 border\"></div>
        //         <div class=\"col-2 border\">Totales</div>
        //         <div class=\"xs:col-flex1 text-center hidden sm:hidden md:hidden lg:block xl:block \"></div>
        //         <div class=\"col-2 border\"\">".number_format($Bruto, 2,'.','')."</div>
        //         <div class=\"xs:col-flex1 border\"\">".number_format($MontoIvaT, 2,'.','')."</div>
        //         <div class=\"col-2\"\">".number_format($Exento, 2,'.','')."</div>
        //         <div class=\"hidden sm:hidden md:hidden lg:block xl:block\"\">".number_format($ImpInterno, 2,'.','')."</div>
        //         <div class=\"hidden sm:hidden md:hidden lg:block xl:block\"\">".number_format($PerIva, 2,'.','')."</div>
        //         <div class=\"hidden sm:hidden md:hidden lg:block xl:block\"\">".number_format($RetIB, 2,'.','')."</div>
        //         <div class=\"hidden sm:hidden md:hidden lg:block xl:block\"\">".number_format($RetGan, 2,'.','')."</div>
        //         <div class=\"col-2 border\"\">".number_format($NetoT, 2,'.','')."</div>
        //         <div class=\"xs:col-flex1 border\"\">".number_format($MontoPagado, 2,'.','')."</div>
        //         <div class=\"hidden sm:hidden md:hidden lg:block xl:block\"\">".number_format($Saldo, 2,'.','')."</div>
        //         <div class=\"hidden sm:hidden md:hidden lg:block xl:block\"\">".number_format($Cantidad, 2,'.','')."</div>
        //         <div class=\"hidden sm:hidden md:hidden lg:block xl:block\"\"></div>
        //         <div class=\"hidden sm:hidden md:hidden lg:block xl:block\"\"></div>
        //         <div class=\"xs:col-flex1\"\"></div>
        //         <div class=\"xs:col-flex1\"\"></div>
        // </div>    ";

        // $this->filtro = $this->filtro."<tr class=\"bg-gradient-to-r from-purple-400 via-pink-500 to-red-500\"><td></td><td></td><td></td><td class=\"border border-green-600\">Totales</td><td class=\"border border-green-600 text-right\">".number_format($Bruto, 2,'.','')."</td><td class=\"border border-green-600 text-right\">".number_format($MontoIvaT, 2,'.','')."</td><td class=\"border border-green-600 text-right\">".number_format($Exento, 2,'.','')."</td><td class=\"border border-green-600 text-right\">".number_format($ImpInterno, 2,'.','')."</td><td class=\"border border-green-600 text-right\">".number_format($PerIva, 2,'.','')."</td><td class=\"border border-green-600 text-right\">".number_format($RetIB, 2,'.','')."</td><td class=\"border border-green-600 text-right\">".number_format($RetGan, 2,'.','')."</td><td class=\"border border-green-600 text-right\">".number_format($NetoT, 2,'.','')."</td><td class=\"border border-green-600 text-right\">".number_format($MontoPagado, 2,'.','')."</td><td class=\"border border-green-600 text-right\"><strong>".number_format($Saldo, 2,'.','')."</strong></td><td class=\"border border-green-600 text-right\">".number_format($Cantidad, 2,'.','')."</td></tr>";
        // $this->filtro=$this->filtro."</table>";
        
    }

    public function ConvierteMesEnTexto($id) {
        switch ($id) {
            case 1 : $caso="Enero"; break;
            case 2 : $caso="Febrero"; break;
            case 3 : $caso="Marzo"; break;
            case 4 : $caso="Abril"; break;
            case 5 : $caso="Mayo"; break;
            case 6 : $caso="Junio"; break;
            case 7 : $caso="Julio"; break;
            case 8 : $caso="Agosto"; break;
            case 9 : $caso="Setiembre"; break;
            case 10 : $caso="Octubre"; break;
            case 11 : $caso="Noviembre"; break;
            case 12 : $caso="Diciembre"; break;
        }
        return $caso;
    }

    public function gsetanio($dato){
        $this->gfanio=$dato;
        $this->gfiltro();
    }
    public function ProcesaSQLFiltro($interfaz){
        $sql='';
        switch ($interfaz) {
            case "comprobantes" : {
                //Mes 	Proveedor 	ParticipaIva 	Iva 	Detalle 	Area 	Cuenta 	Año 	Asc. C/Saldo
                //dd($this->gfmes);
                if ($this->gfmes<>null) $sql=" PasadoEnMes=" . $this->gfmes;
                if ($this->gfproveedor) $sql=$sql ? $sql=$sql." and proveedor_id=" . $this->gfproveedor : " proveedor_id=" . $this->gfproveedor;
                if ($this->gfparticipa) $sql=$sql ? $sql=$sql." and ParticIva='" . $this->gfparticipa . "'" : " ParticIva='" . $this->gfparticipa . "'";
                if ($this->gfiva) $sql=$sql ? $sql=$sql." and iva_id=" . $this->gfiva : " iva_id=" . $this->gfiva;
                //dd($this->gfdetalle);
                //if ($this->gfdetalle<>null) $sql=$sql ? $sql=$sql." and detalle='" . $this->gfdetalle . "'" : " ";
                // if ($this->gfdetalle=="Todos") $sql=$sql ? $sql=$sql." and detalle='" . $this->gfdetalle . "'" : " detalle='" . $this->gfdetalle . "'";
                if ($this->gfdetalle<>null) {
                    
                    if ($this->gfdetalle<>"Todos") $sql=$sql . " and detalle='" . $this->gfdetalle. "'";
                }
                //dd($sql);
                if ($this->gfarea) $sql=$sql ? $sql=$sql." and area_id=" . $this->gfarea : " area_id=" . $this->gfarea;
                if ($this->gfcuenta) $sql=$sql ? $sql=$sql." and cuenta_id=" . $this->gfcuenta : " cuenta_id=" . $this->gfcuenta;
                if ($this->gfanio) $sql=$sql ? $sql=$sql." and Anio=" . $this->gfanio : " Anio=" . $this->gfanio;
                $sql=$sql ? $sql=$sql." and empresa_id=" . session('empresa_id') : $sql." empresa_id=" . session('empresa_id');
                //Fecha	Comprobante	Proveedor	Detalle	Bruto	Iva	exento	Imp.Interno	Percec.Iva	Retenc.IB	Retenc.Gan	Neto	Pagado	Saldo	Cant.Litros	Partic.Iva	Pasado EnMes	Area	Cuenta
                $sql = "SELECT * FROM comprobantes WHERE" . $sql; // . " ORDER BY fecha, comprobante";
                // dd($sql);
                if ($this->fgascendente) { $sql=$sql . " ORDER BY fecha, comprobante"; } else { $sql=$sql . " ORDER BY fecha DESC, comprobante DESC"; }
                break;
            }
            case "deuda" : {
                
                //"SELECT proveedors.name as Name, Saldos.Saldo as Saldo FROM proveedors, (SELECT sum(NetoComp-MontoPagadoComp) as Saldo, comprobantes.proveedor_id as idproveedor FROM comprobantes WHERE fecha>='2021-09-01' and fecha<='2021-09-30' and empresa_id=1     GROUP BY comprobantes.proveedor_id ) as Saldos WHERE proveedors.id = Saldos.idproveedor and Saldos.Saldo>1
                
                if ($this->darea==0) { $darea=''; } else { $darea=' and comprobantes.area_id='.$this->darea; }  //Comprueba si se ha seleccionado un area en especìfico
                // dd($this->darea);
                if ($this->danio==0) { $danio=''; } else { $danio=' and comprobantes.Anio='.$this->danio; }  //Comprueba si se ha seleccionado un año en especìfico

                if($this->darea<>0) {
                    $sql = DB::table('comprobantes')
                    ->selectRaw('sum(NetoComp-MontoPagadoComp) as Saldo, proveedors.id')
                    ->join('proveedors', 'comprobantes.proveedor_id', '=', 'proveedors.id')
                    ->groupBy('proveedors.id')
                    // ->whereRaw('(NetoComp-MontoPagadoComp)>1')
                    //->whereBetween('comprobantes.fecha',["'".$this->ddesde."'","'".$this->dhasta."'"])
                    ->where('comprobantes.fecha','>=',$this->ddesde)
                    ->where('comprobantes.fecha','<=',$this->dhasta)
                    ->where('comprobantes.empresa_id','=',session('empresa_id'))
                    ->where('area_id','=',$this->darea)
                    // ->where('Anio','=',$this->danio)
                    //->orderByDesc('avg_salary')
                    ->get();
                } else {
                    $sql = DB::table('comprobantes')
                    ->selectRaw('sum(NetoComp-MontoPagadoComp) as Saldo, proveedors.id')
                    ->join('proveedors', 'comprobantes.proveedor_id', '=', 'proveedors.id')
                    ->groupBy('proveedors.id')
                    ->where('comprobantes.fecha','>=',$this->ddesde)
                    ->where('comprobantes.fecha','<=',$this->dhasta)
                    ->where('comprobantes.empresa_id','=',session('empresa_id'))
                    ->get();
                }

                $this->MostrarDeudaProveedores=true;break;
            };
            case "credito" : {
                //"SELECT proveedors.name as Name, Saldos.Saldo as Saldo FROM proveedors, (SELECT sum(NetoComp-MontoPagadoComp) as Saldo, comprobantes.proveedor_id as idproveedor FROM comprobantes WHERE fecha>='2021-09-01' and fecha<='2021-09-30' and empresa_id=1     GROUP BY comprobantes.proveedor_id ) as Saldos WHERE proveedors.id = Saldos.idproveedor and Saldos.Saldo<1
                
                if ($this->carea==0) { $carea=''; } else { $carea=' and comprobantes.area_id='.$this->carea; }  //Comprueba si se ha seleccionado un area en especìfico
                if ($this->canio==0) { $canio=''; } else { $canio=' and comprobantes.Anio='.$this->canio; }  //Comprueba si se ha seleccionado un año en especìfico

                if($this->carea<>0) {
                // $sql="SELECT proveedors.name as Name, Saldos.Saldo as Saldo FROM proveedors, (SELECT sum(NetoComp-MontoPagadoComp) as Saldo, comprobantes.proveedor_id as idproveedor FROM comprobantes WHERE fecha>='". $this->cdesde."' and fecha<='". $this->chasta."' and empresa_id=". session('empresa_id')." $carea  $canio  GROUP BY comprobantes.proveedor_id ) as Saldos WHERE proveedors.id = Saldos.idproveedor and Saldos.Saldo<1";
                    $sql = DB::table('comprobantes')
                    ->selectRaw('sum(NetoComp-MontoPagadoComp) as Saldo, proveedors.id')
                    ->join('proveedors', 'comprobantes.proveedor_id', '=', 'proveedors.id')
                    ->groupBy('proveedors.id')
                    ->where('comprobantes.fecha','>=',$this->cdesde)
                    ->where('comprobantes.fecha','<=',$this->chasta)
                    ->where('comprobantes.empresa_id','=',session('empresa_id'))
                    ->where('area_id','=',$this->carea)
                    ->get();
                } else {
                    $sql = DB::table('comprobantes')
                    ->selectRaw('sum(NetoComp-MontoPagadoComp) as Saldo, proveedors.id')
                    ->join('proveedors', 'comprobantes.proveedor_id', '=', 'proveedors.id')
                    ->groupBy('proveedors.id')
                    ->where('comprobantes.fecha','>=',$this->cdesde)
                    ->where('comprobantes.fecha','<=',$this->chasta)
                    ->where('comprobantes.empresa_id','=',session('empresa_id'))
                    ->get();
                }

                $this->MostrarCreditoProveedores=true;break;
            };
            case "libro" : {
                $sql="SELECT PasadoEnMes, Max(Cerrado) as Cerrado FROM comprobantes WHERE ParticIva='Si' and Anio=" . $this->lanio . " and empresa_id='".session('empresa_id')."' GROUP BY PasadoEnMes, Anio";
                $this->MostrarLibrosComponent=true;break;
            };
        }
        //dd($sql);
        return $sql;
    }

    public function gCargarRegistro($id) {
        $registro=Comprobante::find($id);
        $this->comprobante_id = $id;
        $this->id = $id; //Utilizado para buscar el registro para eliminar
        $this->gfecha= substr($registro->fecha,0,10);
        $this->gcomprobante=$registro->comprobante;
        $this->gdetalle=$registro->detalle;
        //dd($registro);
        //dd($this->gdetalle);
        $this->gbruto=number_format($registro->BrutoComp, 2, '.','');
        $this->gpartiva=$registro->ParticIva;
        $a=Iva::find($registro->iva_id);
        $this->iva_value= $a->monto;
        //  dd($this->iva_value);
        $this->giva2=number_format($registro->MontoIva, 2, '.','');
        $this->gexento=number_format($registro->ExentoComp, 2, '.','');
        $this->gimpinterno=number_format($registro->ImpInternoComp, 2, '.','');
        $this->gperciva=number_format($registro->PercepcionIvaComp, 2, '.','');
        $this->gperib=number_format($registro->RetencionIB, 2, '.','');
        $this->gretgan=number_format($registro->RetencionGan, 2, '.','');
        $this->gneto=number_format($registro->NetoComp, 2, '.','');
        $this->gmontopagado=number_format($registro->MontoPagadoComp, 2, '.','');
        $this->gcantidad=number_format($registro->CantidadLitroComp, 2, '.','');
        $this->ganio=$registro->Anio;
        $this->gmes=$registro->PasadoEnMes;
        $this->garea=$registro->area_id;
        $this->gcuenta=$registro->cuenta_id;
        $this->giva=$registro->iva_id;
        $this->gproveedor=$registro->proveedor_id;
        
        $this->validate([
            'gfecha'            => 'required|date',
            'gbruto'            => 'numeric',
            'gpartiva'          => 'required',
            'giva2'             => 'numeric',
            'gexento'           => 'numeric',
            'gimpinterno'       => 'numeric',
            'gperciva'          => 'numeric',
            'gperib'            => 'numeric',
            'gretgan'           => 'numeric',
            'gneto'             => 'numeric',
            'gmontopagado'      => 'numeric', 
            'gcantidad'         => 'numeric',
            'ganio'             => 'required|integer',
            'gmes'              => 'required',
            'giva'              => 'required|integer',
            'garea'             => 'required|integer',
            'gcuenta'           => 'required|integer',
            'gproveedor'        => 'required|integer',
        ]);
    }

    public function CalcularIva() {
        //dd($this->iva_value);$a=Iva::find($registro->iva_id);
        $a=Iva::find($this->giva);
        if ($this->gbruto=="") $this->gbruto=0.00;
        $this->iva_value= $a->monto;
        if($this->iva_value<>0) {
            $result = (float)$this->gbruto * (float)$this->iva_value / 100;
            (float) $this->giva2 = number_format($result,2,'.','');
        } else {
            (float) $this->giva2 = 0;
        }

        $this->CalcularNeto();
        //$this->gfsaldo = $this->gneto-$this->gmontopagado;
    }

    public function CalcularNeto() {
        $this->gneto = number_format( floatval($this->gbruto) + floatval($this->giva2) + floatval($this->gexento) + floatval($this->gimpinterno) + floatval($this->gperciva) + floatval($this->gperib) + floatval($this->gretgan),2 ,'.','' ) ;
    }

    public function copiarMontoPagado() {
        $this->gmontopagado= $this->gneto;
    }

    public function CalcularDeudaProveedores($ret) {
        $registros = $this->ProcesaSQLFiltro('deuda'); // Procesa los campos a mostrar
        //dd($sql);
        //$registros = DB::select(DB::raw($sql));       // Busca el recordset

        // $registros = DB::table('comprobantes')
        //             ->selectRaw('sum(NetoComp-MontoPagadoComp) as Saldo, proveedors.id')
        //             ->join('proveedors', 'comprobantes.proveedor_id', '=', 'proveedors.id')
        //             ->groupBy('proveedors.id')
        //             //->whereBetween('comprobantes.fecha',["'".$this->ddesde."'","'".$this->dhasta."'"])
        //             ->where('comprobantes.fecha','>=',$this->ddesde)
        //             ->where('comprobantes.fecha','<=',$this->dhasta)
        //             //->orderByDesc('avg_salary')
        //             ->get();

        $this->deudaPDF = $registros;
        //dd($this->deudaPDF);
        //Dibuja el filtro
        $Saldo=0;
        $this->DeudaProveedoresFiltro = "<table class=\"mt-6\" style=\"width:300px\">
            <tr class=\"bg-blue-200 border border-blue-500\">
                <td class=\"center bg-gray-300\"><b>Nombre</b></td>
                <td class=\"center bg-gray-300\"><b>Deuda</b></td>
            </tr>";
        foreach($registros as $registro) {
            if ($registro->Saldo>1) {
                $proveedor = Proveedor::find($registro->id);
                $this->DeudaProveedoresFiltro = $this->DeudaProveedoresFiltro .
                "<tr>
                    <td class=\"bg-gray-100 border border-blue-500 text-left pl-4\">
                        $proveedor->name
                        <div class=\"tooltip\">
                            <span class=\"tooltiptext\">
                                Teléfono: ".$proveedor->telefono."<br>
                                Email: ".$proveedor->email."
                            </span>
                        </div>
                    </td>
                    <td class=\"bg-gray-100 border border-blue-500 text-right pr-4\">" . number_format($registro->Saldo,2,',','.') . "
                    </td>
                </tr>";

                $Saldo = $Saldo + $registro->Saldo;
            }
        }
        $this->DeudaProveedoresFiltro = $this->DeudaProveedoresFiltro .
            "<tr class=\"bg-green-500 w-36\">
                <td class=\"colspan-2 bg-gray-300\">Total Deuda</td>
                <td class=\"text-right bg-gray-300 pr-4\"><b>".number_format($Saldo,2,',','.')."</b></td>
            </tr>
            </table>";
            //dd("filtro" . $this->DeudaProveedoresFiltro);
            //$this->deudaPDF = $this->DeudaProveedoresFiltro;
        if($ret) return $this->DeudaProveedoresFiltro;
        //SELECT proveedors.name, Saldos.Saldo FROM proveedors, (SELECT sum(NetoComp-MontoPagadoComp) as Saldo, comprobantes.proveedor_id as idproveedor FROM comprobantes WHERE empresa_id=1 GROUP BY comprobantes.proveedor_id ) as Saldos WHERE proveedors.id = Saldos.idproveedor and Saldos.Saldo>1
    }

    public function CalcularCreditoProveedores() {
        $registros = $this->ProcesaSQLFiltro('credito'); // Procesa los campos a mostrar
        // $sql = $this->ProcesaSQLFiltro('credito'); // Procesa los campos a mostrar
        // $registros = DB::select(DB::raw($sql));       // Busca el recordset

        //Dibuja el filtro
        $Saldo=0;
        $this->CreditoProveedoresFiltro = "<table class=\"mt-6\" style=\"width:300px\">
            <tr class=\"bg-blue-200 border border-blue-500\">
                <td class=\"center bg-gray-400\"><b>Nombre</b></td>
                <td class=\"center bg-gray-400\"><b>Crédito</b></td>
            </tr>";
        foreach($registros as $registro) {
            if($registro->Saldo<-1) {
                $proveedor = Proveedor::find($registro->id);
                // "<tr>
                //     <td class=\"bg-gray-100 border border-blue-500 text-left tooltip\" wire:click=\"copy(".$proveedor->id.")\"><span class=\"tooltiptext\">
                //     Teléfono: ".$proveedor->telefono."<br>Email: ".$proveedor->email."</span>" . $proveedor . "</td>
                //     <td class=\"bg-gray-100 border border-blue-500 text-right\">" . number_format($registro->Saldo * -1 ,2,',','.') . "</td>
                // </tr>";
                $this->CreditoProveedoresFiltro = $this->CreditoProveedoresFiltro .
                "<tr>
                    <td class=\"bg-gray-100 border border-blue-500 text-left pl-4\">" . $proveedor->name . "</td>
                    <td class=\"bg-gray-100 border border-blue-500 text-right pr-4\">" . number_format($registro->Saldo * -1 ,2,',','.') . "</td>
                </tr>";
                $Saldo = $Saldo + $registro->Saldo * -1;
            }
        }
        
        $this->CreditoProveedoresFiltro = $this->CreditoProveedoresFiltro .
            "<tr class=\"bg-green-500\">
                <td class=\"colspan-2 bg-gray-400\">Total Crédito</td>
                <td class=\"bg-gray-400 text-right pr-4\"><b>".number_format($Saldo,2,',','.')."</b></td>
            </tr>
            </table>";
    }

    public function MostrarLibros() {
        if($this->lmes && $this->lanio) {
            $sql = $this->ProcesaSQLFiltro('libro'); // Procesa los campos a mostrar
            $registros = DB::select($sql);       // Busca el recordset
            //Dibuja el filtro
            $Saldo=0;
            $this->LibroFiltro ="<table class=\"w-full mt-8  shadow-lg\" ><tr><td class=\"bg-gray-300 border border-green-400\">Mes</td><td class=\"bg-gray-300 border border-green-400\">Estado</td>";
            //dd($registros);
            foreach ($registros as $libro) {
                $NombreMes = $this->ConvierteMesEnTexto($libro->PasadoEnMes);
                if($libro->Cerrado>0) { $AbiertoCerrado = 'Cerrado'; } else { $AbiertoCerrado = 'Abierto'; }
                $this->LibroFiltro = $this->LibroFiltro . "<tr><td class=\"bg-gray-100 border border-green-400\">". $NombreMes . "</td><td class=\"bg-gray-100 border border-green-400\">" . $AbiertoCerrado . "</td>";
            }
            $this->LibroFiltro = $this->LibroFiltro . "</tr></table>";
        }
    }

    public function CerrarLibro() {
        //$sSql="SELECT * FROM tblComprobantes WHERE Anio=$LibroAnio and Empresa='".$_SESSION['CuitEmpresa']."' and PasadoEnMes='$LibroMes' and ParticipaEnIva='Si'";
        $i=0;
        dd('jhkhkjh');
        $registros = DB::table('comprobantes')              // Busca la última página utilizada para la empresa seleccionada
            ->where('empresa_id','=',session('empresa_id'))
            ->where('ParticIva','=','Si')
            ->groupByRaw('Anio,PasadoEnMes,Cerrado')
            ->orderBy('Cerrado')
            ->get();
        dd($registros);
        $UltimaPaginaCerrada = $registros->last()->Cerrado; // Asigna el valor en $UltimaPaginaCerrada
        $registros = DB::table('comprobantes')        // Carga todos los registros que van a ser modificados que corresponden al mes y año
            ->where('Anio','=',$this->lanio)
            ->where('PasadoEnMes','=',$this->lmes)
            ->where('empresa_id','=',session('empresa_id'))
            ->where('ParticIva','=','Si')
            ->orderByRaw('fecha,comprobante,BrutoComp')
            ->get();
        $UltimaPaginaCerrada++;
        foreach($registros as $registro) {
            $reg = Comprobante::find($registro->id);
            if ($i==35) { $UltimaPaginaCerrada++; $i=0; }
            $reg->Cerrado = $UltimaPaginaCerrada;
            $reg->save();
            $i++;
        }
        $this->MostrarLibros();
    }

    public function agregar_detalle() {
        
        $this->validate([
            'comprobante_id'    => 'required',
            'gselect_productos' => 'required|numeric',
            'gcantidad_prod'    => 'required|numeric',
            'gprecio_prod'      => 'required|numeric',
        ]);
        $detalle = new Compras_Productos;
        $detalle->comprobantes_id = $this->comprobante_id;
        $detalle->productos_id = $this->gselect_productos;
        $detalle->cantidad = $this->gcantidad_prod;
        $detalle->precio = $this->gprecio_prod;
        $detalle->user_id = $userid=auth()->user()->id;

        $detalle->save();

        // Incrementa la cantidad de stock del producto
        $producto = Producto::find($this->gselect_productos);
        $producto->existencia = $producto->existencia + abs($this->gcantidad_prod);
        $producto->save();

        $this->listado_productos();
    }

    public function eliminar_detalle($id_detalle) {
        
        //Encuentra el detalle a eliminar pasa buscar la cantidad que tiene que eliminar
        $eliminar = Compras_Productos::find($id_detalle);
        //dd($eliminar);
        $cant_a_eliminar = $eliminar->cantidad*-1;


        $detalle = new Compras_Productos;
        $detalle->comprobantes_id = $this->comprobante_id;
        $detalle->productos_id = $eliminar->productos_id;
        $detalle->cantidad = $cant_a_eliminar;  //Actualiza el valor con la cantidad a eliminar
        $detalle->precio = $eliminar->precio;
        $detalle->user_id = $userid=auth()->user()->id;

        $detalle->save();
        
        // Incrementa la cantidad de stock del producto
        $producto = Producto::find($eliminar->productos_id);
        $producto->existencia = $producto->existencia + $cant_a_eliminar;
        $producto->save();

        $this->listado_productos();
    }
    
    public function listado_productos() {
        
        $this->glistado_prod = Compras_Productos::join('productos','compras__productos.productos_id','productos.id')
        ->where('comprobantes_id',$this->comprobante_id)
        ->get(['compras__productos.*','productos.name']);
        //falta el where
        //dd($this->glistado_prod);
    }


    
    public function GenerarCertificado() {
        // CUIT al cual le queremos generar el certificado
        $tax_id = 20255083571; 

        // Usuario para ingresar a AFIP.
        // Para la mayoria es el mismo CUIT, pero al administrar
        // una sociedad el CUIT con el que se ingresa es el del administrador
        // de la sociedad.
        $username = '20255083571'; 

        // Contraseña para ingresar a AFIP.
        $password = 'sOCIEDAD2023';

        // Alias para el certificado (Nombre para reconocerlo en AFIP)
        // un alias puede tener muchos certificados, si estas renovando
        // un certificado podes utilizar el mismo alias
        $alias = 'afipsdkCertificado';

        // Creamos una instancia de la libreria
        $afip = new Afip(array('CUIT' => $tax_id ));

        // Creamos el certificado (¡Paciencia! Esto toma unos cuantos segundos)
        $res = $afip->CreateCert($username, $password, $alias);

        // Mostramos el certificado por pantalla
        var_dump($res->cert);

        // Mostramos la key por pantalla
        var_dump($res->key);

        dd($res->cert);
    }

    public function AutorizarCertificado() {
        // CUIT al cual le queremos generar la autorización
        $tax_id = 20255083571; 

        // Usuario para ingresar a AFIP.
        // Para la mayoria es el mismo CUIT, pero al administrar
        // una sociedad el CUIT con el que se ingresa es el del administrador
        // de la sociedad.
        $username = '20255083571'; 

        // Contraseña para ingresar a AFIP.
        $password = 'sOCIEDAD2023';

        // Alias del certificado a autorizar (previamente creado)
        $alias = 'afipsdkCertificado';

        // Id del web service a autorizar
        $wsid = 'wsfe';

        // Creamos una instancia de la libreria
        $afip = new Afip(array('CUIT' => $tax_id ));

        // Creamos la autorizacion (¡Paciencia! Esto toma unos cuantos segundos)
        $res = $afip->CreateWSAuth($username, $password, $alias, $wsid);

        // Mostramos el resultado por pantalla
        var_dump($res);
    }

    public function Emitidos() {

        // Certificado (Puede estar guardado en archivos, DB, etc)
        $cert = file_get_contents('/home/enzo/Escritorio/erp.softxplus.com/app/Http/Livewire/Compra/certificado.crt');

        // Key (Puede estar guardado en archivos, DB, etc)
        $key = file_get_contents('/home/enzo/Escritorio/erp.softxplus.com/app/Http/Livewire/Compra/key.key');

        // Tu CUIT
        // $tax_id = 30712141790;
        $tax_id = 20255083571;

        $afip = new Afip(array(
            'CUIT' => $tax_id,
            'cert' => $cert,
            'key' => $key
        ));

        $voucher_types = $afip->ElectronicBilling->GetVoucherTypes();
        $CbteTipo = $voucher_types[0]->Id;
        // dd($CbteTipo);

        $sales_points = $afip->ElectronicBilling->GetSalesPoints();
        $PtoVta = $sales_points[0]->Nro;
        // dd($PtoVta);
        /**
        * @param int $number 		Number of voucher to get information
        * @param int $sales_point 	Sales point of voucher to get information
        * @param int $type 			Type of voucher to get information */
        $number = 2;
        $sales_point = $PtoVta;
        $a = $afip->ElectronicBilling->GetVoucherInfo($number, $sales_point, $CbteTipo);
        dd($a);
    }

    public function Facturar(){

        // Certificado (Puede estar guardado en archivos, DB, etc)
        $cert = file_get_contents('/home/enzo/Escritorio/erp.softxplus.com/app/Http/Livewire/Compra/certificado.crt');

        // Key (Puede estar guardado en archivos, DB, etc)
        $key = file_get_contents('/home/enzo/Escritorio/erp.softxplus.com/app/Http/Livewire/Compra/key.key');

        // Tu CUIT
        // $tax_id = 30712141790;
        $tax_id = 20255083571;

        $afip = new Afip(array(
            'CUIT' => $tax_id,
            'cert' => $cert,
            'key' => $key
        ));


        // Para hacer pruebas
        // Tu CUIT
        // $tax_id = 20111111112;
        // $afip = new Afip(array('CUIT' => 20255083571));

        $voucher_types = $afip->ElectronicBilling->GetVoucherTypes();
        $CbteTipo = $voucher_types[0]->Id;
        // dd($CbteTipo);

        $sales_points = $afip->ElectronicBilling->GetSalesPoints();
        $PtoVta = $sales_points[0]->Nro;
        // dd($PtoVta);

        $DocTipos = $afip->ElectronicBilling->GetDocumentTypes();
        $DocTipo = $DocTipos[0]->Id;    // 0: CUIT  y 9:DNI
        // dd($DocTipos);

        $TiposIva = $afip->ElectronicBilling->GetAliquotTypes();
        $TipoIva = $TiposIva[2]->Id;   // El Concepto del arrary en la posición 2, tiene en su ID el valor 5 que es IVA al 21%
        // dd($TipoIva);

        $Conceptos = $afip->ElectronicBilling->GetConceptTypes();
        $Concepto = $Conceptos[2]->Id;  // Concepto del Comprobante: (1)Productos, (2)Servicios, (3)Productos y Servicios
        // El Concepto del arrary en la posición 2, tiene en su ID el valor 3 que es Productos y Servicios
        // dd($Conceptos); 

        $Tributos = $afip->ElectronicBilling->GetTaxTypes();
        $Tributo = $Tributos[4]->Id; // El Concepto del arrary en la posición 4, tiene en su ID el valor 99 que es Otros Tributos
        $TributoDesc = $Tributos[4]->Desc; 
        // dd($Tributo);


        //$CbteNro = $afip->ElectronicBilling->GetLastVoucher($PtoVta,$CbteTipo);
        //dd($CbteNro);


        $data = array(
            'CantReg' 		=> 1, // Cantidad de comprobantes a registrar
            'PtoVta' 		=> $PtoVta, // Punto de venta
            'CbteTipo' 		=> $CbteTipo, // Tipo de comprobante (ver tipos disponibles) 
            'Concepto' 		=> $Concepto, // Concepto del Comprobante: (1)Productos, (2)Servicios, (3)Productos y Servicios
            'DocTipo' 		=> $DocTipo, // Tipo de documento del comprador (ver tipos disponibles)
            'DocNro' 		=> 20111111112, // Numero de documento del comprador
            'CbteDesde' 	=> 1, // Numero de comprobante o numero del primer comprobante en caso de ser mas de uno
            'CbteHasta' 	=> 1, // Numero de comprobante o numero del ultimo comprobante en caso de ser mas de uno
            'CbteFch' 		=> intval(date('Ymd')), // (Opcional) Fecha del comprobante (yyyymmdd) o fecha actual si es nulo
            'ImpTotal' 		=> 189.3, // Importe total del comprobante
            'ImpTotConc' 	=> 0, // Importe neto no gravado
            'ImpNeto' 		=> 150, // Importe neto gravado
            'ImpOpEx' 		=> 0, // Importe exento de IVA
            'ImpIVA' 		=> 31.5, //Importe total de IVA
            'ImpTrib' 		=> 7.8, //Importe total de tributos
            'FchServDesde' 	=> intval(date('Ymd')), // (Opcional) Fecha de inicio del servicio (yyyymmdd), obligatorio para Concepto 2 y 3
            'FchServHasta' 	=> intval(date('Ymd')), // (Opcional) Fecha de fin del servicio (yyyymmdd), obligatorio para Concepto 2 y 3
            'FchVtoPago' 	=> intval(date('Ymd')), // (Opcional) Fecha de vencimiento del servicio (yyyymmdd), obligatorio para Concepto 2 y 3
            'MonId' 		=> 'PES', //Tipo de moneda usada en el comprobante (ver tipos disponibles)('PES' para pesos argentinos) 
            'MonCotiz' 	    => 1, 
            'Tributos' 		=> array( // (Opcional) Tributos asociados al comprobante
                array(
                    'Id' 		=>  $Tributo, // Id del tipo de tributo (ver tipos disponibles) 
                    'Desc' 		=>  $TributoDesc, //'Ingresos Brutos', // (Opcional) Descripcion
                    'BaseImp' 	=> 150, // Base imponible para el tributo
                    'Alic' 		=> 5.2, // Alícuota
                    'Importe' 	=> 7.8 // Importe del tributo
                )
            ),
	        'Iva' 			=> array( // (Opcional) Alícuotas asociadas al comprobante
		        array(
			        'Id' 		=> $TipoIva, // Id del tipo de IVA (ver tipos disponibles) 
        			'BaseImp' 	=> 150, // Base imponible
		        	'Importe' 	=> 31.5 // Importe 
                ),
            ),
        );

        $a = $afip->ElectronicBilling->CreateNextVoucher($data);

        dd($a);

        // include('/home/enzo/Escritorio/erp.softxplus.com/app/Http/Livewire/Compra/ElectronicBilling.php');
        // $Factura = new ElectronicBilling('wsfe');
        // $sales_points = $Factura->GetDocumentTypes();

        // $sales_points = $afip->ElectronicBilling->GetDocumentTypes();
        // $sales_points = $afip->ElectronicBilling->GetAliquotTypes();
    }


    
}