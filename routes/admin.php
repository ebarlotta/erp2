<?php

use App\Http\Livewire\EmpresaGestion\EmpresaGestion;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\EmpresaModulos\EmpresaModulosComponent;
use App\Http\Livewire\EmpresaUsuarios\EmpresaUsuariosComponent;
use App\Http\Livewire\ModuloUsuarios\ModuloUsuariosComponent;
//use App\Http\Livewire\Categoria\CategoriaProductoComponent;
use App\Http\Livewire\Categoria\CategoriaproductoComponent;
use App\Http\Livewire\Estado\EstadoComponent;
use App\Http\Livewire\Producto\ProductoComponent;
use App\Http\Livewire\Tag\TagComponent;
use App\Http\Livewire\Unidad\UnidadComponent;
use App\Http\Livewire\Tablas\TablasComponent;
use App\Http\Livewire\Tablas\EditarTablaComponent;
use App\Http\Livewire\Tablas\VisualizarTablaComponent;
use App\Http\Livewire\Haberes\HaberesComponent;
use App\Http\Livewire\Categoriaprofesional\CategoriaprofesionalComponent;
use App\Http\Livewire\Certificado\CertificadoComponent;
use App\Http\Livewire\Tablas\DisenarComponent;
use App\Http\Livewire\Roles\RolesComponent;
use App\Http\Livewire\Modulo\ModuloComponent;
use App\Http\Livewire\GestionModulos\GestionModuloComponent;
use App\Http\Livewire\Area\AreaComponent;
use App\Http\Livewire\Cuenta\CuentaComponent;
use App\Http\Livewire\Cliente\ClienteComponent;
use App\Http\Livewire\Empleado\EmpleadoComponent;
use App\Http\Livewire\Proveedor\ProveedorComponent;
use App\Http\Livewire\Empresa\EmpresaComponent;
use App\Livewire\NuevoComponent;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

Route::get('modulos',NuevoComponent::class)->name('modulos');


Route::get('/dasboard', function () {
    return view('empresas');
})->name('dashboard');

// Route::get('/', EmpresaComponent::class)->name('inicio');
Route::get('/', function () { return view('home')->extends('layouts.guest'); })->name('home1');
Route::get('/home', function () { Auth::loginUsingId(1); return view('home')->extends('guest'); })->name('home2');
Route::get('modulos',ModuloComponent::class)->name('modulos');
Route::get('empresas', EmpresaComponent::class)->name('empresas');
Route::get('empresausuarios',EmpresaUsuariosComponent::class)->name('empresausuarios');
Route::get('empresamodulos',EmpresaModulosComponent::class)->name('empresamodulos');
Route::get('modulousuarios',ModuloUsuariosComponent::class)->name('modulousuarios');
Route::get('empresagestion',EmpresaGestion::class)->name('empresagestion');
Route::get('tags',TagComponent::class)->name('tags');
Route::get('unidades',UnidadComponent::class)->name('unidades');
Route::get('categoriaproducto',CategoriaproductoComponent::class)->name('categoriaproducto');
Route::get('estados',EstadoComponent::class)->name('estados');
Route::get('productos',ProductoComponent::class)->name('productos');
Route::get('tablas',TablasComponent::class)->name('tablas');
Route::get('tablas-edit',EditarTablaComponent::class)->name('tablas-edit');
Route::get('tablas-ver',VisualizarTablaComponent::class)->name('tablas-ver');
Route::get('tablas-disenar',DisenarComponent::class)->name('tablas-disenar');
Route::get('haberes',HaberesComponent::class)->name('haberes');
Route::get('categoriaprofesional',CategoriaprofesionalComponent::class)->name('categoriaprofesional');
Route::get('certificados',CertificadoComponent::class)->name('certificados');
Route::get('roles', RolesComponent::class)->name('roles');
Route::get('gestionmodulos', GestionModuloComponent::class)->name('gestionmodulos');
Route::get('areas',AreaComponent::class)->name('areas');
Route::get('cuentas',CuentaComponent::class)->name('cuentas');
Route::get('clientes',ClienteComponent::class)->name('clientes');
Route::get('empleados',EmpleadoComponent::class)->name('empleados');
Route::get('proveedores',ProveedorComponent::class)->name('proveedores');


