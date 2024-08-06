<?php

namespace App\Models\Elementos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElementoIngrediente extends Model
{
    use HasFactory;

    protected $fillable=[
        'estado_id',
        'elemento_id',
        'empresa_id',
    ];
}
