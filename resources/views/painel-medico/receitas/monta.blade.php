@extends('template.painel-admin')
@section('title', 'Receita')
@section('content')
<?php
use App\Models\medico;
use App\Models\paciente;
use App\Models\receita;
use App\Models\receitado;
@session_start();
if(@$_SESSION['nivel_usuario'] != 'Medico'){
  echo "<script language='javascript'> window.location='./' </script>";
}
if(!isset($id)){
  $id = "";
}
$monta_receita=receita::where('id','=',$idreceita->id)->first();
$receitados_todos=receitado::where('idreceita','=',$idreceita->id)->get();
$pegamedico=medico::where('id','=',$monta_receita->idmedico)->first();
$pegapaciente=paciente::where('id','=',$monta_receita->idpaciente)->first();
?>

<div class="card shadow mb-4">
<div class="card-body">
@csrf
@method('get')
<a href="{{route('listapacrec.index',$pegapaciente->id)}}" type="button" class="mt-4 mb-4 btn btn-primary">Voltar <i class="fas fa-fw fa-backspace"> </i></a>
<center><h3><label for="receita" style="font-weight: bold; text-decoration: underline;">Receituário </label></h3></center><br><br>
<h6><label for="receita" >Numero da receita:         {{$monta_receita->id}} </label></h6>
<h6><label for="receita" >Médico Responsável: Dr(a). {{$pegamedico->nome}} </label></h6>
<h6><label for="receita" >Nome do paciente:          {{$pegapaciente->nome}}</label></h6>
<hr width = “2” size = “100”>
<br>
<h5><label for="receita" >Descrição da receita: </label></h5>
<div class="col-md-11">
<div class="table-responsive">
    <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th</th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      @foreach($receitados_todos as $rec)
         <tr>
            <th></th>
            <th>{{$rec->nome}}</th>
            <th>{{$rec->modouso}}</th>
        </tr>
        @endforeach
      </tbody>
  </table>
</div>
</div>
<br><hr width = “2” size = “100”>
<div class="row">
<div class="col-md-6">
    <h6><label for="receita" >Data:         {{$monta_receita->data}} </label></h6>
</div>
<div class="col-md-6">
    <h6><label for="receita" >Assinatura do médico responsavel: </label></h6><br>
    <h6><label for="receita" >{{$pegamedico->nome}}: </label></h6>
    <h6><label for="receita" >CRM: {{$pegamedico->crm}} </label></h6>
</div>
</div>
</div>
</div>
@endsection
