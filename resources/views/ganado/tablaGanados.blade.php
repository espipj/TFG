<input type="text" id="buscadorGanados" class="buscadorjs noform" data-tabla="tablaGanados"
       placeholder="Buscar res por crotal...">

<label class="checkbox-inline"><input type="checkbox" rel="vivo" value="1" class="tick" data-tabla="tablaGanados">Vivas</label>
<label class="checkbox-inline"><input type="checkbox" rel="vivo" value="0" class="tick" data-tabla="tablaGanados">Muertas</label>
<table id="tablaGanados" class="table header-fixed ganados">
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
        @if($ganado->crotal && $ganado->sexo && $ganado->fecha_nacimiento)



            <tr class="clickable-row vacas" data-href="{{route('verganado',[$ganado])}}" data-id="{{$ganado->id}}">
                <td style="width:12%;" class="vivo" rel="{{$ganado->vivo}}">{{$ganado->crotal}}</td>
                <td style="width:15%;">{{$ganado->sexo->nombre}}</td>
                <td style="width:20%;">{{$ganado->fecha_nacimiento->format('d-m-Y')}}</td>
                @if(!empty($ganado->ganaderia))
                <td style="width:25%;">{{$ganado->ganaderia->nombre}}</td>
                @else
                    <td style="width:25%;">No definida</td>
                @endif
                <td style="width:28%;">
                    <div class="btn-group">
                        <a href="{{url('ver/ganado',['ganado'=>$ganado])}}" class="btn btn-info btn-sm"
                           role="button"><span class="glyphicon glyphicon-list"></span> Detalles</a>
                        <a href="{{url('editar/ganado',['ganado'=>$ganado])}}" class="btn btn-success btn-sm"
                           role="button"><span class="glyphicon glyphicon-edit"></span> Editar</a>
                        @if($ganado->vivo==1)
                        <a href="#!" class="btn btn-danger btn-sm eliminar"
                           role="button"><span class="glyphicon glyphicon-remove"></span> Eliminar</a>
                        @else
                            <a href="#!" class="btn btn-danger btn-sm eliminar disabled"
                               role="button"><span class="glyphicon glyphicon-remove"></span> Eliminar</a>
                        @endif
                    </div>
                </td>
            </tr>
        @endif
    @endforeach
    </tbody>
</table>

{!! Form::open(['url' => ['eliminar/ganado/:ID_ELIMINAR'], 'method' => 'DELETE','id'=>'form-delete']) !!}
{!! Form::close() !!}

@section('scripts')

    <script src="{{asset('js/controller-model.js')}}" type="text/javascript"></script>

@endsection
