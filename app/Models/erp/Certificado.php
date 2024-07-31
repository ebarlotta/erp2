<?php

namespace App\Models\erp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificado extends Model
{
    use HasFactory;

    protected $fillable=[
        'tax_id',
        'username',
        'password',
        'alias',
        'estado',
        'empresa_id',
    ];

}
