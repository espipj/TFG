@extends('layout')


@section('contenido')

    @if (Auth::guest())
        @include('partials.permission')
    @else


        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">Editar mis datos</div>
                        <div class="panel-body">
                            @include('partials.errors')
                            <div class="alert alert-info alert-dismissable fade in col-sm-7 col-sm-offset-3">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Importante!</strong> Es importante que introduzcas un E-Mail correcto, en caso contrario perderas el acceso a tu
                                cuenta.
                            </div>


                            {!! Form::open(['url' => 'perfil/usuario/editar','class' =>'form-horizontal']) !!}
                            {!! Form::hidden('usuario_id',$usuario->id) !!}
                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label class="col-md-4 control-label">Nombre</label>
                                <div class="col-md-6">
                                    {!! Form::text('name', $usuario->name, ['class' => 'form-control', 'placeholder'=>$usuario->name,'required']) !!}

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">E-Mail</label>
                                <div class="col-md-6">
                                    {!! Form::text('email', $usuario->email, ['class' => 'form-control', 'placeholder'=>$usuario->email,'required']) !!}

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
