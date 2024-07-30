<?php

namespace App\Models\Geri;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camas extends Model
{
    use HasFactory;

    protected $fillable = [
        'NroHabitacion',
        'NroCama',
        'EstadoCama',
        'SexoCama',
    ];
}
