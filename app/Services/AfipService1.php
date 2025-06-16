<?php

namespace App\Services;

use SoapClient;
use Exception;

class AfipService
{
    protected $wsdl = 'https://wswhomo.afip.gov.ar/wsfev1/service.asmx?wsdl';
    protected $options = [
        'soap_version' => SOAP_1_2,
        'trace' => 1,
        'exceptions' => true,
    ];

    public function consultarFECAEA(string $token, string $sign, string $cuit, int $periodo, int $orden)
    {
        try {
            
            $client = new SoapClient($this->wsdl, $this->options);

            $request = [
                'Auth' => [
                    'Token' => $token,
                    'Sign' => $sign,
                    'Cuit' => $cuit,
                ],
                'Periodo' => $periodo,
                'Orden' => $orden,
            ];

            $response = $client->FECAEAConsultar($request);

            return $response;
        } catch (Exception $e) {
            throw new Exception("Error en AFIP: " . $e->getMessage());
        }
    }
}