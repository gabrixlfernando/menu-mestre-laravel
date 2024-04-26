<?php

namespace App\Http\Controllers;

use App\Models\Mesa;
use Illuminate\Http\Request;

class MesaController extends Controller
{
    public function index()
    {
        $mesas = Mesa::all();
        return response()->json($mesas);
    }

    public function show($id)
    {
        $mesa = Mesa::find($id);
        if (!$mesa) {
            return response()->json(['error' => 'Mesa não encontrada'], 404);
        }
        return response()->json($mesa);
    }
}
