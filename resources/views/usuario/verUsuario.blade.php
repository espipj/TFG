@extends('layout')


@section('contenido')

    @if (Auth::guest())
        @include('partials.permission')
    @else
        <div class="jumbotron">
            <h1>Datos del usuario</h1>
            <h2>Nombre: {{$usuario->name}}</h2>
            <h3>E-Mail: <a href="mailto:{{$usuario->email}}">{{$usuario->email}}</a> </h3>


            <a href="{{url('editar/usuario',['usuario'=>$usuario])}}" class="btn btn-success btn-sm"
               role="button"><span
                        class="glyphicon glyphicon-user"></span> Asignar Responsabilidades</a>
            <a href="" class="btn btn-danger btn-sm eliminar-detail"
               role="button" data-id="{{$usuario->id}}"><span class="glyphicon glyphicon-remove"></span> Eliminar</a>
        </div>


    @endif

@endsection


{!! Form::open(['url' => ['eliminar/usuario/:ID_ELIMINAR'], 'method' => 'DELETE','id'=>'form-delete']) !!}
{!! Form::close() !!}

@section('scripts')

    <script src="{{asset('js/controller-model.js')}}" type="text/javascript"></script>

@endsection