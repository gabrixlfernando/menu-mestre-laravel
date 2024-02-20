<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;


class AdministrativoController extends Controller
{
    public function index(){

    //recuperando o id do funcionario da sessão

    $id = session('id');

    //busacando o funcionario pelo id no banco de dados
    $funcionario = Funcionario::find($id);

    //verificando se o funcionario foi encontrado
    if(!$funcionario) {

        //se o funcionario não foi encontrado emite uma tela de erro
        abort(404, 'Funcionario não encontrado!');
    }

    //passando o objeto $funcionario para view

    //dd($funcionario);
    return view('dashboard.administrativo.index', compact('funcionario'));

    }

    public function cardapio(){

        $id = session('id');

    //busacando o funcionario pelo id no banco de dados
    $funcionario = Funcionario::find($id);

        return view('dashboard.administrativo.cardapio', compact('funcionario'));
    }


}
