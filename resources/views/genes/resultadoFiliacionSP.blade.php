@extends('layout')
@section('contenido')

    @if (Auth::guest())
        @include('partials.permission')
    @elseif($permiso=="sinpermiso")
        @include('partials.role-permission')
    @else

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Resultado de la Filiación Sin Padre</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-1">
                                <h1 style="margin-bottom: 30px">Resultados:</h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 text-center cuadro-gan">
                                    <img src="{{asset('images/hembra.png')}}"/>

                                        <h2>
                                            <a href="{{route('verganado',[$ganado->madre])}}">{{$ganado->madre->crotal}}</a>
                                        </h2>

                            </div>
                            <div class="col-md-6 text-center cuadro-gan">

                                <img src="{{asset('images/macho.png')}}"/>

                                <div class="text-left">
                                @foreach($resimp as $key => $resultado)
                                    <h2>{{$key+1}}º-<a href="{{route('verganado',[$resultado["ganado"]->crotal])}}">{{$resultado["ganado"]->crotal}}</a>:
                                        {{$resultado["porcentaje"]}} %.

                                    </h2>
                                @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-offset-4 col-md-4 text-center cuadro-gan">

                                <img src="{{asset('images/hijo.png')}}"/>
                                <h2><a href="{{route('verganado',[$ganado])}}">{{$ganado->crotal}}</a></h2>



                            </div>
                        </div>

                        <div class="row" style="margin-top: 30px">
                            <div class="col-md-6 col-md col-lg-offset-6">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection