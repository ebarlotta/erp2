<?php

namespace App\Models\erp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'productos_id',
        'cantidad',
    ];
}
