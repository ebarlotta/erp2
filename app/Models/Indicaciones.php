<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicaciones extends Model
{
    /** @use HasFactory<\Database\Factories\IndicacionesFactory> */
    use HasFactory;

    protected $fillable=[
        'dia_de_la_semana_id',
        'actor_id',
        'elemento_id',
        'cantidad',
        'momento_del_dia_id',
    ];
}
