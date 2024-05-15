<?php

namespace App\Http\Controllers;

use App\Models\Cardapio;
use Illuminate\Http\Request;

class CardapioController extends Controller
{
    public function index()
    {
        // $cardapios = Cardapio::all();
         $cardapios = Cardapio::orderBy('idProduto', 'desc')->get();
        return response()->json($cardapios);
    }

    public function show($id)
    {
        $cardapio = Cardapio::find($id);
        if (!$cardapio) {
            return response()->json(['error' => 'Item do cardápio não encontrado'], 404);
        }
        return response()->json($cardapio);
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

            // Retorna a resposta JSON com sucesso
            return response()->json(['message' => 'Produto desativado com sucesso!', 'produto' => $cardapio], 200);
        } else {
            // Retorna a resposta JSON com erro
            return response()->json(['error' => 'Produto não encontrado'], 404);
        }
    }

    public function ativarProduto($idProduto)
    {
        // Encontre o produto pelo ID
        $cardapio = Cardapio::find($idProduto);

        // Verifique se o produto foi encontrado
        if ($cardapio) {
            // Atualize o status para "ativo"
            $cardapio->statusProduto = 'ativo';
            $cardapio->save();

            // Retorna a resposta JSON com sucesso
            return response()->json(['message' => 'Produto ativado com sucesso!', 'produto' => $cardapio], 200);
        } else {
            // Retorna a resposta JSON com erro
            return response()->json(['error' => 'Produto não encontrado'], 404);
        }
    }
}
