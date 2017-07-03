@extends('layout')

@section('head')

    <meta name="csrf-token" content="{{{ csrf_token() }}}">

@endsection

@section('contenido')

    @if (Auth::guest())
        @include('partials.permission')
    @else

        <div class="card" style="margin-bottom: 30px">
            <div class="card-content"><span class="card-title"><h1>Usuarios</h1></span>

                <p>Desde esta página puedes cambiar los permisos de cada usuario existente, asi como asignarle
                    responsabilidades.</p>

                @include('usuario.tablaUsuarios')
            </div>
        </div>
    @endif
@endsection
