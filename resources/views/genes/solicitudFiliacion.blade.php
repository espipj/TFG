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
                    <div class="panel-heading">Solicitar Filiación</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <div class="cuadro-gan">
                                    <img src="{{asset('images/hembra.png')}}"/>
                                    @if($ganado->madre)
                                        <h2>
                                            <a href="{{route('verganado',[$ganado->madre])}}">{{$ganado->madre->crotal}}</a>
                                        </h2>
                                        @if(!isset($ganado->madre->gen))
                                            <p style="color: red">¡El perfil genético no está definido! Debes definir antes el perfil
                                                genético de la madre.</p>
                                        @endif
                                        <a href="{{url('anadir/genes',['ganado'=>$ganado->madre])}}"
                                           class="btn btn-success btn-sm"
                                           role="button"><span
                                                    class="glyphicon glyphicon-pencil"></span> Editar Perfil
                                            Genético</a>
                                    @else
                                        <h2>No definida</h2>
                                        <p>Debe definir antes a la madre.</p>
                                        <a href="{{url('editar/ganado',['ganado'=>$ganado->madre])}}"
                                           class="btn btn-warning btn-sm"
                                           role="button"><span
                                                    class="glyphicon glyphicon-pencil"></span> Editar Perfil
                                            Genético</a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 text-center cuadro-gan">

                                <img src="{{asset('images/macho.png')}}"/>
                                @if($ganado->padre)
                                    <h2><a href="{{route('verganado',[$ganado->padre])}}">{{$ganado->padre->crotal}}</a>
                                    </h2>

                                    @if(!isset($ganado->padre->gen))
                                        <p style="color: red">¡El perfil genético no está definido! Debes definir antes el perfil
                                            genético del padre.</p>
                                    @endif
                                    <a href="{{url('anadir/genes',['ganado'=>$ganado->padre])}}"
                                       class="btn btn-success btn-sm"
                                       role="button"><span
                                                class="glyphicon glyphicon-pencil"></span> Editar Perfil Genético</a>
                                @else
                                    <h2>No definido</h2>
                                    <p>Si no lo define antes se utilizara el proceso de filiación sin padre</p>
                                    <a href="{{url('editar/ganado',['ganado'=>$ganado->padre])}}"
                                       class="btn btn-warning btn-sm"
                                       role="button"><span
                                                class="glyphicon glyphicon-pencil"></span> Editar Perfil Genético</a>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-offset-3 col-md-6 cuadro-gan text-center">

                                <img src="{{asset('images/hijo.png')}}"/>
                                <h2><a href="{{route('verganado',[$ganado])}}">{{$ganado->crotal}}</a></h2>
                                @if(!isset($ganado->gen))
                                    <p style="color: red">¡El perfil genético no está definido! Debes definir antes el perfil
                                        genético del hijo.</p>
                                @endif
                                <a
                                        href="{{url('anadir/genes',['ganado'=>$ganado])}}"
                                        class="btn btn-success btn-sm"
                                        role="button"><span
                                            class="glyphicon glyphicon-pencil"></span> Editar Perfil Genético</a>


                            </div>
                        </div>

                        <div class="row" style="margin-top: 30px">
                            <div class="col-md-6 col-md col-lg-offset-6">
                            @if(isset($ganado->madre->gen) && isset($ganado->gen))

                                {!! Form::open(['url' => 'filiar/ganado','class' =>'form-horizontal']) !!}
                                {!! csrf_field() !!}
                                {!! Form::hidden('ganado_id',$ganado->id) !!}
                                {!! Form::hidden('consulta',"sinpadre") !!}

                                <button type="submit" class="btn btn-warning pull-right btn-lg" style="float: right;margin-left: 10px;">
                                    <span
                                            class="glyphicon glyphicon-indent-right"></span> Filiación sin padre
                                </button>
                                {!! Form::close() !!}
                            @endif
                            @if(isset($ganado->madre->gen) && isset($ganado->padre->gen) && isset($ganado->gen))
                                {!! Form::open(['url' => 'filiar/ganado','class' =>'form-horizontal']) !!}
                                {!! csrf_field() !!}
                                {!! Form::hidden('ganado_id',$ganado->id) !!}
                                {!! Form::hidden('consulta',"conpadre") !!}

                                <button type="submit" class="btn btn-primary btn-lg" style="float: right;margin-left: 10px;">
                                    <span
                                            class="glyphicon glyphicon-indent-right"></span> Filiación con padre
                                </button>
                                {!! Form::close() !!}
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection