@extends('template.painel-paciente')
@section('title','Painel de Pacientes')
@section('content')
<?php
@session_start();
if(@$_SESSION['nivel_usuario'] != 'Paciente'){
  echo "<script language='javascript'> window.location='./' </script>";
}
?>
<center>
    <img src="{{URL::asset('img/painelpaciente.png')}}">
</center>
@endsection
