<?php

namespace App\Models\Geri;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Geri\Informes\Informe;


class Agenteinforme extends Model
{
    use HasFactory;

    protected $fillable=[
        'agente_id', 
        'informe_id',
        'nroperiodo',
        'anio',
        'profesional_id',
    ];

    public function datosagente()
    {
        return $this->hasOne(Actor::class,'id','agente_id');
    }

    public function datosinforme()
    {
        return $this->hasOne(Informe::class,'id','informe_id');
    }

    public function datosprofesional()
    {
        return $this->hasOne(Actor::class,'id','profesional_id');
    }
}
