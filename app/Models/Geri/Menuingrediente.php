<?php

namespace App\Models\Geri;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menuingrediente extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'elemento_id',
        'cantidad',
    ];

    // public function ingredientes()
    // {
    //     return $this->belongsToMany(elemento_id::class);
    // }
}
