<?php

namespace App\Http\Middleware;

use App\Models\Funcionario;
use App\Models\Usuario;
use Closure;
use Illuminate\Http\Request;

class AutRestauranteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $email = session('email');

        if ($email) {
            $usuario = Usuario::where('email', $email)->first();
            if (!$usuario) {
                return redirect()->route('login')->withErrors(['email' => 'Não autenticado']);
            }

            $tipoUsuario = $usuario->tipo_usuario;

            if ($tipoUsuario) {
                $tipo = null;

                if ($tipoUsuario instanceof Funcionario) {
                    $tipo = $tipoUsuario->tipoFuncionario;
                }
            }

            $tipoUser = session('tipo_usuario');



            if ($tipo === $tipoUser) {

                session(['tipo_usuario_id' => $usuario->tipo_usuario_id]);

                return $next($request);
                
            } else {
                return back()->withErrors(['email' => 'Acesso não permitido para esse perfil']);
            }
        }
    }
}
