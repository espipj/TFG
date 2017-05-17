<input type="text" id="buscadorExplotaciones" class="buscadorjs noform" data-tabla="tablaExplotaciones"
       placeholder="Buscar res por CEA...">
<table id="tablaExplotaciones" class="table header-fixed ganados">
    <thead>
    <tr class="header">
        <th style="width:30%;">CEA</th>
        <th style="width:40%;">Municipio</th>
        <th style="width:30%;">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($explotaciones as $explotacion)
        @if($explotacion->id && $explotacion->municipio)



            <tr class="clickable-row" data-href="{{route('verexplotacion',[$explotacion])}}" data-id="{{$explotacion->id}}">
                <td style="width:30%;">{{$explotacion->codigo_explotacion}}</td>
                <td style="width:40%;">{{$explotacion->municipio}}</td>
                <td style="width:30%;">
                    <div class="btn-group">
                        <a href="{{url('ver/explotacion',['explotacion'=>$explotacion])}}" class="btn btn-info btn-sm"
                           role="button"><span class="glyphicon glyphicon-list"></span> Detalles</a>
                        <a href="{{url('editar/explotacion',['explotacion'=>$explotacion])}}" class="btn btn-success btn-sm"
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
{!! Form::open(['url' => ['eliminar/explotacion/:ID_ELIMINAR'], 'method' => 'DELETE','id'=>'form-delete']) !!}
{!! Form::close() !!}

@section('scripts')

    <script src="{{asset('js/controller-model.js')}}" type="text/javascript"></script>

@endsection

