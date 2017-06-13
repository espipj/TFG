@extends('layout')

@section('head')

    <meta name="csrf-token" content="{{{ csrf_token() }}}">

@endsection

@section('contenido')

    @if (Auth::guest())
        @include('partials.permission')
    @elseif($permiso=="sinpermiso")
        @include('partials.role-permission')
    @else


        @if(Auth::user()->hasAnyRole(array('Administrador','SuperAdmin')))
        <div class="dropzone" id="dropzone" data-tipo="ganado">
            <h2 id='titulodrop' class='titulodrop' hidden>Deposita el fichero Excel a importar.</h2>
            <img id='imagedrop' src="{{asset('images/excel.png')}}" height="50%" width="50%" hidden>
            <div class="in-dropzone">
                @endif
        <h1>Genes:</h1>
        <p>Desde esta página puedes importar o exportar genes en formato Excel.</p>

        <a href="{{url('exportar/ganado/xlsx')}}" class="btn btn-excel btn-md" role="button"><span
                    class="glyphicon glyphicon-cloud-download"></span> Exportar Genes en XLSX</a>
        <a href="{{url('exportar/ganado/csv')}}" class="btn btn-excel btn-md" role="button"><span
                    class="glyphicon glyphicon-cloud-download"></span> Exportar Genes en CSV</a>

                @if(Auth::user()->hasAnyRole(array('Laboratorio','SuperAdmin')))
        {!! Form::open(['url' => 'importar/genes','id'=>'file','class'=>'form-inline','files'=>'true']) !!}
        {!! csrf_field() !!}
            <label class="btn btn-excel btn-md"><span class="glyphicon glyphicon-cloud-upload"></span> Importar desde Excel
                {!! Form::file('import_file',['hidden','id'=>'file']) !!}
            </label>
        {!! Form::close() !!}
                @endif
            </div>
        </div>
    @endif
@endsection
