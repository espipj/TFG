@extends('layout')


@section('contenido')
    @if (Auth::guest())
        @include('partials.permission')
    @else

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">Registrar Muestra</div>
                        <div class="panel-body">
                            @include('partials.errors')


                            {!! Form::open(['url' => 'registrar/muestra','class' =>'form-horizontal']) !!}
                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label class="col-md-4 control-label">Código Tubo de Extracción</label>
                                <div class="col-md-6">
                                    {!! Form::text('tubo', null, ['class' => 'form-control', 'placeholder'=>'Código del Tubo','required']) !!}
                                </div>
                            </div>

                            <div class="col-xs-10 col-xs-offset-1">
                                <label>Seleccionar res</label>

                                <input type="text" id="buscadorGanado" class="buscadorjs" data-tabla="tablaGanado"
                                       placeholder="Buscar ganado por crotal...">

                                <table id="tablaGanado" class="table header-fixed pariente">
                                    <thead>
                                    <tr class="header">
                                        <th style="width:33%;">Crotal</th>
                                        <th style="width:33%;">Ganadería</th>
                                        <th style="width:34%;">Seleccionar</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($ganados as $ganado)
                                        @if($ganado->crotal && $ganado->sexo && $ganado->fecha_nacimiento)



                                            <tr class="clickable-row" data-href="{{route('verganado',[$ganado])}}"
                                                data-id="{{$ganado->id}}">
                                                <td style="width:33%;">{{$ganado->crotal}}</td>

                                                @if(!empty($ganado->ganaderia))
                                                    <td style="width:33%;">{{$ganado->ganaderia->nombre}}</td>
                                                @else
                                                    <td style="width:33%;">No definida</td>
                                                @endif
                                                <td style="width:34%;">{!! Form::radio('ganado_id',$ganado->id,false,['class'=>'pariente']) !!}</td>

                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>


                            <div class="form-group">
                                <label class="col-md-4 control-label">Tipo de muestra</label>
                                <div class="col-md-6">
                                    {!! Form::select('tipo_muestra_id',$tipomuestras,null,['placeholder'=>' -- Selecciona una opción -- ','class'=>'form-control','required']) !!}

                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-4 control-label">Tipo de consulta</label>
                                <div class="col-md-6">
                                    {!! Form::select('tipo_consulta_id',$tipoconsultas,null,['placeholder'=>' -- Selecciona una opción -- ','class'=>'form-control','required']) !!}

                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-4 control-label">Laboratorio</label>
                                <div class="col-md-6">
                                    {!! Form::select('laboratorio_id',$laboratorios,null,['placeholder'=>' -- Selecciona una opción -- ','class'=>'form-control','required']) !!}

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Fecha de Extracción</label>
                                <div class="col-md-6">
                                    {!! Form::date('fecha_extraccion', \Carbon\Carbon::now()) !!}
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary" style="margin-right: 15px;">
                                        Registrar
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
