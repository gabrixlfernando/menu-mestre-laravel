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

    public function salvarNoBanco(Request $request){


        $dados = $request->json()->all(); //recebe os dados do json e transforma em array associativo

        $validarDados = Validator::make($dados, [
            'nomeContato'       => 'required|max:100',
            'emailContato'      => 'required|email|max:100',
            'foneContato'       => 'required|max:15',
            // 'assuntoContato'    => 'required|max:100',
            'mensContato'       => 'required',


        ]);

       


        if ($validarDados->fails()) {//se existir algum erro de valida
            return response()->json(['erros'=>$validarDados->errors()], 422);
        }else{
            $contato = Contato::create($validarDados->validated());//criando um novo contato com os dados validos

            //Por email

            Mail::to('webdequebrada@smpsistema.com.br')->send(new ContatoEmail($contato));

            return response()->json(['success' => 'Email registrado com sucesso!']);
        }

    }

}
