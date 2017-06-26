@extends('layout')


@section('contenido')

    @if (Auth::guest())
        @include('partials.permission')
    @else
        <div class="jumbotron">
            <div class="row">
                <h1>Datos de la res:</h1></div>
            <div class="row">
                <div class="col-sm-9">
                    <h2>Crotal: {{$ganado->crotal}}</h2>
                    @if(isset($ganado->ganaderia))
                        <h2>Ganadería: <a
                                    href="{{route('verganaderia',[$ganado->ganaderia])}}">{{$ganado->ganaderia->nombre}}</a>
                            @else
                                <h2>Ganadería: No definida</a>

                                </h2>
                            @endif
                            @if(isset($ganado->sexo) && isset($ganado->capa) && isset($ganado->fecha_nacimiento))
                                <h3>Sexo: {{$ganado->sexo->nombre}}</h3>
                                <h3>Capa: {{$ganado->capa->nombre}}</h3>
                                <h3>Fecha de Nacimiento: {{$ganado->fecha_nacimiento->format('d-m-Y')}}</h3>
                                <h3>Estado: {{$ganado->estado->nombre}}</h3>
                            @endif
                            @if(isset($ganado->padre))
                                <h3>Padre: <a
                                            href="{{route('verganado',[$ganado->padre])}}">{{$ganado->padre->crotal}}</a>
                                </h3>
                            @else
                                <h3>Padre: no definido</h3>
                            @endif
                            @if(isset($ganado->madre))
                                <h3>Madre: <a
                                            href="{{route('verganado',[$ganado->madre])}}">{{$ganado->madre->crotal}}</a>
                                </h3>
                            @else
                                <h3>Madre: no definida</h3>
                    @endif


                </div>
                <div class="col-sm-3">
                    @if(Auth::user()->hasAnyRole(array('Administrador','SuperAdmin')))
                        <a href="{{url('editar/ganado',['ganado'=>$ganado])}}" class="btn btn-success btn-sm"
                           role="button"><span
                                    class="glyphicon glyphicon-edit"></span> Editar</a>
                        @if($ganado->estado->alias=='V')
                            <a href="" class="btn btn-danger btn-sm eliminar-detail"
                               role="button" data-id="{{$ganado->id}}"><span
                                        class="glyphicon glyphicon-remove"></span>
                                Eliminar</a>
                        @else
                            <a href="" class="btn btn-danger btn-sm eliminar-detail disabled"
                               role="button" data-id="{{$ganado->id}}"><span
                                        class="glyphicon glyphicon-remove"></span>
                                Eliminar</a>

                        @endif
                    @endif
                    @if(Auth::user()->hasAnyRole(array('Laboratorio')) && !isset($ganado->gen))
                        <a
                                href="{{url('anadir/genes',['ganado'=>$ganado])}}"
                                class="btn btn-success btn-sm edpgen"
                                role="button"><span
                                    class="glyphicon glyphicon-pencil"></span> Crear Perfil Genético</a>
                    @endif
                </div>
            </div>
            @if(isset($ganados))
            <div class="row">
                <div class="tree scrollable">


                    {!! $arbol !!}

                </div>
            </div>
            @endif
            @if(Auth::user()->hasAnyRole(array('Laboratorio')) && isset($ganado->gen))
                <div class="row dropgenes">
                    <div class="panel-group">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" href="#collapse1">Perfil genético</a>
                                </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse">
                                <div class="panel-body">
                                    @include('genes.tablaInfo',['ganadoinfo'=>$ganado])
                                    <div class="text-center"><a
                                                href="{{url('anadir/genes',['ganado'=>$ganado])}}"
                                                class="btn btn-success btn-sm edpgen"
                                                role="button"><span
                                                    class="glyphicon glyphicon-pencil"></span> Editar Perfil
                                            Genético</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endif
        </div>

        @if(isset($ganados))
            <h2>Hijos</h2>
            @include('ganado.tablaGanados')
        @endif
    @endif

@endsection


{!! Form::open(['url' => ['eliminar/ganado/:ID_ELIMINAR'], 'method' => 'DELETE','id'=>'form-delete']) !!}
{!! Form::close() !!}

@section('scripts')

    <script src="{{asset('js/controller-model.js')}}" type="text/javascript"></script>

@endsection