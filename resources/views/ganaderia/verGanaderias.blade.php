@extends('layout')


@section('contenido')

    @if (Auth::guest())
        @include('partials.permission')
    @else
        @include('ganaderia.tablaGanaderias')
    @endif
@endsection
