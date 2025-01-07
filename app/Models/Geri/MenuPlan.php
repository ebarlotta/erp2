<?php

namespace App\Models\Geri;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuPlan extends Model
{
    /** @use HasFactory<\Database\Factories\Geri\MenuPlanFactory> */
    use HasFactory;

    protected $fillable=[
        'menu_id',
        'plan_id',
        'dia',
        'momento_dia_id',
        'cantidad',
        'activo',
    ];
}
