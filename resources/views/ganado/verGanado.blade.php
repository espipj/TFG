@extends('layout')


@section('contenido')

    @if (Auth::guest())
        @include('partials.permission')
    @else
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title"><h1>Ficha de la res</h1></span>
                    </div>
                    <div class="card-content">
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
                    <div class="row text-center card-content">
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
            </div>

            @if(Auth::user()->hasAnyRole(array('Laboratorio')) && isset($ganado->gen))
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title"><h1>Perfil genético</h1></span>
                        </div>
                        <div class="card-content">
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


            @endif
        </div>

        @if(isset($ganados))
            <div class="row">
                <h1>Árbol genealógico:</h1>
                <div class="tree text-center">


                    {!! $arbol !!}

                </div>
            </div>
        @endif








        <div class="row">
            @if(isset($ganados))
                <div class="card" style="margin-bottom: 40px">
                    <div class="card-content">
                        <span class="card-title"><h2>Hijos</h2></span>

                        @include('ganado.tablaGanados')
                    </div>
                </div>

            @endif
        </div>
    @endif

@endsection


{!! Form::open(['url' => ['eliminar/ganado/:ID_ELIMINAR'], 'method' => 'DELETE','id'=>'form-delete']) !!}
{!! Form::close() !!}

@section('scripts')

    <script src="{{asset('js/controller-model.js')}}" type="text/javascript"></script>

@endsection