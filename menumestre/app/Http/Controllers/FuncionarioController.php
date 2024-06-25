<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Symfony\Contracts\Service\Attribute\Required;

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

    public function dadosVendas($id)
    {
        $funcionario = Funcionario::findOrFail($id);

        // Definindo o período mensal (mês atual)
        $inicioMes = now()->startOfMonth();
        $fimMes = now()->endOfMonth();

        // Total faturado com as vendas (valorTaxa) no mês atual
        $totalFaturado = $funcionario->comandas()
                                     ->whereBetween('created_at', [$inicioMes, $fimMes])
                                     ->sum('valorTaxa');

        // Total vendido em comandas com valorTaxa maior que zero no mês atual
        $totalVendido = $funcionario->comandas()
                                    ->where('valorTaxa', '>', 0)
                                    ->whereBetween('created_at', [$inicioMes, $fimMes])
                                    ->sum('total');

        // Contar o número de pedidos realizados pelo funcionário no mês atual
        $numPedidos = $funcionario->pedidos()
                                  ->whereBetween('created_at', [$inicioMes, $fimMes])
                                  ->count();

        // Contar o número de mesas atendidas pelo funcionário no mês atual
        $numMesasAtendidas = $funcionario->comandas()
                                         ->whereBetween('created_at', [$inicioMes, $fimMes])
                                         ->distinct('mesa_id')
                                         ->count('mesa_id');

        return response()->json([
            'funcionario' => [
                'id' => $funcionario->idFuncionario,
                'nome' => $funcionario->nomeFuncionario,
                'email' => $funcionario->email,
                'totalFaturado' => $totalFaturado,
                'totalVendido' => $totalVendido,
                'numPedidos' => $numPedidos,
                'numMesasAtendidas' => $numMesasAtendidas,
            ]
        ]);
    }


    public function createFuncionario(Request $request)
    {
        $request->merge([
            'dataContratacao' => now(),
            'criado_em' => now(),
            'atualizado_em' => now()
        ]);

        $validator = Validator::make($request->all(), [
            'nomeFuncionario'       => 'required|string|max:255',
            'email'                 => 'required|email|max:255',
            'dataNascimento'        => 'required|date',
            'foneFuncionario'       => 'required|string|max:20',
            'enderecoFuncionario'   => 'required|string|max:255',
            'cidadeFuncionario'     => 'required|string|max:100',
            'estadoFuncionario'     => 'required|string|max:50',
            'cepFuncionario'        => 'required|string|max:10',
            'dataContratacao'       => 'required|date',
            'cargo'                 => 'required|string|max:100',
            'salario'               => 'required|numeric',
            'tipoFuncionario'       => 'required|in:administrativo,atendente,cozinheiro',
            'fotoFuncionario'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $ultimoFuncionario = Funcionario::latest('idFuncionario')->first();
        $ultimoID = $ultimoFuncionario ? $ultimoFuncionario->idFuncionario : 0;

        $proximoID = $ultimoID + 1;

        $funcionario = new Funcionario();
        $funcionario->nomeFuncionario           = $request->input('nomeFuncionario');
        $funcionario->email                     = $request->input('email');
        $funcionario->dataNascimento            = $request->input('dataNascimento');
        $funcionario->foneFuncionario           = $request->input('foneFuncionario');
        $funcionario->enderecoFuncionario       = $request->input('enderecoFuncionario');
        $funcionario->cidadeFuncionario         = $request->input('cidadeFuncionario');
        $funcionario->estadoFuncionario         = $request->input('estadoFuncionario');
        $funcionario->cepFuncionario            = $request->input('cepFuncionario');
        $funcionario->dataContratacao           = $request->input('dataContratacao');
        $funcionario->cargo                     = $request->input('cargo');
        $funcionario->salario                   = $request->input('salario');
        $funcionario->tipoFuncionario           = $request->input('tipoFuncionario');

        if ($request->hasFile('fotoFuncionario')) {
            $fotoFuncionario = $request->file('fotoFuncionario');
            $nomeArquivo = $proximoID . '_' . Str::slug($funcionario->nomeFuncionario) . '.' . $fotoFuncionario->getClientOriginalExtension();
            $caminhoDestino = public_path('assets/images/funcionarios/');

            $fotoFuncionario->move($caminhoDestino, $nomeArquivo);

            $funcionario->fotoFuncionario = $nomeArquivo;
        }

        $funcionario->save();

        return response()->json([
            'success' => true,
            'message' => 'Funcionario cadastrado com sucesso!',
            'data' => $funcionario
        ], 201);
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

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'senha' => 'required',
        ]);

        $usuario = Usuario::where('email', $credentials['email'])->where('senha', $credentials['senha'])->first();
        if ($usuario && $usuario->tipo_usuario_type === 'funcionario') {
            $funcionario = $usuario->tipo_usuario()->first();
            if ($funcionario) {

                $token = $usuario->createToken('Token de Acesso')->plainTextToken;

                return response()->json([
                    'message' => 'Login realizado com sucesso!',
                    'usuario' => [
                        'id_usuario' => $usuario->id_usuario,
                        'nome' => $usuario->nome,
                        'email' => $usuario->email,
                        'tipo_usuario' => $usuario->tipo_usuario_type,
                        'dados_funcionario' => [
                            'idFuncionario' => $funcionario->idFuncionario,
                            'nomeFuncionario' => $funcionario->nomeFuncionario,
                        ],
                    ],

                    'access_token' => $token,
                    'token_type' =>  'Bearer'
                ]);
            }
        }
        return response()->json(['message' => 'Credenciais inválidas ou usuário não é um funcionario.'], 401);
    }
}
