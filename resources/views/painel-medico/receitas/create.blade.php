@extends('template.painel-admin')
@section('title', 'Prescrever')
@section('content')

<h6 class="mb-4"><i>PRESCRIÇÃO DE MEDICAMENTOS</i></h6><hr>
<form method="POST" action="{{route('receitas.insert')}}">
    @csrf
    <div class="modal-body">
                <div class="form-group">
                <label >Medicamento</label>
                <select class="form-control" name="nome" id="nome">
                <?php
                    use App\Models\medicamento;
                    $tabela = medicamento::all();
                ?>
                @foreach($tabela as $medicamento)
                    <option value='{{$medicamento->nome}}' id="nome">{{$medicamento->nome}} - {{$medicamento->formato}} - {{$medicamento->tamanho}}</option>
                @endforeach
                </select>
                </div>
                <div class="form-group">
                    <label >Posologia (Qtd x intervalo x periodo)</label>
                    <input value="" type="text" class="form-control" id="posologia" name="posologia" placeholder="Posologia">
                </div>
    </div>
    <input value="{{$idreceita}}" type="hidden" class="form-control" id="idreceita" name="idreceita">
    <div class="modal-footer">
        <button type="submit" name="btn-salvar-perfil" id="btn-salvar-perfil" class="btn btn-primary">Salvar  <i class="fas fa-fw fa-save"> </i></button>
    </div>
</form>
@endsection

