<?php

use App\Http\Controllers\AdministrativoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\AutRestauranteMiddleware;
use App\Http\Middleware\LogAcessoRestaurante;
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
// página home site
Route::get('/',[HomeController::class, 'index'])->name('home');
Route::get('/',[HomeController::class, 'exibirCardapio'])->name('cardapio.site');
Route::post('/', [HomeController::class, 'salvarNoBanco'])->name('contato.enviar');

// login admin

Route::get('/admin', [LoginController::class, 'index'])->name('login');

// autenticação
Route::post('/admin', [LoginController::class, 'autenticar'])->name('login');

Route::middleware(['autenticacao:administrativo'])->group(function(){

    // Dashboard
    Route::get('/dashboard/administrativo', [AdministrativoController::class, 'index'])->name('dashboard.administrativo');

    // Cardapio
    Route::get('/dashboard/administrativo/cardapio', [AdministrativoController::class, 'cardapio'])->name('dashboard.administrativo.cardapio');

    Route::get('/dashboard/administrativo/cardapio/desativar-produto/{idProduto}', [AdministrativoController::class, 'desativarProduto'])->name('dashboard.administrativo.cardapio.desativar');

    Route::get('/dashboard/administrativo/cardapio/ativar-produto/{idProduto}', [AdministrativoController::class, 'ativarProduto'])->name('ativar.produto');

    Route::post('/dashboard/administrativo/produtos/create', [AdministrativoController::class, 'createProduto'])->name('admin.produto.create');

    Route::get('/dashboard/administrativo/cardapio/edit/{idProduto}', [AdministrativoController::class, 'editProduto'])->name('admin.produto.edit');

    Route::put('/dashboard/administrativo/produtos/update/{idProduto}', [AdministrativoController::class, 'updateProduto'])->name('admin.produto.update');

    // Funcionarios
    Route::get('/dashboard/administrativo/funcionario', [AdministrativoController::class, 'funcionario'])->name('dashboard.administrativo.funcionario');

    Route::post('/dashboard/administrativo/funcionario/create', [AdministrativoController::class, 'createFuncionario'])->name('admin.funcionario.create');

    Route::get('/dashboard/administrativo/funcionario/edit/{idFuncionario}', [AdministrativoController::class, 'editFuncionario'])->name('admin.funcionario.edit');

    Route::put('/dashboard/administrativo/funcionario/update/{idFuncionario}', [AdministrativoController::class, 'updateFuncionario'])->name('admin.funcionario.update');


    // Mesas
    Route::get('/dashboard/administrativo/mesa', [AdministrativoController::class, 'mesa'])->name('dashboard.administrativo.mesa');

    Route::get('/dashboard/administrativo/mesa/edit/{id}', [AdministrativoController::class, 'editMesa'])->name('mesa.edit');

    Route::put('/dashboard/administrativo/mesa/update/{id}', [AdministrativoController::class, 'updateMesa'])->name('mesa.update');

    Route::post('/dashboard/administrativo/mesa/create', [AdministrativoController::class, 'createMesa'])->name('mesa.create');

    Route::get('/dashboard/administrativo/mesa/desativar-mesa/{id}', [AdministrativoController::class, 'desativarMesa'])->name('mesa.desativar');

    Route::get('/dashboard/administrativo/mesa/ativar-mesa/{id}', [AdministrativoController::class, 'ativarMesa'])->name('mesa.ativar');

    Route::get('/dashboard/administrativo/mesa/ativar-mesa/{id}', [AdministrativoController::class, 'ativarMesa'])->name('mesa.ativar');

    Route::get('/dashboard/administrativo/mesa/show/{id}', [AdministrativoController::class, 'showMesa'])->name('mesa.show');

    Route::put('/dashboard/administrativo/mesa/fechar/{id}', [AdministrativoController::class, 'fecharMesa'])->name('mesa.fechar');

    Route::post('/dashboard/administrativo/mesa/adicionar', [AdministrativoController::class, 'adicionarProduto'])->name('mesa.adicionar');





    // Contato (Página Mensagens)
    Route::get('/dashboard/administrativo/contato', [AdministrativoController::class, 'contato'])->name('dashboard.administrativo.contato');

    Route::get('/dashboard/administrativo/contato/show/{id}', [AdministrativoController::class, 'showContato'])->name('contato.show');

    Route::put('/atualizar-lido/{id}', [AdministrativoController::class, 'atualizarLido'])->name('contato.atualizar-lido');

    Route::get('/verificar-lido/{id}', [AdministrativoController::class, 'verificarLido'])->name('contato.verificar-lido');


    Route::get('/dashboard/administrativo/contato/show/{id}', [AdministrativoController::class, 'showContato'])->name('contato.show');

    Route::put('/atualizar-lido/{id}', [AdministrativoController::class, 'atualizarLido'])->name('contato.atualizar-lido');

    Route::get('/verificar-lido/{id}', [AdministrativoController::class, 'verificarLido'])->name('contato.verificar-lido');
});


// Route::get('/dashboard/administrativo', [AdministrativoController::class, 'index'])->name('dashboard.administrativo');


// logout
Route::get('/sair', function(){
    session()->flush();
    return redirect('/');
})->name('sair');
