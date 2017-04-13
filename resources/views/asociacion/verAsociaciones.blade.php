@extends('layout')


@section('contenido')


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
                        <form method="POST" action="{{url('ver/asociacion')}}" style="display: inline">
                            {!! csrf_field() !!}
                            <input type="hidden" name="asociacion_id" value="{{ $asociacion->id }}">
                            <button type="submit" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-list"></span> Detalles</button>
                        </form>
                        <form method="POST" action="{{url('editar/asociacion')}}" style="display: inline">
                            {!! csrf_field() !!}
                            <input type="hidden" name="asociacion_id" value="{{ $asociacion->id }}">
                            <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-edit"></span> Modificar</button>
                        </form>
                        <form method="POST" action="{{url('eliminar/asociacion')}}" style="display: inline">
                            {!! csrf_field() !!}
                            <input type="hidden" name="asociacion_id" value="{{ $asociacion->id }}">
                            <button type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span> Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>

@endsection
