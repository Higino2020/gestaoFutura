<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    UserController,
    ProdutoController,
    EntradaController,
    SaidaController,
    PreVendaController,
    FornecedorController,
    CategoriaController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('user', UserController::class);
Route::resource('produto', ProdutoController::class);
Route::resource('entradas', EntradaController::class);
Route::resource('saida', SaidaController::class);
Route::resource('prevenda', PreVendaController::class);
Route::resource('fornecedor', FornecedorController::class);
Route::resource('Categoria', CategoriaController::class);
//Routas Simplificas para cada efeito unico
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
