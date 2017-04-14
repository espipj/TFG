@extends('layout')


@section('contenido')


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

                        {!! Form::open(['url' => 'ver/ganaderia', 'style'=>'display: inline']) !!}
                        {!! csrf_field() !!}
                        {!! Form::hidden('ganaderia_id',$ganaderia->id) !!}
                            <button type="submit" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-list"></span> Detalles</button>
                        {!! Form::close() !!}


                        {!! Form::open(['url' => 'editar/ganaderia', 'style'=>'display: inline']) !!}
                        {!! csrf_field() !!}
                        {!! Form::hidden('ganaderia_id',$ganaderia->id) !!}
                        <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-edit"></span> Editar</button>
                        {!! Form::close() !!}

                        {!! Form::open(['url' => 'eliminar/ganaderia', 'style'=>'display: inline']) !!}
                        {!! csrf_field() !!}
                        {!! Form::hidden('ganaderia_id',$ganaderia->id) !!}
                        <button type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span> Eliminar</button>
                        {!! Form::close() !!}

                    </td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>

@endsection
