@extends('template.painel-farmacia')
@section('title','Painel de Farmácias')
@section('content')
<?php
@session_start();
if(@$_SESSION['nivel_usuario'] != 'Farmacia'){
  echo "<script language='javascript'> window.location='./' </script>";
}
?>
<center>
    <img src="{{URL::asset('img/painelfarmacia.png')}}">
</center>
@endsection
