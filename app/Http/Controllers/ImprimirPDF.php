<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use App\Http\Livewire\Haberes\HaberesComponent as Haber;

class ImprimirPDF extends Controller
{
    public function DeudaPFD( Request $request) {
        $operacion = "deuda"; //$request->operacion;
        $registros = DB::table('comprobantes')
        ->selectRaw('sum(NetoComp-MontoPagadoComp) as Saldo, proveedors.id, proveedors.name')
        ->join('proveedors', 'comprobantes.proveedor_id', '=', 'proveedors.id')
        //->whereBetween('comprobantes.fecha',["'".$this->ddesde."'","'".$this->dhasta."'"])
        // ->whereRaw('(NetoComp-MontoPagadoComp)>1')
        ->where('comprobantes.fecha','>=',$request->ddesde)
        ->where('comprobantes.fecha','<=',$request->dhasta)
        ->groupBy('proveedors.id')
        ->get();

        //$sql ="select sum(NetoComp-MontoPagadoComp) as Saldo, proveedors.* from `comprobantes` inner join `proveedors` on `comprobantes`.`proveedor_id` = `proveedors`.`id` where `comprobantes`.`fecha` >= $request->ddesde and `comprobantes`.`fecha` <= $request->dhasta group by comprobantes.proveedor_id";
        //dd($sql);
        $registros = DB::select(DB::raw($sql));

        $saldo = 0;
        foreach($registros as $registro) { 
            if($registro->Saldo>1) { $saldo = $saldo + $registro->Saldo; }
        }
        
        $pdf = PDF::loadView('livewire.compra.pdf_view',compact('registros','saldo','operacion'));
        
        // download PDF file with download method
        return $pdf->stream('pdf_file.pdf');
    }

    public function CreditoPFD( Request $request) {
        $operacion = "credito"; //$request->operacion;
        $registros = DB::table('comprobantes')
        ->selectRaw('sum(NetoComp-MontoPagadoComp) as Saldo, proveedors.id, proveedors.name')
        ->join('proveedors', 'comprobantes.proveedor_id', '=', 'proveedors.id')
        ->groupBy('proveedors.id')
        //->whereBetween('comprobantes.fecha',["'".$this->ddesde."'","'".$this->dhasta."'"])
        // ->whereRaw('(NetoComp-MontoPagadoComp)<1')
        ->where('comprobantes.fecha','>=',$request->cdesde)
        ->where('comprobantes.fecha','<=',$request->chasta)
        ->get();

        $saldo = 0;
        foreach($registros as $registro) { 
            if($registro->Saldo<1) { $saldo = $saldo + $registro->Saldo; }
        }
        $saldo = $saldo *-1;
        $pdf = PDF::loadView('livewire.compra.pdf_view',compact('registros','saldo','operacion'));
        
        // download PDF file with download method
        return $pdf->stream('pdf_file.pdf');
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

    // public function ejemplo(Request $request) {
    //     $registros = DB::table('comprobantes')
    //     // ->selectRaw('sum(NetoComp-MontoPagadoComp) as Saldo'       
    //     ->where('comprobantes.Anio','>=',$request->anio)
    //     ->where('comprobantes.PasadoEnMes','<=',$request->mes)
    //     ->where('comprobantes.empresa_id','=',session('empresa_id'))
    //     ->where('ParticIva','=','Si')
    //     ->join('proveedors', 'comprobantes.proveedor_id', '=', 'proveedors.id')
    //     ->get();
    //     // dd($registros);
    //     $BrutoComp=0; $MontoIva=0; $ExentoComp=0; $ImpInternoComp=0; $PercepcionIvaComp=0; $RetencionIB=0; $RetencionGan=0; $NetoComp=0;$MontoPagadoComp = 0; $CantidadLitroComp=0;
        
    //     foreach($registros as $registro) { 
    //         $BrutoComp=$BrutoComp + $registro->BrutoComp; 
    //         $MontoIva=$MontoIva + $registro->MontoIva; 
    //         $ExentoComp=$ExentoComp + $registro->ExentoComp; 
    //         $ImpInternoComp=$ImpInternoComp + $registro->ImpInternoComp; 
    //         $PercepcionIvaComp=$PercepcionIvaComp + $registro->PercepcionIvaComp; 
    //         $RetencionIB=$RetencionIB + $registro->RetencionIB; 
    //         $RetencionGan=$RetencionGan + $registro->RetencionGan; 
    //         $NetoComp=$NetoComp + $registro->NetoComp;
    //     }
    //     $mes = $this->ConvierteMesEnTexto($request->mes);
    //     $anio = $request->anio;
    //     //dd($registros);
    //     $empresa = Empresa::find(session('empresa_id'));
    //     $pdf = PDF::loadView('livewire.compra.pdf_iva_view',compact('registros','BrutoComp', 'MontoIva', 'ExentoComp', 'ImpInternoComp', 'PercepcionIvaComp', 'RetencionIB', 'RetencionGan', 'NetoComp', 'empresa','mes','anio'))->setPaper('a4', 'landscape');
    //     return $pdf->stream('pdf_file.pdf');
        
    // }

    public function encabezado($pagina, $mes, $anio, $compraventa) {
        $empresa = Empresa::find(session('empresa_id'));
        $mes = $this->ConvierteMesEnTexto($mes);
        $libro = 0;
        if ($compraventa) { $LIBRO = 'COMPRAS'; } else { $LIBRO = 'VENTAS'; }
        $encabezado = '<table style="font-size: 14px; line-height: 16px; width:100%; border: 1px solid #ddd; font-family: Arial, Helvetica, sans-serif">
        <tr>
            <td style="width:33%; text-align:left;">Empresa: ' . $empresa->name.'</td>
            <td style="width:33%; text-align:center;"></td>
            <td style="width:33%; text-align:right;">Mes: '. $mes.'</td>
        </tr>
        <tr>
            <td style="width:33%; text-align:left;">' . $empresa->direccion.'</td>
            <td style="width:33%; text-align:center;"><u>REGISTRO IVA ' . $LIBRO . '</u></td>
            <td style="width:33%; text-align:right;">Libro Nro: ' . $libro.'</td>
        </tr>
        <tr>
            <td style="width:33%; text-align:left;">Cuit:' . $empresa->cuit.' - IB: ' . $empresa->ib.'</td>
            <td style="width:33%; text-align:center;"></td>
            <td style="width:33%; text-align:right;">Página Nro: ' . $pagina.'</td>
        </tr>
        <tr>
            <td style="width:33%; text-align:left;">Nro Establecimiento: ' . $empresa->establecimiento.'</td>
            <td style="width:33%; text-align:center;"></td>
            <td style="width:33%; text-align:right;">'. $mes.' - '.$anio.'</td>
        </tr>
        <tr>
            <td style="width:33%; text-align:left;">Condición IVA: ' . $empresa->actividad1.'</td>
            <td style="width:33%; text-align:center;"></td>
            <td style="width:33%; text-align:right;"></td>
        </tr>
    </table>
    <table style=" margin-top:3px; font-size: 12px; line-height: 12px; border-collapse: collapse; width:100%;">
        <tr style="color:black; background-color:#ddd; border: 1px solid #ddd;">
            <td style="border: 1px solid #ddd; text-align:center;">Fecha</td>
            <td style="border: 1px solid #ddd; text-align:center;">Comprobante</td>
            <td style="border: 1px solid #ddd; text-align:center;">Vendedor</td>
            <td style="border: 1px solid #ddd; text-align:center;">Cuit</td>
            <td style="border: 1px solid #ddd; text-align:center;">Bruto</td>
            <td style="border: 1px solid #ddd; text-align:center;">Iva</td>
            <td style="border: 1px solid #ddd; text-align:center;">Exento</td>
            <td style="border: 1px solid #ddd; text-align:center;">Imp.Interno</td>
            <td style="border: 1px solid #ddd; text-align:center;">Perc.Iva</td>
            <td style="border: 1px solid #ddd; text-align:center;">Ret.IB</td>
            <td style="border: 1px solid #ddd; text-align:center;">Ret.GAN</td>
            <td style="border: 1px solid #ddd; text-align:center;">Total</td>
        </tr>';
        return $encabezado;
    }

    public function IvaCompras(Request $request) {
        $html = "No hay registros para este período!!!";
        $registros = DB::table('comprobantes')
        // ->selectRaw('sum(NetoComp-MontoPagadoComp) as Saldo'       
        ->where('comprobantes.Anio','=',$request->anio)
        ->where('comprobantes.PasadoEnMes','=',$request->mes)
        ->where('comprobantes.empresa_id','=',session('empresa_id'))
        ->where('ParticIva','=','Si')
        ->join('proveedors', 'comprobantes.proveedor_id', '=', 'proveedors.id')
        ->orderByRaw('fecha, comprobante,BrutoComp')
        ->get();
        $BrutoComp=0; $MontoIva=0; $ExentoComp=0; $ImpInternoComp=0; $PercepcionIvaComp=0; $RetencionIB=0; $RetencionGan=0; $NetoComp=0;
        
        // <body style="font-family: Arial, Helvetica, sans-serif">';
        if(count($registros)) {
            $pagina=$registros->first()->Cerrado; $libro='0';
            $html =  $this->encabezado($pagina, $request->mes,$request->anio,1); //  1:COMPRAS
            $row=''; $i = 0;
            foreach($registros as $registro) {
                $row = $row . '<tr>
                <td style="text-align:center; border: 1px solid #ddd; mr-3 pr-3">'. substr($registro->fecha,8,2) ."-". substr($registro->fecha,5,2) ."-". substr($registro->fecha,0,4) .'</td>
                <td style="text-align:right; border: 1px solid #ddd; mr-3 pr-3">'. $registro->comprobante .'</td>
                <td style="text-align:right; border: 1px solid #ddd; mr-3 pr-3" style="color:red">'. $registro->name .'</td>
                <td style="text-align:center; border: 1px solid #ddd; mr-3 pr-3">'. substr($registro->cuit,0,2) ."-" . substr($registro->cuit,3,8) . "-" . substr($registro->cuit,12,1).'</td>
                <td style="text-align:right; border: 1px solid #ddd; mr-3 pr-3">'. number_format($registro->BrutoComp, 2, ',', '.') .'</td>
                <td style="text-align:right; border: 1px solid #ddd; mr-3 pr-3">'. number_format($registro->MontoIva, 2, ',', '.') .'</td>
                <td style="text-align:right; border: 1px solid #ddd; mr-3 pr-3">'. number_format($registro->ExentoComp, 2, ',', '.') .'</td>
                <td style="text-align:right; border: 1px solid #ddd; mr-3 pr-3">'. number_format($registro->ImpInternoComp, 2, ',', '.') .'</td>
                <td style="text-align:right; border: 1px solid #ddd; mr-3 pr-3">'. number_format($registro->PercepcionIvaComp, 2, ',', '.') .'</td>
                <td style="text-align:right; border: 1px solid #ddd; mr-3 pr-3">'. number_format($registro->RetencionIB, 2, ',', '.') .'</td>
                <td style="text-align:right; border: 1px solid #ddd; mr-3 pr-3">'. number_format($registro->RetencionGan, 2, ',', '.') .'</td>
                <td style="text-align:right; border: 1px solid #ddd; mr-3 pr-3">'. number_format($registro->NetoComp, 2, ',', '.') .'
                </td>
                </tr>';
        
                $BrutoComp=$BrutoComp + $registro->BrutoComp; 
                $MontoIva=$MontoIva + $registro->MontoIva; 
                $ExentoComp=$ExentoComp + $registro->ExentoComp; 
                $ImpInternoComp=$ImpInternoComp + $registro->ImpInternoComp; 
                $PercepcionIvaComp=$PercepcionIvaComp + $registro->PercepcionIvaComp; 
                $RetencionIB=$RetencionIB + $registro->RetencionIB; 
                $RetencionGan=$RetencionGan + $registro->RetencionGan; 
                $NetoComp=$NetoComp + $registro->NetoComp;

                $pie = '<tr style="background-color:#ddd;">
                <td style="text-align:right; border: 1px solid #ddd;"></td>
                <td style="text-align:right; border: 1px solid #ddd;"></td>
                <td style="text-align:right; border: 1px solid #ddd;"></td>
                <td style="text-align:right; border: 1px solid #ddd;">Totales</td>
                <td style="text-align:right; border: 1px solid #ddd;">'.  number_format($BrutoComp, 2, ',', '.').'</td>
                <td style="text-align:right; border: 1px solid #ddd;">'.  number_format($MontoIva, 2, ',', '.').'</td>
                <td style="text-align:right; border: 1px solid #ddd;">'.  number_format($ExentoComp, 2, ',', '.').'</td>
                <td style="text-align:right; border: 1px solid #ddd;">'.  number_format($ImpInternoComp, 2, ',', '.').'</td>
                <td style="text-align:right; border: 1px solid #ddd;">'.  number_format($PercepcionIvaComp, 2, ',', '.').'</td>
                <td style="text-align:right; border: 1px solid #ddd;">'.  number_format($RetencionIB, 2, ',', '.').'</td>
                <td style="text-align:right; border: 1px solid #ddd;">'.  number_format($RetencionGan, 2, ',', '.').'</td>
                <td style="text-align:right; border: 1px solid #ddd;">'.  number_format($NetoComp, 2, ',', '.').'</td>
                </tr>
                </table>';
                
                $i++;
                if($i>35) {
                    $row = $row . $pie;
                    $row = $row . '<div style="page-break-after:always;"></div>';
                    $pagina++;
                    $row = $row . $this->encabezado($pagina,$request->mes,$request->anio,1);
                    $i=0;
                }
            }        
            $html =  $html . $row .$pie ;
        
        }        
        $pdf = PDF::loadHtml($html);
        $pdf->setPaper('A4', 'landscape');
        //$pdf->render();
        return $pdf->stream('pdf_iva_view.pdf');
    }

    public function IvaVentas(Request $request) {
        $html = "No hay registros para este período!!!";
        $registros = DB::table('ventas')
        // ->selectRaw('sum(NetoComp-MontoPagadoComp) as Saldo'       
        ->where('ventas.Anio','=',$request->anio)
        ->where('ventas.PasadoEnMes','=',$request->mes)
        ->where('ventas.empresa_id','=',session('empresa_id'))
        ->where('ParticIva','=','Si')
        ->join('clientes', 'ventas.cliente_id', '=', 'clientes.id')
        ->orderByRaw('fecha, BrutoComp')
        ->get();
        $BrutoComp=0; $MontoIva=0; $ExentoComp=0; $ImpInternoComp=0; $PercepcionIvaComp=0; $RetencionIB=0; $RetencionGan=0; $NetoComp=0;
        // dd($registros);
        // <body style="font-family: Arial, Helvetica, sans-serif">';
        if(count($registros)) {
            $pagina=$registros->first()->Cerrado; $libro='0';
            $html =  $this->encabezado($pagina, $request->mes,$request->anio,0); //  0: VENTAS
            $row=''; $i = 0;
            foreach($registros as $registro) {
                $row = $row . '<tr>
                <td style="text-align:center; border: 1px solid #ddd; mr-3 pr-3">'. substr($registro->fecha,8,2) ."-". substr($registro->fecha,5,2) ."-". substr($registro->fecha,0,4) .'</td>
                <td style="text-align:right; border: 1px solid #ddd; mr-3 pr-3">'. $registro->comprobante .'</td>
                <td style="text-align:right; border: 1px solid #ddd; mr-3 pr-3" style="color:red">'. $registro->name .'</td>
                <td style="text-align:center; border: 1px solid #ddd; mr-3 pr-3">'. substr($registro->cuil,0,2) ."-" . substr($registro->cuil,2,8) . "-" . substr($registro->cuil,10,1).'</td>
                <td style="text-align:right; border: 1px solid #ddd; mr-3 pr-3">'. number_format($registro->BrutoComp, 2, ',', '.') .'</td>
                <td style="text-align:right; border: 1px solid #ddd; mr-3 pr-3">'. number_format($registro->MontoIva, 2, ',', '.') .'</td>
                <td style="text-align:right; border: 1px solid #ddd; mr-3 pr-3">'. number_format($registro->ExentoComp, 2, ',', '.') .'</td>
                <td style="text-align:right; border: 1px solid #ddd; mr-3 pr-3">'. number_format($registro->ImpInternoComp, 2, ',', '.') .'</td>
                <td style="text-align:right; border: 1px solid #ddd; mr-3 pr-3">'. number_format($registro->PercepcionIvaComp, 2, ',', '.') .'</td>
                <td style="text-align:right; border: 1px solid #ddd; mr-3 pr-3">'. number_format($registro->RetencionIB, 2, ',', '.') .'</td>
                <td style="text-align:right; border: 1px solid #ddd; mr-3 pr-3">'. number_format($registro->RetencionGan, 2, ',', '.') .'</td>
                <td style="text-align:right; border: 1px solid #ddd; mr-3 pr-3">'. number_format($registro->NetoComp, 2, ',', '.') .'
                </td>
                </tr>';
        
                $BrutoComp=$BrutoComp + $registro->BrutoComp; 
                $MontoIva=$MontoIva + $registro->MontoIva; 
                $ExentoComp=$ExentoComp + $registro->ExentoComp; 
                $ImpInternoComp=$ImpInternoComp + $registro->ImpInternoComp; 
                $PercepcionIvaComp=$PercepcionIvaComp + $registro->PercepcionIvaComp; 
                $RetencionIB=$RetencionIB + $registro->RetencionIB; 
                $RetencionGan=$RetencionGan + $registro->RetencionGan; 
                $NetoComp=$NetoComp + $registro->NetoComp;

                $pie = '<tr style="background-color:#ddd;">
                <td style="text-align:right; border: 1px solid #ddd;"></td>
                <td style="text-align:right; border: 1px solid #ddd;"></td>
                <td style="text-align:right; border: 1px solid #ddd;"></td>
                <td style="text-align:right; border: 1px solid #ddd;">Totales</td>
                <td style="text-align:right; border: 1px solid #ddd;">'.  number_format($BrutoComp, 2, ',', '.').'</td>
                <td style="text-align:right; border: 1px solid #ddd;">'.  number_format($MontoIva, 2, ',', '.').'</td>
                <td style="text-align:right; border: 1px solid #ddd;">'.  number_format($ExentoComp, 2, ',', '.').'</td>
                <td style="text-align:right; border: 1px solid #ddd;">'.  number_format($ImpInternoComp, 2, ',', '.').'</td>
                <td style="text-align:right; border: 1px solid #ddd;">'.  number_format($PercepcionIvaComp, 2, ',', '.').'</td>
                <td style="text-align:right; border: 1px solid #ddd;">'.  number_format($RetencionIB, 2, ',', '.').'</td>
                <td style="text-align:right; border: 1px solid #ddd;">'.  number_format($RetencionGan, 2, ',', '.').'</td>
                <td style="text-align:right; border: 1px solid #ddd;">'.  number_format($NetoComp, 2, ',', '.').'</td>
                </tr>
                </table>';
                
                $i++;
                if($i>35) {
                    $row = $row . $pie;
                    $row = $row . '<div style="page-break-after:always;"></div>';
                    $pagina++;
                    $row = $row . $this->encabezado($pagina,$request->mes,$request->anio,0); //  0: VENTAS
                    $i=0;
                }
            }        
            $html =  $html . $row .$pie ;
        
        }        
        $pdf = PDF::loadHtml($html);
        $pdf->setPaper('A4', 'landscape');
        //$pdf->render();
        return $pdf->stream('pdf_iva_view.pdf');
    }

    public function Recibo(Request $request) {
        $Haber = new Haber;
        $Haber->empleadoseleccionado = $request->empleadoseleccionado;
        $Haber->CargarDatosRecibo($request->anio . $request->mes, $request->empleadoseleccionado);
        
        $firmaempleador="EMPLEADOR";

        $html='<table style="font-size: 5px; line-height: 16px; width:100%; font-family: Arial, Helvetica, sans-serif; border-collapse: collapse;">
                        <tbody bordercolor="#FFFFFF" bgcolor="#AFF3F7">
                            <tr align="center">
                                <td valign="top" style="min-width: 80%">
                                    <div id="DivRecibo">
                                        <div style="background-color: rgb(156 163 175 / var(--tw-bg-opacity));">
                                                <table class="table table-responsive table-hover" style="font-size:10px; border-collapse: collapse;" border="1">
                                                    <tbody style="height: 100px; overflow-y: auto;">
                                                        <tr>
                                                            <td colspan="3" style="border-bottom-width: 2px;border-color: black;">
                                                                <strong>Nombre de la Empresa: '. $Haber->NombreEmpresa .'</strong>
                                                            </td>
                                                            <td colspan="2" align="center" style="border-bottom-width: 2px;border-color: black;">
                                                                <strong>CUIT DE LA EMPRESA: '. $Haber->Cuit . '</strong>
                                                            </td>
                                                            <td colspan="2" align="right" style="border-bottom-width: 2px;border-color: black; width:10%">
                                                                Dirección: '. $Haber->DireccionEmpresa .'
                                                            </td>
                                                        </tr>
                                                        <tr bgcolor="lightGray">
                                                            <td colspan="2" align="center"><strong>APELLIDO Y NOMBRES</strong></td>
                                                            <td align="center"><strong>CUIL EMPLEADO</strong></td>
                                                            <td align="center"><strong>CONVENIO</strong></td>
                                                            <td align="center"><strong>SECCION</strong></td>
                                                            <td colspan="2" align="center"><strong>FECHA INGRESO/ANT</strong>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" align="center">'. $Haber->NombreEmpleado . '</td>
                                                            <td align="center">'. $Haber->Cuil . '</td>
                                                            <td align="center">'. $Haber->CCT . '</td>
                                                            <td align="center">'. $Haber->Seccion . '</td>
                                                            <td colspan="2" align="center">'. substr($Haber->FechaIngreso, 0, 10) . ' - ' . $Haber->ano_diferencia . 'a' . $Haber->mes_diferencia . 'm </td>
                                                        </tr>
                                                        <tr bgcolor="lightGray">
                                                            <td align="center"><strong>CATEGORIA</strong></td>
                                                            <td colspan="2" align="center"><strong>CALIFICACION PROFESIONAL</strong></td>
                                                            <td align="center" style="font-size:7px"><strong>PERIODO DE PAGO</strong></td>
                                                            <td align="center"><b>LEGAJO Nº </b>
                                                            <td colspan="2" align="center"><strong>REMUNERACION ASIGNADA</strong></td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center" style="border-bottom-width: 2px;border-color: black;">'. $Haber->NombreCategoria .'</td>
                                                            <td colspan="2" align="center" style="border-bottom-width: 2px;border-color: black;">'. $Haber->NombreSubCategoria .'</td>
                                                            <td align="center" style="border-bottom-width: 2px;border-color: black;"><strong>'. $Haber->PerPago .'</strong></td>
                                                            <td align="center" style="border-bottom-width: 2px;border-color: black;"><strong>'. $Haber->Legajo  .'</strong></td>
                                                            <td colspan="2" align="center" style="border-bottom-width: 2px;border-color: black;">$ '. number_format($Haber->TotHaberes, 2, ',', '.') .'</td>
                                                        </tr>
                                                        <tr bgcolor="lightGray">
                                                            <td align="left"><strong>CÓDIGO</td>
                                                            <td colspan="2"><strong>CONCEPTOS</strong></td>
                                                            <td align="center"><strong>UNIDADES</strong></td>
                                                            <td align="right"style="font-size:7px"><strong>REM.SUJETAS A RETENCIONES</strong></td>
                                                            <td align="right"style="font-size:7px"><strong>REMUNERACIONES EXENTAS</strong></td>
                                                            <td align="right"><strong>DESCUENTOS</strong></td>
                                                        </tr>
                                                        @if ($Haber->Conceptos)';
                                                            //$htmlConcepto = '<tr><td colspan="7"><table border="0">';
                                                            $htmlConcepto = '';
                                                            foreach ($Haber->Conceptos as $Concepto) {
                                                                $htmlConcepto = $htmlConcepto . '
                                                                <tr style="height: 14px; padding:10px; line-height:10px">
                                                                    <td>'. substr(str_repeat(0, 4).$Concepto['orden'], - 4) . '</td>
                                                                    <td colspan="2">'. $Concepto['name'] .'</td>
                                                                    <td align="center">'.  '   '.$Concepto['cantidad'] .' </td>
                                                                    <td align="right">'. number_format($Concepto['Rem'], 2, ',', '.') .' </td>
                                                                    <td align="right">'. number_format($Concepto['NoRem'], 2, ',', '.') .' </td>
                                                                    <td align="right">'. number_format($Concepto['Descuento'], 2, ',', '.') .' </td>
                                                                </tr>';
                                                            }
                                                            //$htmlConcepto = $htmlConcepto . '</td></tr></table>';
                                                        $html = $html . $htmlConcepto;
                                                        $html = $html . '
                                                        @endif
                            <tr>
                                <td align="center"><strong></strong></td>
                                <td colspan="2" align="center"><strong></strong></td>
                                <td align="center"><strong></strong></td>
                                <td align="right"><strong>' . number_format($Haber->AcumRem, 2, ',', '.') . '</strong></td>
                                <td align="right"><strong>' . number_format($Haber->AcumNoRem, 2, ',', '.') . '</strong></td>
                                <td align="right"><strong>' . number_format($Haber->AcumDescuento, 2, ',', '.') . '</strong></td>
                            </tr>
                            <tr>
                                
                                <td colspan="6" align="center" style="border-bottom-width: 2px;border-color: black;"><strong>NETO A COBRAR</strong></td>
                                <td bgcolor="lightGray" align="center" style="border-bottom-width: 2px;border-color: black; font-weight: bold;">
                                    <b>$ '. number_format($Haber->NetoACobrar, 2, ',', '.') .' </b>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7" bgcolor="lightGray"><strong>Son pesos: '. strtoupper($Haber->NetoACobrarLetras) .'</strong></td>
                            </tr>
                            <tr>
                                <td><strong>LUGAR</strong></td>
                                <td align="left">'. $Haber->LugarPago .'</td>
                                <td><strong>BANCO</strong></td>
                                <td align="left">.' . $Haber->Banco .'</td>
                                <td rowspan="3" colspan="3">Recibí el importe de esta liquidación de pago de mi remuneración correspondiente <br>al período indicado y duplicado de la misma conforme a la ley vigente.<br><br>
                                    <center><strong>FIRMA EMPLEADO/R</strong></center>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>ULTIMA LIQUIDACIÓN</strong></td>
                                <td align="left">'.substr($Haber->PerUltLiq,0,4) . '-' . substr($Haber->PerUltLiq,4,2) .'</td>
                                <td><strong>FECHA DEPOSITO</strong></td>
                                <td align="left">' . $Haber->FechaPago .'</td>
                            </tr>
                            <tr>
                                <td><strong>FECHA DE LIQUIDACIÓN</strong></td>
                                <td align="left">'. substr($Haber->FechaUltLiq,8,2).'-'.substr($Haber->FechaUltLiq,5,2).'-'. substr($Haber->FechaUltLiq,0,4) .'</td>
                                <td><strong>ART 12 LEY 17250</strong></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>';

        // $firmaempleador="EMPLEADO";

        //$html =  $html . $pieRecibo ;

        
        $html =  $html . '<br>---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------<br><br>'.$html;

        $pdf = PDF::loadHtml($html);
        $pdf->setPaper('A4', 'PORTAIL');
        //$pdf->render();
        return $pdf->stream('recibos/pdf_recibo_view.pdf');
    }

}
