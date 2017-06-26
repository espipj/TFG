@extends('layout')


@section('contenido')


    @if (Auth::guest())
        @include('partials.permission')
    @elseif($explotaciones=="noexp")
        @include('partials.role-permission')
    @else

        <h1>Explotaciones</h1>
        <p>Desde esta página puedes registrar una nueva explotación o editar las ya existentes.</p>
        @if(Auth::user()->hasAnyRole(array('Administrador','SuperAdmin')))
            <a href="{{url('registrar/explotacion')}}" class="btn btn-primary btn-md" role="button"><span
                        class="glyphicon glyphicon-plus"></span> Nueva explotación</a>
        @endif
        @if(Auth::user()->hasAnyRole(array('Administrador','SuperAdmin','Ganadero')))
            <a href="{{url('exportar/explotacion/xlsx')}}" class="btn btn-excel btn-md" role="button"><span
                        class="glyphicon glyphicon-cloud-download"></span> Exportar Explotaciones en XLSX</a>
            <a href="{{url('exportar/explotacion/csv')}}" class="btn btn-excel btn-md" role="button"><span
                        class="glyphicon glyphicon-cloud-download"></span> Exportar Explotaciones en CSV</a>
        @endif

        @include('explotacion.tablaExplotacion')
    @endif
@endsection
