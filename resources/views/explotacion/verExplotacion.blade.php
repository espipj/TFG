@extends('layout')


@section('contenido')

    @if (Auth::guest())
        @include('partials.permission')
    @else

        <div class="jumbotron">
            <h1>Datos de la explotación:</h1>
            <h2>Ganadería: <a
                        href="{{route('verganaderia',[$explotacion->ganaderia])}}">{{$explotacion->ganaderia->nombre}}</a></h2>
            <h2>CEA: {{$explotacion->codigo_explotacion}}</h2>
            <h2>Municipio: {{$explotacion->municipio}}</h2>
            <a href="{{url('editar/explotacion',['explotacion'=>$explotacion])}}" class="btn btn-success btn-sm"
               role="button"><span
                        class="glyphicon glyphicon-edit"></span> Editar</a>

            <a href="" class="btn btn-danger btn-sm eliminar-detail"
               role="button" data-id="{{$explotacion->id}}"><span class="glyphicon glyphicon-remove"></span>
                Eliminar</a>
        </div>
    @endif

@endsection
{!! Form::open(['url' => ['eliminar/explotacion/:ID_ELIMINAR'], 'method' => 'DELETE','id'=>'form-delete']) !!}
{!! Form::close() !!}

@section('scripts')

    <script src="{{asset('js/controller-model.js')}}" type="text/javascript"></script>

@endsection
