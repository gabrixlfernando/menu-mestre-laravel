<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Contato;
use Illuminate\Http\Request;

class MensagensNaoLidasMiddleware
{
    public function handle($request, Closure $next)
    {
        // Contar o número de mensagens não lidas
        $naoLidas = Contato::where('lidoContato', false)->count();

        // Armazena o número de mensagens não lidas na sessão
        session(['mensagensNaoLidas' => $naoLidas]);

        // Passa a solicitação para o próximo middleware na pilha
        return $next($request);
    }
}
