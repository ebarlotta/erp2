<?php

namespace App\Models\Geri;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanAlimentario extends Model
{
    /** @use HasFactory<\Database\Factories\Geri\PlanAlimentarioFactory> */
    use HasFactory;

    protected $fillable=[
        'nombre',
        'descripcion',
        'desde',
        'hasta',
        'activo',
        'empresa_id',
    ];

    // public function listado_menues() {
    //     return $this->hasMany(MenuPlan::class, 'id', 'plan_id');
    // }
}
