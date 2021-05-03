@extends('template.painel-farmacia')
@section('title', 'Receitas Ativas')
@section('content')
<?php
use App\Models\paciente;
use App\Models\receita;
@session_start();
if(@$_SESSION['nivel_usuario'] != 'Farmacia'){
  echo "<script language='javascript'> window.location='./' </script>";
}
if(!isset($id)){
  $id = "";
}
$ativas = receita::where('idpaciente','=',$item->id)->where('status','=','Ativa')->get();
$pac= paciente::where('id','=',$item->id)->first();
?>

<div class="card shadow mb-4">
<div class="card-body">
@csrf
@method('get')
<a href="{{route('indicepacientes.index')}}" type="button" class="mt-4 mb-4 btn btn-primary">Voltar <i class="fas fa-fw fa-backspace"> </i></a>
<div class="col-md-3">
    <div class="form-group">
        <label for="receitas_ativas" style="font-weight: bold;">Receitas Ativas para {{$pac->nome}} </label>
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
            <td><a href="{{route('farmontareceita.index',$at->id)}}">{{$at->id}}</a></td>
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
</div>
<script type="text/javascript">
  $(document).ready(function () {
    $('#dataTable').dataTable({
      "ordering": false
    })

  });
</script>
@endsection
