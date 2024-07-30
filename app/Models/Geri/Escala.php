<?php

namespace App\Models\Geri;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escala extends Model
{
    use HasFactory;

    protected $fillable=[
        'nombreescala',
        'tipodatos',
        'minimo',
        'maximo',
    ];
}
