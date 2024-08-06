<?php

namespace App\Models\Elementos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElementoProducto extends Model
{
    use HasFactory;

    protected $fillable=[
        'barra',
        'qr',
        'descuento',
        'calificacion',
        'descuento_especial',
        'precio_venta',
        'descripcion',
        'lote',
        'ruta',
        'estado_id',
        'elemento_id',
        'proveedor_id',
        'empresa_id',
    ];
}
