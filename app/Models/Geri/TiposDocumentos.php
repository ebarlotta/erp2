<?php

namespace App\Models\Geri;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiposDocumentos extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipodocumento',
    ];
}
