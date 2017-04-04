@extends('layout')


@section('contenido')


    <ul class="list-group">
        @foreach($ganados as $ganado)
            <li class="list-group-item">{{$ganado->crotal}}</li>
        @endforeach
    </ul>

@endsection
