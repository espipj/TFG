@extends('layout')


@section('contenido')


    <h1>Datos de la res:</h1>
    <h2>Crotal: {{$ganado->crotal}}</h2>
    <h2>Ganadería: {{$ganado->ganaderia->nombre}}</h2>
    <h3>Sexo: {{$ganado->sexo->nombre}}</h3>
    <h3>Fecha de Nacimiento: {{$ganado->fecha_nacimiento}}</h3>
    <a href="{{url('editar/ganado',['ganado'=>$ganado])}}" class="btn btn-success btn-sm" role="button"><span class="glyphicon glyphicon-edit"></span> Editar</a>
    <a href="{{url('eliminar/ganado',['ganado'=>$ganado])}}" class="btn btn-danger btn-sm" role="button"><span class="glyphicon glyphicon-remove"></span> Eliminar</a>



@endsection
