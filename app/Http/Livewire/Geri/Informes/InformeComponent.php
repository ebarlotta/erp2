<?php

namespace App\Http\Livewire\Geri\Informes;

use App\Models\Area as Areas;

use App\Models\Geri\Escala;
use App\Models\Geri\Informes\Informe;
use App\Models\Geri\Periodo;
use App\Models\Geri\Pregunta;

use Livewire\Component;

class InformeComponent extends Component
{
    public $periodosview = false, $escalasview = false, $preguntasview = false, $informesview = false;
    public $pregunta_id=false;
    public $periodos, $escalas, $preguntas, $informes, $areas;
    public $informe_id, $escala_id, $area_id;
    public $editpregunta=false, $editinforme=false;
    public $textopregunta;

    public $nombreinforme, $periodo_id, $observaciones;


    public function render()
    {
        $this->periodos = Periodo::all();
        // dd($this->periodos);
        $this->escalas = Escala::all();
        $this->preguntas= Pregunta::all();
        $this->informes = Informe::orderby('nombreinforme')->get();
        $this->areas = Areas::orderby('name')->get();
// dd($this->informes);
        return view('livewire.geri.informes.informe-component')->extends('layouts.adminlte');
    }

    public function Mostrar($opcion)
    {
        switch ($opcion) {
            case 'Periodos': { $this->periodosview=true;$this->escalasview=false;$this->preguntasview=false;$this->informesview=false;
                break; }
            case 'Escalas': { $this->periodosview=false;$this->escalasview=true;$this->preguntasview=false;$this->informesview=false;
                break; }
            case 'Preguntas': { $this->periodosview=false;$this->escalasview=false;$this->preguntasview=true;$this->informesview=false;
                break; }
            case 'Informes': { $this->periodosview=false;$this->escalasview=false;$this->preguntasview=false;$this->informesview=true;
                break; }
        }
    }

    public function agregar($id) {
        switch ($id) {
            case 3: //informesview 
                {   $this->editinforme = true; 
                    $this->nombreinforme=''; $this->area_id='';$this->periodo_id='';$this->observaciones='';
                    break; 
            }
            case 4: //Preguntas 
                {   $this->editpregunta = true; 
                    $this->informe_id=''; $this->area_id='';$this->escala_id='';$this->textopregunta='';
                    break; 
            }
        }
    }

    public function ocultar($id) {
        switch ($id) {
            case 3: //Informes
                { $this->editinforme = false; $this->informe_id=''; break; }
            case 4: //Preguntas 
                { $this->editpregunta = false; $this->pregunta_id=''; break; }
        }
    }

    public function store($id) {
        switch ($id) {
            case 3: //Informes
                {   $this->validate([
                    'nombreinforme' => 'required',
                    'periodo_id' => 'required|integer',
                    'area_id' => 'required|integer',
                ]);
                Informe::updateOrCreate(['id' => $this->informe_id], [
                    'nombreinforme' => $this->nombreinforme,
                    'periodo_id' => $this->periodo_id,
                    'area_id' => $this->area_id,
                    'observaciones' => $this->observaciones,
                    'empresa_id' =>  1, //session(['empresa_id' => $id]),
                ]);
        
                session()->flash('message', $this->informe_id ? 'Pregunta Actualizada.' : 'Pregunta Creada.');
                $this->editinforme = false; break; }

            case 4: //Preguntas 
                {   $this->validate([
                    'informe_id' => 'required|integer',
                    'area_id' => 'required|integer',
                    'escala_id' => 'required|integer',
                    'textopregunta' => 'required',
                ]);
            
                Pregunta::updateOrCreate(['id' => $this->pregunta_id], [
                    'informe_id' => $this->informe_id,
                    'area_id' => $this->area_id,
                    'escala_id' => $this->escala_id,
                    'textopregunta' => $this->textopregunta,
                ]);
        
                session()->flash('message', $this->pregunta_id ? 'Pregunta Actualizada.' : 'Pregunta Creada.');
        
                $this->editpregunta = false; break; }
        }

        $this->pregunta_id = null;
    }

    public function editarpregunta($id) {
        // dd('entro');
        $pregunta = Pregunta::find($id);
        // $pregunta = Pregunta::where('id','=',$id)->get();
        
        $this->agregar(4);
        $this->informe_id = $pregunta->informe_id;
        $this->area_id = $pregunta->area_id;
        $this->escala_id = $pregunta->escala_id;
        $this->textopregunta = $pregunta->textopregunta;
        $this->pregunta_id = $id;

    }

    public function editarinforme($id) {
        $informe = Informe::find($id);
        // $pregunta = Pregunta::where('id','=',$id)->get();
        
        $this->agregar(3);
        $this->nombreinforme = $informe->nombreinforme;
        $this->periodo_id = $informe->periodo_id;
        $this->area_id = $informe->area_id;
        $this->observaciones = $informe->observaciones;
        $this->informe_id = $id;
    }

}
