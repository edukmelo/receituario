@extends('template.painel-admin')
@section('title', 'Medicamentos')
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

<h4 class="mb-4"><i>LISTAGEM DE MEDICAMENTOS</i></h4><hr>
<h7 class="red"><i>Atenção ! Caso o medicamento necessário não esteja cadastrado, entrar em contato com o administrador
do sistema. Neste caso, a receita deve ser feita a mão.</i></h7><hr>
<div class="card shadow mb-4">
<div class="card-body">
<form method="GET" action="{{route('pesqmedicamentos.index')}}">
@csrf
@method('get')
<div class="col-md-3">
    <div class="form-group">
        <label for="buscnome">Busca por nome</label>
        <input value="" name="nome" type="text" class="form-control" id="nome"  placeholder="Digite o nome do medicamento">
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
          <th>Formato</th>
          <th>Tamanho</th>
          <th>Função</th>
        </tr>
      </thead>
      <tbody>
      @foreach($itens as $item)
         <tr>
            <td>{{$item->nome}}</td>
            <td>{{$item->formato}}</td>
            <td>{{$item->tamanho}}</td>
            <td>{{$item->funcao}}</td>
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


