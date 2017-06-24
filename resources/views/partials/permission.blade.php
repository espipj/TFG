@extends('layout')

@section('contenido')
<div class="alert alert-danger">
<h1>Error!</h1>
<h4>No has iniciado sesión para ver la página solicitada inicia sesión, <a href="{{route('register')}}">regístrate</a> o contacta con el administrador de la web.</h4>
</div>


@include('auth.loginform')
@endsection
