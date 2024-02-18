<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;

class AdministrativoController extends Controller
{
    public function index($id){
        $funcionario = Funcionario::findOrFail($id);

        return view('dashboard.administrativo.index', ['funcionario' => $funcionario]);
    }


}
