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