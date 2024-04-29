<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    public function index()
    {
        // $funcionarios = Funcionario::all();
        // return response()->json($funcionarios);

        // Consulta todos os funcionários do tipo "administrativo"
        $administradores = Funcionario::where('tipoFuncionario', 'administrativo')->get();

        // Consulta todos os funcionários do tipo "atendente"
        $atendentes = Funcionario::where('tipoFuncionario', 'atendente')->get();

        // Construir array com os dados
        $data = [
            'administradores' => $administradores,
            'atendentes' => $atendentes,
        ];

        // Retornar os dados em formato JSON
        return response()->json($data);
    }

    public function show($id)
    {
        $funcionario = Funcionario::find($id);
        if (!$funcionario) {
            return response()->json(['error' => 'Funcionário não encontrado'], 404);
        }
        return response()->json($funcionario);
    }
}
