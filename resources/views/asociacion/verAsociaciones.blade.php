@extends('layout')


@section('contenido')
    @if (Auth::guest())
        @include('partials.permission')
    @else

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



                <tr class="clickable-row">
                    <td style="width:20%;">{{$asociacion->nombre}}</td>
                    <td style="width:25%;">{{$asociacion->direccion}}</td>
                    <td style="width:25%;"><a href="mailto:{{$asociacion->email}}">{{$asociacion->email}}</a></td>
                    <td style="width:30%;">
                        <a href="{{url('ver/asociacion',['asociacion'=>$asociacion])}}" class="btn btn-info btn-sm" role="button"><span class="glyphicon glyphicon-list"></span> Detalles</a>
                        <a href="{{url('editar/asociacion',['asociacion'=>$asociacion])}}" class="btn btn-success btn-sm" role="button"><span class="glyphicon glyphicon-edit"></span> Editar</a>
                        <a href="{{url('eliminar/asociacion',['asociacion'=>$asociacion])}}" class="btn btn-danger btn-sm" role="button"><span class="glyphicon glyphicon-remove"></span> Eliminar</a>

                    </td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    @endif
@endsection
