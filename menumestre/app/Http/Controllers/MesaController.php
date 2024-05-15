<?php

namespace App\Http\Controllers;

use App\Models\Mesa;
use Illuminate\Http\Request;

class MesaController extends Controller
{
    public function index()
    {
        $mesas = Mesa::all();
        return response()->json($mesas);
    }

    public function show($id)
    {
        $mesa = Mesa::find($id);
        if (!$mesa) {
            return response()->json(['error' => 'Mesa não encontrada'], 404);
        }
        return response()->json($mesa);
    }

    public function createMesa(Request $request)
    {
        // Validação dos dados do formulário
        $validatedData = $request->validate([
            'capacidade' => 'required|integer',
            'status' => 'required|in:disponivel,reservada,ocupada',
            // 'preco' => 'required|numeric',
        ]);

        // Obtenha o número da última mesa cadastrada
        $ultimaMesa = Mesa::orderBy('id', 'desc')->first();

        // Determine o número para a nova mesa (último número + 1)
        $numeroMesa = $ultimaMesa ? $ultimaMesa->numero_mesa + 1 : 1;

        // Criação da nova mesa
        $mesa = new Mesa();
        $mesa->numero_mesa = $numeroMesa;
        $mesa->capacidade = $validatedData['capacidade'];
        $mesa->status = $validatedData['status'];
        // $mesa->preco = $validatedData['preco'];
        $mesa->save();

        // Retorna a resposta JSON com a nova mesa criada
        return response()->json(['message' => 'Mesa cadastrada com sucesso!', 'mesa' => $mesa], 201);
    }

    public function desativarMesa($id)
    {
        // Encontre a mesa pelo ID
        $mesa = Mesa::find($id);

        // Verifique se a mesa foi encontrada
        if ($mesa) {
            // Atualize o status para "inativo"
            $mesa->status = 'inativo';
            $mesa->save();

            // Retorna a resposta JSON com sucesso
            return response()->json(['message' => 'Mesa desativada com sucesso!', 'mesa' => $mesa], 200);
        } else {
            // Retorna a resposta JSON com erro
            return response()->json(['error' => 'Mesa não encontrada'], 404);
        }
    }

    public function ativarMesa($id)
    {
        // Encontre a mesa pelo ID
        $mesa = Mesa::find($id);

        // Verifique se a mesa foi encontrada
        if ($mesa) {
            // Atualize o status para "disponível"
            $mesa->status = 'disponivel';
            $mesa->save();

            // Retorna a resposta JSON com sucesso
            return response()->json(['message' => 'Mesa ativada com sucesso!', 'mesa' => $mesa], 200);
        } else {
            // Retorna a resposta JSON com erro
            return response()->json(['error' => 'Mesa não encontrada'], 404);
        }
    }

    
}
