<?php

namespace App\Models\Elementos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Elementos\Elemento;

class ElementoArticulo extends Elemento
{
    use HasFactory;

    protected $fillable=[
        'precioventa',
        'marca',
        'lista_id',
        'elemento_id',
        'empresa_id',
    ];    
}
