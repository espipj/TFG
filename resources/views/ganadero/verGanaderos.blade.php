@extends('layout')


@section('contenido')


    @if (Auth::guest())
        @include('partials.permission')
    @else
        @include('ganadero.tablaGanaderos')
    @endif
@endsection
