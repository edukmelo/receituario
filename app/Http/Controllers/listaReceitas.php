<?php

namespace App\Http\Controllers;

use App\Models\paciente;
use App\Models\receita;
use Carbon\Carbon;
use Illuminate\Http\Request;

class listaReceitas extends Controller
{
    public function index() {
        return view('painel-paciente.index');
    }

    public function listaRec(paciente $paciente) {
        $data_hoje=Carbon::now()->toDateTimeString();
        $muda_validade=receita::where('validade','<',$data_hoje)->get();
        foreach($muda_validade as $mv) {
            $mv->status="Inativa";
            $mv->save();
        }
        return view('painel-paciente.listaativas',['paciente' => $paciente]);
    }

    public function listaRecIn(paciente $paciente) {
        $data_hoje=Carbon::now()->toDateTimeString();
        $muda_validade=receita::where('validade','<',$data_hoje)->get();
        foreach($muda_validade as $mv) {
            $mv->status="Inativa";
            $mv->save();
        }
        return view('painel-paciente.listainativas',['paciente' => $paciente]);
    }

    public function montaReceita(receita $idreceita){
        return view('painel-paciente.monta',['idreceita' => $idreceita]);
    }
}
