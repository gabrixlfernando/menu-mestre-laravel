<?php

namespace App\Http\Controllers;

use App\Mail\ContatoEmail;
use App\Models\Contato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index(){
        return view('site.home');
    }

    public function salvarNoBanco(Request $request)
    {
        //dd($request->all());
        // Extrai os dados JSON da requisição
        $dados = $request->json()->all();


       // dd($request);


        // Valida os dados recebidos
        $validarDados = Validator::make($dados, [
            'nomeContato'       => 'required|max:100',
            'emailContato'      => 'required|email|max:100',
            'foneContato'       => 'required|max:15',
            'assuntoContato'    => 'required|max:100',
            'mensContato'       => 'required',
        ]);
        // dd($dados);


        // Verifica se houve falha na validação
        if ($validarDados->fails()) {

            return response()->json(['erros' => $validarDados->errors()], 422);

        } else {
            // Cria um novo registro de contato no banco de dados
            $contato = Contato::create($validarDados->validated());

            // Envia e-mail
            try {
                Mail::to('webdequebrada@smpsistema.com.br')->send(new ContatoEmail($contato));
            } catch (\Exception $e) {
                // Em caso de erro no envio do e-mail, retorna uma resposta de erro
                return response()->json(['error' => 'Erro ao enviar e-mail.'], 500);
            }

            // Retorna uma resposta de sucesso
            return response()->json(['success' => 'E-mail registrado com sucesso!']);
        }
    }

}
