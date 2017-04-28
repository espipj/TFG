@extends('layout')


@section('contenido')

    @if (Auth::guest())
        @include('partials.permission')
    @else

        <div class="jumbotron">
        <h1>Datos de la explotación:</h1>
        <h2>CEA: {{$explotacion->id}}</h2>
        <h2>Municipio: {{$explotacion->municipio}}</h2>
        <a href="{{url('ver/ganadero',['$ganadero'=>$ganadero])}}" class="btn btn-info btn-sm" role="button"><span
                    class="glyphicon glyphicon-list"></span> Detalles</a>
        <a href="{{url('editar/ganadero',['$ganadero'=>$ganadero])}}" class="btn btn-success btn-sm" role="button"><span
                    class="glyphicon glyphicon-edit"></span> Editar</a>
        <a href="{{url('eliminar/ganadero',['$ganadero'=>$ganadero])}}" class="btn btn-danger btn-sm"
           role="button"><span class="glyphicon glyphicon-remove"></span> Eliminar</a>
        </div>
    @endif

@endsection
