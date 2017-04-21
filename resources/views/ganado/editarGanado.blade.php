@extends('layout')


@section('contenido')

    @if (Auth::guest())
        @include('partials.permission')
    @else
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Registrar Ganado</div>
                        <div class="panel-body">
                            @include('partials.errors')


                            {!! Form::open(['url' => 'editar/ganado/completed','class' =>'form-horizontal']) !!}
                            {!! csrf_field() !!}
                            Crotal:
                            {!! Form::text('crotal', $ganado->crotal, ['class' => 'form-control', 'placeholder'=>$ganado->crotal,'required']) !!}



                            <div class="form-group">
                                <label class="col-md-4 control-label">Sexo</label>
                                <div class="col-md-6">
                                    @foreach($sexos as $sexo)
                                        @if($sexo->nombre != $ganado->sexo->nombre)
                                            <label class="radio-inline"><input type="radio" name="sexo_id"
                                                                               value="{{$sexo->id}}">{{$sexo->nombre}}
                                            </label>
                                        @else
                                            <label class="radio-inline"><input type="radio" name="sexo_id" value="{{$sexo->id}}"
                                                                               checked="checked">{{$sexo->nombre}}
                                            </label>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Fecha de Nacimiento</label>
                                <div class="col-md-6">
                                    {!! Form::date('fecha_nacimiento', $ganado->fecha_nacimiento) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Ganadería</label>
                                <div class="col-md-6">

                                    {!! Form::select('ganaderia_id',$ganaderias,$ganado->ganaderia->id,['placeholder'=>' -- Selecciona una opción -- ','class'=>'form-control','required']) !!}

                                </div>
                            </div>
                            {!! Form::hidden('ganado_id',$ganado->id) !!}
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary" style="margin-right: 15px;">
                                        Crear
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
