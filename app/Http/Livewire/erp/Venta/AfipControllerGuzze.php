<?php

// require 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class AfipControllerGuzze {
    private $wsdl;
    private $client;
    private $cuit;
    private $token;
    private $sign;

    public function __construct($wsdl_service, $cuit, $token, $sign)
    {
        $this->wsdl = $wsdl_service;
        $this->cuit = $cuit;
        $this->token = $token;
        $this->sign = $sign;

        $this->client = new Client();
    }

    public function callSoapFunction($action, $params)
    {
        $headers = [
            'Content-Type' => 'text/xml; charset=utf-8',
            'SOAPAction' => $action
        ];

        $body = $this->buildSoapRequest($action, $params);

        try {
            $response = $this->client->request('POST', $this->wsdl, [
                'headers' => $headers,
                'body' => $body
            ]);

            return $response->getBody()->getContents();
        } catch (RequestException $e) {
            echo 'Error: ' . $e->getMessage();
            return null;
        }
    }

    private function buildSoapRequest($action, $params)
    {
        $xml= '<?xml version="1.0" encoding="utf-8"?>
        <soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
          <soap12:Body>
            <FECAESolicitar xmlns="http://ar.gov.afip.dif.FEV1/">
              <Auth>
                <Token>'.$this->token.'</Token>
                <Sign>'.$this->sign.'string</Sign>
                <Cuit>'.$this->cuit.'</Cuit>
              </Auth>
              <FeCAEReq>
                <FeCabReq />
                <FeDetReq>
                  <FECAEDetRequest />
                  <FECAEDetRequest />
                </FeDetReq>
              </FeCAEReq>
            </FECAESolicitar>
          </soap12:Body>
        </soap12:Envelope>';

        return $xml;
    }

    private function arrayToXml($params)
    {
        $xml = '';
        foreach ($params as $key => $value) {
            if (is_array($value)) {
                $xml .= "<$key>" . $this->arrayToXml($value) . "</$key>";
            } else {
                $xml .= "<$key>$value</$key>";
            }
        }
        return $xml;
    }
}

// // Ejemplo de uso
// $afip = new AfipController(
//     'https://servicios1.afip.gov.ar/wsfev1/service.asmx?WSDL',
//     '20-12345678-9',
//     'YOUR_TOKEN',
//     'YOUR_SIGN'
// );

// // Llamar a un método SOAP
// $response = $afip->callSoapFunction('YourSoapMethod', [
//     'param1' => 'value1',
//     'param2' => 'value2'
// ]);

// echo $response;
