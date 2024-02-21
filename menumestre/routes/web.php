<?php

use App\Http\Controllers\AdministrativoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\AutRestauranteMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/',[HomeController::class, 'index'])->name('home');

// login

Route::get('/admin', [LoginController::class, 'index'])->name('login');

// autenticação
Route::post('/admin', [LoginController::class, 'autenticar'])->name('login');

Route::middleware(['autenticacao:administrativo'])->group(function(){

    Route::get('/dashboard/administrativo', [AdministrativoController::class, 'index'])->name('dashboard.administrativo');

    Route::get('/dashboard/administrativo/cardapio', [AdministrativoController::class, 'cardapio'])->name('dashboard.administrativo.cardapio');

    Route::get('/dashboard/administrativo/cardapio/desativar-produto/{idProduto}', [AdministrativoController::class, 'desativarProduto'])->name('dashboard.administrativo.cardapio.desativar');

    Route::get('/dashboard/administrativo/cardapio/ativar-produto/{idProduto}', [AdministrativoController::class, 'ativarProduto'])->name('ativar.produto');


});


// Route::get('/dashboard/administrativo', [AdministrativoController::class, 'index'])->name('dashboard.administrativo');


// logout
Route::get('/sair', function(){
    session()->flush();
    return redirect('/');
})->name('sair');
