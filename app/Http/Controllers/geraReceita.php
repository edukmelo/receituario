<?php

namespace App\Http\Controllers;

use App\Models\medicamento;
use App\Models\medico;
use App\Models\paciente;
use App\Models\receita;
use App\Models\receitado;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class geraReceita extends Controller
{
    public function createRec($idreceita) {
        return view('painel-medico.receitas.create', ['idreceita' => $idreceita]);
    }

    public function insertRec(Request $request) {

        $receitado= new receitado();
        $receitado->idreceita=$request->idreceita;
        $auxid=medicamento::where('nome','=',$request->nome)->first();
        $receitado->idmedicamento=$auxid->id;
        $receitado->nome=$request->nome;
        $receitado->modouso=$request->posologia;
        $item1=receita::where('id','=',$receitado->idreceita)->first();
        $item=paciente::where('id','=',$item1->idpaciente)->first();
        $receitado->save();
        return redirect()->route('addmedicamentos.index',['item' => $item]);
    }

    public function pesquisaPaciente(Request $request) {
        $pnome = $request->query('nome');
        $tabela = paciente::where('nome', 'like',  '%' .$pnome. '%')->get();
        return view('painel-medico.receitas.index', ['itens' => $tabela]);

    }

    public function addMedicamentos(paciente $item) {
        return view('painel-medico.receitas.geraReceita',['item' => $item]);
    }

    public function inicializaReceita(paciente $item) {
        $deletados=receita::where('tiporeceita','=',NULL)->delete();
        @session_start();
        $data_hoje=Carbon::now()->toDateTimeString();
        $data_val=Carbon::now()->addMonth(6);
        $newreceita=new receita();
        $newreceita->idpaciente=$item->id;
        $newreceita->idmedico=@$_SESSION['id_medico'];
        $newreceita->data=$data_hoje;
        $newreceita->validade=$data_val;
        $newreceita->save();
        echo "<script language='javascript'> window.alert('Receita Gerada !') </script>";
        return view('painel-medico.receitas.geraReceita',['item' => $item]);
    }

    public function finalizaReceita(Request $request, receita $idreceita) {
        $conta_receitados=receitado::where('idreceita','=',$idreceita->id)->count();
        $item_aux=receita::where('id','=',$idreceita->id)->first();
        $item=paciente::where('id','=',$item_aux->idpaciente)->first();
        if ($conta_receitados == 0) {
            echo "<script language='javascript'> window.alert('Nenhum medicamento prescrito. Prescreva ao menos 1 medicamento !') </script>";
            return view('painel-medico.receitas.geraReceita',['item' => $item]);
        }
        else {
            $idreceita->status="Ativa";
            $idreceita->tiporeceita=$request->tiporeceita;
            $idreceita->save();
            echo "<script language='javascript'> window.alert('Receita Incluída com sucesso !') </script>";
            return redirect()->route('medicos.index');
        }
    }

    public function listaReceitas(Request $request) {
        $deletados=receita::where('tiporeceita','=',NULL)->delete();
        $data_hoje=Carbon::now()->toDateTimeString();
        $muda_validade=receita::where('validade','<',$data_hoje)->get();
        foreach($muda_validade as $mv) {
            $mv->status="Inativa";
            $mv->save();
        }
        $pnome = $request->query('nome');
        $tabela = paciente::where('nome', 'like',  '%' .$pnome. '%')->get();
        return view('painel-medico.receitas.pesquisa', ['itens' => $tabela]);

    }
    public function listaPacRec(paciente $paciente) {
        return view('painel-medico.receitas.lista',['item' => $paciente]);
    }

    public function montaReceita(receita $idreceita){
        return view('painel-medico.receitas.monta',['idreceita' => $idreceita]);
    }
}
