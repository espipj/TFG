@extends('layout')


@section('contenido')
    @if (Auth::guest())
        @include('partials.permission')
    @else
        <h1>Asociaciones</h1>
        <p>Desde esta página puedes registrar una nueva asociación o editar las ya existentes y listadas.</p>
        <a href="{{url('registrar/asociacion')}}" class="btn btn-primary btn-md" role="button"><span
                    class="glyphicon glyphicon-plus"></span> Nueva asociación</a>


        <table id="miTabla" class="table header-fixed">
            <thead>
            <tr class="header">
                <th style="width:20%;">Nombre</th>
                <th style="width:25%;">Dirección</th>
                <th style="width:25%;">Email</th>
                <th style="width:30%;">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($asociaciones as $asociacion)
                @if($asociacion->nombre && $asociacion->direccion && $asociacion->email)



                    <tr class="clickable-row" data-href="{{route('verasociacion',[$asociacion])}}" data-id="{{$asociacion->id}}">
                        <td style="width:20%;">{{$asociacion->nombre}}</td>
                        <td style="width:25%;">{{$asociacion->direccion}}</td>
                        <td style="width:25%;"><a href="mailto:{{$asociacion->email}}">{{$asociacion->email}}</a></td>
                        <td style="width:30%;">
                            <div class="btn-group">
                                <a href="{{url('ver/asociacion',['asociacion'=>$asociacion])}}"
                                   class="btn btn-info btn-sm" role="button"><span
                                            class="glyphicon glyphicon-list"></span> Detalles</a>
                                <a href="{{url('editar/asociacion',['asociacion'=>$asociacion])}}"
                                   class="btn btn-success btn-sm" role="button"><span
                                            class="glyphicon glyphicon-edit"></span> Editar</a>
                                <a href=""
                                   class="btn btn-danger btn-sm eliminar" role="button"><span
                                            class="glyphicon glyphicon-remove"></span> Eliminar</a>
                            </div>
                        </td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    @endif
@endsection



{!! Form::open(['url' => ['eliminar/asociacion/:ID_ELIMINAR'], 'method' => 'DELETE','id'=>'form-delete']) !!}
{!! Form::close() !!}

@section('scripts')

    <script src="{{asset('js/controller-model.js')}}" type="text/javascript"></script>

@endsection
