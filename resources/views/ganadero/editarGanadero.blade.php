@extends('layout')


@section('contenido')


    <h1>Datos del ganadero:</h1>
    <p>Modifique los campos que desee editar.</p>
    <form method="POST" class="form" action="{{url('editar/ganadero/completed')}}">
        {!! csrf_field() !!}
        Nombre:
        <input type="text" name="nombre" class="form-control" placeholder="{{ $ganadero->nombre }}" value="{{ $ganadero->nombre }}">
        Primer Apellido:
        <input type="text" name="apellido1" class="form-control" placeholder="{{ $ganadero->apellido1 }}" value="{{ $ganadero->apellido1 }}">
        Segundo Apellido:
        <input type="text" name="apellido2" class="form-control" placeholder="{{ $ganadero->apellido2 }}" value="{{ $ganadero->apellido2 }}">
        DNI:
        <input type="text" name="dni" class="form-control" placeholder="{{ $ganadero->dni }}" value="{{ $ganadero->dni }}">
        Correo Electronico:
        <input type="text" name="email" class="form-control" placeholder="{{ $ganadero->email }}" value="{{ $ganadero->email }}">
        Telefono:
        <input type="text" name="telefono" class="form-control" placeholder="{{ $ganadero->email }}" value="{{ $ganadero->email }}">
        Ganadería:
        <select name="ganaderia_id" class="form-control">
            @foreach($ganaderias as $ganaderia)
                <option value="{{$ganaderia->id}}" @if($ganadero->ganaderia==$ganaderia) selected="selected"@endif>{{$ganaderia->nombre}}</option>
            @endforeach
        </select>
        <input type="hidden" name="ganadero_id" value="{{$ganadero->id}}">
        <button type="submit" class="btn btn-primary">Confirmar</button>
    </form>


@endsection
