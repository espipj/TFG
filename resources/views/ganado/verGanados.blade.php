@extends('layout')


@section('contenido')

    @if (Auth::guest())
        @include('partials.permission')
    @else
        <h1>Ganado</h1>
        <p>Desde esta página puedes registrar una nueva res o editar las ya existentes y listadas.</p>
        <a href="{{url('registrar/ganado')}}" class="btn btn-primary btn-md" role="button"><span
                    class="glyphicon glyphicon-plus"></span> Nueva res</a>
        <a href="{{url('exportar/ganado/xlsx')}}" class="btn btn-excel btn-md" role="button"><span
                    class="glyphicon glyphicon-cloud-download"></span> Exportar Ganado en XLSX</a>
        <a href="{{url('exportar/ganado/csv')}}" class="btn btn-excel btn-md" role="button"><span
                    class="glyphicon glyphicon-cloud-download"></span> Exportar Ganado en CSV</a>
        {!! Form::open(['url' => 'importar/ganado','id'=>'file','class'=>'form-inline']) !!}
        {!! csrf_field() !!}
            <label class="btn btn-excel btn-md"><span class="glyphicon glyphicon-cloud-upload"></span> Importar desde Excel
                {!! Form::file('file',['hidden','id'=>'file']) !!}
            </label>
        {!! Form::close() !!}
        {{-- <a href="{{route('verganadomuerto')}}" class="btn btn-danger btn-md" role="button"><span class="glyphicon glyphicon-minus"></span> Muertas</a>
        --}}
        @include('ganado.tablaGanados')

    @endif
@endsection
