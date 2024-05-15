<?php

use App\Http\Controllers\AdministrativoController;
use App\Http\Controllers\CardapioController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\MesaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('adm')->group(function () {

    // Cardapio
    Route::get('/cardapio', [CardapioController::class, 'index']);
    Route::get('/cardapio/{id}', [CardapioController::class, 'show']);
    Route::put('/cardapio/{idProduto}/desativar', [CardapioController::class, 'desativarProduto']);
    Route::put('/cardapio/{idProduto}/ativar', [CardapioController::class, 'ativarProduto']);


    // Mesa
    Route::get('/mesa', [MesaController::class, 'index']);
    Route::get('/mesa/{id}', [MesaController::class, 'show']);
    Route::post('/mesa', [MesaController::class, 'createMesa']);
    Route::put('/mesa/{id}/desativar', [MesaController::class, 'desativarMesa']);
    Route::put('/mesa/{id}/ativar', [MesaController::class, 'ativarMesa']);

    // Funcionario
    Route::get('/funcionario', [FuncionarioController::class, 'index']);
    Route::get('/funcionario/{id}', [FuncionarioController::class, 'show']);
    Route::put('/funcionario/{idFuncionario}', [FuncionarioController::class, 'update']);
    

    // Contato
    Route::get('/contato', [ContatoController::class, 'index']);
    Route::get('/contato/{id}', [ContatoController::class, 'show']);


    // Dashboard

    Route::get('/dashboard', [AdministrativoController::class, 'getDashboard']);
});
