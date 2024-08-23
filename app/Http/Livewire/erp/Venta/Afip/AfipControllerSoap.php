<?php

require('Pepe.php');
// use SoapClient as Soap2;

require '/vendor/autoload.php';

class AfipController
{
    private $wsdl;
    private $cuit;
    private $token;
    private $sign;

    public $soapClient;

    public function __construct($wsdl_service, $cuit, $token, $sign)
    {
        $this->wsdl = $wsdl_service;
        $this->cuit = $cuit;
        $this->token = $token;
        $this->sign = $sign;

        // Uso del controlador
        $this->wsdl = 'https://servicios1.afip.gov.ar/wsfev1/service.asmx?WSDL'; // URL del WSDL del web service
        $this->cuit = '20-12345678-9'; // CUIT del usuario
        $this->token = env('AFIP_ACCESS_TOKEN'); // Token de autenticación
        $this->sign = 'Firma';  // $this->certificado_crt; //'YOUR_SIGN'; // Firma de autenticación

        $this->initializeSoapClient();
    }

    private function initializeSoapClient()
    {
        $options = [
            'trace' => true,
            'exceptions' => true,
            'cache_wsdl' => false, // WSDL_CACHE_NONE,
        ];

        try {
            // $this->soapClient = new Pepe($this->wsdl, $options);
            // $this->soapClient = new SoapClient($this->wsdl, $options);
            $this->soapClient = new Soap2($this->wsdl, $options);
        } catch (SoapFault $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // $this->soapClient = new SoapClient($this->wsdl, $options);

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
