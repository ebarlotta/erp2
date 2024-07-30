<?php

namespace App\Models\Geri;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Geri\PersonasCampos;

class Interfaces extends Model
{
    use HasFactory;

    protected $fillable=[
        'NombreInterface',
        'tipo_de_persona_id',
    ];

    public function campos()
    {
        return $this->hasMany('App\Models\Geri\PersonasCampos');
        //return $this->hasMany(PersonasCampos::class);
    }

    public function tipodepersonas()
    {
        dd($this->belongsTo('App\Models\Geri\TipoDePersona'));
        return $this->belongsTo('App\Models\TipoDePersona');
    }
}
