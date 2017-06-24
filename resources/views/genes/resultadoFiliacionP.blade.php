@extends('layout')
@section('contenido')

    @if (Auth::guest())
        @include('partials.permission')
    @elseif($permiso=="sinpermiso")
        @include('partials.role-permission')
    @else

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-success">
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
                                    <img src="{{asset('images/hembra.png')}}"/>

                                        <h2>
                                            <a href="{{route('verganado',[$ganado->madre])}}">{{$ganado->madre->crotal}}</a>
                                        </h2>
                                </div>
                            </div>
                            <div class="col-md-6 text-center cuadro-gan">

                                <img src="{{asset('images/macho.png')}}"/>

                                    <h2><a href="{{route('verganado',[$ganado->padre])}}">{{$ganado->padre->crotal}}</a>
                                    </h2>


                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-offset-4 col-md-4 text-center cuadro-gan">

                                <img src="{{asset('images/hijo.png')}}"/>
                                <h2><a href="{{route('verganado',[$ganado])}}">{{$ganado->crotal}}</a></h2>



                            </div>
                        </div>

                        @if(isset($ganadosf[0]))
                            <div class="row dropgenes">
                                <div class="col-xs-offset-1 col-xs-10">
                                    <div class="panel-group">
                                        <div class="panel panel-success">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" href="#genes">Ver perfiles genéticos</a>
                                                </h4>
                                            </div>
                                            <div id="genes" class="panel-collapse collapse in">
                                                <div class="panel-body">

                                                    @foreach($ganadosf as $ganadoif)
                                                        <div class="col-xs-4 text-center">
                                                            <h3>{{$ganadoif[0]}}</h3>
                                                            @include('genes.tablaInfo',['ganadoinfo'=>$ganadoif[1]])
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection