<?php

namespace App\Models\erp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoTag extends Model
{
    use HasFactory;

    public function producto_name()
    {
        return $this->belongsTo(Producto::class);
    }
}
