@extends('layout')


@section('contenido')


    <h1>Datos del ganadero:</h1>
    <h2>Nombre: {{$ganadero->nombre}}</h2>
    <h2>Apellidos: {{$ganadero->apellido1}} {{$ganadero->apellido2}}</h2>
    <h3>DNI: {{$ganadero->dni}}</h3>
    <h3>Teléfono: <a href="tel:{{$ganadero->telefono}}">{{$ganadero->telefono}}</a></h3>
    <h3>Email: <a href="mailto:{{$ganadero->email}}">{{$ganadero->email}}</a></h3>
    <h3>Ganadería: {{$ganadero->ganaderia->nombre}}</h3>
    <form method="POST" action="{{url('editar/ganadero')}}" style="display: inline">
        {!! csrf_field() !!}
        <input type="hidden" name="ganadero_id" value="{{ $ganadero->id }}">
        <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-edit"></span> Modificar</button>
    </form>
    <form method="POST" action="{{url('eliminar/ganadero')}}" style="display: inline">
        {!! csrf_field() !!}
        <input type="hidden" name="ganadero_id" value="{{ $ganadero->id }}">
        <button type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span> Eliminar</button>
    </form>


@endsection
