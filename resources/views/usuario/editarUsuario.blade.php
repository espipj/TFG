@extends('layout')


@section('contenido')

    @if (Auth::guest())
        @include('partials.permission')
    @else


        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">Asignar Responsabilidades</div>
                        <div class="panel-body">
                            @include('partials.errors')


                            {!! Form::open(['url' => 'editar/usuario/completed','class' =>'form-horizontal']) !!}
                            {!! Form::hidden('usuario_id',$usuario->id) !!}
                            {!! csrf_field() !!}

                            @if($usuario->hasAnyRole(array('Ganadero')))
                            <div class="form-group">
                                <label class="col-md-4 control-label">Ganadería</label>
                                <div class="col-md-6">
                                    @if(!empty($usuario->ganaderia->id))
                                        {!! Form::select('ganaderia_id',$ganaderias,$usuario->ganaderia->id,['placeholder'=>' -- Selecciona una opción -- ','class'=>'form-control']) !!}
                                    @else
                                        {!! Form::select('ganaderia_id',$ganaderias,null,['placeholder'=>' -- Selecciona una opción -- ','class'=>'form-control']) !!}

                                    @endif
                                </div>
                            </div>
                            @endif
                            @if($usuario->hasAnyRole(array('Administrador')))
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Asociación</label>
                                    <div class="col-md-6">
                                        @if(!empty($usuario->asociacion->id))
                                            {!! Form::select('asociacion_id',$asociaciones,$usuario->asociacion->id,['placeholder'=>' -- Selecciona una opción -- ','class'=>'form-control']) !!}
                                        @else
                                            {!! Form::select('asociacion_id',$asociaciones,null,['placeholder'=>' -- Selecciona una opción -- ','class'=>'form-control']) !!}

                                        @endif
                                    </div>
                                </div>
                            @endif

                            @if($usuario->hasAnyRole(array('Laboratorio')))
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Laboratorio</label>
                                    <div class="col-md-6">
                                        @if(!empty($usuario->laboratorio->id))
                                            {!! Form::select('laboratorio_id',$laboratorios,$usuario->laboratorio->id,['placeholder'=>' -- Selecciona una opción -- ','class'=>'form-control']) !!}
                                        @else
                                            {!! Form::select('laboratorio_id',$laboratorios,null,['placeholder'=>' -- Selecciona una opción -- ','class'=>'form-control']) !!}

                                        @endif
                                    </div>
                                </div>
                            @endif




                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-success" style="margin-right: 15px;">
                                        Asignar
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
