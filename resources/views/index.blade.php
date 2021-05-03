<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<title> Receituário Médico Online </title>
<link rel="shortcut icon" href="{{ URL::asset('img/favicon.ico') }}" type="image/x-icon">
<link rel="icon" href="{{ URL::asset('img/favicon.ico') }}" type="image/x-icon">
<div class="container">
        <div class="row justify-content-center align-items-center" style="height:100vh">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <center>
                    <h1><img src="{{ URL::asset('img/logo_mod.png') }}" "></h1><br><br>
                        </center>
                    <form method="post" action="{{route('usuarios.login')}}">
                        @csrf
                            <div class="form-group">
                                <label for="usuario">Digite seu e-mail:</label>
                                <input type="text" class="form-control" name="usuario" placeholder="Digite o e-mail">
                            </div>
                            <div class="form-group">
                                <label for="senha">Digite sua senha:</label>
                                <input type="password" class="form-control" name="senha" placeholder="Digite sua senha">
                            </div>
                            <button type="submit" id="sendlogin" class="btn btn-primary">Entrar no sistema</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
