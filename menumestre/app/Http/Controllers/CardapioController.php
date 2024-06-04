<?php

namespace App\Http\Controllers;

use App\Models\Cardapio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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

    public function createProduto(Request $request)
    {
        // Validação dos dados do formulário
        $validator = Validator::make($request->all(), [
            'nomeProduto' => 'required|string|max:255',
            'descricaoProduto' => 'required|string|max:255',
            'valorProduto' => 'required|numeric',
            'categoriaProduto' => 'required|in:comida,bebida,sobremesa,massa',
            'fotoProduto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Verifica se há erros de validação
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Obtém o último produto cadastrado
        $ultimoProduto = Cardapio::latest('idProduto')->first();
        $ultimoID = $ultimoProduto ? $ultimoProduto->idProduto : 0;

        // Calcula o ID do próximo produto
        $proximoID = $ultimoID + 1;

        // Cria um novo objeto de produto
        $produto = new Cardapio();

        // Define os atributos do produto com base nos dados do formulário
        $produto->idProduto = $proximoID; // Aqui você define o ID do próximo produto
        $produto->nomeProduto = $request->input('nomeProduto');
        $produto->descricaoProduto = $request->input('descricaoProduto');
        $produto->valorProduto = $request->input('valorProduto');
        $produto->categoriaProduto = $request->input('categoriaProduto');

        // Verifica se uma nova imagem foi enviada
        if ($request->hasFile('fotoProduto')) {
            // Obtém o objeto da imagem
            $imagem = $request->file('fotoProduto');
            // Define o nome do arquivo usando o ID do próximo produto e o nome original da imagem
            $nomeArquivo = $proximoID . '_' . Str::slug($produto->nomeProduto) . '.' . $imagem->getClientOriginalExtension();

            // Move a imagem para o diretório de destino
            $imagem->move(public_path('assets/images/cardapio/'), $nomeArquivo);
            // Define o nome da imagem no objeto do produto
            $produto->fotoProduto = $nomeArquivo;
        }

        // Salva o novo produto no banco de dados
        $produto->save();

        // Retorna uma resposta JSON com os dados do produto criado
        return response()->json([
            'success' => true,
            'message' => 'Produto cadastrado com sucesso!',
            'data' => $produto
        ], 201);
    }

    public function store(Request $request, $idProduto)
    {
        // Regras de validação
        $rules = [
            'nomeProduto' => 'sometimes|required|max:255',
            'descricaoProduto' => 'sometimes|required|max:255',
            'valorProduto' => 'sometimes|required|numeric',
            'categoriaProduto' => 'sometimes|required|in:comida,bebida,sobremesa,massa',
            'fotoProduto' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // opcional, máximo de 2MB
        ];

        // Mensagens de erro personalizadas
        $messages = [
            'categoriaProduto.in' => 'A categoria selecionada é inválida.',
            'fotoProduto.image' => 'O arquivo enviado não é uma imagem válida.',
            'fotoProduto.mimes' => 'A imagem deve ser do tipo: jpeg, png, jpg ou gif.',
            'fotoProduto.max' => 'A imagem não pode ter mais de 2MB.',
        ];

        // Validação dos dados
        $validator = Validator::make($request->all(), $rules, $messages);

        // Verifica se há erros de validação
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Encontre o produto pelo ID
        $produto = Cardapio::findOrFail($idProduto);

        // Verifique se uma nova imagem foi enviada
        if ($request->hasFile('fotoProduto')) {
            // Se uma nova imagem foi enviada, mova-a para o diretório e atualize o nome da imagem no produto
            $imagem = $request->file('fotoProduto');
            $nomeArquivo = $idProduto . '_' . Str::slug($request->input('nomeProduto')) . '.' . $imagem->getClientOriginalExtension();
            $imagem->move(public_path('assets/images/cardapio/'), $nomeArquivo);
            $produto->fotoProduto = $nomeArquivo;
        }

        // Atualize os campos que estão presentes na requisição
        if ($request->has('nomeProduto')) {
            $produto->nomeProduto = $request->input('nomeProduto');
        }
        if ($request->has('descricaoProduto')) {
            $produto->descricaoProduto = $request->input('descricaoProduto');
        }
        if ($request->has('valorProduto')) {
            $produto->valorProduto = $request->input('valorProduto');
        }
        if ($request->has('categoriaProduto')) {
            $produto->categoriaProduto = $request->input('categoriaProduto');
        }

        // Salve as alterações no banco de dados
        $produto->save();

        // Retorne a resposta em JSON com os dados atualizados
        return response()->json([
            'success' => true,
            'message' => 'Produto atualizado com sucesso!',
            'data' => $produto
        ]);
    }
}
