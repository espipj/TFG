<input type="text" id="buscadorMuestras" class="buscadorjs noform" data-tabla="tablaMuestras"
       placeholder="Buscar muestra por NºTubo...">

<table id="tablaMuestras" class="table header-fixed ganados">
    <thead>
    <tr class="header">
        <th style="width:12%;">Nº Tubo</th>
        <th style="width:15%;">Extracción</th>
        <th style="width:20%;">Consulta</th>
        <th style="width:25%;">Res</th>
        <th style="width:28%;">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($muestras as $muestra)
        @if($muestra->tubo && $muestra->fecha_extraccion && $muestra->ganado && $muestra->tipoConsulta)



            <tr class="clickable-row" data-href="{{route('vermuestra',[$muestra])}}" data-id="{{$muestra->id}}">
                <td style="width:12%;">{{$muestra->tubo}}</td>
                <td style="width:15%;">{{$muestra->fecha_extraccion->format('d-m-Y')}}</td>
                @if($muestra->tipoconsulta->nombre == "Filiación Padre" || $muestra->tipoconsulta->nombre == "Filiación Progenitores")
                    <td style="width:20%;">{{$muestra->tipoConsulta->nombre}} <img src="{{asset('images/gen.png')}}" height="20px"></td>
                @else
                    <td style="width:20%;">{{$muestra->tipoConsulta->nombre}}</td>
                @endif
                <td style="width:25%;">{{$muestra->ganado->crotal}}</td>
                <td style="width:28%;">
                    <div class="btn-group">
                        <a href="{{route('vermuestra',[$muestra])}}" class="btn btn-info btn-sm"
                           role="button"><span class="glyphicon glyphicon-list"></span> Detalles</a>
                        <a href="{{url('editar/muestra',['$muestra'=>$muestra])}}" class="btn btn-success btn-sm"
                           role="button"><span class="glyphicon glyphicon-edit"></span> Editar</a>
                        <a href="#!" class="btn btn-danger btn-sm eliminar"
                           role="button"><span class="glyphicon glyphicon-remove"></span> Eliminar</a>
                    </div>
                </td>
            </tr>
        @endif
    @endforeach
    </tbody>
</table>

{!! Form::open(['url' => ['eliminar/muestra/:ID_ELIMINAR'], 'method' => 'DELETE','id'=>'form-delete']) !!}
{!! Form::close() !!}

@section('scripts')

    <script src="{{asset('js/controller-model.js')}}" type="text/javascript"></script>

@endsection
