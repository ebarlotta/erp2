<?php

namespace App\Models\Geri;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombremenu',
        'menuactivo',
        'tiempopreparacion',
        'empresa_id',
    ];

}