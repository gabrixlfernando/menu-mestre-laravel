<?php

namespace App\Http\Controllers;

use App\Models\Cardapio;
use App\Models\Funcionario;
use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Http\Request;


class AdministrativoController extends Controller
{
    public function index()
    {

        //recuperando o id do funcionario da sessão

        $id = session('id');

        //busacando o funcionario pelo id no banco de dados
        $funcionario = Funcionario::find($id);

        //verificando se o funcionario foi encontrado
        if (!$funcionario) {

            //se o funcionario não foi encontrado emite uma tela de erro
            abort(404, 'Funcionario não encontrado!');
        }

        //passando o objeto $funcionario para view

        //dd($funcionario);
        return view('dashboard.administrativo.index', compact('funcionario'));
    }

    public function cardapio()
    {

        $id = session('id');

        //busacando o funcionario pelo id no banco de dados
        $funcionario = Funcionario::find($id);

        //  $cardapio = Cardapio::all();

        $cardapio = Cardapio::orderBy('idProduto', 'desc')->get();



        // return view('dashboard.administrativo.cardapio', compact('funcionario'), ['cardapio' => $cardapio]);

        return view('dashboard.administrativo.cardapio', compact('funcionario', 'cardapio'));
    }



    public function desativarProduto($idProduto)
    {
        // Encontre o produto pelo ID
        $cardapio = Cardapio::find($idProduto);

        // Verifique se o produto foi encontrado
        if ($cardapio) {
            // Atualize o status para "inativo"
            $cardapio->statusProduto = 'inativo';
            $cardapio->save();


            Alert::success('Desativado!', 'O item não está mais visível no site.');

            // return redirect()->back()->with('success', 'O produto foi desativado com sucesso.');

            return redirect()->route('dashboard.administrativo.cardapio');
        } else {
            Alert::error('Erro!', 'Ocorreu um erro ao desativar o item.');
            return redirect()->route('dashboard.administrativo.cardapio');
        }
    }


    public function ativarProduto($idProduto)
    {
        $cardapio = Cardapio::find($idProduto);

        if ($cardapio) {
            $cardapio->statusProduto = 'ativo';
            $cardapio->save();

            Alert::success('Ativado!', 'O item está visível no site.');

            return redirect()->route('dashboard.administrativo.cardapio');

            // return redirect()->back()->with('success', 'Produto ativado com sucesso.');
        } else {
            Alert::error('Erro!', 'Ocorreu um erro ao ativar o item.');
            return redirect()->route('dashboard.administrativo.cardapio');
        }
    }



    public function funcionario()
    {

        $id = session('id');

        //busacando o funcionario pelo id no banco de dados
        $funcionario = Funcionario::find($id);

        $administradores = Funcionario::where('tipoFuncionario', 'administrativo')->get();

        // Consulta todos os funcionários com tipo "atendente"
        $atendentes = Funcionario::where('tipoFuncionario', 'atendente')->get();

        // return view('dashboard.administrativo.cardapio', compact('funcionario'), ['cardapio' => $cardapio]);

        return view('dashboard.administrativo.funcionario', compact('funcionario','administradores', 'atendentes'));
    }



}
