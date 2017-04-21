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

            <tr class="clickable-row" data-href="{{route('verganaderia',[$ganaderia])}}">
                <td style="width:20%;">{{$ganaderia->nombre}}</td>
                <td style="width:25%;">{{$ganaderia->direccion}}</td>
                <td style="width:25%;">{{$ganaderia->asociacion->nombre}}</td>
                <td style="width:30%;">
                    <div class="btn-group">
                        <a href="{{url('ver/ganaderia',['ganaderia'=>$ganaderia])}}" class="btn btn-info btn-sm"
                           role="button"><span class="glyphicon glyphicon-list"></span> Detalles</a>
                        <a href="{{url('editar/ganaderia',['ganaderia'=>$ganaderia])}}" class="btn btn-success btn-sm"
                           role="button"><span class="glyphicon glyphicon-edit"></span> Editar</a>
                        <a href="{{url('eliminar/ganaderia',['ganaderia'=>$ganaderia])}}" class="btn btn-danger btn-sm"
                           role="button"><span class="glyphicon glyphicon-remove"></span> Eliminar</a>
                    </div>

                </td>
            </tr>
        @endif
    @endforeach
    </tbody>
</table>