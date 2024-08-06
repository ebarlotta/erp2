<?php

namespace App\Models\Elementos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElementoMedicamento extends Model
{
    use HasFactory;

    protected $fillable=[
        'psiquiatrico',
        'pedira',
        'elemento_id',
        'empresa_id',
    ];
}
