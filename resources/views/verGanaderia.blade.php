@extends('layout')


@section('contenido')


    <h1>Datos de la asociación</h1>
    <h2>Nombre: {{$asociacion->nombre}}</h2>
    <h2>Dirección: {{$asociacion->direccion}}</h2>
    <h3>Email: <a href="mailto:{{$asociacion->email}}">{{$asociacion->email}}</a></h3>

    <!--TODO Lista de ganaderias-->
    <form method="POST" action="{{url('editar/asociacion')}}" style="display: inline">
        {!! csrf_field() !!}
        <input type="hidden" name="asociacion_id" value="{{ $asociacion->id }}">
        <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-edit"></span> Modificar</button>
    </form>
    <form method="POST" action="{{url('eliminar/asociacion')}}" style="display: inline">
        {!! csrf_field() !!}
        <input type="hidden" name="asociacion_id" value="{{ $asociacion->id }}">
        <button type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span> Eliminar</button>
    </form>


@endsection
