@extends('layout')


@section('contenido')
    @if (Auth::guest())
        @include('partials.permission')
    @else
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar Ganadería</div>
                    <div class="panel-body">

                        @include('partials.errors')
                        {!! Form::open(['url' => 'editar/ganaderia/completed','class' =>'form-horizontal']) !!}
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="col-md-4 control-label">Nombre</label>
                            <div class="col-md-6">
                                {!! Form::text('nombre', $ganaderia->nombre, ['class' => 'form-control', 'placeholder'=>'Nombre','required']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Sigla</label>
                            <div class="col-md-6">
                                {!! Form::text('sigla', $ganaderia->sigla, ['class' => 'form-control', 'placeholder'=>$ganaderia->sigla,'required']) !!}
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-4 control-label">Email</label>
                            <div class="col-md-6">
                                {!! Form::text('email', $ganaderia->email, ['class' => 'form-control', 'placeholder'=>$ganaderia->email,'required']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Teléfono</label>
                            <div class="col-md-6">
                                {!! Form::text('telefono', $ganaderia->telefono, ['class' => 'form-control', 'placeholder'=>$ganaderia->telefono,'required']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Asociación</label>
                            <div class="col-md-6">
                                    {!! Form::select('asociacion_id',$asociaciones,$ganaderia->asociacion->id,['placeholder'=>' -- Selecciona una opción -- ','class'=>'form-control','required']) !!}
                            </div>
                        </div>

                        {!! Form::hidden('ganaderia_id',$ganaderia->id) !!}


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
