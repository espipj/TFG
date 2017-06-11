@extends('layout')


@section('contenido')

    @if (Auth::guest())
        @include('partials.permission')
    @elseif($muestras=="nomuest")
        @include('partials.role-permission')
    @else
        <h1>Muestras</h1>
        <p>Desde esta página puedes registrar una nueva muestra o editar las ya existentes y listadas.</p>
        @if(Auth::user()->hasAnyRole(array('Administrador','SuperAdmin')))
        <a href="{{url('registrar/muestra')}}" class="btn btn-primary btn-md" role="button"><span class="glyphicon glyphicon-plus"></span> Nueva muestra</a>
        @endif
        @include('muestra.tablaMuestras')

    @endif
@endsection
