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
                        {!! Form::hidden('ganaderia_id',$ganaderia->id) !!}
                            <input name="_method" type="hidden" value="PATCH">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Nombre</label>
                                <div class="col-md-6">
                                    {!! Form::text('nombre', $ganaderia->nombre, ['class' => 'form-control', 'placeholder'=>$ganaderia->nombre,'required']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Dirección postal</label>
                                <div class="col-md-6">
                                    {!! Form::text('direccion', $ganaderia->direccion, ['class' => 'form-control', 'placeholder'=>$ganaderia->direccion,'required']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Asociación</label>
                                <div class="col-md-6">
                                    {!! Form::select('asociacion_id',$asociaciones,$ganaderia->asociacion->id,['placeholder'=>' -- Selecciona una opción -- ','class'=>'form-control','required']) !!}
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-success" style="margin-right: 15px;">
                                        Editar
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
