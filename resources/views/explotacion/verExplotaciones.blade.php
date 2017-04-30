@extends('layout')


@section('contenido')


    @if (Auth::guest())
        @include('partials.permission')
    @else
        @include('explotacion.tablaExplotacion')
    @endif
@endsection
