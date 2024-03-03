<?php

namespace App\Http\Controllers;

use App\Models\Cardapio;
use App\Models\Contato;
use App\Models\Funcionario;
use App\Models\Mesa;
use App\Models\LogAcesso;
use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdministrativoController extends Controller
{
    public function index()
    {
        // Recuperando o total de funcionários
        $totalFuncionarios = Funcionario::count();

        $totalPratos = Cardapio::count();

        $totalMensagens= Contato::count();

        $totalMesas = Mesa::count();

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
        return view('dashboard.administrativo.index', compact('funcionario', 'totalFuncionarios', 'totalPratos', 'totalMesas', 'totalMensagens', 'totalAcessosDia', 'totalAcessosSemana', 'totalAcessos'));
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
        $dadosProduto = $request->all();

        // Verifica se uma nova imagem foi enviada
        if ($request->hasFile('fotoProduto')) {
            // Obtém o objeto da imagem
            $imagem = $request->file('fotoProduto');
            // Obtém o nome original da imagem
            $nomeOriginalImagem = $imagem->getClientOriginalName();
            // Move a imagem para o diretório de destino
            $imagem->move(public_path('assets/images/cardapio/'), $nomeOriginalImagem);
            // Define o nome original da imagem nos dados do produto
            $dadosProduto['fotoProduto'] = $nomeOriginalImagem;
        }


        // Cria um novo produto no banco de dados com os dados fornecidos
        $produto = Cardapio::create($dadosProduto);

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
        $item = Cardapio::findOrFail($idProduto);

        // Verifique se uma nova imagem foi enviada
        if ($request->hasFile('fotoProduto')) {
            $imagem = $request->file('fotoProduto');
            $nomeImagem = time() . '.' . $imagem->getClientOriginalExtension();
            $imagem->move(public_path('assets/images/cardapio/'), $nomeImagem);
            // Atualize o nome da imagem no produto
            $item->fotoProduto = $nomeImagem;
        }

        // Atualize os outros campos do produto
        $item->nomeProduto = $request->input('nomeProduto');
        $item->descricaoProduto = $request->input('descricaoProduto');
        $item->valorProduto = $request->input('valorProduto');
        $item->categoriaProduto = $request->input('categoriaProduto');

        // Salve as alterações no banco de dados
        $item->save();

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
            'statusFuncionario'     => 'required|in:ativo,inativo',
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
        $funcionario->statusFuncionario         = $request->input('statusFuncionario');
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

        //busacando o funcionario pelo id no banco de dados
        $funcionario = Funcionario::find($id);

        return view('dashboard.administrativo.mesa', compact('mesas', 'funcionario'));
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
            'preco' => 'required|numeric',
        ]);

        // Criação da nova mesa
        $mesa = new Mesa();
        $mesa->numero_mesa = $numeroMesa;
        $mesa->capacidade = $validatedData['capacidade'];
        $mesa->status = $validatedData['status'];
        $mesa->preco = $validatedData['preco'];
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

    // Lista Contato
    public function contato()
    {
        // $contatos = Contato::all();
        $contatos = Contato::orderBy('id', 'desc')->paginate(5); // Retorna 5 contatos por página
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
            return response()->json(['success' => true, 'message' => 'Contato marcado como lido com sucesso']);
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
}
