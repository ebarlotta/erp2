<?php

namespace App\Http\Livewire\Afip;

use Livewire\Component;
use App\Services\AfipService;
use App\Services\AfipFeService;
use Exception;

class ConsultaAfip extends Component
{
/*    public $token;
    public $sign;
    public $cuit;
    public $periodo;
    public $orden;
    public $resultado;
    public $error;

    public function consultar()
    {
        $this->validate([
            'token' => 'required|string',
            'sign' => 'required|string',
            'cuit' => 'required|numeric',
            'periodo' => 'required|integer',
            'orden' => 'required|integer',
        ]);

        try {
            $afipService = new AfipService();
            $this->resultado = $afipService->consultarFECAEA(
                $this->token,
                $this->sign,
                $this->cuit,
                $this->periodo,
                $this->orden
            );
            $this->error = null;
        } catch (Exception $e) {
            $this->error = $e->getMessage();
            $this->resultado = null;
        }
    }*/

    public $periodo;
    public $orden;
    public $resultado;
    public $error;

    public function consultar()
    {
        $this->validate([
            'periodo' => 'required|integer',
            'orden' => 'required|integer',
        ]);

        try {
            $afipService = new AfipFeService(new \App\Services\AfipAuthService());
            $this->resultado = $afipService->consultarFECAEA($this->periodo, $this->orden);
            $this->error = null;
        } catch (Exception $e) {
            $this->error = $e->getMessage();
            $this->resultado = null;
        }
    }

    public function render()
    {
        return view('livewire.afip.consulta-afip');
    }
}
