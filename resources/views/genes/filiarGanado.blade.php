@endsection

@section('contenido')

    @if (Auth::guest())
        @include('partials.permission')
    @elseif($permiso=="sinpermiso")
        @include('partials.role-permission')
    @else

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">Filiar Ganado</div>
                        <div class="panel-body">
                            @include('partials.errors')


                            {!! Form::open(['url' => 'filiar/ganado','class' =>'form-horizontal']) !!}
                            {!! csrf_field() !!}




                            <div class="col-xs-10 col-xs-offset-1">
                                <label>Seleccionar res</label>

                                <input type="text" id="buscadorRes" class="buscadorjs" data-tabla="tablaRes"
                                       placeholder="Buscar res por crotal...">

                                <table id="tablaRes" class="table header-fixed pariente">
                                    <thead>
                                    <tr class="header">
                                        <th style="width:33%;">Crotal</th>
                                        <th style="width:33%;">Ganadería</th>
                                        <th style="width:34%;">Seleccionar</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($ganados as $ganado)

                                            <tr class="clickable-row" data-href="{{route('verganado',[$ganado])}}"
                                                data-id="{{$ganado->id}}">
                                                <td style="width:33%;">{{$ganado->crotal}}</td>

                                                @if(!empty($ganado->ganaderia))
                                                    <td style="width:33%;">{{$ganado->ganaderia->nombre}}</td>
                                                @else
                                                    <td style="width:33%;">No definida</td>
                                                @endif
                                                <td style="width:34%;">{!! Form::radio('madre_id',$ganado->id,false,['class'=>'pariente']) !!}</td>

                                            </tr>
                                    @endforeach
                                    </tbody>
                                </table>

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
@endsection