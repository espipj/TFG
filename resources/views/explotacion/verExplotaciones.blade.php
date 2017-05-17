@extends('layout')


@section('contenido')


    @if (Auth::guest())
        @include('partials.permission')
    @else

        <h1>Explotaciones</h1>
        <p>Desde esta página puedes registrar una nueva explotación o editar las ya existentes.</p>
        @if(Auth::user()->hasAnyRole(array('Administrador','SuperAdmin')))
            <a href="{{url('registrar/explotacion')}}" class="btn btn-primary btn-md" role="button"><span
                        class="glyphicon glyphicon-plus"></span> Nueva explotación</a>
        @endif

        @include('explotacion.tablaExplotacion')
    @endif
@endsection
