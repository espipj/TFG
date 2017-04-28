@extends('layout')


@section('contenido')

    @if (Auth::guest())
        @include('partials.permission')
    @else

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar Ganadero</div>
                    <div class="panel-body">
                        @include('partials.errors')



                        {!! Form::open(['url' => 'editar/ganadero/completed','class' =>'form-horizontal']) !!}
                            {!! csrf_field() !!}
                            {!! Form::hidden('ganadero_id',$ganadero->id) !!}
                            <div class="form-group">
                                <label class="col-md-4 control-label">Nombre</label>
                                <div class="col-md-6">
                                    {!! Form::text('nombre', $ganadero->nombre, ['class' => 'form-control', 'placeholder'=>$ganadero->nombre,'required']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Primer Apellido</label>
                                <div class="col-md-6">
                                    {!! Form::text('apellido1', $ganadero->apellido1, ['class' => 'form-control', 'placeholder'=>$ganadero->apellido1,'required']) !!}
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-4 control-label">Segundo Apellido</label>
                                <div class="col-md-6">
                                    {!! Form::text('apellido2', $ganadero->apellido2, ['class' => 'form-control', 'placeholder'=>$ganadero->apellido2,'required']) !!}
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-4 control-label">DNI</label>
                                <div class="col-md-6">
                                    {!! Form::text('dni', $ganadero->dni, ['class' => 'form-control', 'placeholder'=>$ganadero->dni,'required']) !!}
                                </div>
                            </div>



                            <div class="form-group">
                                <label class="col-md-4 control-label">E-Mail</label>
                                <div class="col-md-6">
                                    {!! Form::email('email', $ganadero->email, ['class' => 'form-control', 'placeholder'=>$ganadero->email,'required']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Teléfono</label>
                                <div class="col-md-6">
                                    {!! Form::text('telefono', $ganadero->telefono, ['class' => 'form-control', 'placeholder'=>$ganadero->email,'required']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Ganadería</label>
                                <div class="col-md-6">
                                    {!! Form::select('ganaderia_id',$ganaderias,$ganadero->ganaderia->id,['placeholder'=>' -- Selecciona una opción -- ','class'=>'form-control','required']) !!}
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-success" style="margin-right: 15px;">
                                        Editar
                                    </button>
                                </div>
                            </div>
                        {!! Form::close(); !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endif

@endsection
