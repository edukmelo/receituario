<?php

namespace App\Http\Controllers;

use App\Models\paciente;
use App\Models\usuario;
use Illuminate\Http\Request;

class cadPacientesController extends Controller
{
    public function index() {
       $tabela = paciente::orderby('nome','asc')->paginate();
       return view('painel-medico.pacientes.index', ['itens' => $tabela]);

    }
    public function create() {
        return view('painel-medico.pacientes.create');
    }
    public function insert(Request $request) {
        $tabela = new paciente();
        $tabela->nome = $request->nome;
        $tabela->email = $request->email;
        $tabela->telefone = $request->telefone;
        $tabela->cpf = $request->cpf;
        $tabela->endereco = $request->endereco;
        $tabela->convenio = $request->convenio;
        $tabela->carteirinha = $request->carteirinha;
        $tabela2 = new usuario();
        $tabela2->nome = $request->nome;
        $tabela2->email = $request->email;
        $tabela2->senha = '123';
        $tabela2->nivel = 'Paciente';
        $itens = paciente::where('email', '=', $request->email)->orwhere('cpf', '=', $request->cpf)->orwhere('carteirinha', '=', $request->carteirinha)->count();
        if ($itens > 0) {
            echo "<script language='javascript'> window.alert('Paciente já existente') </script>";
            return view('painel-medico.pacientes.create');
        }
        $tabela->save();
        $tabela2->save();
        return redirect()->route('pacientes.index');
    }
    public function edit(paciente $item) {
        return view('painel-medico.pacientes.edit',['item' => $item]);
    }
    public function editar(Request $request, paciente $item) {
        $item->nome = $request->nome;
        $item->email = $request->email;
        $item->telefone = $request->telefone;
        $item->cpf = $request->cpf;
        $item->endereco = $request->endereco;
        $item->convenio = $request->convenio;
        $item->carteirinha = $request->carteirinha;

        $oldcpf = $request->oldcpf;
        $oldemail = $request->oldemail;
        $oldcarteirinha = $request->oldcarteirinha;

        if ($oldcpf != $request->cpf) {
            $itens = paciente::where('cpf', '=', $request->cpf)->count();
            if ($itens > 0) {
                echo "<script language='javascript'> window.alert('CPF já cadastrado') </script>";
                return view('painel-medico.pacientes.edit',['item' => $item]);
            }
        }

        if ($oldemail != $request->email) {
            $itens = paciente::where('email', '=', $request->email)->count();
            if ($itens > 0) {
                echo "<script language='javascript'> window.alert('EMAIL já cadastrado') </script>";
                return view('painel-medico.pacientes.edit',['item' => $item]);
            }
        }

        if ($oldcarteirinha != $request->carteirinha) {
            $itens = paciente::where('carteirinha', '=', $request->carteirinha)->count();
            if ($itens > 0) {
                echo "<script language='javascript'> window.alert('CARTEIRINHA já cadastrada') </script>";
                return view('painel-medico.pacientes.edit',['item' => $item]);
            }
        }

        $item->save();
        return redirect()->route('pacientes.index');
    }
    public function delete(paciente $item) {
        $item->delete();
        return redirect()->route('pacientes.index');
    }

    public function modal($id) {
        $item = paciente::orderby('nome', 'asc')->paginate();
        return view('painel-medico.pacientes.index', ['itens' =>$item, 'id' =>$id]);
    }

    public function pesquisa(Request $request) {
        $pnome = $request->query('nome');
        $tabela2 = paciente::where('nome', 'like',  '%' .$pnome. '%')->get();
        return view('painel-medico.pacientes.index', ['itens' => $tabela2]);

    }
}
