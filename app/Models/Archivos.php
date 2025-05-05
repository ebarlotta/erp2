<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivos extends Model
{
    /** @use HasFactory<\Database\Factories\ArchivosFactory> */
    use HasFactory;

    protected $fillable=[
        'archivable_type',
        'archivable_id',
        'url',
        'descripcion',
    ];
}
