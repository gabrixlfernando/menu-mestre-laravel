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

Route::post('login', [FuncionarioController::class, 'login']);

// Route::prefix('adm')->group(function ()

Route::middleware('auth:sanctum', 'funcionario')->group(function () {
    // Cardapio
    Route::get('/cardapio', [CardapioController::class, 'index']);
    Route::get('/cardapio/{id}', [CardapioController::class, 'show']);
    Route::put('/cardapio/{idProduto}/desativar', [CardapioController::class, 'desativarProduto']);
    Route::put('/cardapio/{idProduto}/ativar', [CardapioController::class, 'ativarProduto']);
    Route::post('/cardapio', [CardapioController::class, 'createProduto']);
    Route::post('/cardapio/{idProduto}', [CardapioController::class, 'store']);


    // Mesa
    Route::get('/mesa', [MesaController::class, 'index']);
    Route::get('/mesa/{id}', [MesaController::class, 'show']);
    Route::post('/mesa', [MesaController::class, 'createMesa']);
    Route::put('/mesa/{id}/desativar', [MesaController::class, 'desativarMesa']);
    Route::put('/mesa/{id}/ativar', [MesaController::class, 'ativarMesa']);
    // Rotas para Gerenciamento de Produtos nas Mesas
    Route::post('/mesa/{id}/produtos', [MesaController::class, 'adicionarProduto']); // Adiciona produtos a uma mesa específica
    Route::post('/mesa/{id}/remover-produto', [MesaController::class, 'removerProduto']); // Remove um produto específico de uma mesa
    Route::post('/mesa/{id}/fechar', [MesaController::class, 'fecharMesa']); // Fecha uma mesa específica
    //atualizar
    Route::post('/mesa/{id}', [MesaController::class, 'store']);

    // Funcionario
    Route::get('/funcionario', [FuncionarioController::class, 'index']);
    Route::get('/funcionario/{id}', [FuncionarioController::class, 'show']);
    Route::get('/funcionario/vendas/{id}', [FuncionarioController::class, 'dadosVendas']);
    Route::post('/funcionario', [FuncionarioController::class, 'createFuncionario']);
    //atualizar
    Route::post('/funcionario/{idFuncionario}', [FuncionarioController::class, 'store']);



    // Contato
    Route::get('/contato', [ContatoController::class, 'index']);
    Route::get('/contato/{id}', [ContatoController::class, 'show']);


    // Dashboard

    Route::get('/dashboard', [AdministrativoController::class, 'getDashboard']);
});
