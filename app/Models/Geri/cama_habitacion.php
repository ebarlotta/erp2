<?php

namespace App\Models\Geri;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cama_habitacion extends Model
{
    use HasFactory;
    protected $fillable=[
    'cama_id',
    'habitacion_id',
    ];
}
