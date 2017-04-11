@extends('layout')


@section('contenido')


    <h1>Datos de la res:</h1>
    <h2>Crotal: {{$ganado->crotal}}</h2>
    <h2>Ganadería: {{$ganado->ganaderia->nombre}}</h2>
    <h3>Sexo: {{$ganado->sexo->nombre}}</h3>
    <h3>Fecha de Nacimiento: {{$ganado->fecha_nacimiento}}</h3>
    <form method="POST" action="{{url('editar/ganado')}}" style="display: inline">
        {!! csrf_field() !!}
        <input type="hidden" name="ganado_id" value="{{ $ganado->id }}">
        <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-edit"></span> Modificar</button>
    </form>
    <form method="POST" action="{{url('eliminar/ganado')}}" style="display: inline">
        {!! csrf_field() !!}
        <input type="hidden" name="ganado_id" value="{{ $ganado->id }}">
        <button type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span> Eliminar</button>
    </form>


@endsection
