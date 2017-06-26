@extends('layout')

@section('head')

    <meta name="csrf-token" content="{{{ csrf_token() }}}">

@endsection

@section('contenido')


    @if (Auth::guest())
        @include('partials.permission')
    @elseif($explotaciones=="noexp")
        @include('partials.role-permission')
    @else


        @if(Auth::user()->hasAnyRole(array('Administrador','SuperAdmin')))
            <div class="dropzone" id="dropzone" data-tipo="explotacion">
                <h2 id='titulodrop' class='titulodrop' hidden>Deposita el fichero Excel a importar.</h2>
                <img id='imagedrop' src="{{asset('images/excel.png')}}" height="50%" width="50%" hidden>
                <div class="in-dropzone">
                    @endif
                    <h1>Explotaciones</h1>
                    <p>Desde esta página puedes registrar una nueva explotación o editar las ya existentes.</p>
                    @if(Auth::user()->hasAnyRole(array('Administrador','SuperAdmin')))
                        <a href="{{url('registrar/explotacion')}}" class="btn btn-primary btn-md" role="button"><span
                                    class="glyphicon glyphicon-plus"></span> Nueva explotación</a>
                    @endif
                    @if(Auth::user()->hasAnyRole(array('Administrador','SuperAdmin','Ganadero')))
                        <a href="{{url('exportar/explotacion/xlsx')}}" class="btn btn-excel btn-md" role="button"><span
                                    class="glyphicon glyphicon-cloud-download"></span> Exportar Explotaciones en
                            XLSX</a>
                        <a href="{{url('exportar/explotacion/csv')}}" class="btn btn-excel btn-md" role="button"><span
                                    class="glyphicon glyphicon-cloud-download"></span> Exportar Explotaciones en CSV</a>
                    @endif

                    @if(Auth::user()->hasAnyRole(array('Administrador','SuperAdmin')))
                        {!! Form::open(['url' => 'importar/explotacion','id'=>'file','class'=>'form-inline','files'=>'true']) !!}
                        {!! csrf_field() !!}
                        <label class="btn btn-excel btn-md"><span class="glyphicon glyphicon-cloud-upload"></span>
                            Importar desde Excel
                            {!! Form::file('import_file',['hidden','id'=>'file']) !!}
                        </label>
                        {!! Form::close() !!}
                    @endif
                    @include('explotacion.tablaExplotacion')
                </div>
            </div>
        @endif
@endsection
