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



                <tr class="clickable-row" data-href="{{route('verganado',[$ganado])}}">
                    <td style="width:12%;">{{$ganado->crotal}}</td>
                    <td style="width:15%;">{{$ganado->sexo->nombre}}</td>
                    <td style="width:20%;">{{$ganado->fecha_nacimiento}}</td>
                    <td style="width:25%;">{{$ganado->ganaderia->nombre}}</td>
                    <td style="width:28%;">

                        <a href="{{url('ver/ganado',['ganado'=>$ganado])}}" class="btn btn-info btn-sm" role="button"><span class="glyphicon glyphicon-list"></span> Detalles</a>
                        <a href="{{url('editar/ganado',['ganado'=>$ganado])}}" class="btn btn-success btn-sm" role="button"><span class="glyphicon glyphicon-edit"></span> Editar</a>
                        <a href="{{url('eliminar/ganado',['ganado'=>$ganado])}}" class="btn btn-danger btn-sm" role="button"><span class="glyphicon glyphicon-remove"></span> Eliminar</a>

                    </td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>
