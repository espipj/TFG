@extends('layout')


@section('contenido')


    <h1>Datos de la ganadería</h1>
    <h2>Nombre: {{$ganaderia->nombre}}</h2>
    <h2>Dirección: {{$ganaderia->direccion}}</h2>
    <h3>Asociación: {{$ganaderia->asociacion->nombre}} </h3>

    <!--TODO Lista de ganados-->
    <!--TODO Lista de ganaderos-->
    <form method="POST" action="{{url('editar/ganaderia')}}" style="display: inline">
        {!! csrf_field() !!}
        <input type="hidden" name="ganaderia_id" value="{{ $ganaderia->id }}">
        <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-edit"></span> Modificar</button>
    </form>
    <form method="POST" action="{{url('eliminar/ganaderia')}}" style="display: inline">
        {!! csrf_field() !!}
        <input type="hidden" name="ganaderia_id" value="{{ $ganaderia->id }}">
        <button type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span> Eliminar</button>
    </form>


@endsection
