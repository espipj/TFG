@extends('layout')


@section('contenido')


  @include('partials/errors')

  <form method="POST" class="form" action="{{url('registrar/ganaderia')}}">
    {!! csrf_field() !!}
    Nombre:
    <input type="text" name="nombre" class="form-control" placeholder="Nombre" value="{{ old('nombre')}}"></input>
    Direccion postal:
    <input type="text" name="direccion" class="form-control" placeholder="Direccion" value="{{ old('direccion')}}"></input>
    Asociación:
    <select name="asociacion_id" class="form-control">
      @foreach($asociaciones as $asociacion)
        <option value="{{$asociacion->id}}" {{ (old("asociacion_id") == $asociacion->id ? "selected":"") }}>{{$asociacion->nombre}}</option>
      @endforeach
    </select>
    <button type="submit" class="btn btn-primary">Crear</button>
  </form>

@endsection
