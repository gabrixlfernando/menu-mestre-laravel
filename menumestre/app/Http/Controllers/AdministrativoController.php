<?php

namespace App\Http\Controllers;

use App\Models\Cardapio;
use App\Models\Funcionario;
use App\Models\Mesa;
use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Http\Request;


class AdministrativoController extends Controller
{
    public function index()
    {
        // Recuperando o total de funcionários
        $totalFuncionarios = Funcionario::count();

        $totalPratos = Cardapio::count();

        $totalMesas = Mesa::count();
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
        return view('dashboard.administrativo.index', compact('funcionario', 'totalFuncionarios', 'totalPratos', 'totalMesas'));
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



        // Consulta todos os funcionários com tipo "administrativo"
        $administradores = Funcionario::where('tipoFuncionario', 'administrativo')->get();

        // Substituir "administrativo" por "Gerente" nos resultados
        foreach ($administradores as $administrador) {
            $administrador->tipoFuncionario = 'Gerente';
        }

        // Consulta todos os funcionários com tipo "atendente"
        $atendentes = Funcionario::where('tipoFuncionario', 'atendente')->get();

        // return view('dashboard.administrativo.cardapio', compact('funcionario'), ['cardapio' => $cardapio]);

        return view('dashboard.administrativo.funcionario', compact('funcionario', 'administradores', 'atendentes'));
    }

    public function mesa()
    {
        $mesas = Mesa::all();

        $id = session('id');

        //busacando o funcionario pelo id no banco de dados
        $funcionario = Funcionario::find($id);


        // return view('dashboard.administrativo.cardapio', compact('funcionario'), ['cardapio' => $cardapio]);

        return view('dashboard.administrativo.mesa', compact('mesas','funcionario'));
    }


    public function statusMesa(Request $request)
    {
        $mesa = Mesa::findOrFail($request->mesaId); // Encontra a mesa pelo ID

        // Atualiza o status e a capacidade da mesa com os valores recebidos do formulário
        $mesa->status = $request->statusMesa;
        $mesa->capacidade = $request->capacidadeMesa;

        $mesa->save(); // Salva as alterações no banco de dados

        return response()->json(['message' => 'Status e capacidade da mesa atualizados com sucesso']);
    }
}
