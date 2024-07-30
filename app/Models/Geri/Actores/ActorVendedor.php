<?php

namespace App\Models\Geri\Actores;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActorVendedor extends Model
{
    use HasFactory;

    protected $fillable=[
        'iva_id',
        'actor_id',
    ];
}
