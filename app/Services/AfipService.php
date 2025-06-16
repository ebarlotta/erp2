<?php

namespace App\Services;

use Afip;

class AfipService
{
    protected $afip;

    public function __construct()
    {
        // dd( env('AFIP_CUIT'));
        $this->afip = new Afip([
            'CUIT' => env('AFIP_CUIT'), // Tu CUIT
            'production' => false, // false para homologación
            'cert' => storage_path('app/afip/Aliasbarber06062025_40ef27df108968a4.crt'), // Ruta al certificado
            'key' => storage_path('app/afip/barber06062025.key'), // Ruta a la clave privada
            'passphrase' => env('AFIP_PASSPHRASE', ''), // Passphrase del certificado
            'ta_folder' => storage_path('app/afip/'), // Carpeta para tokens de acceso
        ]);
    }

    /**
     * Obtener datos del servicio dummy de facturación electrónica
     */
    public function getDummyData()
    {
        try {

            $afip = new Afip(array(
            'CUIT' => env('AFIP_CUIT'),
            'cert' => storage_path('app/afip/barber06062025.csr'),
            // 'cert' => storage_path('app/afip/Aliasbarber06062025_40ef27df108968a4.crt'),
            'key' => storage_path('app/afip/barber06062025.key')
        ));

        // Numero de punto de venta
$punto_de_venta = 1;

// Tipo de comprobante
$tipo_de_comprobante = 6; // 6 = Factura B

$last_voucher = $afip->ElectronicBilling->GetLastVoucher($punto_de_venta, $tipo_de_comprobante);

        dd($last_voucher);
            // Ejemplo para Facturación Electrónica (wsfe)
            $status = $this->afip->ElectronicBilling->GetServerStatus();
            
            return [
                'app_status' => $status->AppServer,
                'db_status' => $status->DbServer,
                'auth_status' => $status->AuthServer,
            ];
        } catch (\Exception $e) {
            throw new \Exception("Error al conectar con AFIP: " . $e->getMessage());
        }
    }

    /**
     * Ejemplo para obtener el último número de comprobante autorizado
     */
    public function getLastAuthorized($pointOfSale, $type)
    {
        try {
            return $this->afip->ElectronicBilling->GetLastAuthorizedDoc([
                'PtoVta' => $pointOfSale,
                'CbteTipo' => $type
            ]);
        } catch (\Exception $e) {
            throw new \Exception("Error al obtener último comprobante: " . $e->getMessage());
        }
    }
}