@extends('layout')


@section('contenido')
    @if (Auth::guest())
        @include('partials.permission')
    @else
    <div class="jumbotron">
    <h1>Datos de la ganadería</h1>
    <h2>Nombre: {{$ganaderia->nombre}}</h2>
    <h2>Dirección: {{$ganaderia->direccion}}</h2>
    <h3>Asociación: {{$ganaderia->asociacion->nombre}} </h3>
        <br>
        <a href="{{url('editar/ganaderia',['ganaderia'=>$ganaderia])}}" class="btn btn-success btn-sm" role="button"><span class="glyphicon glyphicon-edit"></span> Editar</a>
        <a href="{{url('eliminar/ganaderia',['ganaderia'=>$ganaderia])}}" class="btn btn-danger btn-sm" role="button"><span class="glyphicon glyphicon-remove"></span> Eliminar</a>
        <a href="{{url('registrar/ganadero',['ganaderia'=>$ganaderia])}}" class="btn btn-primary btn-md" role="button"><span class="glyphicon glyphicon-plus"></span> Registrar Ganadero</a>
        <a href="{{url('registrar/ganado',['ganaderia'=>$ganaderia])}}" class="btn btn-primary btn-md" role="button"><span class="glyphicon glyphicon-plus"></span> Registrar Ganado</a>

    </div>
    <!--TODO Lista de ganados-->
    <!--TODO Lista de ganaderos-->
    <h2>Ganado</h2>
    @include('ganado.tablaGanados');
    <h2>Ganaderos</h2>
    @include('ganadero.tablaGanaderos')

    @endif
@endsection
