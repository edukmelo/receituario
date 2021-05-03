@extends('template.painel-admin')
@section('title', 'Cadastro de Pacientes')
@section('content')

<h6 class="mb-4"><i>CADASTRO DE PACIENTES</i></h6><hr>
<form method="POST" action="{{route('pacientes.insert')}}">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="nomepaci">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="emailpac">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="fonepaci">Telefone</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" required>
                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-md-4">
                <div class="form-group">
                    <label for="cpfpacie">CPF</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" required>
                </div>
            </div>


            <div class="col-md-8">
                <div class="form-group">
                    <label for="endepaci">Endereço</label>
                    <input type="text" class="form-control" id="endereco" name="endereco" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="convpaci">Convenio</label>
                    <input type="text" class="form-control" id="convenio" name="convenio" required>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="cartpaci">Carteirinha</label>
                    <input type="text" class="form-control" id="carteirinha" name="carteirinha" required>
                </div>
            </div>
        </div>
        <p align="right">
        <button type="submit" class="btn btn-primary">Salvar  <i class="fas fa-fw fa-save"> </i></button>
        </p>
    </form>
@endsection
