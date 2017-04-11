@extends('layout')


@section('contenido')


    <h1>Datos de la res:</h1>
    <p>Modifique los campos que desee editar.</p>
    <form method="POST" class="form" action="{{url('editar/ganaderia/completed')}}">
        {!! csrf_field() !!}
        Nombre:
        <input type="text" name="nombre" class="form-control" placeholder="{{$ganaderia->nombre}}" value="{{$ganaderia->nombre}}"></input>
        Direccion postal:
        <input type="text" name="direccion" class="form-control" placeholder="{{$ganaderia->direccion}}" value="{{$ganaderia->direccion}}"></input>
        Asociacion:
        <select name="asociacion_id" class="form-control">
            @foreach($asociaciones as $asociacion)
                <option value="{{$asociacion->id}}" @if($ganaderia->asociacion==$asociacion) selected="selected"@endif>{{$asociacion->nombre}}</option>
            @endforeach
        </select>
        <input type="hidden" name="ganaderia_id" value="{{$ganaderia->id}}">
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>


@endsection
