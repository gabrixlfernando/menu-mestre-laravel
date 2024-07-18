<?php

namespace App\Http\Controllers;

use App\Models\Cardapio;
use App\Models\Comanda;
use App\Models\Contato;
use App\Models\Funcionario;
use App\Models\Mesa;
use App\Models\LogAcesso;
use App\Models\Pedido;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdministrativoController extends Controller
{
    public function index()
    {
        // Recuperando o total de funcionários
        $totalFuncionarios = Funcionario::count();

        $totalPratos = Cardapio::count();

        $totalMensagens = Contato::count();

        $totalMesas = Mesa::where('status', 'disponivel')->count();

        $totalComandas = Comanda::sum('total');

        $diaAtual = date('Y-m-d');

        // Consulta para obter o total de pedidos para o dia atual
        $totalComandasPorDia = Comanda::whereDate('created_at', $diaAtual)->sum('total');


        $inicioSemana = date('Y-m-d', strtotime('monday this week')); // Obtém a data de início da semana atual
        $fimSemana = date('Y-m-d', strtotime('sunday this week')); // Obtém a data de término da semana atual

        // Consulta para obter o total de pedidos para a semana atual
        $totalComandasPorSemana = Comanda::whereDate('created_at', '>=', $inicioSemana)
            ->whereDate('created_at', '<=', $fimSemana)
            ->sum('total');

        // Obtém o ano e mês atual no formato 'YYYY-MM'
        $anoMesAtual = date('Y-m');

        // Consulta para obter o total de pedidos para o mês atual
        $totalComandasPorMes = Comanda::whereYear('created_at', '=', date('Y'))
            ->whereMonth('created_at', '=', date('m'))
            ->sum('total');

        // Obtém o ano atual
        $anoAtual = date('Y');

        // Consulta para obter o total de pedidos para o ano atual
        $totalComandasPorAno = Comanda::whereYear('created_at', $anoAtual)
            ->sum('total');



        // $cardapio = Cardapio::orderBy('idProduto', 'desc')->take(5)->get(); // mostra até 6 primeiros pratos


        // Consultar a tabela pedidos e contar quantas vezes cada produto foi pedido
        $produtos_mais_pedidos = Pedido::select('produto_id', DB::raw('SUM(quantidade) as total_pedidos'))
            ->groupBy('produto_id')
            ->orderByDesc('total_pedidos')
            ->take(7)
            ->get();

        // Verificar se há produtos mais pedidos
        if ($produtos_mais_pedidos->isNotEmpty()) {
            // Pegar os IDs dos produtos mais pedidos
            $ids_produtos_mais_pedidos = $produtos_mais_pedidos->pluck('produto_id');

            // Consultar os detalhes desses produtos na tabela tblprodutos (Cardapio)
            $produtos_cardapio = Cardapio::whereIn('idProduto', $ids_produtos_mais_pedidos)
                ->get();
        } else {
            $produtos_cardapio = collect(); // Retorna uma coleção vazia se não houver produtos mais pedidos
        }

        // Recupera o número de acessos por dia nos últimos 7 dias
        $acessosDia = DB::table('log_acessos')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->where('log', 'like', '%/ %')
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        $totalAcessosDia = $acessosDia->sum('total');

        // Recupera o número de acessos por semana nos últimos 8 semanas
        $acessosSemana = DB::table('log_acessos')
            ->select(DB::raw('YEAR(created_at) as year'), DB::raw('WEEK(created_at) as week'), DB::raw('count(*) as total'))
            ->where('created_at', '>=', Carbon::now()->subWeeks(8))
            ->where('log', 'like', '%/ %')
            ->groupBy('year', 'week')
            ->orderBy('year')
            ->orderBy('week')
            ->get();
        $totalAcessosSemana = $acessosSemana->sum('total');

        // Recupera o número total de acessos à página '/'
        $totalAcessos = DB::table('log_acessos')
            ->where('log', 'like', '%/ %')
            ->count();

        //recuperando o id do funcionario da sessão
        $id = session('id');

        //busacando o funcionario pelo id no banco de dados
        $funcionario = Funcionario::find($id);

        //verificando se o funcionario foi encontrado
        if (!$funcionario) {

            //se o funcionario não foi encontrado emite uma tela de erro
            abort(404, 'Funcionario não encontrado!');
        }

        //passando o objeto $funcionario para view

        //dd($funcionario);
        return view('dashboard.administrativo.index', compact('funcionario', 'totalFuncionarios', 'totalPratos', 'totalMesas', 'totalComandas', 'totalMensagens', 'totalAcessosDia', 'totalAcessosSemana', 'totalAcessos', 'produtos_mais_pedidos', 'totalComandasPorDia', 'totalComandasPorSemana', 'totalComandasPorMes', 'totalComandasPorAno'));
    }

    public function cardapio()
    {

        $id = session('id');

        //busacando o funcionario pelo id no banco de dados
        $funcionario = Funcionario::find($id);

        //  $cardapio = Cardapio::all();

        $cardapio = Cardapio::orderBy('idProduto', 'desc')->get();





        // return view('dashboard.administrativo.cardapio', compact('funcionario'), ['cardapio' => $cardapio]);

        return view('dashboard.administrativo.cardapio', compact('funcionario', 'cardapio'));
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


            Alert::success('Desativado!', 'O item não está mais visível no site.');

            // return redirect()->back()->with('success', 'O produto foi desativado com sucesso.');

            return redirect()->route('dashboard.administrativo.cardapio');
        } else {
            Alert::error('Erro!', 'Ocorreu um erro ao desativar o item.');
            return redirect()->route('dashboard.administrativo.cardapio');
        }
    }


    public function ativarProduto($idProduto)
    {
        $cardapio = Cardapio::find($idProduto);

        if ($cardapio) {
            $cardapio->statusProduto = 'ativo';
            $cardapio->save();

            Alert::success('Ativado!', 'O item está visível no site.');

            return redirect()->route('dashboard.administrativo.cardapio');

            // return redirect()->back()->with('success', 'Produto ativado com sucesso.');
        } else {
            Alert::error('Erro!', 'Ocorreu um erro ao ativar o item.');
            return redirect()->route('dashboard.administrativo.cardapio');
        }
    }

    public function createProduto(Request $request)
{
    // Obtém todos os dados do formulário
    $produto = $request->all();

    // Obtém o último produto cadastrado
    $ultimoProduto = Cardapio::latest('idProduto')->first();

    // Verifica se existe algum produto cadastrado
    if ($ultimoProduto) {
        // Se houver um produto cadastrado, obtenha o ID do último produto
        $ultimoID = $ultimoProduto->idProduto;
    } else {
        // Se não houver nenhum produto cadastrado, defina o ID como 1
        $ultimoID = 1;
    }

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
    $produto->altProduto = $request->input('altProduto');

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

    // Exibe uma mensagem de sucesso para o usuário
    Alert::success('Produto Cadastrado!', 'O item foi cadastrado com sucesso.');

    // Redireciona o usuário de volta para a página de cardápio
    return redirect()->route('dashboard.administrativo.cardapio');
}

    // Buscar produto pelo id
    public function editProduto($idProduto)
    {
        $cardapio = Cardapio::findOrfail($idProduto);

        return redirect()->route('dashboard.administrativo.cardapio', compact('cardapio'));
    }

    // Atualizar Produto
    public function updateProduto(Request $request, $idProduto)
{
    // Regras de validação
    $rules = [
        'nomeProduto' => 'required|max:255',
        'descricaoProduto' => 'required|max:255',
        'valorProduto' => 'required|numeric',
        'categoriaProduto' => 'required|in:comida,bebida,sobremesa,massa',
        'fotoProduto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // opcional, máximo de 2MB
        'altProduto' => 'required|max:255', // Adicionando regra para altProduto
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
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Se não houver erros de validação, continue com o processo de atualização do produto
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

    // Atualize os outros campos do produto
    $produto->nomeProduto = $request->input('nomeProduto');
    $produto->descricaoProduto = $request->input('descricaoProduto');
    $produto->valorProduto = $request->input('valorProduto');
    $produto->categoriaProduto = $request->input('categoriaProduto');
    $produto->altProduto = $request->input('altProduto');

    // Salve as alterações no banco de dados
    $produto->save();

    Alert::success('Produto Atualizado!', 'O item foi atualizado com sucesso.');

    // Redirecione de volta para a página de visualização do produto
    return redirect()->route('dashboard.administrativo.cardapio');
}


    // lista funcionarios
    public function funcionario()
    {

        $id = session('id');

        //busacando o funcionario pelo id no banco de dados
        $funcionario = Funcionario::find($id);



        // Consulta todos os funcionários com tipo "administrativo"
        $administradores = Funcionario::where('tipoFuncionario', 'administrativo')->get();

        // Substituir "administrativo" por "Gerente" nos resultados
        foreach ($administradores as $administrador) {
            $administrador->tipoFuncionario = 'Gerente';
        }

        // Consulta todos os funcionários com tipo "atendente"
        $atendentes = Funcionario::where('tipoFuncionario', 'atendente')->get();

        // return view('dashboard.administrativo.cardapio', compact('funcionario'), ['cardapio' => $cardapio]);

        return view('dashboard.administrativo.funcionario', compact('funcionario', 'administradores', 'atendentes'));
    }

    public function createFuncionario(Request $request)
    {
        $request->merge([
            'dataContratacao' => now(),
            'criado_em' => now(),
            'atualizado_em' => now()
        ]);

        $request->validate([
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
        $funcionario->fotoFuncionario           = $request->input('fotoFuncionario');


        if ($request->hasFile('fotoFuncionario')) {
            $fotoFuncionario = $request->file('fotoFuncionario');
            $nomeArquivo = $proximoID . '_' . str_replace(' ', '_', $funcionario->nomeFuncionario) . '.' . $fotoFuncionario->getClientOriginalExtension();
            $caminhoDestino = public_path('assets/images/funcionarios/');

            $fotoFuncionario->move($caminhoDestino, $nomeArquivo);

            $funcionario->fotoFuncionario = $nomeArquivo;
        }

        $funcionario->save();

        Alert::success('Funcionario Cadastrado!', 'O funcionario foi cadastrado com sucesso.');

        return Redirect::route('dashboard.administrativo.funcionario');
    }

    public function updateFuncionario(Request $request, $idFuncionario)
    {
        $request->merge([
            'dataContratacao' => now(),
            'criado_em' => now(),
            'atualizado_em' => now()
        ]);

        $request->validate([
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
            'statusFuncionario'     => 'required|in:ativo,inativo',
            'fotoFuncionario'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $funcionario = Funcionario::findOrFail($idFuncionario);

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
        $funcionario->save();

        Alert::success('Funcionario Atualizado!', 'O funcionario foi atualizado com sucesso.');

        return Redirect::route('dashboard.administrativo.funcionario');
    }

    public function editFuncionario($idFuncionario)
    {
        $funcionario = Funcionario::findOrfail($idFuncionario);

        return redirect()->route('dashboard.administrativo.funcionario', compact('funcionario'));
    }

    // lista todas as mesas
    public function mesa()
    {
        $mesas = Mesa::all();
        $id = session('id');
        $funcionario = Funcionario::find($id);
        $totalPedidosPorMesa = [];

        foreach ($mesas as $mesa) {
            $mesaId = $mesa->id;
            $mesa_session_key = 'mesa_' . $mesaId;

            // Obtém os pedidos da mesa atual da sessão
            $produtosMesa = session()->get($mesa_session_key . '.produtos', []);

            // Inicializa o total de pedidos para esta mesa como zero
            $totalPedidosMesa = 0;

            // Calcula o total dos pedidos para a mesa atual
            foreach ($produtosMesa as $pedido) {
                $totalPedidosMesa += $pedido['total_item'];
            }

            // Armazena o total dos pedidos para a mesa atual
            $totalPedidosPorMesa[$mesaId] = $totalPedidosMesa;
        }



        return view('dashboard.administrativo.mesa', compact('mesas',  'funcionario', 'totalPedidosPorMesa'));
    }

    // busca mesa pelo id

    public function editMesa($id)
    {
        $mesa = Mesa::findOrfail($id);

        return redirect()->route('dashboard.administrativo.mesa', compact('mesa'));
    }

    public function updateMesa(Request $request, $id)
    {
        // Encontre a mesa pelo ID
        $mesa = Mesa::findOrFail($id);


        $mesa->status = $request->input('status');

        // Se o status for "disponível", defina pessoas_sentadas como 0, caso contrário, obtenha o valor do formulário
        if ($mesa->status === 'disponivel') {
            $mesa->pessoas_sentadas = 0;
        } else {
            $mesa->pessoas_sentadas = $request->input('pessoas_sentadas');
        }

        // Salve as alterações no banco de dados
        $mesa->save();

        Alert::success('Mesa Atualizada!', 'A mesa foi atualizada com sucesso.');
        // Redirecione de volta para a página de visualização da mesa ou outra página desejada
        return redirect()->route('dashboard.administrativo.mesa', ['id' => $mesa->id]);
    }

    public function createMesa(Request $request)
    {
        // Obtenha o número da última mesa cadastrada
        $ultimaMesa = Mesa::orderBy('id', 'desc')->first();

        // Determine o número para a nova mesa (último número + 1)
        $numeroMesa = $ultimaMesa ? $ultimaMesa->numero_mesa + 1 : 1;

        // Validação dos dados do formulário
        $validatedData = $request->validate([
            'capacidade' => 'required|integer',
            'status' => 'required|in:disponivel,reservada,ocupada',
            // 'preco' => 'required|numeric',
        ]);

        // Criação da nova mesa
        $mesa = new Mesa();
        $mesa->numero_mesa = $numeroMesa;
        $mesa->capacidade = $validatedData['capacidade'];
        $mesa->status = $validatedData['status'];
        // $mesa->preco = $validatedData['preco'];
        $mesa->save();

        Alert::success('Mesa Cadastrada!', 'A mesa foi cadastrada com sucesso.');
        // Redireciona de volta com uma mensagem de sucesso
        return redirect()->route('dashboard.administrativo.mesa');
    }

    public function desativarMesa($id)
    {
        // Encontre o produto pelo ID
        $mesa = Mesa::find($id);
        // Verifique se o produto foi encontrado
        if ($mesa) {
            // Atualize o status para "inativo"
            $mesa->status = 'inativo';
            $mesa->save();
            Alert::success('Desativada!', 'A mesa foi desativada com sucesso.');
            return redirect()->route('dashboard.administrativo.mesa');
        } else {
            Alert::error('Erro!', 'Ocorreu um erro ao desativar o item.');
            return redirect()->route('dashboard.administrativo.mesa');
        }
    }

    public function ativarMesa($id)
    {
        $mesa = mesa::find($id);

        if ($mesa) {
            $mesa->status = 'disponivel';
            $mesa->save();

            Alert::success('Ativada!', 'A mesa foi ativada com sucesso.');

            return redirect()->route('dashboard.administrativo.mesa');

            // return redirect()->back()->with('success', 'Produto ativado com sucesso.');
        } else {
            Alert::error('Erro!', 'Ocorreu um erro ao ativar o item.');
            return redirect()->route('dashboard.administrativo.mesa');
        }
    }

    public function showMesa($id)
    {
        $idFuncionario = session('id');
        $funcionario = Funcionario::findOrFail($idFuncionario);
        $mesa = Mesa::findOrFail($id);
        $cardapio = Cardapio::all();
        $categorias = Cardapio::select('categoriaProduto')->distinct()->pluck('categoriaProduto');

        if ($mesa->status === 'ocupada') {
            $comandaExistente = Comanda::where('mesa_id', $id)->where('status', 'aberta')->first();
            if (!$comandaExistente) {
                session()->put('mesa_' . $id, ['produtos' => []]);
                $comanda = new Comanda();
                $comanda->mesa_id = $id;
                $comanda->funcionario_id = $idFuncionario;
                $comanda->status = 'aberta';
                $comanda->save();
            }
        }

        return view('dashboard.administrativo.mesa.show', compact('funcionario', 'mesa', 'cardapio', 'categorias'));
    }

    // public function adicionarProduto(Request $request)
    // {
    //     $request->validate([
    //         'produto' => 'required|exists:tblprodutos,idProduto',
    //         'quantidade' => 'required|integer|min:1',
    //     ]);

    //     $produto = Cardapio::findOrFail($request->produto);
    //     $pedido = [
    //         'produto' => $produto,
    //         'quantidade' => $request->quantidade,
    //         'preco_unitario' => $produto->valorProduto,
    //         'total_item' => $produto->valorProduto * $request->quantidade,
    //     ];

    //     $mesa_id = $request->input('mesa_id'); // Certifique-se de que 'mesa_id' está sendo enviado no formulário
    //     $mesa_session_key = 'mesa_' . $mesa_id;

    //     if ($request->session()->has($mesa_session_key)) {
    //         $produtos = $request->session()->get($mesa_session_key . '.produtos', []);
    //         $produtos[] = $pedido;
    //         $request->session()->put($mesa_session_key . '.produtos', $produtos);
    //     }

    //     return redirect()->back()->with('success', 'Produto adicionado à mesa com sucesso.');
    // }

    public function adicionarProduto(Request $request)
    {
        $mesa_id = $request->input('mesa_id'); // Certifique-se de que 'mesa_id' está sendo enviado no formulário
        $mesa_session_key = 'mesa_' . $mesa_id;

        // Adicionar logs para verificar os dados recebidos
        Log::info('Produtos recebidos:', $request->all());

        // Processar múltiplos produtos
        $produtosParaAdicionar = $request->input('produtos', []);

        foreach ($produtosParaAdicionar as $produto) {
            $produto_id = $produto['id']; // Acesse a chave correta
            $quantidade = $produto['quantidade']; // Acesse a chave correta

            $produtoInfo = Cardapio::findOrFail($produto_id);
            $pedido = [
                'produto' => $produtoInfo,
                'quantidade' => $quantidade,
                'preco_unitario' => $produtoInfo->valorProduto,
                'total_item' => $produtoInfo->valorProduto * $quantidade,
            ];

            if ($request->session()->has($mesa_session_key)) {
                $produtos = $request->session()->get($mesa_session_key . '.produtos', []);
                $produtos[] = $pedido;
                $request->session()->put($mesa_session_key . '.produtos', $produtos);
            } else {
                // Se a chave de sessão não existe, crie-a com o primeiro produto
                $request->session()->put($mesa_session_key . '.produtos', [$pedido]);
            }
        }

        return redirect()->back()->with('success', 'Produtos adicionados à mesa com sucesso.');
    }








    public function removerProduto(Request $request)
    {
        $mesaId = $request->input('mesa_id');
        $index = $request->input('index');

        // Recupere os produtos da sessão
        $mesa_session_key = 'mesa_' . $mesaId;
        $produtosMesa = session()->get($mesa_session_key . '.produtos', []);

        // Verifique se o índice é válido
        if (isset($produtosMesa[$index])) {
            // Remova o produto do array
            unset($produtosMesa[$index]);

            // Atualize a sessão com os produtos atualizados
            session()->put($mesa_session_key . '.produtos', $produtosMesa);

            // Retorne uma resposta de sucesso
            return response()->json(['success' => 'Produto removido com sucesso.']);
        } else {
            // Retorne uma resposta de erro se o índice não for válido
            return response()->json(['error' => 'Ocorreu um erro ao tentar remover o produto.']);
        }
    }

    public function fecharMesa(Request $request, $id)
    {
        $mesa_session_key = 'mesa_' . $id;
        if (session()->has($mesa_session_key)) {
            // Obter os produtos da sessão
            $produtosMesa = session()->get($mesa_session_key . '.produtos', []);

            // Calcular o total da mesa
            $totalMesa = 0;
            foreach ($produtosMesa as $pedido) {
                $totalMesa += $pedido['total_item'];
            }

            // Verificar se o cliente deseja pagar a taxa de serviço
            $pagarTaxa = $request->has('pagar_taxa');

            // Calcular o total com ou sem taxa de serviço
            if ($pagarTaxa) {
                $valorTaxa = $totalMesa * 0.1; // Calcula 10% da taxa de serviço
                $totalComTaxa = $totalMesa + $valorTaxa; // Adiciona taxa de serviço ao total
            } else {
                $valorTaxa = 0.00; // Sem taxa de serviço
                $totalComTaxa = $totalMesa; // Total sem taxa de serviço
            }

            // Atualizar o status da comanda para "fechada" e salvar o total e a taxa da mesa
            $comanda = Comanda::where('mesa_id', $id)->where('status', 'aberta')->first();
            if ($comanda) {
                // Registrar o funcionário que fechou a comanda
                $idFuncionario = session('id');
                $comanda->status = 'fechada';
                $comanda->total = $totalComTaxa; // Atualiza o total da comanda com ou sem a taxa de serviço
                $comanda->valorTaxa = $valorTaxa; // Armazena o valor da taxa de serviço
                $comanda->funcionario_id = $idFuncionario; // Associar o fechamento ao funcionário atual
                $comanda->save();

                // Gravar os produtos na tabela de pedidos, associando ao funcionário da comanda
                foreach ($produtosMesa as $pedido) {
                    Pedido::create([
                        'mesa_id' => $id,
                        'produto_id' => $pedido['produto']->idProduto,
                        'quantidade' => $pedido['quantidade'],
                        'preco_unitario' => $pedido['preco_unitario'],
                        'total_item' => $pedido['total_item'],
                        'comanda_id' => $comanda->id, // Associar o pedido à comanda fechada
                    ]);
                }
            }

            // Limpar a sessão
            session()->forget($mesa_session_key);
        }

        // Atualizar o status e a quantidade de pessoas sentadas da mesa
        $mesa = Mesa::findOrFail($id);
        $mesa->update(['status' => 'disponivel', 'pessoas_sentadas' => 0]);

        // Retornar uma resposta de sucesso
        Alert::success('Mesa Finalizada!', 'A mesa foi finalizada com sucesso.');
        return redirect()->route('dashboard.administrativo.mesa')->with('success', 'Mesa fechada com sucesso.');
    }


    // Lista Contato
    public function contato()
    {
        // $contatos = Contato::all();
        $contatos = Contato::where('status', 'ativo')
            ->orderBy('id', 'desc')
            ->paginate(5); // Retorna 5 contatos por página
        $id = session('id');

        // Buscando o funcionário pelo id no banco de dados
        $funcionario = Funcionario::find($id);

        return view('dashboard.administrativo.contato', compact('contatos', 'funcionario'));
    }

    // Buscar contato pelo id
    public function showContato($id)
    {
        $contato = Contato::findOrFail($id);
        return view('dashboard.administrativo.contato.show', compact('contato'));
    }

    public function atualizarLido($id)
    {
        $contato = Contato::find($id);
        if ($contato) {
            $contato->update(['lidoContato' => true]);

            // Contar as mensagens não lidas restantes
            $naoLidas = Contato::where('lidoContato', false)->count();

            return response()->json([
                'success' => true,
                'message' => 'Contato marcado como lido com sucesso',
                'naoLidas' => $naoLidas
            ]);
        } else {
            return response()->json(['success' => false, 'message' => 'Contato não encontrado'], 404);
        }
    }

    public function verificarLido($id)
    {
        $contato = Contato::find($id);
        if ($contato) {
            return response()->json(['lido' => $contato->lidoContato]);
        } else {
            return response()->json(['error' => 'Contato não encontrado'], 404);
        }
    }

    public function desativar(Request $request)
    {
        // Validação do ID da mensagem
        $request->validate([
            'contato_id' => 'required|exists:contatos,id',
        ]);

        // Encontrar a mensagem pelo ID e atualizar seu status
        $contato = Contato::findOrFail($request->input('contato_id'));
        $contato->status = 'inativo'; // Supondo que 'status' seja o campo e 'inativo' o valor desejado
        $contato->save();

        // Redirecionar de volta com uma mensagem de sucesso
        Alert::success('Mensagem Excluída!', 'A mensagem foi excluída com sucesso.');
        return redirect()->route('dashboard.administrativo.contato')->with('success', 'Mensagem excluída com sucesso.');
    }


    // API Referente aos dados dos relatório
    public function getDashboard()
    {
        // Recuperando o total de funcionários
        $totalFuncionarios = Funcionario::count();

        $totalPratos = Cardapio::where('statusProduto', 'ativo')->count();

        $totalMensagens = Contato::count();

        $totalMesas = Mesa::where('status', 'disponivel')->count();

        $totalComandas = Comanda::sum('total');

        $diaAtual = date('Y-m-d');

        // Consulta para obter o total de pedidos para o dia atual
        $totalComandasPorDia = Comanda::whereDate('created_at', $diaAtual)->sum('total');

        $inicioSemana = date('Y-m-d', strtotime('monday this week')); // Obtém a data de início da semana atual
        $fimSemana = date('Y-m-d', strtotime('sunday this week')); // Obtém a data de término da semana atual

        // Consulta para obter o total de pedidos para a semana atual
        $totalComandasPorSemana = Comanda::whereDate('created_at', '>=', $inicioSemana)
            ->whereDate('created_at', '<=', $fimSemana)
            ->sum('total');

        // Obtém o ano e mês atual no formato 'YYYY-MM'
        $anoMesAtual = date('Y-m');

        // Consulta para obter o total de pedidos para o mês atual
        $totalComandasPorMes = Comanda::whereYear('created_at', '=', date('Y'))
            ->whereMonth('created_at', '=', date('m'))
            ->sum('total');

        // Obtém o ano atual
        $anoAtual = date('Y');

        // Consulta para obter o total de pedidos para o ano atual
        $totalComandasPorAno = Comanda::whereYear('created_at', $anoAtual)
            ->sum('total');

        // Consultar a tabela pedidos e contar quantas vezes cada produto foi pedido
        $produtos_mais_pedidos = Pedido::select('produto_id', DB::raw('SUM(quantidade) as total_pedidos'))
            ->groupBy('produto_id')
            ->orderByDesc('total_pedidos')
            ->take(8)
            ->get();

        // Recupera o número de acessos por dia nos últimos 7 dias
        $acessosDia = DB::table('log_acessos')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->where('log', 'like', '%/ %')
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        $totalAcessosDia = $acessosDia->sum('total');

        // Recupera o número de acessos por semana nos últimos 8 semanas
        $acessosSemana = DB::table('log_acessos')
            ->select(DB::raw('YEAR(created_at) as year'), DB::raw('WEEK(created_at) as week'), DB::raw('count(*) as total'))
            ->where('created_at', '>=', Carbon::now()->subWeeks(8))
            ->where('log', 'like', '%/ %')
            ->groupBy('year', 'week')
            ->orderBy('year')
            ->orderBy('week')
            ->get();
        $totalAcessosSemana = $acessosSemana->sum('total');

        // Recupera o número total de acessos à página '/'
        $totalAcessos = DB::table('log_acessos')
            ->where('log', 'like', '%/ %')
            ->count();

        // Construir array com os dados
        $data = [
            'totalFuncionarios' => $totalFuncionarios,
            'totalPratos' => $totalPratos,
            'totalMensagens' => $totalMensagens,
            'totalMesas' => $totalMesas,
            'totalComandas' => $totalComandas,
            'totalComandasPorDia' => $totalComandasPorDia,
            'totalComandasPorSemana' => $totalComandasPorSemana,
            'totalComandasPorMes' => $totalComandasPorMes,
            'totalComandasPorAno' => $totalComandasPorAno,
            'produtos_mais_pedidos' => $produtos_mais_pedidos,
            'totalAcessosDia' => $totalAcessosDia,
            'totalAcessosSemana' => $totalAcessosSemana,
            'totalAcessos' => $totalAcessos,
        ];

        // Retornar os dados em formato JSON
        return response()->json($data);
    }
}
