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
}
