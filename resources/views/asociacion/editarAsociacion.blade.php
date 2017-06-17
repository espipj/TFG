@extends('layout')


@section('contenido')

    @if (Auth::guest())
        @include('partials.permission')
    @else

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar Asociación</div>
                    <div class="panel-body">

                        @include('partials.errors')
                        {!! Form::open(['url' => 'editar/asociacion/completed','class' =>'form-horizontal']) !!}
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="col-md-4 control-label">Nombre</label>
                            <div class="col-md-6">
                                {!! Form::text('nombre', $asociacion->nombre, ['class' => 'form-control', 'placeholder'=>$asociacion->nombre,'required']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Dirección postal</label>
                            <div class="col-md-6">
                                {!! Form::text('direccion', $asociacion->direccion, ['class' => 'form-control', 'placeholder'=>$asociacion->direccion,'required']) !!}
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-4 control-label">Email</label>
                            <div class="col-md-6">
                                {!! Form::text('email', $asociacion->email, ['class' => 'form-control', 'placeholder'=>$asociacion->email,'required']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Teléfono</label>
                            <div class="col-md-6">
                                {!! Form::text('telefono', $asociacion->telefono, ['class' => 'form-control', 'placeholder'=>$asociacion->telefono,'required']) !!}
                            </div>
                        </div>

                        {!! Form::hidden('asociacion_id',$asociacion->id) !!}


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
