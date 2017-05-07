@extends('layout')


@section('contenido')

    @if (Auth::guest())
        @include('partials.permission')
    @else
        <div class="jumbotron">
            <h1>Datos de la res:</h1>
            <h2>Crotal: {{$ganado->crotal}}</h2>
            @if(!empty($ganado->ganaderia))
            <h2>Ganadería: <a href="{{route('verganaderia',[$ganado->ganaderia])}}">{{$ganado->ganaderia->nombre}}</a>
            @else
            <h2>Ganadería: No definida</a>
            @endif
            </h2>
            <h3>Sexo: {{$ganado->sexo->nombre}}</h3>
            @if($ganado->capa=='C')
            <h3>Capa: Morucha Cárdena</h3>
            @else
            <h3>Capa: Morucha Negra</h3>
            @endif
            <h3>Fecha de Nacimiento: {{$ganado->fecha_nacimiento->format('d-m-Y')}}</h3>
            <h3>Estado: {{$ganado->estado->nombre}}</h3>
            @if(!empty($ganado->padre))
                <h3>Padre: <a href="{{route('verganado',[$ganado->padre])}}">{{$ganado->padre->crotal}}</a></h3>
            @else
                <h3>Padre: no definido</h3>
            @endif
            @if(!empty($ganado->madre))
                <h3>Madre: <a href="{{route('verganado',[$ganado->madre])}}">{{$ganado->madre->crotal}}</a></h3>
            @else
                <h3>Madre: no definida</h3>
            @endif
            <a href="{{url('editar/ganado',['ganado'=>$ganado])}}" class="btn btn-success btn-sm" role="button"><span
                        class="glyphicon glyphicon-edit"></span> Editar</a>
            <a href="{{url('eliminar/ganado',['ganado'=>$ganado])}}" class="btn btn-danger btn-sm" role="button"><span
                        class="glyphicon glyphicon-remove"></span> Eliminar</a>

        </div>

        <h2>Hijos</h2>
        @include('ganado.tablaGanados')

    @endif

@endsection
