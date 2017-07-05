@extends('layout')

@section('head')

    <meta name="csrf-token" content="{{{ csrf_token() }}}">

@endsection

@section('contenido')

    @if (Auth::guest())
        @include('partials.permission')
    @elseif($ganados=="sing")
        @include('partials.role-permission')
    @else
        <div class="card" style="margin-bottom: 30px"><div class="card-content"><span class="card-title"><h1>Ganado</h1></span>

        @if(Auth::user()->hasAnyRole(array('Administrador','SuperAdmin')))
            <div class="dropzone" id="dropzone" data-tipo="ganado">
                <h2 id='titulodrop' class='titulodrop' hidden>Deposita el fichero Excel a importar.</h2>
                <img id='imagedrop' src="{{asset('images/excel.png')}}" height="50%" width="50%" hidden>
                <div class="in-dropzone">
        @endif

                    <p>{{$descripcion}}</p>
<br>
                    @if(Auth::user()->hasAnyRole(array('Administrador','SuperAdmin')))
                        <a href="{{url('registrar/ganado')}}" class="btn btn-primary btn-md" role="button"><span
                                    class="glyphicon glyphicon-plus"></span> Nueva res</a>
                    @endif
                    @if(Auth::user()->hasAnyRole(array('Administrador','SuperAdmin','Ganadero')))
                    <a href="{{url('exportar/ganado/xlsx')}}" class="btn btn-excel btn-md" role="button"><span
                                class="glyphicon glyphicon-cloud-download"></span> Exportar Ganado en XLSX</a>
                    <a href="{{url('exportar/ganado/csv')}}" class="btn btn-excel btn-md" role="button"><span
                                class="glyphicon glyphicon-cloud-download"></span> Exportar Ganado en CSV</a>
                    @endif

                    @if(Auth::user()->hasAnyRole(array('Administrador','SuperAdmin')))
                        {!! Form::open(['url' => 'importar/ganado','id'=>'file','class'=>'form-inline','files'=>'true']) !!}
                        {!! csrf_field() !!}
                        <label class="btn btn-excel btn-md"><span class="glyphicon glyphicon-cloud-upload"></span>
                            Importar desde Excel
                            {!! Form::file('import_file',['hidden','id'=>'file']) !!}
                        </label>
                        {!! Form::close() !!}

                        <a href="{{route('infoxls')}}" class="btn btn-info btn-md" role="button"><span
                                    class="glyphicon glyphicon-info-sign"></span> Ayuda Imporación/Exportación</a>
                    @endif

                    @include('ganado.tablaGanados')
                </div>
            </div></div></div>
        @endif
@endsection
