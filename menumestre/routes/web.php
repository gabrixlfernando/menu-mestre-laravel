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

});


// Route::get('/dashboard/administrativo', [AdministrativoController::class, 'index'])->name('dashboard.administrativo');


// logout
Route::get('/sair', function(){
    session()->flush();
    return redirect('/');
})->name('sair');
