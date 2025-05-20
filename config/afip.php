<?php 

    // env(['AFIP_CUIT'=>'20255083571']);
    // env(['AFIP_CERT_PATH'=>'afip/20255083571_CertificadoProduccionBarBer.crt']);
    // env(['AFIP_KEY_PATH'=>'afip/20255083571_CertificadoProduccionBarBer.key']);
    // env(['AFIP_ENV'=>'testing']); // # testing | productio])n

// return [
//     'empresa_id' => env('empresa_id'),
//     // otras variables...

    
// ];

return [
'AFIP_CUIT'=>'20255083571',
'AFIP_CERT_PATH'=>'afip/20255083571MiPedidoCSRBarBer',
'AFIP_KEY_PATH'=>'afip/20255083571MiPedidoPEMBarBer',
// 'AFIP_CERT_PATH'=>'afip/20255083571_CertificadoProduccionBarBer.crt',
// 'AFIP_KEY_PATH'=>'afip/20255083571_CertificadoProduccionBarBer.key',
'AFIP_ENV'=>'testing', // # testing | production
];

// dd(env('AFIP_CERT_PATH'));
?>