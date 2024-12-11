<?php

namespace App\Models\erp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Estado;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'descripcion',
        'precio_compra',
        'existencia',
        'stock_minimo',
        'lote',

        'barra',
        'qr',
        'barra_proveedor',
        'descuento',
        'calificacion',
        'descuento_especial',
        'precio_venta',
        
        'unidads_id',
        'categoriaproductos_id',
        'estados_id',
        'proveedor_id',
        'empresa_id',
        'ruta',
    ];

    //Relacion de uno a muchos 

    public function unidad()
    {
        return $this->hasMany('App\Models\Unidad','id');
    }

    public function estado()
    {
        return $this->hasOne(Estado::class,'id','estados_id');
        // return $this->hasOne('App\Models\Estado','id');
    }
}
