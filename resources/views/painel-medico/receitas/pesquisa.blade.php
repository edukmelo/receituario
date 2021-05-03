@extends('template.painel-admin')
@section('title', 'Pacientes')
@section('content')
<?php
@session_start();
if(@$_SESSION['nivel_usuario'] != 'Medico'){
  echo "<script language='javascript'> window.location='./' </script>";
}
if(!isset($id)){
  $id = "";
}
?>
<div class="card shadow mb-4">
<div class="card-body">
<form method="GET" action="{{route('pesqpacrec.index')}}">
@csrf
@method('get')
<div class="col-md-3">
    <div class="form-group">
        <label for="exampleInputEmail1">Busca paciente por nome</label>
        <input value="" name="nome" type="text" class="form-control" id="nome"  placeholder="Digite o nome do paciente">
    </div>
    <div class="form-group">
    <button type="submit" id="btn-fechar" class="btn btn-primary btn-sm" data-dismiss="modal">Buscar  <i class="fas fa-fw fa-search"> </i></button>
    </div>
</div>
</form>
<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Email</th>
          <th>CPF</th>
          <th>Telefone</th>
          <th>Convenio</th>
        </tr>
      </thead>
      <tbody>
      @foreach($itens as $item)
         <tr>
            <td><a href="{{route('listapacrec.index',$item)}}">{{$item->nome}}</a></td>
            <td>{{$item->email}}</td>
            <td>{{$item->cpf}}</td>
            <td>{{$item->telefone}}</td>
            <td>{{$item->convenio}}</td>
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
