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

    public function store(Request $request, $idFuncionario)
{

    // ValidFuncionarioação dos campos
    $request->validate([
        'nomeFuncionario'       => 'string|max:255',
        'email'                 => 'email|max:255',
        'dataNascimento'        => 'date',
        'foneFuncionario'       => 'string|max:20',
        'enderecoFuncionario'   => 'string|max:255',
        'cidadeFuncionario'     => 'string|max:100',
        'estadoFuncionario'     => 'string|max:50',
        'cepFuncionario'        => 'string|max:10',
        'dataContratacao'       => 'date',
        'cargo'                 => 'string|max:100',
        'salario'               => 'numeric',
        'tipoFuncionario'       => 'in:administrativo,atendente,cozinheiro',
        'statusFuncionario'     => 'in:ativo,inativo',
        'fotoFuncionario'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Encontrar o funcionário pelo ID
    $funcionario = Funcionario::findOrFail($idFuncionario);



    // Atualizar apenas os campos fornecidos no request
    $funcionario->fill($request->only([
        'nomeFuncionario',
        'email',
        'dataNascimento',
        'foneFuncionario',
        'enderecoFuncionario',
        'cidadeFuncionario',
        'estadoFuncionario',
        'cepFuncionario',
        'dataContratacao',
        'cargo',
        'salario',
        'tipoFuncionario',
        'statusFuncionario',
    ]));

    // Verificar se uma nova imagem foi enviada
    if ($request->hasFile('fotoFuncionario')) {
        $fotoFuncionario = $request->file('fotoFuncionario');
        $nomeArquivo = $funcionario->idFuncionario . '_' . str_replace(' ', '_', $funcionario->nomeFuncionario) . '.' . $fotoFuncionario->getClientOriginalExtension();
        $caminhoDestino = public_path('assets/images/funcionarios/');

        // Remover a foto antiga se existir
        if ($funcionario->fotoFuncionario) {
            if (file_exists(public_path('assets/images/funcionarios/' . $funcionario->fotoFuncionario))) {
                unlink(public_path('assets/images/funcionarios/' . $funcionario->fotoFuncionario));
            }
        }

        // Mover a nova foto para o diretório de destino
        $fotoFuncionario->move($caminhoDestino, $nomeArquivo);

        // Atualizar o caminho da foto no modelo
        $funcionario->fotoFuncionario = $nomeArquivo;
        $funcionario->save();
    }
    // Salvar as mudanças
    $funcionario->save();

    // Criar uma resposta em JSON
    return response()->json([
        'message' => 'Funcionario Atualizado com sucesso!',
        'funcionario' => $funcionario
    ], 200);
}


}
