<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ImprimirPDF;
use App\Http\Controllers\ImprimirPDFInformes;

use Livewire\Livewire;


//use App\Http\Livewire\Categoria\CategoriaProductoComponent;
use App\Http\Livewire\EmpresaGestion\EmpresaGestion;
use App\Http\Livewire\EmpresaModulos\EmpresaModulosComponent;
use App\Http\Livewire\EmpresaUsuarios\EmpresaUsuariosComponent;
use App\Http\Livewire\ModuloUsuarios\ModuloUsuariosComponent;
use App\Http\Livewire\Modulo\ModuloComponent;
use App\Http\Livewire\GestionModulos\GestionModuloComponent;
use App\Http\Livewire\Empresa\EmpresaComponent;
use App\Http\Livewire\Roles\RolesComponent;

use App\Http\Livewire\Area\AreaComponent;
use App\Http\Livewire\Categorias\CategoriasComponent;
use App\Http\Livewire\Cuenta\CuentaComponent;
use App\Http\Livewire\Elementos\ElementosComponent;
use App\Http\Livewire\Estado\EstadoComponent;
use App\Http\Livewire\Estadosciviles\EstadosCivilesComponent;
use App\Http\Livewire\Proveedor\ProveedorComponent;
use App\Http\Livewire\Tiposdedocumentos\TiposDeDocumentosComponent;
use App\Http\Livewire\Unidad\UnidadComponent;

use App\Http\Livewire\Localidades\LocalidadesComponent;
use App\Http\Livewire\Nacionalidad\NacionalidadComponent;
use App\Http\Livewire\Provincias\ProvinciasComponent;

// ERP
// =======

use App\Http\Livewire\erp\Certificado\CertificadoComponent;

use App\Http\Livewire\erp\Categoria\CategoriaproductoComponent;
use App\Http\Livewire\erp\Categoriaprofesional\CategoriaprofesionalComponent;
use App\Http\Livewire\erp\Cliente\ClienteComponent;
use App\Http\Livewire\erp\Compra\CompraSimpleComponent;
use App\Http\Livewire\erp\Compra\CompraComponent;
use App\Http\Livewire\erp\Empleado\EmpleadoComponent;
use App\Http\Livewire\erp\Haberes\HaberesComponent;
use App\Http\Livewire\erp\Producto\ProductoComponent;
use App\Http\Livewire\erp\Tag\TagComponent;
use App\Http\Livewire\erp\Venta\VentaComponent;
use App\Http\Livewire\erp\Venta\VentaMostradorComponent;

use App\Http\Livewire\erp\Tablas\TablasComponent;
use App\Http\Livewire\erp\Tablas\EditarTablaComponent;
use App\Http\Livewire\erp\Tablas\VisualizarTablaComponent;
use App\Http\Livewire\erp\Tablas\DisenarComponent;

// Geri
// ===============================================
use App\Http\Livewire\Geri\Actores\ActorComponent;
use App\Http\Livewire\Geri\Beneficios\clsBeneficios;
use App\Http\Livewire\Geri\Escolaridades\EscolaridadesComponent;
use App\Http\Livewire\Geri\Estadocama\EstadocamaComponent;
use App\Http\Livewire\Geri\Gradodependencia\GradodependenciaComponent;
use App\Http\Livewire\Geri\Habitacion\Habitacion;
use App\Http\Livewire\Geri\Informes\InformeComponent;
use App\Http\Livewire\Geri\Motivoegreso\MotivoegresoComponent;
use App\Http\Livewire\Geri\Personactivo\PersonActivoComponent;
use App\Http\Livewire\Geri\Tiposdepersonas\TiposDePersonasComponent;



use App\Http\Livewire\Geri\Personas\PersonaComponent;
use App\Http\Livewire\Geri\PersonaCampos\PersonasCamposComponent;
use App\Http\Livewire\Geri\Interfaces\InterfacesComponent;
use App\Http\Livewire\Geri\Medicamentos\MedicamentosComponent;
use App\Http\Livewire\Geri\Menu\MenuComponent;
use App\Http\Livewire\Geri\Ingredientes\IngredientesComponent;

use App\Http\Livewire\erp\Cart\Payment\PaymentComponent;
use App\Http\Livewire\erp\Cart\Cart;
use App\Http\Controllers\Productos;

// use App\Http\Livewire\Empresa\EmpresaComponent;
// use App\Http\Livewire\EmpresaGestion\EmpresaGestion;
// use App\Http\Livewire\EmpresaModulos\EmpresaModulosComponent;
// use App\Http\Livewire\EmpresaUsuarios\EmpresaUsuariosComponent;
// use App\Http\Livewire\ModuloUsuarios\ModuloUsuariosComponent;
// use App\Http\Livewire\Unidad\UnidadComponent;

// use App\Http\Controllers\ClsOtrasCosasController;
// use App\Http\Controllers\Admin\Settings;
// use Barryvdh\DomPDF\Facade\Pdf as PDF;

Route::get('/dasboard', function () {
    return view('empresas');
})->name('dashboard');

// Livewire::setUpdateRoute(function ($handle) {
//     return Route::post('/custom/livewire/update', $handle);
// });

// Route::get('/', EmpresaComponent::class)->name('inicio');

// Ruta Inicial
// ============
//Route::get('/', function () { return view('home')->extends('layouts.guest'); })->name('home1');
//Route::get('/', function () { return redirect()->route('public/login'); }); // return view('welcome');   
// php artisan route:clear
Route::get('/', function () { return redirect()->route('login'); }); // return view('welcome'); 

Route::get('/home', function () { Auth::loginUsingId(1); return view('home')->extends('guest'); })->name('home2');

Route::get('areas',AreaComponent::class)->name('areas');
Route::get('categorias',CategoriasComponent::class)->name('categorias');
Route::get('categoriaprofesional',CategoriaprofesionalComponent::class)->name('categoriaprofesional');
Route::get('categoriaproducto',CategoriaproductoComponent::class)->name('categoriaproducto');
Route::get('certificados',CertificadoComponent::class)->name('certificados');
Route::get('clientes',ClienteComponent::class)->name('clientes');
Route::get('compras',CompraComponent::class)->name('compras');
Route::get('cuentas',CuentaComponent::class)->name('cuentas');
Route::get('elementos',ElementosComponent::class)->name('elementos');
Route::get('empleados',EmpleadoComponent::class)->name('empleados');
Route::get('empresas', EmpresaComponent::class)->name('empresas');
Route::get('empresagestion',EmpresaGestion::class)->name('empresagestion');
Route::get('empresamodulos',EmpresaModulosComponent::class)->name('empresamodulos');
Route::get('empresausuarios',EmpresaUsuariosComponent::class)->name('empresausuarios');
Route::get('estados',EstadoComponent::class)->name('estados');
Route::get('haberes',HaberesComponent::class)->name('haberes');
Route::get('localidades',LocalidadesComponent::class)->name('localidades');
Route::get('modulos',ModuloComponent::class)->name('modulos');
Route::get('modulousuarios',ModuloUsuariosComponent::class)->name('modulousuarios');
Route::get('gestionmodulos', GestionModuloComponent::class)->name('gestionmodulos');
Route::get('nacionalidad',NacionalidadComponent::class)->name('nacionalidad');
Route::get('productos',ProductoComponent::class)->name('productos');

Route::get('producto/addtag/{product_id}/{tag_id}', [Productos::class, 'addtag'])->name('producto.addtag');
Route::get('producto/deltag/{product_id}/{tag_id}', [Productos::class, 'deltag'])->name('producto.deltag');
Route::get('producto/tag', [Productos::class, 'tag'])->name('producto.tag');
Route::get('producto/{producto}/tagedit', [Productos::class, 'tagedit'])->name('producto.tagedit');
Route::resource('producto',Productos::class);
Route::get('producto/productobajas', [Productos::class, 'productobajas'])->name('producto.productobajas');
Route::get('carts',Cart::class)->name('carts');
Route::get('payments',PaymentComponent::class)->name('payments');




Route::get('proveedores',ProveedorComponent::class)->name('proveedores');
Route::get('provincias',ProvinciasComponent::class)->name('provincias');
Route::get('roles', RolesComponent::class)->name('roles');
Route::get('tablas',TablasComponent::class)->name('tablas');
Route::get('tablas-edit',EditarTablaComponent::class)->name('tablas-edit');
Route::get('tablasver',VisualizarTablaComponent::class)->name('tablasver');
Route::get('tablas-disenar',DisenarComponent::class)->name('tablas-disenar');
Route::get('tags',TagComponent::class)->name('tags');
Route::get('unidades',UnidadComponent::class)->name('unidades');
Route::get('ventas',VentaComponent::class)->name('ventas');
Route::get('VentaSimple',CompraSimpleComponent::class)->name('VentaSimple');
Route::get('ventasmostrador',VentaMostradorComponent::class)->name('ventasmostrador');

Route::get('pdf/deuda/{ddesde}/{dhasta}', [ImprimirPDF::class, 'DeudaPFD'])->name('DeudaPFD');
Route::get('pdf/credito/{cdesde}/{chasta}', [ImprimirPDF::class, 'CreditoPFD'])->name('CreditoPFD');
Route::get('pdf/ivacompras/{anio}/{mes}', [ImprimirPDF::class, 'IvaCompras'])->name('IvaCompras');
Route::get('pdf/ivaventas/{anio}/{mes}', [ImprimirPDF::class, 'IvaVentas'])->name('IvaVentas');

Route::get('pdf/recibos/{anio}/{mes}/{empleadoseleccionado}', [ImprimirPDF::class, 'Recibo'])->name('Recibos');
Route::get('pdf/informes/{nombre}', [VisualizarTablaComponent::class, 'GenerarPDF'])->name('InformePFD');

// Route::get('pdf/informes/{empresa_id}/{informe_name}', [ImprimirPDFInformes::class, 'PDF'])->name('InformePFD');


// ROUTES PARA GERI
// =================

Route::get('actores',ActorComponent::class)->name('actores');
Route::get('beneficios',clsBeneficios::class)->name('crudBeneficios');
Route::get('escolaridades',EscolaridadesComponent::class)->name('escolaridades');
Route::get('estadocama',EstadocamaComponent::class)->name('estadocama');
Route::get('estadosciviles',EstadosCivilesComponent::class)->name('crudEstadosCiviles');
Route::get('gradodependencia',GradodependenciaComponent::class)->name('gradodependencia');
Route::get('habitaciones',Habitacion::class)->name('habitaciones');
Route::get('informes',InformeComponent::class)->name('informes');
Route::get('ingredientes',IngredientesComponent::class)->name('ingredientes');
Route::get('interfaces',InterfacesComponent::class)->name('interfaces');
Route::get('medicamentos',MedicamentosComponent::class)->name('medicamentos');
Route::get('menu',MenuComponent::class)->name('menu');
Route::get('motivoegreso',MotivoegresoComponent::class)->name('motivoegreso');
Route::get('personascampos',PersonasCamposComponent::class)->name('personascampos');
Route::get('personactivo',PersonActivoComponent::class)->name('crudPersonActivo');
Route::get('personas',ActorComponent::class)->name('personas');
Route::get('tiposdedocumentos',TiposDeDocumentosComponent::class)->name('crudTiposDeDocumentos');
Route::get('tiposdepersonas',TiposDePersonasComponent::class)->name('crudTiposDePersonas');
Route::get('pdf/informes', ActorComponent::class, 'showPDF');

Route::get('modalpreguntas',[ActorComponent::class,'ResponderInforme1'])->name('modalpreguntas');

// Route::get('areas',AreasComponent::class)->name('areas');

// Route::get('settings',[Settings::class,'index'])->name('admin.settings.index');
// Route::get('settings/beneficios',[clsBeneficios::class,'index'])->name('admin.settings.beneficios.index');
// Route::get('settings/beneficios', clsBeneficios::class);
// Route::get('settings/beneficios',[clsBeneficios::class,'index'])->name('liveware.settings.beneficios');
// Route::get('settings/beneficios',[clsBeneficios::class,'render'])->name('liveware.crudbeneficios');
// Route::get('settings/beneficios',[clsBeneficios::class,'render'])->name('liveware.crudbeneficios');
// Route::get('beneficios/createbeneficios',[clsBeneficios::class,'create'])->name('beneficios.create');
// Route::get('prueba',clsBeneficios::class);
// Route::get('otrascosas',[ClsOtrasCosasController::class,'index'])->name('admin.otrascosas');
// Route::get('otrascosas',ClsOtrasCosasController::class)->name('admin.otrascosas');
// Route::get('otrascosas',Liveotra::class)->name('admin.otrascosas');
// Route::get('empresas',EmpresaComponent::class)->name('empresas');
// Route::get('empresausuarios',EmpresaUsuariosComponent::class)->name('empresausuarios');
// Route::get('empresamodulos',EmpresaModulosComponent::class)->name('empresamodulos');
// Route::get('modulousuarios',ModuloUsuariosComponent::class)->name('modulousuarios');
// Route::get('empresagestion',EmpresaGestion::class)->name('empresagestion');
// Route::get('unidades',UnidadComponent::class)->name('unidades');
// Route::get('personas',PersonaComponent::class)->name('personas');
