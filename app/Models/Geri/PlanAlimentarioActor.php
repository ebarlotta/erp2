<?php

namespace App\Models\Geri;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanAlimentarioActor extends Model
{
    /** @use HasFactory<\Database\Factories\Geri\PlanAlimentarioActorFactory> */
    use HasFactory;

    protected $fillable=[
        'actor_id',
        'plan_id',
    ];
}
