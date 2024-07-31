<?php

namespace App\Models\erp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'empresa_id',
        'valor',
    ];

}
