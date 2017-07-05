@extends('layout')


@section('contenido')

    @if (Auth::guest())
        @include('partials.permission')
    @else
        <div class="col-sm-6 col-sm-offset-3">
            <div class="card" style="margin-bottom: 30px">
                <div class="card-content"><span class="card-title"><h1>Usuario</h1></span>

                    <h3 class="card-color-text">Nombre:
                        <div class="card-color-text-normal">{{$usuario->name}}</div>
                    </h3>
                    <h3 class="card-color-text">E-Mail:
                        <div class="card-color-text-normal"><a href="mailto:{{$usuario->email}}">{{$usuario->email}}</a>
                        </div>
                    </h3>
                    <br>
                    <div class="text-center">
@if(Auth::user()==$usuario)
                        <a href="{{url('perfil/usuario/editar')}}" class="btn btn-success btn-sm"
                           role="button"><span
                                    class="glyphicon glyphicon-edit"></span> Editar mi perfil</a>
                        @endif
    @if(Auth::user()->hasAnyRole(array('SuperAdmin')))
                        <a href="{{url('editar/usuario',['usuario'=>$usuario])}}" class="btn btn-success btn-sm"
                           role="button"><span
                                    class="glyphicon glyphicon-user"></span> Asignar Responsabilidades</a>
                        <a href="" class="btn btn-danger btn-sm eliminar-detail"
                           role="button" data-id="{{$usuario->id}}"><span class="glyphicon glyphicon-remove"></span>
                            Eliminar</a>
        @endif
                    </div>
                </div>
            </div>
        </div>


    @endif

@endsection


{!! Form::open(['url' => ['eliminar/usuario/:ID_ELIMINAR'], 'method' => 'DELETE','id'=>'form-delete']) !!}
{!! Form::close() !!}

@section('scripts')

    <script src="{{asset('js/controller-model.js')}}" type="text/javascript"></script>

@endsection