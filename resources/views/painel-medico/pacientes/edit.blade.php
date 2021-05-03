@extends('template.painel-admin')
@section('title', 'Editar Pacientes')
@section('content')

<h6 class="mb-4"><i>EDITAR PACIENTES</i></h6><hr>
<form method="POST" action="{{route('pacientes.editar',$item)}}">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="pacinome">Nome</label>
                    <input value="{{$item->nome}}" type="text" class="form-control" id="nome" name="nome" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="paciente">Email</label>
                    <input value="{{$item->email}}" type="email" class="form-control" id="email" name="email" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="paciente">Telefone</label>
                    <input value="{{$item->telefone}}" type="text" class="form-control" id="telefone" name="telefone" required>
                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-md-4">
                <div class="form-group">
                    <label for="paciente">CPF</label>
                    <input value="{{$item->cpf}}" type="text" class="form-control" id="cpf" name="cpf" required>
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="paciente">Endereço</label>
                    <input value="{{$item->endereco}}" type="text" class="form-control" id="endereco" name="endereco" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="paciente">Convenio</label>
                    <input value="{{$item->convenio}}" type="text" class="form-control" id="convenio" name="convenio" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="paciente">Carteirinha</label>
                    <input value="{{$item->carteirinha}}" type="text" class="form-control" id="carteirinha" name="carteirinha" required>
                </div>
            </div>
        </div>
        <p align="right">
        <input value="{{$item->cpf}}" type="hidden"  name="oldcpf" >
        <input value="{{$item->email}}" type="hidden"  name="oldemail" >
        <input value="{{$item->carteirinha}}" type="hidden"  name="oldcarteirinha" >
        <button type="submit" class="btn btn-primary">Salvar <i class="fas fa-fw fa-save"> </i></button>
        </p>
    </form>
@endsection

