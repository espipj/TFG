@extends('layout')


@section('contenido')


  @include('partials/errors')

  <form method="POST" class="form" action="{{url('registrar/ganadero')}}">
    {!! csrf_field() !!}
    Nombre:
    <input type="text" name="nombre" class="form-control" placeholder="Nombre" value="{{ old('nombre')}}"></input>
    Primer Apellido:
    <input type="text" name="apellido1" class="form-control" placeholder="Primero Apellido" value="{{ old('apellido1')}}"></input>
    Segundo Apellido:
    <input type="text" name="apellido2" class="form-control" placeholder="Segundo Apellido" value="{{ old('apellido2')}}"></input>
    DNI:
    <input type="text" name="dni" class="form-control" placeholder="DNI" value="{{ old('dni')}}"></input>
    Email:
    <input type="text" name="email" class="form-control" placeholder="Email" value="{{ old('email')}}"></input>
    Telefono:
    <input type="text" name="telefono" class="form-control" placeholder="telefono" value="{{ old('telefono')}}"></input>
    Ganadería:
    <select name="ganaderia_id" class="form-control">
      <option disabled selected value> -- Selecciona una opción -- </option>
      @foreach($ganaderias as $ganaderia)
        <option value="{{$ganaderia->id}}">{{$ganaderia->nombre}}</option>
      @endforeach
    </select>
    <button type="submit" class="btn btn-primary">Crear</button>
  </form>

@endsection
