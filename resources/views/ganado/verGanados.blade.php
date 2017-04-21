@extends('layout')


@section('contenido')

    @if (Auth::guest())
        @include('partials.permission')
    @else
        <h1>Ganado</h1>
        <p>Desde esta página puedes registrar una nueva res o editar las ya existentes y listadas.</p>
        <a href="{{url('registrar/ganado')}}" class="btn btn-primary btn-md" role="button"><span class="glyphicon glyphicon-plus"></span> Nueva res</a>

        @include('ganado.tablaGanados')

    @endif
@endsection
