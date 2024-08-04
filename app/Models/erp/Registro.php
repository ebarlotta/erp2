<?php

namespace App\Models\erp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'fila', 
        'columna', 
        'expresion',
        'colorfondocelda', 
        'alineacion', 
    ];
}
