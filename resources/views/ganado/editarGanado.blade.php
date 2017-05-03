@extends('layout')


@section('contenido')

    @if (Auth::guest())
        @include('partials.permission')
    @else


        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">Editar Ganado</div>
                        <div class="panel-body">
                            @include('partials.errors')


                            {!! Form::open(['url' => 'editar/ganado/completed','class' =>'form-horizontal']) !!}
                            {!! Form::hidden('ganado_id',$ganadoe->id) !!}
                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label class="col-md-4 control-label">Ganadería</label>
                                <div class="col-md-6">
                                    @if(!empty($ganadoe->ganaderia->id))
                                    {!! Form::select('ganaderia_id',$ganaderias,$ganadoe->ganaderia->id,['placeholder'=>' -- Selecciona una opción -- ','class'=>'form-control','required']) !!}
                                    @else
                                        {!! Form::select('ganaderia_id',$ganaderias,null,['placeholder'=>' -- Selecciona una opción -- ','class'=>'form-control','required']) !!}

                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Crotal</label>
                                <div class="col-md-6">
                                    {!! Form::text('crotal', $ganadoe->crotal, ['class' => 'form-control', 'placeholder'=>$ganadoe->crotal,'required']) !!}
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-4 control-label">Fecha de Nacimiento</label>
                                <div class="col-md-6">
                                    {!! Form::date('fecha_nacimiento', $ganadoe->fecha_nacimiento) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Sexo</label>
                                <div class="col-md-6">
                                    @foreach($sexos as $sexo)
                                        @if($sexo->nombre != $ganadoe->sexo->nombre)
                                            <label class="radio-inline"><input type="radio" name="sexo_id"
                                                                               value="{{$sexo->id}}">{{$sexo->nombre}}
                                            </label>
                                        @else
                                            <label class="radio-inline"><input type="radio" name="sexo_id"
                                                                               value="{{$sexo->id}}"
                                                                               checked="checked">{{$sexo->nombre}}
                                            </label>
                                        @endif
                                    @endforeach
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-4 control-label">Capa</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="capa">
                                        <option value="C" @if($ganadoe->capa=='C') selected @endif>Morucha Cárdena
                                        </option>
                                        <option value="N" @if($ganadoe->capa=='N') selected @endif>Morucha Negra</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-10 col-xs-offset-1">
                                <label>Seleccionar la posible madre</label>

                                <input type="text" id="buscadorMadre" class="buscadorjs" data-tabla="tablaMadre"
                                       placeholder="Buscar madre por crotal...">

                                <table id="tablaMadre" class="table header-fixed pariente">
                                    <thead>
                                    <tr class="header">
                                        <th style="width:33%;">Crotal</th>
                                        <th style="width:33%;">Ganadería</th>
                                        <th style="width:34%;">Seleccionar</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($ganados as $ganado)
                                        @if($ganado->crotal && $ganado->sexo->nombre == 'Hembra' && $ganado->fecha_nacimiento && $ganado->ganaderia->nombre)



                                            <tr class="clickable-row" data-href="{{route('verganado',[$ganado])}}"
                                                data-id="{{$ganado->id}}">
                                                <td style="width:33%;">{{$ganado->crotal}}</td>
                                                <td style="width:33%;">{{$ganado->ganaderia->nombre}}</td>
                                                @if($ganadoe->madre->id==$ganado->id)
                                                    <td style="width:34%;">{!! Form::radio('madre_id',$ganado->id,true,['class'=>'pariente']) !!}</td>
                                                @else
                                                    <td style="width:34%;">{!! Form::radio('madre_id',$ganado->id,false,['class'=>'pariente']) !!}</td>
                                                @endif
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>

                                <label>Seleccionar el posible padre</label>
                                <input type="text" id="buscadorPadre" class="buscadorjs" data-tabla="tablaPadre"
                                       placeholder="Buscar padre por crotal...">

                                <table id="tablaPadre" class="table header-fixed pariente">
                                    <thead>
                                    <tr class="header">
                                        <th style="width:33%;">Crotal</th>
                                        <th style="width:33%;">Ganadería</th>
                                        <th style="width:34%;">Seleccionar</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($ganados as $ganado)
                                        @if($ganado->crotal && $ganado->sexo->nombre == 'Macho' && $ganado->fecha_nacimiento && $ganado->ganaderia->nombre)



                                            <tr class="clickable-row" data-href="{{route('verganado',[$ganado])}}"
                                                data-id="{{$ganado->id}}">
                                                <td style="width:33%;">{{$ganado->crotal}}</td>
                                                <td style="width:33%;">{{$ganado->ganaderia->nombre}}</td>
                                                @if($ganadoe->padre->id==$ganado->id)
                                                    <td style="width:34%;">{!! Form::radio('padre_id',$ganado->id,true,['class'=>'pariente']) !!}</td>
                                                @else
                                                    <td style="width:34%;">{!! Form::radio('padre_id',$ganado->id,false,['class'=>'pariente']) !!}</td>
                                                @endif
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
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
