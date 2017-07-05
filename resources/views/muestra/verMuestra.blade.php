@extends('layout')


@section('contenido')

    @if (Auth::guest())
        @include('partials.permission')
    @else
        <div class="col-sm-6 col-sm-offset-3">
            <div class="card" style="margin-bottom: 40px">
                <div class="card-content">
                <span class="card-title">
                    <h1>Datos de la Muestra</h1>
                </span>

                    <h3 class="card-color-text">Crotal:
                        <div class="card-color-text-normal"><a
                                    href="{{route('verganado',[$muestra->ganado])}}">{{$muestra->ganado->crotal}}</a>
                        </div>
                    </h3>
                    <h3 class="card-color-text">Código de Extracción:
                        <div class="card-color-text-normal"> {{$muestra->tubo}}</div>
                    </h3>
                    <h3 class="card-color-text">Tipo de muestra:
                        <div class="card-color-text-normal"> {{$muestra->tipomuestra->nombre}}</div>
                    </h3>
                    <h3 class="card-color-text">Tipo de consulta:
                        <div class="card-color-text-normal"> {{$muestra->tipoconsulta->nombre}}</div>
                    </h3>
                    <h3 class="card-color-text">Laboratorio:
                        <div class="card-color-text-normal"><a
                                    href="{{route('verlaboratorio',[$muestra->laboratorio])}}">{{$muestra->laboratorio->nombre}}</a>
                        </div>
                    </h3>
                    <h3 class="card-color-text">Fecha de la extracción:
                        <div class="card-color-text-normal"> {{$muestra->fecha_extraccion->format('d-m-Y')}}</div>
                    </h3>


                    <div class="text-center" style="margin-top: 30px">

                        @if(Auth::user()->hasAnyRole(array('Administrador','SuperAdmin')))
                            <a href="{{url('editar/muestra',['muestra'=>$muestra])}}" class="btn btn-success btn-sm"
                               role="button"><span
                                        class="glyphicon glyphicon-edit"></span> Editar</a>
                            <a href="" class="btn btn-danger btn-sm eliminar-detail"
                               role="button" data-id="{{$muestra->id}}"><span class="glyphicon glyphicon-remove"></span>
                                Eliminar</a>
                        @endif
                        @if(Auth::user()->hasAnyRole(array('Laboratorio')))
                            @if($muestra->tipoconsulta->nombre == "Filiación Padre" || $muestra->tipoconsulta->nombre == "Filiación Progenitores")

                                <a href="{{url('solicitar/filiacion',['ganado'=>$muestra->ganado])}}"
                                   class="btn btn-success btn-sm"
                                   role="button"><span
                                            class="glyphicon glyphicon-indent-right"></span> Filiar</a>

                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection


{!! Form::open(['url' => ['eliminar/muestra/:ID_ELIMINAR'], 'method' => 'DELETE','id'=>'form-delete']) !!}
{!! Form::close() !!}

@section('scripts')

    <script src="{{asset('js/controller-model.js')}}" type="text/javascript"></script>

@endsection
