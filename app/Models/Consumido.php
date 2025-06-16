<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consumido extends Model
{
    /** @use HasFactory<\Database\Factories\ConsumidoFactory> */
    use HasFactory;

    protected $fillable=[
        'fecha',
        'actor_id',
        'elemento_id',
        'menu_id',
        'cantidad',
        'momento_del_dia_id',
        'dia_de_la_semana',
        'empresa_id',
        'consumido',
        'cerrado',
    ];
}
