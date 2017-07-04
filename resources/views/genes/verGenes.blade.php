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


        @if(Auth::user()->hasAnyRole(array('Administrador','SuperAdmin','Laboratorio')))
            <div class="card col-sm-8 col-sm-offset-2">
                <div class="card-content">
                    <div class="dropzone" style="margin-top: 60px" id="dropzone" data-tipo="genes">
                        <h2 id='titulodrop' class='titulodrop' hidden>Deposita el fichero Excel a importar.</h2>
                        <div class="in-dropzone">
                            @endif
                            <h1 class="text-center">Genes</h1>
                            <p class="text-center">Desde esta página puedes importar o exportar genes en formato
                                Excel.</p>

                            <div class="text-center" style="margin: 30px auto">

                                @if(Auth::user()->hasAnyRole(array('Laboratorio','SuperAdmin')))
                                <a href="{{url('exportar/genes/xlsx')}}" class="btn btn-excel btn-md text-center"
                                   role="button"><span
                                            class="glyphicon glyphicon-cloud-download"></span> Exportar Genes en
                                    XLSX</a>
                                <a href="{{url('exportar/genes/csv')}}" class="btn btn-excel btn-md text-center"
                                   role="button"><span
                                            class="glyphicon glyphicon-cloud-download"></span> Exportar Genes en CSV</a>
@endif
                                    {!! Form::open(['url' => 'importar/genes','id'=>'file','class'=>'form-inline','files'=>'true']) !!}
                                    {!! csrf_field() !!}
                                    <label class="btn btn-excel btn-md text-center"><span
                                                class="glyphicon glyphicon-cloud-upload"></span> Importar desde Excel
                                        {!! Form::file('import_file',['hidden','id'=>'file']) !!}
                                    </label>
                                    {!! Form::close() !!}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
@endsection
