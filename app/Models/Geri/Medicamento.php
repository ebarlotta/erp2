<?php

namespace App\Models\Geri;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    use HasFactory;

    protected $fillable=[
        'nombremedicamento',
        'unidad_id',
        'cantidad',
        'psiquiatrico',
    ];
}
