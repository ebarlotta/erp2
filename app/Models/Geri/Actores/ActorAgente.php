<?php

namespace App\Models\Geri\Actores;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ActorAgente extends Model
{
    use HasFactory;

    protected $fillable=[
        'fingreso',
        'fegreso',
        'alias',
        'peso_id',
        'actor_referente',
        'actor_id',
        'cama_id',
        'datossociales_id',
        'datosmedicos_id',
        'motivos_egreso_id',
        'grado_dependencia_id',
        'historiadevida_id',
    ];

    public function MotivosEgreso() {
        return $this->hasManyThrough('\\App\Models\Geri\MotivosEgresos','\\App\Models\Geri\Actores\ActorAgente','motivos_egreso_id','id')->get();
    }

}
