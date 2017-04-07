@extends('layout')


@section('contenido')


    <table id="miTabla" class="table header-fixed">
        <thead>
        <tr class="header">
            <th style="width:25%;">Crotal</th>
            <th style="width:25%;">Sexo</th>
            <th style="width:25%;">Fecha de Nacimiento</th>
            <th style="width:25%;">Ganadería</th>
        </tr>
        </thead>
        <tbody>
            @foreach($ganados as $ganado)
                @if($ganado->crotal && $ganado->sexo && $ganado->fecha_nacimiento && $ganado->ganaderia->nombre)
                <tr style="cursor:pointer" class="clickable-row">
                    <td style="width:25%;">{{$ganado->crotal}}</td>
                    <td style="width:25%;">{{$ganado->sexo->nombre}}</td>
                    <td style="width:25%;">{{$ganado->fecha_nacimiento}}</td>
                    <td style="width:25%;">{{$ganado->ganaderia->nombre}}</td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>

@endsection
