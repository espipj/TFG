@extends('layout')


@section('contenido')


    @include('partials.errors')

    <form method="POST" class="form" action="{{url('registrar/ganado')}}">
        {!! csrf_field() !!}
        Crotal:
        <input type="text" name="crotal" class="form-control" placeholder="Crotal" value="{{ old('crotal')}}"></input>
        Sexo: <br>
        @foreach($sexos as $sexo)
            <label class="radio-inline"> <input type="radio" name="sexo_id" value="{{$sexo->id}}" {{ (old("sexo_id") == $sexo->id ? "selected":"") }}>{{$sexo->nombre}}
            </label>
        @endforeach
        <br>
        Fecha de nacimiento:
        <input type="date" name="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento')}}"></input>
        Ganadería:
        <select name="ganaderia_id" class="form-control">
            <option disabled selected value> -- Selecciona una opción -- </option>
            @foreach($ganaderias as $ganaderia)
                <option value="{{$ganaderia->id}}" {{ (old("ganaderia_id") == $ganaderia->id ? "selected":"") }}>{{$ganaderia->nombre}}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>

@endsection
