@extends('layout')


@section('contenido')


    <h1>Datos de la res:</h1>
    <p>Modifique los campos que desee editar.</p>
    <form method="POST" class="form" action="{{url('editar/ganado')}}">
        {!! csrf_field() !!}
        Crotal:
        <input type="text" name="crotal" class="form-control" placeholder="{{ $ganado->crotal }}" value="{{ $ganado->crotal }}"></input>
        Sexo: <br>
        @foreach($sexos as $sexo)
            @if($sexo->nombre != $ganado->sexo->nombre)
                <label class="radio-inline"><input type="radio" name="sexo_id" value="{{$sexo->id}}">{{$sexo->nombre}}
                </label>
            @else
                <label class="radio-inline"><input type="radio" name="sexo_id" value="{{$sexo->id}}" checked="checked">{{$sexo->nombre}}
                </label>
            @endif
        @endforeach
        <br>
        Fecha de nacimiento:
        <input type="date" name="fecha_nacimiento" class="form-control" value="{{ $ganado->fecha_nacimiento}}"></input>
        Ganadería:
        <select name="ganaderia_id" class="form-control">
            @foreach($ganaderias as $ganaderia)
                <option value="{{$ganaderia->id}}" @if($ganado->ganaderia==$ganaderia) selected="selected"@endif>{{$ganaderia->nombre}}</option>
            @endforeach
        </select>
        <input type="hidden" name="ganado_id" value="{{$ganado->id}}">
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>


@endsection
