<?php

namespace App\Http\Controllers;

use App\Models\paciente;
use App\Models\receita;
use App\Models\usoreceita;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Session\Middleware\StartSession;

class farmacias extends Controller
{
    public function listaClientes(Request $request) {
        $deletados=receita::where('tiporeceita','=',NULL)->delete();
        $data_hoje=Carbon::now()->toDateTimeString();
        $muda_validade=receita::where('validade','<',$data_hoje)->get();
        foreach($muda_validade as $mv) {
            $mv->status="Inativa";
            $mv->save();
        }
        $pnome = $request->query('nome');
        $tabela = paciente::where('nome', 'like',  '%' .$pnome. '%')->get();
        return view('painel-farmacia.pesquisa', ['itens' => $tabela]);
    }

    public function listarec(paciente $paciente) {
        return view('painel-farmacia.lista',['item' => $paciente]);
    }

    public function montaRec(receita $idreceita){
        return view('painel-farmacia.monta',['idreceita' => $idreceita]);
    }

    public function index() {
        return view('painel-farmacia.index');
    }

    public function inserirUso($idreceita) {
        return view('painel-farmacia.utiliza', ['idreceita' => $idreceita]);
    }

    public function insertUso(Request $request) {
        @session_start();
        $data_hoje=Carbon::now()->toDateTimeString();
        $data_val=Carbon::now()->addMonth();
        $pega_proximo=usoreceita::where('idreceita','=',$request->idreceita)->orderby('id','desc')->first();
        if (is_null($pega_proximo)) {
                $usado= new usoreceita();
                $usado->idreceita=$request->idreceita;
                $usado->farmacia=$request->farmacia;
                $usado->datauso=$data_hoje;
                $usado->proximouso=$data_val;
                $usado->save();
        }
        else
        {
            if ($pega_proximo->proximouso < $data_hoje) {
                $usado= new usoreceita();
                $usado->idreceita=$request->idreceita;
                $usado->farmacia=$request->farmacia;
                $usado->datauso=$data_hoje;
                $usado->proximouso=$data_val;
                $usado->save();

            }

        }
        return redirect()->route('farmontareceita.index',['idreceita' => $request->idreceita]);

    }

}
