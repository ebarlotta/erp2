<?php

namespace App\Services;

use Exception;
use SoapClient;

class AfipFeService
{
    private $endpoint;
    private $authService;

    public function __construct(AfipAuthService $authService)
    {
        $this->authService = $authService;
        $this->endpoint = env('AFIP_ENV') === 'testing'
            ? 'https://wswhomo.afip.gov.ar/wsfev1/service.asmx?wsdl'
            : 'https://servicios1.afip.gov.ar/wsfev1/service.asmx?wsdl';
    }

    public function consultarFECAEA(int $periodo, int $orden)
    {
        try {
            $credentials = $this->authService->getCredentials('wsfe');
            dd($credentials.'enzo');

            $client = new SoapClient($this->endpoint, ['soap_version' => SOAP_1_2]);

            $request = [
                'Auth' => [
                    'Token' => $credentials['token'],
                    'Sign' => $credentials['sign'],
                    'Cuit' => env('AFIP_CUIT'),
                ],
                'Periodo' => $periodo,
                'Orden' => $orden,
            ];

            return $client->FECAEAConsultar($request);
        } catch (Exception $e) {
            throw new Exception("Error en AFIP: " . $e->getMessage());
        }
    }
}