@extends('layout')


@section('contenido')

    @if (Auth::guest())
        @include('partials.permission')
    @else
        <div class="jumbotron">
            <h1>Datos de la Muestra:</h1>
            <h2>Crotal: <a href="{{route('verganado',[$muestra->ganado])}}">{{$muestra->ganado->crotal}}</a></h2>
            <h2>Código de Extracción: {{$muestra->tubo}}</h2>
            <h3>Tipo de muestra: {{$muestra->tipomuestra->nombre}}</h3>
            <h3>Tipo de consulta: {{$muestra->tipoconsulta->nombre}}</h3>
            <h3>Laboratorio: <a
                        href="{{route('verlaboratorio',[$muestra->laboratorio])}}">{{$muestra->laboratorio->nombre}}</a>
            </h3>
            <h3>Fecha de la extracción: {{$muestra->fecha_extraccion->format('d-m-Y')}}</h3>

            @if(Auth::user()->hasAnyRole(array('Laboratorio')))
                {{--
                <a href="{{url('solicitar/padremadre',['muestra'=>$muestra])}}" class="btn btn-success btn-sm"
                   role="button"><span
                            class="glyphicon glyphicon-edit"></span> Filiar Padre y Madre</a>

                <a href="{{url('solicitar/padremadre',['muestra'=>$muestra])}}" class="btn btn-success btn-sm"
                   role="button"><span
                            class="glyphicon glyphicon-edit"></span> Filiar Madre</a>--}}
                <a href="{{url('solicitar/padremadre',['muestra'=>$muestra])}}" class="btn btn-success btn-sm"
                   role="button"><span
                            class="glyphicon glyphicon-indent-right"></span> Filiar Padre</a>


            @endif
        </div>

    @endif

@endsection


