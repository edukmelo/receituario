@extends('template.painel-farmacia')
@section('title', 'Uso de Receita')
@section('content')

<?php
use Carbon\Carbon;
@session_start();
$data_hoje=Carbon::now()->toDateTimeString();
if(@$_SESSION['nivel_usuario'] != 'Farmacia'){
  echo "<script language='javascript'> window.location='./' </script>";
}
if(!isset($id)){
  $id = "";

}
?>

<h6 class="mb-4"><i>UTILIZAÇÃO DE RECEITA</i></h6><hr>
<form method="POST" action="{{route('utiliza.insert')}}">
    @csrf
    <div class="modal-body">
                <div class="form-group">
                    <label >Drogaria</label>
                    <input value="{{@$_SESSION['nome_usuario']}}" type="text" class="form-control" id="farmacia" name="farmacia">
                </div>
                <div class="form-group">
                    <label >Data de Uso</label>
                    <input value="{{$data_hoje}}" type="text" class="form-control" id="datauso" name="datauso" disabled="true">
                </div>
    </div>
    <input value="{{$idreceita}}" type="hidden" class="form-control" id="idreceita" name="idreceita">
    <div class="modal-footer">
        <button type="submit" name="btn-salvar-perfil" id="btn-salvar-perfil" class="btn btn-primary">Confirma Uso <i class="fas fa-fw fa-check"> </i></button>
    </div>
</form>
@endsection

