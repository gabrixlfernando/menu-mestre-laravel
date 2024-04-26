<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    public function index()
    {
        $contatos = Contato::all();
        return response()->json($contatos);
    }

    public function show($id)
    {
        $contato = Contato::find($id);
        if (!$contato) {
            return response()->json(['error' => 'Contato não encontrado'], 404);
        }
        return response()->json($contato);
    }
}
