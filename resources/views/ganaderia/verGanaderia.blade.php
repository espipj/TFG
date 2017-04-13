@extends('layout')


@section('contenido')

    <div class="jumbotron">
    <h1>Datos de la ganadería</h1>
    <h2>Nombre: {{$ganaderia->nombre}}</h2>
    <h2>Dirección: {{$ganaderia->direccion}}</h2>
    <h3>Asociación: {{$ganaderia->asociacion->nombre}} </h3>
        <br>
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
    </div>
    <!--TODO Lista de ganados-->
    <!--TODO Lista de ganaderos-->
    <h2>Ganado</h2>
    <table id="miTabla" class="table header-fixed">
        <thead>
        <tr class="header">
            <th style="width:12%;">Crotal</th>
            <th style="width:15%;">Sexo</th>
            <th style="width:20%;">Fecha de Nacimiento</th>
            <th style="width:25%;">Ganadería</th>
            <th style="width:28%;">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($ganados as $ganado)
            @if($ganado->crotal && $ganado->sexo && $ganado->fecha_nacimiento && $ganado->ganaderia->nombre)



                <tr class="clickable-row">
                    <td style="width:12%;">{{$ganado->crotal}}</td>
                    <td style="width:15%;">{{$ganado->sexo->nombre}}</td>
                    <td style="width:20%;">{{$ganado->fecha_nacimiento}}</td>
                    <td style="width:25%;">{{$ganado->ganaderia->nombre}}</td>
                    <td style="width:28%;">
                        <form method="POST" action="{{url('ver/ganado')}}" style="display: inline">
                            {!! csrf_field() !!}
                            <input type="hidden" name="ganado_id" value="{{ $ganado->id }}">
                            <button type="submit" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-list"></span> Detalles</button>
                        </form>
                        <form method="POST" action="{{url('editar/ganado')}}" style="display: inline">
                            {!! csrf_field() !!}
                            <input type="hidden" name="ganado_id" value="{{ $ganado->id }}">
                            <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-edit"></span> Modificar</button>
                        </form>
                        <form method="POST" action="{{url('eliminar/ganado')}}" style="display: inline">
                            {!! csrf_field() !!}
                            <input type="hidden" name="ganado_id" value="{{ $ganado->id }}">
                            <button type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span> Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
    <h2>Ganaderos</h2>
    <table id="miTabla" class="table header-fixed">
        <thead>
        <tr class="header">
            <th style="width:12%;">Nombre</th>
            <th style="width:15%;">Apellidos</th>
            <th style="width:20%;">Telefono</th>
            <th style="width:25%;">DNI</th>
            <th style="width:28%;">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($ganaderos as $ganadero)
            @if($ganadero->nombre && $ganadero->apellido1 && $ganadero->telefono && $ganadero->dni)



                <tr class="clickable-row">
                    <td style="width:12%;">{{$ganadero->nombre}}</td>
                    <td style="width:15%;">{{$ganadero->apellido1}} {{$ganadero->apellido2}}</td>
                    <td style="width:20%;"><a href="tel:{{$ganadero->telefono}}">{{$ganadero->telefono}}</a></td>
                    <td style="width:25%;">{{$ganadero->dni}}</td>
                    <td style="width:28%;">
                        <form method="POST" action="{{url('ver/ganadero')}}" style="display: inline">
                            {!! csrf_field() !!}
                            <input type="hidden" name="ganadero_id" value="{{ $ganadero->id }}">
                            <button type="submit" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-list"></span> Detalles</button>
                        </form>
                        <form method="POST" action="{{url('editar/ganadero')}}" style="display: inline">
                            {!! csrf_field() !!}
                            <input type="hidden" name="ganadero_id" value="{{ $ganadero->id }}">
                            <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-edit"></span> Modificar</button>
                        </form>
                        <form method="POST" action="{{url('eliminar/ganadero')}}" style="display: inline">
                            {!! csrf_field() !!}
                            <input type="hidden" name="ganadero_id" value="{{ $ganadero->id }}">
                            <button type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span> Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>


@endsection
