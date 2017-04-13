@extends('layout')


@section('contenido')


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
