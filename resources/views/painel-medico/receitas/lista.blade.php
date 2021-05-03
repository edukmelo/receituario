@extends('template.painel-admin')
@section('title', 'Lista Receita')
@section('content')
<?php
use App\Models\paciente;
use App\Models\receita;
@session_start();
if(@$_SESSION['nivel_usuario'] != 'Medico'){
  echo "<script language='javascript'> window.location='./' </script>";
}
if(!isset($id)){
  $id = "";
}
$ativas = receita::where('idpaciente','=',$item->id)->where('status','=','Ativa')->get();
$inativas = receita::where('idpaciente','=',$item->id)->where('status','=','Inativa')->get();
$pac= paciente::where('id','=',$item->id)->first();
?>

<div class="card shadow mb-4">
<div class="card-body">
@csrf
@method('get')
<a href="{{route('listareceitas.index')}}" type="button" class="mt-4 mb-4 btn btn-primary">Voltar <i class="fas fa-fw fa-backspace"> </i></a>
<div class="col-md-3">
    <div class="form-group">
        <label for="receita" style="font-weight: bold;">Receitas Ativas para {{$pac->nome}} </label>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>Id Receita</th>
          <th>Data</th>
          <th>Validade</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
      @foreach($ativas as $at)
         <tr>
            <td><a href="{{route('montareceita.index',$at->id)}}">{{$at->id}}</a></td>
            <td>{{$at->data}}</td>
            <td>{{$at->validade}}</td>
            <td style="color: green; font-weight: bold; ">{{$at->status}}</td>
        </tr>
        @endforeach
      </tbody>
  </table>
</div>
</div>
</div>
<div class="card shadow mb-4">
<div class="card-body">
<div class="col-md-3">
    <div class="form-group">
        <label for="receita" style="font-weight: bold;">Receitas Inativas para {{$pac->nome}} </label>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>Id Receita</th>
          <th>Data</th>
          <th>Validade</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
      @foreach($inativas as $inat)

         <tr>
            <td>{{$inat->id}}</td>
            <td>{{$inat->data}}</td>
            <td>{{$inat->validade}}</td>
            <td style="color: red; font-weight: bold;">{{$inat->status}}</td>

        </tr>
        @endforeach
      </tbody>
  </table>
</div>
</div>
</div>
</div>
<script type="text/javascript">
  $(document).ready(function () {
    $('#dataTable').dataTable({
      "ordering": false
    })

  });
</script>
@endsection
