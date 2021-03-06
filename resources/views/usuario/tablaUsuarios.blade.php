<input type="text" id="buscadorUsuarios" class="buscadorjs noform" data-tabla="tablaUsuarios"
       placeholder="Buscar usuarios por nombre...">

<div class="table-responsive">
<table id="tablaUsuarios" class="table header-fixed ganados ">
    <thead>
    <tr class="header">
        <th style="width:16%;">Nombre</th>
        <th style="width:18%;">Email</th>
        <th style="width:10%;">Ganadero</th>
        <th style="width:10%;">Laboratorio</th>
        <th style="width:10%;">Administrador</th>
        <th style="width:18%;">Roles</th>
        <th style="width:18%;">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($usuarios as $usuario)
        @if($usuario->name && $usuario->email && !$usuario->hasAnyRole('SuperAdmin'))


            <tr class="clickable-row" data-href="{{route('verusuario',[$usuario])}}" data-id="{{$usuario->id}}">

                {!! Form::open(['url' => ['asignar/usuario'], 'method' => 'POST','id'=>'form-asign']) !!}
                {{ csrf_field() }}
                <td style="width:16%;">{{$usuario->name}}</td>
                <td style="width:18%;">{{$usuario->email}}<input type="hidden" name="email" value="{{ $usuario->email }}"></td>

                <td style="width:10%;"><input type="checkbox" class="role-tick" {{ $usuario->hasAnyRole('Ganadero') ? 'checked' : '' }} name="role_ganad"></td>
                <td style="width:10%;"><input type="checkbox" class="role-tick" {{ $usuario->hasAnyRole('Laboratorio') ? 'checked' : '' }} name="role_labo"></td>
                <td style="width:10%;"><input type="checkbox" class="role-tick" {{ $usuario->hasAnyRole('Administrador') ? 'checked' : '' }} name="role_admin"></td>


                <td style="width:18%;">
                    <button type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-floppy-disk"></span> Asignar</button>

                </td>
                <td style="width:18%;">
                    <div class="btn-group">
                        <a href="{{url('editar/usuario',['usuario'=>$usuario])}}" class="btn btn-success btn-sm"
                           role="button"><span
                                    class="glyphicon glyphicon-user"></span> Administra</a>
                    <a href="#!" role="button" class="btn btn-danger btn-sm eliminar"><span class="glyphicon glyphicon-remove"></span> Eliminar</a>
                    </div>
                </td>
                {!! Form::close() !!}
            </tr>
        @endif
    @endforeach
    </tbody>
</table>
</div>
{!! Form::open(['url' => ['eliminar/usuario/:ID_ELIMINAR'], 'method' => 'DELETE','id'=>'form-delete']) !!}
{!! Form::close() !!}


@section('scripts')

    <script src="{{asset('js/controller-model.js')}}" type="text/javascript"></script>

@endsection
