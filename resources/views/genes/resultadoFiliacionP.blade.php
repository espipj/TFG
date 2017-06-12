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
                    <div class="panel-heading">Resultado de la Filiación Con Padre</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-1">
                                <h1>Resultados:</h1>
                                <p>Para la determinación del porcentaje de Probabilidad de Paternidad se emplean las fórmulas descritas por Evett y Weir2, obteniéndose un valor del {{$porcentaje}}%.</p>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 text-center cuadro-gan">
                                <div class="cuadro-gan">
                                    <img src="{{asset('images/female.png')}}"/>

                                        <h2>
                                            <a href="{{route('verganado',[$ganado->madre])}}">{{$ganado->madre->crotal}}</a>
                                        </h2>
                                </div>
                            </div>
                            <div class="col-md-6 text-center cuadro-gan">

                                <img src="{{asset('images/male.png')}}"/>

                                    <h2><a href="{{route('verganado',[$ganado->padre])}}">{{$ganado->padre->crotal}}</a>
                                    </h2>


                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-offset-4 col-md-4 text-center cuadro-gan">

                                <img src="{{asset('images/ternero.png')}}"/>
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