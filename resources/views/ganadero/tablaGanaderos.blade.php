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



            <tr class="clickable-row" data-href="{{route('verganadero',[$ganadero])}}" data-id="{{$ganadero->id}}">
                <td style="width:12%;">{{$ganadero->nombre}}</td>
                <td style="width:15%;">{{$ganadero->apellido1}} {{$ganadero->apellido2}}</td>
                <td style="width:20%;"><a href="tel:{{$ganadero->telefono}}">{{$ganadero->telefono}}</a></td>
                <td style="width:25%;">{{$ganadero->dni}}</td>
                <td style="width:28%;">
                    <div class="btn-group">
                        <a href="{{url('ver/ganadero',['ganadero'=>$ganadero])}}" class="btn btn-info btn-sm"
                           role="button"><span class="glyphicon glyphicon-list"></span> Detalles</a>
                        <a href="{{url('editar/ganadero',['ganadero'=>$ganadero])}}" class="btn btn-success btn-sm"
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
{!! Form::open(['url' => ['eliminar/ganadero/:ID_ELIMINAR'], 'method' => 'DELETE','id'=>'form-delete']) !!}
{!! Form::close() !!}

@section('scripts')

    <script src="{{asset('js/controller-model.js')}}" type="text/javascript"></script>

@endsection

