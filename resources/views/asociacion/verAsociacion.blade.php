@extends('layout')


@section('contenido')

    @if (Auth::guest())
        @include('partials.permission')
    @else
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">
                            {{$asociacion->nombre}}
                        </span>
                        <h4 class="card-color-text">Dirección: <div class="card-color-text-normal">{{$asociacion->direccion}}</div></h4>
                        <h4 class="card-color-text">Email: <div class="card-color-text-normal"><a href="mailto:{{$asociacion->email}}">{{$asociacion->email}}</a></div></h4>
                        <h4 class="card-color-text">Telefono: <div class="card-color-text-normal"><a href="tel:{{$asociacion->telefono}}">{{$asociacion->telefono}}</a></div></h4>
                        <br>

                        <div class="text-center">
                            <a href="{{url('editar/asociacion',['asociacion'=>$asociacion])}}"
                               class="btn btn-success btn-sm"
                               role="button"><span class="glyphicon glyphicon-edit"></span> Editar</a>

                            <a href="" class="btn btn-danger btn-sm eliminar-detail"
                               role="button" data-id="{{$asociacion->id}}"><span
                                        class="glyphicon glyphicon-remove"></span> Eliminar</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                        <iframe class="card" width="100%" height="32%" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q={{$asociacion->direccion}}&key=AIzaSyDbqmt5yJhB68YvNo_gJjiV8GA1kb3PJHk" allowfullscreen></iframe>

            </div>


        </div>
<div class="row">
            
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">
                            <h2>Ganaderías</h2>
                        </span>
        
        <a href="{{url('registrar/ganaderia',['asociacion'=>$asociacion])}}" class="btn btn-primary btn-sm"
           role="button"><span class="glyphicon glyphicon-plus"></span> Registrar Ganadería</a>

        @include('ganaderia.tablaGanaderias')
</div></div></div>
    @endif
@endsection

{!! Form::open(['url' => ['eliminar/explotacion/:ID_ELIMINAR'], 'method' => 'DELETE','id'=>'form-delete']) !!}
{!! Form::close() !!}

@section('scripts')

    <script src="{{asset('js/controller-model.js')}}" type="text/javascript"></script>


@endsection
