<?php

namespace App\Http\Controllers;

use App\Models\usuario;
use Illuminate\Http\Request;

class medicoController extends Controller
{
    public function index() {
        return view('painel-medico.index');

    }
    public function editar(Request $request, usuario $usuario) {
        $usuario->nome = $request->nome;
        $usuario->email= $request->email;
        $usuario->telefone= $request->telefone;
        $usuario->senha= $request->senha;
        $usuario->save();
        return redirect()->route('medicos.index');
    }
}
