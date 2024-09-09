<?php

use Illuminate\Support\Facades\Route;
use App\Charts\Graficos\Chart;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImprimirPDF;
// use App\Http\Livewire\Empresa\EmpresaComponent;

use App\Http\Controllers\SocialController;
use App\Http\Livewire\Compra\CompraSimpleComponent;

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes()->prefix('');
Route::get('/', function () { return view('welcome'); });


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Login with Facebook
Route::get('login-facebook', [App\Http\Controllers\Auth\LoginSocialController::class,'redirect_facebook']);
Route::get('facebook-callback-url', [App\Http\Controllers\Auth\LoginSocialController::class,'callback_facebook']);
Route::post('/home',[HomeController::class,'upload']);

//Route::get('empresagestion',EmpresaGestion::class)->name('empresagestion');
//Route::get('pdf/deuda/{ddesde}/{dhasta}', [ImprimirPDF::class, 'DeudaPFD'])->name('DeudaPFD');
//Route::get('pdf/credito/{cdesde}/{chasta}', [ImprimirPDF::class, 'CreditoPFD'])->name('CreditoPFD');
// Route::get('/', EmpresaComponent::class)->name('inicio');
// Route::get('/cart', [App\Http\Controllers\Cart::class, 'index']);





// Route::get('carts/single/{{id}}',[Cart::class,'single'])->name('cart.single');
// Route::get('payments',[Cart::class,'payment_index'])->name('payments');
//Route::get('payments',[Cart::class,'payment_index'])->name('payments');

//Route::get('deletion/?id=abc123',EmpleadoComponent::class)->name('deletion'); //Eliminación de datos en Facebook

// Route::get('/search/', 'ProveedorComponent@search')->name('search');



Route::get('pruebas', [Chart::class, 'index'])->name('pruebas');