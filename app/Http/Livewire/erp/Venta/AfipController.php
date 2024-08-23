<?php

namespace App\Http\Livewire\erp\Venta;

// include('SoapClient.php');
// use SoapClient;
use SoapFault;

class AfipController
{
    private $wsdl;
    private $soapClient;
    private $cuit;
    private $token;
    private $sign;

    public function __construct($wsdl, $cuit, $token, $sign)
    {
        $this->wsdl = $wsdl;
        $this->cuit = $cuit;
        $this->token = $token;
        $this->sign = $sign;
        $this->initializeSoapClient();
    }

    private function initializeSoapClient()
    {
        $options = [
            'trace' => true,
            'exceptions' => true,
            'cache_wsdl' => false, // WSDL_CACHE_NONE,
        ];

        $this->soapClient = new SoapClient($this->wsdl, $options);
    }

    private function getAuthParams()
    {
        return [
            'Token' => $this->token,
            'Sign' => $this->sign,
            'CuitRepresentada' => $this->cuit
        ];
    }

    public function callWebService($method, $params)
    {
        try {
            $authParams = $this->getAuthParams();
            $response = $this->soapClient->__soapCall($method, array_merge([$authParams], $params));
            return $response;
        } catch (SoapFault $e) {
            // Manejar excepciones aquí
            return 'Error: ' . $e->getMessage();
        }
    }
}

// // Uso del controlador
// $wsdl = 'https://servicios1.afip.gov.ar/wsfev1/service.asmx?WSDL'; // URL del WSDL del web service
// $cuit = '20-12345678-9'; // CUIT del usuario
// $token = 'YOUR_TOKEN'; // Token de autenticación
// $sign = 'YOUR_SIGN'; // Firma de autenticación

// $afip = new AfipController($wsdl, $cuit, $token, $sign);

// // Ejemplo de llamada a un método del web service
// $response = $afip->callWebService('ConsultaPuntosVenta', []);
// print_r($response);

?>