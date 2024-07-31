<?php

namespace App\Models\erp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compras_Productos extends Model
{
    use HasFactory;

    protected $fillable=[
        'productos_id',
        'comprobantes_id',
        'cantidad',
        'precio',
        'user_id',
    ];
}
