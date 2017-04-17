@extends('layout')


@section('contenido')


    <h1>Datos del ganadero:</h1>
    <h2>Nombre: {{$ganadero->nombre}}</h2>
    <h2>Apellidos: {{$ganadero->apellido1}} {{$ganadero->apellido2}}</h2>
    <h3>DNI: {{$ganadero->dni}}</h3>
    <h3>Teléfono: <a href="tel:{{$ganadero->telefono}}">{{$ganadero->telefono}}</a></h3>
    <h3>Email: <a href="mailto:{{$ganadero->email}}">{{$ganadero->email}}</a></h3>
    <h3>Ganadería: {{$ganadero->ganaderia->nombre}}</h3>
    <a href="{{url('ver/ganadero',['$ganadero'=>$ganadero])}}" class="btn btn-info btn-sm" role="button"><span class="glyphicon glyphicon-list"></span> Detalles</a>
    <a href="{{url('editar/ganadero',['$ganadero'=>$ganadero])}}" class="btn btn-success btn-sm" role="button"><span class="glyphicon glyphicon-edit"></span> Editar</a>
    <a href="{{url('eliminar/ganadero',['$ganadero'=>$ganadero])}}" class="btn btn-danger btn-sm" role="button"><span class="glyphicon glyphicon-remove"></span> Eliminar</a>


@endsection
