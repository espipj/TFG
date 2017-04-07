@extends('layout')


@section('contenido')


  @include('partials/errors')

  <form method="POST" class="form" action="{{url('registrar/ganado')}}">
    {!! csrf_field() !!}
    Crotal:
    <input type="text" name="crotal" class="form-control" placeholder="Crotal" value="{{ old('crotal')}}"></input>
    Sexo:
    <input type="text" name="sexo" class="form-control" placeholder="Macho/Hembra" value="{{ old('sexo')}}"></input>
    Fecha de nacimiento:
    <input type="date" name="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento')}}"></input>
    Fecha de nacimiento:
    <select name="ganaderia_id" class="form-control" value="{{old('ganaderia_id')}}">
      @foreach($ganaderias as $ganaderia)
        <option value="{{$ganaderia->id}}">{{$ganaderia->nombre}}</option>
      @endforeach
    </select>
    <button type="submit" class="btn btn-primary">Crear</button>
  </form>

@endsection
