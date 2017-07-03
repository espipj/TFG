@extends('layout')


@section('contenido')

    @if (Auth::guest())
        @include('partials.permission')
    @elseif($muestras=="nomuest")
        @include('partials.role-permission')
    @else
        <div class="card" style="margin-bottom: 30px"><div class="card-content"><span class="card-title"><h1>Muestras</h1></span>

        <p>{{$descripcion}}</p>
        @if(Auth::user()->hasAnyRole(array('Administrador','SuperAdmin')))
            <br>
        <a href="{{url('registrar/muestra')}}" class="btn btn-primary btn-md" role="button"><span class="glyphicon glyphicon-plus"></span> Nueva muestra</a>
        @endif
        @include('muestra.tablaMuestras')

            </div></div>
    @endif
@endsection
