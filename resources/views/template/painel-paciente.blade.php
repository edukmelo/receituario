<?php
use App\Models\paciente;
use App\Models\usuario;
@session_start();
$id_usuario = @$_SESSION['id_usuario'];
$usuario = usuario::find($id_usuario);
$dados_paciente=paciente::where('email','=',@$_SESSION['email_usuario'])->first();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>@yield('title')</title>
        <link href="{{ URL::asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link href="{{ URL::asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
        <script src="{{ URL::asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ URL::asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <link rel="shortcut icon" href="{{ URL::asset('img/favicon.ico') }}" type="image/x-icon">
        <link rel="icon" href="{{ URL::asset('img/favicon.ico') }}" type="image/x-icon">
    </head>
    <body id="page-top">
        <div id="wrapper">
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('homepac.index')}}">
                    <div class="sidebar-brand-text mx-3"><i class="fas fa-fw fa-home fa-3x"></i></div>
                </a>
                <hr class="sidebar-divider my-0">
                <hr class="sidebar-divider">
                <div class="sidebar-heading">
                    Receitas
                </div>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-search"></i>
                        <span>Receitas</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">

                            <a class="collapse-item" href="{{route('paclistapacrec.index',$dados_paciente)}}">Ativas</a>
                            <a class="collapse-item" href="{{route('paclistapacrecin.index',$dados_paciente)}}">Inativas</a>
                        </div>
                    </div>
                </li>
                <hr class="sidebar-divider d-none d-md-block">
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>
            </ul>
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{$usuario->nome}}</span>
                                    <img class="img-profile rounded-circle" src="{{ URL::asset('img/sem-foto.jpg') }}">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="" data-toggle="modal" data-target="#ModalPerfil">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-primary"></i>
                                        Editar Perfil
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{route('usuarios.logout')}}">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-danger"></i>
                                        Sair
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                    <div class="container-fluid">
                       @yield('content')
                    </div>
                </div>
            </div>
        </div>
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <div class="modal fade" id="ModalPerfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Perfil   <i class="fas fa-fw fa-edit"> </i></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">??</span>
                        </button>
                    </div>
                    <form id="form-perfil" method="post" action="{{route('medico.editar', $id_usuario)}}">
                        @csrf
                        @method('put');
                        <div class="modal-body">
                                    <div class="form-group">
                                        <label >Nome</label>
                                        <input value="{{$usuario->nome}}" type="text" class="form-control" id="nome" name="nome" placeholder="Nome" disabled="true">
                                    </div>

                                    <div class="form-group">
                                        <label >Nivel</label>
                                        <input value="{{$usuario->nivel}}" type="text" class="form-control" id="nivel" name="nivel" placeholder="Nivel" disabled="true">
                                    </div>
                                    <div class="form-group">
                                        <label >Email</label>
                                        <input value="{{$usuario->email}}" type="email" class="form-control" id="email" name="email" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <label >Senha</label>
                                        <input value="{{$usuario->senha}}" type="text" class="form-control" id="text" name="senha" >
                                    </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btn-fechar" class="btn btn-secondary" data-dismiss="modal">Cancelar   <i class="fas fa-fw fa-x"> </i></button>
                            <button type="submit" name="btn-salvar-perfil" id="btn-salvar-perfil" class="btn btn-primary">Salvar   <i class="fas fa-fw fa-save"> </i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="{{ URL::asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
        <script src="{{ URL::asset('js/sb-admin-2.min.js') }}"></script>
        <script src="{{ URL::asset('vendor/chart.js/Chart.min.js') }}"></script>
        <script src="{{ URL::asset('js/demo/chart-area-demo.js') }}"></script>
        <script src="{{ URL::asset('js/demo/chart-pie-demo.js') }}"></script>
        <script src="{{ URL::asset('js/mascaras.js') }}"></script>
        <script src="{{ URL::asset('vendor/datatables/jquery.dataTables.min.jss') }}"></script>
        <script src="{{ URL::asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ URL::asset('js/demo/datatables-demo.js') }}"></script>
        <script src="{{ URL::asset('js/demo/mascaras.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
    </body>
</html>
