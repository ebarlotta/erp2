<?php

namespace App\Services;

use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Storage;

class AfipAuthService
{
    private $endpoint;
    private $cuit;
    private $cert;
    private $key;

    public function __construct()
    {
        // $_ENV['empresa_id']
        // dd(Storage::path(env('AFIP_CERT_PATH')));
        $this->cuit = env('AFIP_CUIT');
        $this->cert = Storage::path(env('AFIP_CERT_PATH'));
        $this->key = Storage::path(env('AFIP_KEY_PATH'));
        $this->endpoint = env('AFIP_ENV') === 'testing'
            ? 'https://wsaahomo.afip.gov.ar/ws/services/LoginCms?wsdl'
            : 'https://wsaa.afip.gov.ar/ws/services/LoginCms?wsdl';
    }

    public function getCredentials(string $service = 'wsfe')
    {
        // Generar el Ticket de Acceso (TA) si no está cacheado
        $taFile = "afip/{$service}_ta.xml";

        // $this->isExpired($taFile) ? $tra=$this->generateTRA($service) : $this->parseTA(Storage::get($taFile));
        // if ($this->isExpired($taFile)) $this->generateTRA($service) return $this->parseTA(Storage::get($taFile));

        // if (Storage::exists($taFile) && !$this->isExpired($taFile)) {
            // dd(Storage::exists($taFile));
            // return $this->parseTA(Storage::get($taFile));
        // }

        // Generar nuevo TA
        $tra = $this->generateTRA($service);
        $cms = $this->signTRA($tra);
        $ta = $this->callWSAA($cms);

        Storage::put($taFile, $ta);

        return $this->parseTA($ta);
    }

    private function generateTRA(string $service)
    {
        $now = time();
        $expires = $now + 3600; // 1 hora de validez

        return <<<XML
            <?xml version="1.0" encoding="UTF-8"?>
            <loginTicketRequest version="1.0">
                <header>
                    <uniqueId>{$now}</uniqueId>
                    <generationTime>{$this->formatTime($now)}</generationTime>
                    <expirationTime>{$this->formatTime($expires)}</expirationTime>
                </header>
                <service>{$service}</service>
            </loginTicketRequest>
            XML;
    }

    private function signTRA(string $tra)
    {
        $tmpFile = tempnam(sys_get_temp_dir(), 'tra');
        file_put_contents($tmpFile, $tra);
        $cmsFile = tempnam(sys_get_temp_dir(), 'cms');
        
        openssl_pkcs7_sign(
            $tmpFile,
            $cmsFile,
            "file://{$this->cert}",
            "file://{$this->key}",
            [],
            PKCS7_DETACHED
        );

        // PKCS7_BINARY
        // "file://{$this->cert}",
            // "file://{$this->key}",
        dd(file_get_contents($cmsFile));

        $cms = file_get_contents($cmsFile);
        $cms = preg_replace('/^.+\n\n/', '', $cms);
        $cms = preg_replace('/\n.+$/', '', $cms);

        unlink($tmpFile);
        unlink($cmsFile);

        return $cms;
    }

    private function callWSAA(string $cms)
    {
        $client = new \SoapClient($this->endpoint, [
            'soap_version' => SOAP_1_2,
            'location' => str_replace('?wsdl', '', $this->endpoint),
            'trace' => 1,
        ]);

        $response = $client->loginCms(['in0' => $cms]);
        return $response->loginCmsReturn;
    }

    private function parseTA(string $ta)
    {
        $xml = simplexml_load_string($ta);
        return [
            'token' => (string) $xml->credentials->token,
            'sign' => (string) $xml->credentials->sign,
        ];
    }

    private function isExpired(string $taFile)
    {
        $ta = Storage::get($taFile);
        $xml = simplexml_load_string($ta);
        $expiration = strtotime((string) $xml->header->expirationTime);
        return $expiration <= time();
    }

    private function formatTime(int $timestamp)
    {
        return date('Y-m-d\TH:i:s', $timestamp) . '-03:00';
    }
}