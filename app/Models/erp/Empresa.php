<?php

namespace App\Models\erp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'direccion',
        'cuit',
        'ib',
        'imagen',
        'establecimiento',
        'telefono',
        'actividad',
        'actividad1',
    ];

    //Relacion de uno a muchos 
      
    public function cuentas()
    {
        return $this->hasMany('App\Models\erp\Cuenta');
    }

    public function areas()
    {
        return $this->hasMany('App\Models\erp\Area');
    }

    public function comprobantes()
    {
        return $this->hasMany('App\Models\erp\Comprobante');
    }

    public function proveedores()
    {
        return $this->hasMany(Proveedor::class);
    }

    public function clientes()
    {
        return $this->hasMany('App\Models\erp\Cliente');
    }
    
    public function empleados()
    {
        return $this->hasMany('App\Models\erp\Empleado');
    }

    public function categoriaprofesionales()
    {
        return $this->hasMany('App\Models\erp\Categoriaprofesional');
    }

    public function tablas()
    {
        return $this->hasMany('App\Models\erp\Tabla');
    }

    public function empresausuarios()
    {
        return $this->hasMany('App\Models\erp\EmpresaUsuario');
    }

    public function empresamodulos()
    {
        return $this->hasMany('App\Models\erp\EmpresaModulo');
    }
}
