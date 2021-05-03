<?php

namespace App\Http\Controllers;

use App\Models\medicamento;
use Illuminate\Http\Request;

class medicamentoController extends Controller
{
    public function index() {
        $tabela = medicamento::orderby('nome','asc')->paginate();
        return view('painel-medico.medicamentos.index', ['itens' => $tabela]);

    }
    public function pesquisa(Request $request) {
        $pnome = $request->query('nome');
        $tabela = medicamento::where('nome', 'like',  '%' .$pnome. '%')->get();
        return view('painel-medico.medicamentos.index', ['itens' => $tabela]);

    }
}
