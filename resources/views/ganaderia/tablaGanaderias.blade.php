<input type="text" id="buscadorGanaderias" class="buscadorjs noform" data-tabla="tablaGanaderias"
       placeholder="Buscar ganadería por nombre...">

<div class="table-responsive">
    <table id="tablaGanaderias" class="table header-fixed ganados">
        <thead>
        <tr class="header">
            <th style="width:20%;">Nombre</th>
            <th style="width:25%;">Telefono</th>
            <th style="width:25%;">Asociación</th>
            <th style="width:30%;">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($ganaderias as $ganaderia)
            @if($ganaderia->nombre && $ganaderia->telefono && $ganaderia->asociacion->nombre)

                <tr class="clickable-row" data-href="{{route('verganaderia',[$ganaderia])}}"
                    data-id="{{$ganaderia->id}}">
                    <td style="width:20%;">{{$ganaderia->nombre}}</td>
                    <td style="width:25%;">{{$ganaderia->telefono}}</td>
                    <td style="width:25%;">{{$ganaderia->asociacion->nombre}}</td>
                    <td style="width:30%;">
                        <div class="btn-group">
                            <a href="{{url('ver/ganaderia',['ganaderia'=>$ganaderia])}}" class="btn btn-info btn-sm"
                               role="button"><span class="glyphicon glyphicon-list"></span> Detalles</a>
                            <a href="{{url('editar/ganaderia',['ganaderia'=>$ganaderia])}}"
                               class="btn btn-success btn-sm"
                               role="button"><span class="glyphicon glyphicon-edit"></span> Editar</a>
                            <a href="" class="btn btn-danger btn-sm eliminar"
                               role="button"><span class="glyphicon glyphicon-remove"></span> Eliminar</a>
                        </div>

                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>

</div>
{!! Form::open(['url' => ['eliminar/ganaderia/:ID_ELIMINAR'], 'method' => 'DELETE','id'=>'form-delete']) !!}
{!! Form::close() !!}

@section('scripts')

    <script src="{{asset('js/controller-model.js')}}" type="text/javascript"></script>

@endsection