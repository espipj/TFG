@extends('layout')


@section('contenido')

    <div class="jumbotron">
        <h1>Datos de la asociación</h1>
        <h2>Nombre: {{$asociacion->nombre}}</h2>
        <h2>Dirección: {{$asociacion->direccion}}</h2>
        <h3>Email: <a href="mailto:{{$asociacion->email}}">{{$asociacion->email}}</a></h3>

        <br>
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
    </div>

    <!--TODO Lista de ganaderias-->
    <h2>Ganaderías</h2>
    <table id="miTabla" class="table header-fixed">
        <thead>
        <tr class="header">
            <th style="width:20%;">Nombre</th>
            <th style="width:25%;">Dirección</th>
            <th style="width:25%;">Asociación</th>
            <th style="width:30%;">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($ganaderias as $ganaderia)
            @if($ganaderia->nombre && $ganaderia->direccion && $ganaderia->asociacion->nombre)

                <tr class="clickable-row">
                    <td style="width:20%;">{{$ganaderia->nombre}}</td>
                    <td style="width:25%;">{{$ganaderia->direccion}}</td>
                    <td style="width:25%;">{{$ganaderia->asociacion->nombre}}</td>
                    <td style="width:30%;">
                        <form method="POST" action="{{url('ver/ganaderia')}}" style="display: inline">
                            {!! csrf_field() !!}
                            <input type="hidden" name="ganaderia_id" value="{{ $ganaderia->id }}">
                            <button type="submit" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-list"></span> Detalles</button>
                        </form>
                        <form method="POST" action="{{url('editar/ganaderia')}}" style="display: inline">
                            {!! csrf_field() !!}
                            <input type="hidden" name="ganaderia_id" value="{{ $ganaderia->id }}">
                            <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-edit"></span> Modificar</button>
                        </form>
                        <form method="POST" action="{{url('eliminar/ganaderia')}}" style="display: inline">
                            {!! csrf_field() !!}
                            <input type="hidden" name="ganaderia_id" value="{{ $ganaderia->id }}">
                            <button type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span> Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>



@endsection