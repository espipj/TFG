@extends('layout')


@section('contenido')
    @if (Auth::guest())
        @include('partials.permission')
    @else
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="card">
                    <div class="card-content">
                    <span class="card-title">
                        {{$ganaderia->nombre}} ({{$ganaderia->sigla}})
                    </span>
                        <h4 class="card-color-text">Email:
                            <div class="card-color-text-normal"><a
                                        href="mailto:{{$ganaderia->email}}">{{$ganaderia->email}}</a></div>
                        </h4>
                        <h4 class="card-color-text">Telefono:
                            <div class="card-color-text-normal"><a
                                        href="tel:{{$ganaderia->telefono}}">{{$ganaderia->telefono}}</a></div>
                        </h4>
                        <h4 class="card-color-text">Asociación:
                            <div class="card-color-text-normal">{{$ganaderia->asociacion->nombre}}</div>
                        </h4>
                        <br>
                        @if(Auth::user()->hasAnyRole(array('Administrador','SuperAdmin')))
                            <div class="text-center">
                                <a href="{{url('editar/ganaderia',['ganaderia'=>$ganaderia])}}"
                                   class="btn btn-success btn-sm" role="button"><span
                                            class="glyphicon glyphicon-edit"></span> Editar</a>

                                <a href="" class="btn btn-danger btn-sm eliminar-detail"
                                   role="button" data-id="{{$ganaderia->id}}"><span
                                            class="glyphicon glyphicon-remove"></span> Eliminar</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="card">
                <div class="card-content">
                    <h2>Ganado</h2>
                    @if(Auth::user()->hasAnyRole(array('Administrador','SuperAdmin')))
                        <a href="{{url('registrar/ganado',['ganaderia'=>$ganaderia])}}" class="btn btn-primary btn-sm"
                           role="button"><span class="glyphicon glyphicon-plus"></span> Registrar Ganado</a>
                    @endif
                    @include('ganado.tablaGanados')
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card" style="margin-bottom: 30px">
                <div class="card-content">
                    <h2>Explotaciones Ganaderas</h2>
                    @if(Auth::user()->hasAnyRole(array('Administrador','SuperAdmin')))
                        <a href="{{url('registrar/explotacion',['ganaderia'=>$ganaderia])}}"
                           class="btn btn-primary btn-sm"
                           role="button"><span class="glyphicon glyphicon-plus"></span> Registrar Explotación</a>
                    @endif
                    @include('explotacion.tablaExplotacion')

                </div>
            </div>
        </div>
    @endif
@endsection


{!! Form::open(['url' => ['eliminar/ganaderia/:ID_ELIMINAR'], 'method' => 'DELETE','id'=>'form-delete']) !!}
{!! Form::close() !!}

@section('scripts')

    <script src="{{asset('js/controller-model.js')}}" type="text/javascript"></script>

@endsection
