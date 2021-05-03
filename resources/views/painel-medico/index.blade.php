@extends('template.painel-admin')
@section('title','Painel de Médicos')
@section('content')
<?php
@session_start();
if(@$_SESSION['nivel_usuario'] != 'Medico'){
  echo "<script language='javascript'> window.location='./' </script>";
}
?>
<center>
    <img src="{{URL::asset('img/painelmedico.png')}}">
</center>
@endsection
