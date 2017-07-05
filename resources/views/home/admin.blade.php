
@if(!isset(Auth::user()->asociacion) && !isset(Auth::user()->laboratorio) && !isset(Auth::user()->ganaderia) && !Auth::user()->hasAnyRole(array('SuperAdmin')))
    <div class="card" id="card-contacto">
    <div class="card-content">
        <span class="card-title"><h1>Tenemos un problema...</h1></span>

            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default pcontacto">
                        <div class="panel-heading">Contactar con el administrador</div>
                        <div class="panel-body">
                            <div class="alert alert-info alert-dismissable fade in col-sm-6 col-sm-offset-3">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Importante!</strong> Aún no se te ha asignado ninguna responsabilidad, contacta con el
                                administrador para que asigne responsabilidades a tu perfil.
                            </div>
                            <div class="col-sm-6 col-sm-offset-3">
                            {!! Form::open(['url' => 'contactoRol','class' =>'form-horizontal','id'=>'contact-form']) !!}
                            {!! Form::hidden('usuario_id',Auth::user()->id) !!}
                            {!! csrf_field() !!}
                            {!! Form::textarea('solicitud', null, ['class' => 'form-control', 'placeholder'=>'Quiero solicitar que se me asigne el rol de X en...','required','size' => '30x5']) !!}
<div class="text-center">
                            <button type="submit" class="btn btn-info contacto"  style="margin-top: 15px"><span class="glyphicon glyphicon-send"></span>
                                Enviar
                            </button>
</div>
                            {!! Form::close() !!}
                            </div>
                        </div></div></div>
            </div>

    </div>
</div>
@endif
<div class="card" style="margin-bottom: 30px">
    <div class="card-content"><span class="card-title"><h1>Panel de Inicio:</h1></span>

        <div class="row">
            @if(Auth::user()->hasAnyRole(array('Administrador','Superadmin')))
                @if(isset(Auth::user()->asociacion) || Auth::user()->hasAnyRole(array('SuperAdmin')))
                    <div class="col-md-3 text-center cuadropanover">
                        <a href="{{url('ver/asociacion')}}">
                            <div class="cuadropan">
                                <img src="{{asset('images/asociacion.png')}}">
                                <h2>Asociación</h2>
                            </div>
                        </a>
                    </div>
                @endif
            @endif
            @if(Auth::user()->hasAnyRole(array('Administrador','Superadmin','Ganadero')))
                @if(isset(Auth::user()->asociacion) || isset(Auth::user()->ganaderia) || Auth::user()->hasAnyRole(array('SuperAdmin')))
                    <div class="col-md-3 text-center cuadropanover">
                        <a href="{{url('ver/ganaderia')}}">
                            <div class="cuadropan">

                                <img src="{{asset('images/ganaderia.png')}}">
                                <h2>Ganadería</h2>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 text-center cuadropanover">
                        <a href="{{url('ver/ganado')}}">
                            <div class="cuadropan">

                                <img src="{{asset('images/ganado.png')}}">
                                <h2>Ganado</h2>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 text-center cuadropanover">
                        <a href="{{route('verexplotacion')}}">
                            <div class="cuadropan">

                                <img src="{{asset('images/explotacion.png')}}">
                                <h2>Explotación</h2>
                            </div>
                        </a>
                    </div>
                @endif
            @endif
            @if(Auth::user()->hasAnyRole(array('Laboratorio')) && isset(Auth::user()->laboratorio))
                <div class="col-md-3 text-center cuadropanover">
                    <a href="{{url('ver/ganado')}}">
                        <div class="cuadropan">

                            <img src="{{asset('images/ganado.png')}}">
                            <h2>Ganado</h2>
                        </div>
                    </a>
                </div>
            @endif
            @if(Auth::user()->hasAnyRole(array('Laboratorio','Superadmin','Administrador')))
                @if(isset(Auth::user()->asociacion) || isset(Auth::user()->laboratorio) || Auth::user()->hasAnyRole(array('SuperAdmin')))
                    <div class="col-md-3 text-center cuadropanover">
                        <a href="{{route('vermuestra')}}">
                            <div class="cuadropan">

                                <img src="{{asset('images/muestras.png')}}">
                                <h2>Muestra</h2>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 text-center cuadropanover">
                        <a href="{{route('vergen')}}">
                            <div class="cuadropan">

                                <img src="{{asset('images/genetica.png')}}">
                                <h2>Genética</h2>
                            </div>
                        </a>
                    </div>
                @endif
            @endif
            @if(Auth::user()->hasAnyRole(array('Superadmin')))
                <div class="col-md-3 text-center cuadropanover">
                    <a href="{{route('verusuario')}}">
                        <div class="cuadropan">

                            <img src="{{asset('images/usuarios.png')}}">
                            <h2>Usuarios</h2>
                        </div>
                    </a>
                </div>
            @endif
            <div class="col-md-3 text-center cuadropanover">
                <a href="{{route('manual')}}">
                    <div class="cuadropan">

                        <img src="{{asset('images/manual.png')}}">
                        <h2>Manual</h2>
                    </div>
                </a>
            </div>

        </div>
    </div>
</div>