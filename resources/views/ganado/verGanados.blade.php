@extends('layout')

@section('head')

    <meta name="csrf-token" content="{{{ csrf_token() }}}">

@endsection

@section('contenido')

    @if (Auth::guest())
        @include('partials.permission')
    @else

        <div class="dropzone" id="dropzone" data-tipo="ganado">
            <h2 id='titulodrop' class='titulodrop' hidden>Deposita el fichero Excel a importar.</h2>
            <img id='imagedrop' src="{{asset('images/excel.png')}}" height="50%" width="50%" hidden>
            <div class="in-dropzone">
        <h1>Ganado</h1>
        <p>Desde esta página puedes registrar una nueva res o editar las ya existentes y listadas.</p>
        <a href="{{url('registrar/ganado')}}" class="btn btn-primary btn-md" role="button"><span
                    class="glyphicon glyphicon-plus"></span> Nueva res</a>
        <a href="{{url('exportar/ganado/xlsx')}}" class="btn btn-excel btn-md" role="button"><span
                    class="glyphicon glyphicon-cloud-download"></span> Exportar Ganado en XLSX</a>
        <a href="{{url('exportar/ganado/csv')}}" class="btn btn-excel btn-md" role="button"><span
                    class="glyphicon glyphicon-cloud-download"></span> Exportar Ganado en CSV</a>
        {!! Form::open(['url' => 'importar/ganado','id'=>'file','class'=>'form-inline','files'=>'true']) !!}
        {!! csrf_field() !!}
            <label class="btn btn-excel btn-md"><span class="glyphicon glyphicon-cloud-upload"></span> Importar desde Excel
                {!! Form::file('import_file',['hidden','id'=>'file']) !!}
            </label>
        {!! Form::close() !!}
        {{-- <a href="{{route('verganadomuerto')}}" class="btn btn-danger btn-md" role="button"><span class="glyphicon glyphicon-minus"></span> Muertas</a>
        --}}
        @include('ganado.tablaGanados')
            </div>
        </div>
    @endif
@endsection
