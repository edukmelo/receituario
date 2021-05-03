@extends('template.painel-admin')
@section('title', 'Busca Pacientes')
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
<a href="{{route('pacientes.inserir')}}" type="button" class="mt-4 mb-4 btn btn-primary">Inserir Paciente   <i class="fas fa-fw fa-plus"> </i></a>

<!-- DataTales Example -->
<div class="card shadow mb-4">

<div class="card-body">
<form method="GET" action="{{route('pesqpacientes.index')}}">
@csrf
@method('get')
<div class="col-md-3">
    <div class="form-group">
        <label for="paciente">Busca por nome</label>
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
            <td>{{$item->nome}}</td>
            <td>{{$item->email}}</td>
            <td>{{$item->cpf}}</td>
            <td>{{$item->telefone}}</td>
            <td>{{$item->convenio}}</td>
            <td>

            <a href="{{route('pacientes.edit', $item)}}"><i class="fas fa-edit text-info mr-1"></i></a>
            <a href="{{route('pacientes.modal', $item)}}"><i class="fas fa-trash text-danger mr-1"></i></a>
            </td>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Deletar Registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Deseja Realmente Excluir este Registro?

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <form method="POST" action="{{route('pacientes.delete', $id)}}">
          @csrf
          @method('delete')
          <button type="submit" class="btn btn-danger">Excluir</button>
        </form>
      </div>
    </div>
  </div>
<?php
if(@$id != ""){
  echo "<script>$('#exampleModal').modal('show');</script>";
}
?>
@endsection


