<?php

namespace App\Http\Controllers;

use App\Models\Mesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function store(Request $request, $id)
    {
        // Validação dos dados recebidos
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:disponivel,ocupada,reservada',
            'pessoas_sentadas' => 'required_if:status,ocupada|integer|min:0',
        ]);

        // Se a validação falhar, retorne a mensagem de erro
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Encontre a mesa pelo ID
        $mesa = Mesa::findOrFail($id);

        // Verifique se o número de pessoas sentadas não excede a capacidade máxima
        if ($request->input('pessoas_sentadas') > $mesa->capacidade) {
            return response()->json(['error' => 'O número de pessoas sentadas excede a capacidade máxima da mesa.'], 400);
        }

        // Atualize os dados da mesa
        $mesa->status = $request->input('status');

        // Se o status for "disponível", defina pessoas_sentadas como 0, caso contrário, obtenha o valor do formulário
        if ($mesa->status === 'disponivel') {
            $mesa->pessoas_sentadas = 0;
        } else {
            $mesa->pessoas_sentadas = $request->input('pessoas_sentadas');
        }

        // Salve as alterações no banco de dados
        $mesa->save();

        // Retorne os dados da mesa atualizados em formato JSON
        return response()->json(['message' => 'Mesa atualizada com sucesso', 'mesa' => $mesa], 200);
    }
}
