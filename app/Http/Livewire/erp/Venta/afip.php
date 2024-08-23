<?php

require 'vendor/autoload.php';

use phpseclib\Crypt\RSA;
use phpseclib\Crypt\Random;
use phpseclib\Crypt\Hash;

class AfipWebService
{
    private $cuit;
    private $privateKey;
    private $certFile;
    private $wsaaUrl;
    private $wsUrl;

    public function __construct($cuit, $privateKey, $certFile, $wsaaUrl, $wsUrl)
    {
        $this->cuit = $cuit;
        $this->privateKey = $privateKey;
        $this->certFile = $certFile;
        $this->wsaaUrl = $wsaaUrl;
        $this->wsUrl = $wsUrl;
    }

    public function getServiceTicket()
    {
        $token = $this->requestWsaaToken();
        return $token;
    }

    private function requestWsaaToken()
    {
        $xml = $this->generateWsaaXml();

        $ch = curl_init($this->wsaaUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: text/xml']);

        $response = curl_exec($ch);
        curl_close($ch);

        $xmlResponse = simplexml_load_string($response);
        $token = (string) $xmlResponse->token;
        $sign = (string) $xmlResponse->sign;

        return [$token, $sign];
    }

    private function generateWsaaXml()
    {
        $date = new DateTime();
        $date->add(new DateInterval('PT10M'));
        $expires = $date->format(DateTime::ISO8601);

        $xml = <<<XML
        <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:wsaa="http://ar.gov.afip.dgi.wsaa">
            <soapenv:Header/>
            <soapenv:Body>
                <wsaa:loginCms>
                    <wsaa:request>
                        <wsaa:header>
                            <wsaa:username>{$this->cuit}</wsaa:username>
                            <wsaa:expires>{$expires}</wsaa:expires>
                        </wsaa:header>
                        <wsaa:cms></wsaa:cms>
                    </wsaa:request>
                </wsaa:loginCms>
            </soapenv:Body>
        </soapenv:Envelope>
        XML;

        // Firmar el XML
        $signature = $this->signXml($xml);

        return $signature;
    }

    private function signXml($xml)
    {
        $rsa = new RSA();
        $rsa->loadKey($this->privateKey);
        $signedXml = $rsa->sign($xml);

        return $signedXml;
    }

    public function callService($endpoint, $request)
    {
        list($token, $sign) = $this->getServiceTicket();

        $xmlRequest = $this->createRequestXml($request, $token, $sign);

        $ch = curl_init($this->wsUrl . '/' . $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlRequest);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: text/xml']);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    private function createRequestXml($request, $token, $sign)
    {
        // Crear XML de solicitud con token y firma
        $xml = <<<XML
        <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns="http://ar.gov.afip.dgi.ws">
            <soapenv:Header>
                <wsse:Security xmlns:wsse="http://schemas.xmlsoap.org/ws/2002/12/soap-security">
                    <wsse:UsernameToken>
                        <wsse:Username>{$this->cuit}</wsse:Username>
                        <wsse:Password>{$token}</wsse:Password>
                    </wsse:UsernameToken>
                    <wsse:Signature>
                        <wsse:SignedInfo>
                            <wsse:SignatureMethod Algorithm="http://www.w3.org/2000/09/xmldsig#rsa-sha1"/>
                            <wsse:CanonicalizationMethod Algorithm="http://www.w3.org/2001/10/xml-exc-c14n#"/>
                        </wsse:SignedInfo>
                        <wsse:SignatureValue>{$sign}</wsse:SignatureValue>
                    </wsse:Signature>
                </wsse:Security>
            </soapenv:Header>
            <soapenv:Body>
                {$request}
            </soapenv:Body>
        </soapenv:Envelope>
        XML;

        return $xml;
    }







// Configuración
$cuit = '20-12345678-9'; // CUIT de la empresa
$privateKey = file_get_contents('path/to/your/privatekey.pem');
$certFile = 'path/to/your/certificate.crt';
$wsaaUrl = 'https://wsaa.afip.gov.ar/ws/services/LoginCms?wsdl';
$wsUrl = 'https://ws.afip.gov.ar/ws/service';

$afip = new AfipWebService($cuit, $privateKey, $certFile, $wsaaUrl, $wsUrl);

// Solicitar ticket de servicio
$response = $afip->callService('endpoint', '<YourRequestXML>');

echo $response;