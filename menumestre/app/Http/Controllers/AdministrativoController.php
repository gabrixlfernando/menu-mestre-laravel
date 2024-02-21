<?php

namespace App\Http\Controllers;

use App\Models\Cardapio;
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

    //  $cardapio = Cardapio::all();

     $cardapio = Cardapio::orderBy('idProduto', 'desc')->get();



        // return view('dashboard.administrativo.cardapio', compact('funcionario'), ['cardapio' => $cardapio]);

        return view('dashboard.administrativo.cardapio', compact('funcionario', 'cardapio'));
    }



        public function desativarProduto($idProduto) {
            // Encontre o produto pelo ID
            $cardapio = Cardapio::find($idProduto);

            // Verifique se o produto foi encontrado
            if ($cardapio) {
                // Atualize o status para "inativo"
                $cardapio->statusProduto = 'inativo';
                $cardapio->save();


            //    // Exiba o alerta com SweetAlert
            //     echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
            //     echo "<script>
            //         Swal.fire({
            //             title: 'Desativado!',
            //             text: 'O item não está mais visível no site.',
            //             icon: 'success',
            //             confirmButtonText: 'OK'
            //         }).then(() => {
            //             window.location.href = '/dashboard/administrativo/cardapio';
            //         });
            //     </script>";
        return redirect()->back()->with('success', 'O produto foi desativado com sucesso.');

            } else {
                return redirect()->back()->with('error', 'Produto não encontrado.');
            }
        }


        public function ativarProduto($idProduto) {
            $cardapio = Cardapio::find($idProduto);

            if ($cardapio) {
                $cardapio->statusProduto = 'ativo';
                $cardapio->save();

                return redirect()->back()->with('success', 'Produto ativado com sucesso.');
            } else {
                return redirect()->back()->with('error', 'Produto não encontrado.');
            }
        }



}
