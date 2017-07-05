@extends('layout')

@section('head')

    <meta name="csrf-token" content="{{{ csrf_token() }}}">

@endsection

@section('contenido')

    @if (Auth::guest())
        @include('partials.permission')
    @elseif($ganaderias=="sinpermiso")
        @include('partials.role-permission')
    @else
        <div class="card" style="margin-bottom: 30px"><div class="card-content"><span class="card-title"><h1>Ganaderías</h1></span>

                @if(Auth::user()->hasAnyRole(array('Administrador','SuperAdmin')))
                <div class="dropzone" id="dropzone" data-tipo="ganaderia">

            <h2 id='titulodrop' class='titulodrop' hidden>Deposita el fichero Excel a importar.</h2>
            <img id='imagedrop' src="{{asset('images/excel.png')}}" height="50%" width="50%" hidden>
            <div class="in-dropzone">
@endif
                <p>Desde esta página puedes registrar una nueva ganadería o editar las ya existentes y listadas.</p>
                <br>

                @if(Auth::user()->hasAnyRole(array('Administrador','SuperAdmin')))
                <a href="{{url('registrar/ganaderia')}}" class="btn btn-primary btn-md" role="button"><span
                            class="glyphicon glyphicon-plus"></span> Nueva Ganadería</a>
                <a href="{{url('exportar/ganaderia/xlsx')}}" class="btn btn-excel btn-md" role="button"><span
                            class="glyphicon glyphicon-cloud-download"></span> Exportar Ganaderías en XLSX</a>
                <a href="{{url('exportar/ganaderia/csv')}}" class="btn btn-excel btn-md" role="button"><span
                            class="glyphicon glyphicon-cloud-download"></span> Exportar Ganaderías en CSV</a>
                {!! Form::open(['url' => 'importar/ganaderia','id'=>'file','class'=>'form-inline','files'=>'true']) !!}
                {!! csrf_field() !!}
                <label class="btn btn-excel btn-md"><span class="glyphicon glyphicon-cloud-upload"></span> Importar
                    desde
                    Excel
                    {!! Form::file('import_file',['hidden','id'=>'file']) !!}
                </label>
                {!! Form::close() !!}

                    <a href="{{route('infoxls')}}" class="btn btn-info btn-md" role="button"><span
                                class="glyphicon glyphicon-info-sign"></span> Ayuda Imporación/Exportación</a>
                @endif
                @include('ganaderia.tablaGanaderias')
            </div>
        </div>
            </div></div>
    @endif
@endsection

