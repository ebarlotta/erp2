<?php

namespace App\Models\Geri\Informes;

use App\Models\Geri\Actores\Actor;
use App\Models\Geri\AgenteInforme;
use App\Models\Geri\Escala;
use App\Models\Geri\Pregunta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformeRespuestas extends Model
{
    use HasFactory;

    protected $fillable=[
        'agente_informes_id',
        'preguntas_id',
        'cantidad',
        'descripcion',
        'fotourl',
    ];
    
    // public function nombrearea()
    // {
    //     return $this->hasOne(Areas::class,'id','area_id');
    // }

    public function respuesta()
    {
        return $this->hasMany(Pregunta::class,'id','preguntas_id');
    }

    public function informedelagente()
    {
        return $this->hasOne(AgenteInforme::class,'id','agente_informes_id');
    }

    // public function escala() {
    //     $a = $this->hasOne(Pregunta::class,'id','pregunta_id');
    //     $b = Escala::find($a->escala_id)->nombreescala;
    //     return $b;
    // }
}
