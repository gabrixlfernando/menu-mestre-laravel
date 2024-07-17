<?php

namespace App\Http\Controllers;

use App\Mail\ContatoEmail;
use App\Models\Cardapio;
use App\Models\Contato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        return view('site.home');
    }

    public function salvarNoBanco(Request $request)
{
    $dados = $request->all();

    $validarDados = Validator::make($dados, [
        'nomeContato' => 'required|max:100',
        'emailContato' => 'required|email|max:100',
        'foneContato' => 'required|max:15',
        'assuntoContato' => 'required|max:100',
        'mensContato' => 'required',
    ]);

    if ($validarDados->fails()) {
        return response()->json(['erros' => $validarDados->errors()], 422);
    } else {
        $contato = Contato::create($validarDados->validated());

        try {
            Mail::to('cybercompany@smpsistema.com.br')->send(new ContatoEmail($contato));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao enviar e-mail: ' . $e->getMessage()], 500);
        }

        return response()->json(['success' => 'E-mail registrado com sucesso!']);
    }
}
    public function exibirCardapio()
    {
        // $cardapio = Cardapio::all();

        // Consulta todos os produtos com cada categoria
        $pratos = Cardapio::where('categoriaProduto', 'comida')->where('statusProduto', 'ativo')->get();
        $massas = Cardapio::where('categoriaProduto', 'massa')->where('statusProduto', 'ativo')->get();
        $bebidas = Cardapio::where('categoriaProduto', 'bebida')->where('statusProduto', 'ativo')->get();
        $sobremesas = Cardapio::where('categoriaProduto', 'sobremesa')->where('statusProduto', 'ativo')->get();

        return view('site.home', compact('pratos', 'massas', 'bebidas', 'sobremesas'));
    }
}
