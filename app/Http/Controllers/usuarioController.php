<?php

namespace App\Http\Controllers;

use App\Models\medico;
use App\Models\usuario;
use Illuminate\Http\Request;

class usuarioController extends Controller
{
    public function login(Request $request){

        $usuario = $request->usuario;
        $senha = $request->senha;

        $usuarios = usuario::where('email', '=', $usuario)->where('senha', '=', $senha)->first();

        if(@$usuarios->id != null){
            @session_start();
            $_SESSION['id_usuario'] = $usuarios->id;
            $_SESSION['nome_usuario'] = $usuarios->nome;
            $_SESSION['email_usuario']= $usuarios->email;
            $_SESSION['nivel_usuario'] = $usuarios->nivel;
            if($_SESSION['nivel_usuario'] == 'Medico'){
                $dados_medico = medico::where('email', '=', @$_SESSION['email_usuario'])->first();
                $_SESSION['crm_usuario'] = $dados_medico->crm;
                $_SESSION['id_medico'] = $dados_medico->id;
                return view('painel-medico.index');
            }
            if($_SESSION['nivel_usuario'] == 'Paciente'){
                return view('painel-paciente.index');
            }
            if($_SESSION['nivel_usuario'] == 'Farmacia'){
                return view('painel-farmacia.index');
            }

        }else{
            echo "<script language='javascript'> window.alert('Dados Incorretos!') </script>";
            return view('index');
        }
    }
    public function logout(){
       @session_start();
       @session_destroy();
       return view('index');
    }
}
