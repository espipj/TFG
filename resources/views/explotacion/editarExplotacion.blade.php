@extends('layout')


@section('contenido')

    @if (Auth::guest())
        @include('partials.permission')
    @else

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar Explotacion</div>
                    <div class="panel-body">
                        @include('partials.errors')



                        {!! Form::open(['url' => 'editar/explotacion/completed','class' =>'form-horizontal']) !!}
                            {!! csrf_field() !!}
                            {!! Form::hidden('explotacion_id',$explotacion->id) !!}
                            <div class="form-group">
                                <label class="col-md-4 control-label">Código de Explotación</label>
                                <div class="col-md-6">
                                    {!! Form::text('codigo_explotacion', $explotacion->codigo_explotacion, ['class' => 'form-control', 'placeholder'=>$explotacion->codigo_explotacion,'required']) !!}
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-4 control-label">Municipio</label>
                                <div class="col-md-6">
                                    {!! Form::text('municipio', $explotacion->municipio, ['class' => 'form-control', 'placeholder'=>$explotacion->municipio,'required']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Ganadería</label>
                                <div class="col-md-6">
                                    {!! Form::select('ganaderia_id',$ganaderias,$explotacion->ganaderia_id,['placeholder'=>' -- Selecciona una opción -- ','class'=>'form-control','required']) !!}
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-success" style="margin-right: 15px;">
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endif

@endsection
