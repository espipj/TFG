@extends('layout')


@section('contenido')

    @if (Auth::guest())
        @include('partials.permission')
    @else
        <div class="jumbotron">
            <h1>Datos de la Muestra:</h1>
            <h2>Código de Extracción: {{$muestra->tubo}}</h2>
            <h2>Res: <a href="{{route('vermuestra',[$muestra->ganado])}}">{{$muestra->ganado->crotal}}</a></h2>
            <h3>Tipo de muestra: {{$muestra->tipomuestra->nombre}}</h3>
            <h3>Tipo de consulta: {{$muestra->tipoconsulta->nombre}}</h3>
            <h3>Laboratorio: <a href="{{route('verlaboratorio',[$muestra->laboratorio])}}">{{$muestra->laboratorio->nombre}}</a></h3>
            <h3>Fecha de la extracción: {{$muestra->fecha_extraccion->format('d-m-Y')}}</h3>

        </div>

    @endif

@endsection
