<?php

namespace App\Models\erp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoriaprofesional extends Model
{
    use HasFactory;

    //Relacion uno a muchos inversa

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
