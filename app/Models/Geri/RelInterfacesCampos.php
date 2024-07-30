<?php

namespace App\Models\Geri;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelInterfacesCampos extends Model
{
    use HasFactory;

    protected $fillable = [
        'interface_id',
        'campo_id',
    ];

    public function tipospersonas()
    {
        return $this->hasMany('App\Models\Geri\TipoDePersona');
    }
}
