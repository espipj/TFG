@extends('layout')


@section('contenido')


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

@endsection
