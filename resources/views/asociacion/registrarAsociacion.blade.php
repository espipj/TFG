@extends('layout')


@section('contenido')

  @if (Auth::guest())
    @include('partials.permission')
  @else

  @include('partials.errors')

  <form method="POST" class="form" action="{{url('registrar/asociacion')}}">
    {!! csrf_field() !!}
    Nombre:
    <input type="text" name="nombre" class="form-control" placeholder="Nombre" value="{{ old('nombre')}}"></input>
    Direccion postal:
    <input type="text" name="direccion" class="form-control" placeholder="Direccion" value="{{ old('direccion')}}"></input>
    Email:
    <input type="text" name="email" class="form-control" placeholder="Email" value="{{ old('email')}}"></input>

    <button type="submit" class="btn btn-primary">Crear</button>
  </form>
  @endif
@endsection
