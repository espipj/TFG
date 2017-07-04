@extends('layout')


@section('contenido')
    @if (Auth::guest())
        @include('partials.permission')
    @else

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">Editar Muestra</div>
                        <div class="panel-body">
                            @include('partials.errors')


                            {!! Form::open(['url' => 'editar/muestra/completed','class' =>'form-horizontal']) !!}
                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label class="col-md-4 control-label">Código Tubo de Extracción</label>
                                <div class="col-md-6">
                                    {!! Form::text('tubo', $muestra->tubo, ['class' => 'form-control', 'placeholder'=>$muestra->tubo,'required']) !!}
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
                                                @if(isset($muestra->ganado) && $muestra->ganado->id == $ganado->id)

                                                    <td style="width:34%;">{!! Form::radio('ganado_id',$ganado->id,true,['class'=>'pariente']) !!}</td>
                                                    @else
                                                <td style="width:34%;">{!! Form::radio('ganado_id',$ganado->id,false,['class'=>'pariente']) !!}</td>
                                                    @endif


                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>


                            <div class="form-group">
                                <label class="col-md-4 control-label">Tipo de muestra</label>
                                <div class="col-md-6">
                                    {!! Form::select('tipo_muestra_id',$tipomuestras,$muestra->tipoMuestra->id,['placeholder'=>' -- Selecciona una opción -- ','class'=>'form-control','required']) !!}

                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-4 control-label">Tipo de consulta</label>
                                <div class="col-md-6">
                                    {!! Form::select('tipo_consulta_id',$tipoconsultas,$muestra->tipoConsulta->id,['placeholder'=>' -- Selecciona una opción -- ','class'=>'form-control','required']) !!}

                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-4 control-label">Laboratorio</label>
                                <div class="col-md-6">
                                    {!! Form::select('laboratorio_id',$laboratorios,$muestra->laboratorio->id,['placeholder'=>' -- Selecciona una opción -- ','class'=>'form-control','required']) !!}

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Fecha de Extracción</label>
                                <div class="col-md-6">
                                    {!! Form::date('fecha_extraccion', $muestra->fecha_extraccion) !!}
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-success" style="margin-right: 15px;">
                                        Guardar
                                    </button>
                                </div>
                            </div>
                            {!! Form::hidden('muestra_id',$muestra->id) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
