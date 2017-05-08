@extends('layout')


@section('contenido')

    @if (Auth::guest())
        @include('partials.permission')
    @else

        <h1>Ganaderías</h1>
        <p>Desde esta página puedes registrar una nueva ganadería o editar las ya existentes y listadas.</p>
        <a href="{{url('registrar/ganaderia')}}" class="btn btn-primary btn-md" role="button"><span
                    class="glyphicon glyphicon-plus"></span> Nueva Ganadería</a>
        <a href="{{url('exportar/ganaderia/xlsx')}}" class="btn btn-excel btn-md" role="button"><span
                    class="glyphicon glyphicon-cloud-download"></span> Exportar Ganaderías en XLSX</a>
        <a href="{{url('exportar/ganaderia/csv')}}" class="btn btn-excel btn-md" role="button"><span
                    class="glyphicon glyphicon-cloud-download"></span> Exportar Ganaderías en CSV</a>
        {!! Form::open(['url' => 'importar/ganaderia','id'=>'file','class'=>'form-inline','files'=>'true']) !!}
        {!! csrf_field() !!}
        <label class="btn btn-excel btn-md"><span class="glyphicon glyphicon-cloud-upload"></span> Importar desde Excel
            {!! Form::file('import_file',['hidden','id'=>'file']) !!}
        </label>
        {!! Form::close() !!}
        @include('ganaderia.tablaGanaderias')
    @endif
@endsection
