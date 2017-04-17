@extends('layout')


@section('contenido')

    <div class="jumbotron">
        <h1>Datos de la asociación</h1>
        <h2>Nombre: {{$asociacion->nombre}}</h2>
        <h2>Dirección: {{$asociacion->direccion}}</h2>
        <h3>Email: <a href="mailto:{{$asociacion->email}}">{{$asociacion->email}}</a></h3>

        <br>

        <a href="{{url('editar/asociacion',['asociacion'=>$asociacion])}}" class="btn btn-success btn-sm" role="button"><span class="glyphicon glyphicon-edit"></span> Editar</a>
        <a href="{{url('eliminar/asociacion',['asociacion'=>$asociacion])}}" class="btn btn-danger btn-sm" role="button"><span class="glyphicon glyphicon-remove"></span> Eliminar</a>

    </div>

    <!--TODO ¿Meterlo en un collapsible panel?-->
    @include('ganaderia.tablaGanaderias');



@endsection
