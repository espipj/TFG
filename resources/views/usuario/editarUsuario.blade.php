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
