@extends('layout')


@section('contenido')

    @if (Auth::guest())
        @include('partials.permission')
    @else

    <h1>Datos de la asociación:</h1>
    <p>Modifique los campos que desee editar.</p>
    <form method="POST" class="form" action="{{url('editar/asociacion/completed')}}">
        {!! csrf_field() !!}

        Nombre:
        <input type="text" name="nombre" class="form-control" placeholder="{{$asociacion->nombre}}" value="{{$asociacion->nombre}}"></input>
        Direccion postal:
        <input type="text" name="direccion" class="form-control" placeholder="{{$asociacion->direccion}}" value="{{$asociacion->direccion}}"></input>
        Email:
        <input type="text" name="email" class="form-control" placeholder="{{$asociacion->email}}" value="{{$asociacion->email}}"></input>

        <input type="hidden" name="asociacion_id" value="{{$asociacion->id}}">
        <button type="submit" class="btn btn-primary">Confirmar</button>
    </form>

    @endif
@endsection
