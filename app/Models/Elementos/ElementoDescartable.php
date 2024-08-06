<?php

namespace App\Models\Elementos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElementoDescartable extends Model
{
    use HasFactory;

    protected $fillable=[
        'pendiente',
        'elemento_id',
        'empresa_id',
    ];
}
