@extends('template.painel-admin')
@section('title', 'Gerar Receita')
@section('content')
<?php
@session_start();
use App\Models\receita;
use App\Models\receitado;
use Carbon\Carbon;
$date = Carbon::now()->toDateTimeString();
$datef=\Carbon\Carbon::parse($date)->format('d/m/Y');
$receitados=receita::where('idpaciente','=',$item->id)->orderby('id','desc')->first();
$receitados_todos=receitado::where('idreceita','=',$receitados->id)->get();
$conta_receitados=receitado::where('idreceita','=',$receitados->id)->count();
if(@$_SESSION['nivel_usuario'] != 'Medico'){
  echo "<script language='javascript'> window.location='./' </script>";
}
if(!isset($id)){
  $id = "";

}
?>
<div class="card shadow mb-4">
<div class="card-body">
<div class="row">
                <div class="form-group">
                    <label for="receita">Nome do(a) paciente:  {{$item->nome}}</label><br>
                </div>
</div>
<div class="row">
                <div class="form-group">
                    <label for="receita">CPF:   {{$item->cpf}}</label>
                </div>
</div>
<div class="row">
                <div class="form-group">
                    <label for="receita">Data:   {{$datef}}</label>
                </div>
</div>
<div class="row">
                <div class="form-group">
                    <label for="receita">Nome do médico: Dr(a). {{@$_SESSION['nome_usuario']}} </label><br>
                </div>
</div>
<div class="row">
                <div class="form-group">
                    <label for="receita">CRM:   {{@$_SESSION['crm_usuario']}}</label>
                </div>
</div>
</form>
<a href="{{route('receitas.inserir',$receitados->id)}}" type="button" class="mt-4 mb-4 btn btn-primary">Prescrever Medicamento<i class="fas fa-fw fa-plus"> </i></a>
  <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Modo de Uso</th>
        </tr>
      </thead>
      <tbody>
          @foreach($receitados_todos as $rect)
        <tr>
            <td>{{$rect->nome}}</td>
            <td>{{$rect->modouso}}</td>
        </tr>
        @endforeach
      </tbody>
  </table>
</div>
<br><b>
<div class="col-md-4">
<label>Tipo de receita</label>
<form method="POST" action="{{route('finalizareceita.index',$receitados->id)}}">
        @csrf
        @method('post')
    <select class="form-control" name="tiporeceita" id="tiporeceita">
            <option value='Normal' id="normal">Normal</option>
            <option value='Renovavel' id="renovavel">Renovável</option>
            <option value='Controle Especial' id="especial">Controle Especial</option>
    </select>
</div>
<br>
<button type="submit" class="mt-4 mb-4 btn btn-primary">Salvar  <i class="fas fa-fw fa-save"> </i></button>
</form>
</div>
</div>
@endsection
