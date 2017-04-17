@extends('layout')


@section('contenido')

    @if (Auth::guest())
        @include('partials.permission')
    @else

@include('ganado.tablaGanados')

    @endif
@endsection
