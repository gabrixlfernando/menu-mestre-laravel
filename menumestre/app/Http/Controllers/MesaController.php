<?php

namespace App\Http\Controllers;

use App\Models\Cardapio;
use App\Models\Comanda;
use App\Models\Mesa;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MesaController extends Controller
{
    public function index()
    {
        $mesas = Mesa::all();
        return response()->json($mesas);
    }

     // Retorna uma mesa específica e seus produtos
     public function show($id)
     {
         $mesa = Mesa::findOrFail($id);
         $produtosMesa = session()->get('mesa_' . $id . '.produtos', []);

         // Log para verificar os dados da mesa e produtos
         Log::info('Dados da mesa e produtos:', ['mesa' => $mesa, 'produtos' => $produtosMesa]);

         return response()->json([
             'mesa' => $mesa,
             'produtos' => $produtosMesa
         ]);
     }


     // Adiciona produtos a uma mesa
     public function adicionarProduto(Request $request, $id)
     {
         $mesa_session_key = 'mesa_' . $id;

         // Processar múltiplos produtos
         $produtosParaAdicionar = $request->input('produtos', []);

         foreach ($produtosParaAdicionar as $produto) {
             $produto_id = $produto['id'];
             $quantidade = $produto['quantidade'];

             $produtoInfo = Cardapio::findOrFail($produto_id);
             $pedido = [
                 'produto' => $produtoInfo,
                 'quantidade' => $quantidade,
                 'preco_unitario' => $produtoInfo->valorProduto,
                 'total_item' => $produtoInfo->valorProduto * $quantidade,
             ];

             $produtos = session()->get($mesa_session_key . '.produtos', []);
             $produtos[] = $pedido;
             session()->put($mesa_session_key . '.produtos', $produtos);

             // Adicione um log para verificar o conteúdo da sessão
             Log::info("Produtos na sessão após adição:", $produtos);
         }

         return response()->json(['message' => 'Produtos adicionados à mesa com sucesso.']);
     }



    // Remove um produto de uma mesa
    public function removerProduto(Request $request, $id)
    {
        $mesaId = $id;
        $index = $request->input('index');

        // Chave da sessão associada à mesa
        $mesa_session_key = 'mesa_' . $mesaId;

        // Recupere os produtos da sessão
        $produtosMesa = session()->get($mesa_session_key . '.produtos', []);

        // Verifique se o índice é válido
        if (isset($produtosMesa[$index])) {
            // Remova o produto do array
            unset($produtosMesa[$index]);

            // Reindexa o array para manter a consistência
            $produtosMesa = array_values($produtosMesa);

            // Atualize a sessão com os produtos atualizados
            session()->put($mesa_session_key . '.produtos', $produtosMesa);

            // Retorne uma resposta de sucesso com os produtos atualizados
            return response()->json([
                'success' => true,
                'message' => 'Produto removido com sucesso.',
                'produtos_atualizados' => $produtosMesa
            ]);
        } else {
            // Retorne uma resposta de erro se o índice não for válido
            return response()->json([
                'success' => false,
                'message' => 'Ocorreu um erro ao tentar remover o produto. Índice inválido.'
            ]);
        }
    }


    // Fecha a mesa
    public function fecharMesa(Request $request, $id)
    {
        $mesa_session_key = 'mesa_' . $id;

        if (session()->has($mesa_session_key)) {
            $produtosMesa = session()->get($mesa_session_key . '.produtos', []);
            $totalMesa = 0;

            foreach ($produtosMesa as $pedido) {
                $totalMesa += $pedido['total_item'];
            }

            $pagarTaxa = $request->input('pagar_taxa', false);

            $valorTaxa = $pagarTaxa ? $totalMesa * 0.1 : 0.00;
            $totalComTaxa = $totalMesa + $valorTaxa;

            $comanda = Comanda::where('mesa_id', $id)->where('status', 'aberta')->first();

            if ($comanda) {
                $idFuncionario = session('id');
                $comanda->status = 'fechada';
                $comanda->total = $totalComTaxa;
                $comanda->valorTaxa = $valorTaxa;
                $comanda->funcionario_id = $idFuncionario;
                $comanda->save();

                foreach ($produtosMesa as $pedido) {
                    Pedido::create([
                        'mesa_id' => $id,
                        'produto_id' => $pedido['produto']->idProduto,
                        'quantidade' => $pedido['quantidade'],
                        'preco_unitario' => $pedido['preco_unitario'],
                        'total_item' => $pedido['total_item'],
                        'comanda_id' => $comanda->id,
                    ]);
                }
            }

            session()->forget($mesa_session_key);
        }

        $mesa = Mesa::findOrFail($id);
        $mesa->update(['status' => 'disponivel', 'pessoas_sentadas' => 0]);

        return response()->json(['message' => 'Mesa fechada com sucesso.']);
    }

    // public function show($id)
    // {
    //     $mesa = Mesa::find($id);
    //     if (!$mesa) {
    //         return response()->json(['error' => 'Mesa não encontrada'], 404);
    //     }
    //     return response()->json($mesa);
    // }

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

    public function updateMesa(Request $request, $id)
    {
        // Validação dos dados recebidos
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:disponivel,ocupada,reservada',
            'pessoas_sentadas' => 'required_if:status,ocupada|integer|min:0',
        ]);

        // Se a validação falhar, retorne a mensagem de erro detalhada
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'input' => $request->all()
            ], 400);
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
            $mesa->pessoas_sentadas = $request->input('pessoas_sentadas', 0); // Valor padrão 0 se não for fornecido
        }

        // Salve as alterações no banco de dados
        $mesa->save();

        // Retorne os dados da mesa atualizados em formato JSON
        return response()->json(['message' => 'Mesa atualizada com sucesso', 'mesa' => $mesa], 200);
    }


}
