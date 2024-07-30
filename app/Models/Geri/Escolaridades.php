<?php

namespace App\Models\Geri;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escolaridades extends Model
{
    use HasFactory;

    protected $fillable = [
        'escolaridadDescripcion',
    ];
}
