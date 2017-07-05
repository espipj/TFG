@extends('layout')


@section('contenido')

    @if (Auth::guest())
        @include('partials.permission')
    @else
        <div class="col-sm-6 col-sm-offset-3">
            <div class="card" style="margin-bottom: 30px">
                <div class="card-content"><span class="card-title"><h1>Explotación</h1></span>

                    <h2 class="card-color-text">CEA:
                        <div class="card-color-text-normal">{{$explotacion->codigo_explotacion}}</div>
                    </h2>
                    <h2 class="card-color-text">Municipio:
                        <div class="card-color-text-normal">{{$explotacion->municipio}}</div>
                    </h2>
                    @if(isset($explotacion->ganaderia))
                        <h2 class="card-color-text">Ganadería:
                            <div class="card-color-text-normal"><a
                                        href="{{route('verganaderia',[$explotacion->ganaderia])}}">{{$explotacion->ganaderia->nombre}}</a>
                            </div>
                            </a>
                        </h2>
                    @else
                        <h2 class="card-color-text">Ganadería:
                            <div class="card-color-text-normal">No definida</div>
                            </a>
                        </h2>
                    @endif
                    @if(Auth::user()->hasAnyRole(array('Administrador','SuperAdmin')))
                        <div class="text-center">
                            <a href="{{url('editar/explotacion',['explotacion'=>$explotacion])}}"
                               class="btn btn-success btn-sm"
                               role="button"><span
                                        class="glyphicon glyphicon-edit"></span> Editar</a>

                            <a href="" class="btn btn-danger btn-sm eliminar-detail"
                               role="button" data-id="{{$explotacion->id}}"><span
                                        class="glyphicon glyphicon-remove"></span>
                                Eliminar</a></div>
                        @endif
                </div>

            </div>
        </div>
    @endif

@endsection
{!! Form::open(['url' => ['eliminar/explotacion/:ID_ELIMINAR'], 'method' => 'DELETE','id'=>'form-delete']) !!}
{!! Form::close() !!}

@section('scripts')

    <script src="{{asset('js/controller-model.js')}}" type="text/javascript"></script>

@endsection
