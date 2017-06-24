@extends('layout')

@section('head')

    <meta name="csrf-token" content="{{{ csrf_token() }}}">

@endsection

@section('contenido')

    @if (Auth::guest())
        @include('partials.permission')
    @else


        <h1>Usuarios</h1>
        <p>Desde esta página puedes cambiar los permisos de cada usuario existente, asi como asignarle responsabilidades.</p>

        @include('usuario.tablaUsuarios')
    @endif
@endsection
