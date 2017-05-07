@extends('layout')


@section('contenido')

    @if (Auth::guest())
        @include('partials.permission')
    @else

        {!! Form::open(['url' => 'importar','class' =>'form-horizontal','id'=>'file']) !!}
        {!! csrf_field() !!}


        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default">
                <div class="panel-heading">Importar Ganado</div>
                <div class="panel-body">

                    <div class="form-group">

                        <label class="col-md-4 control-label">Importar desde Excel</label>
                        <div class="col-md-6">
                            <label class="btn btn-excel btn-md"><span class="glyphicon glyphicon-cloud-upload"></span> Buscar Archivo
                            {!! Form::file('import_file',['id'=>'file']) !!}
                            </label>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {!! Form::close() !!}


    @endif

@endsection