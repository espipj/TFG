<div class="card" style="margin-bottom: 30px"><div class="card-content"><span class="card-title"><h1>Panel de Inicio:</h1></span>

<div class="row">
    @if(Auth::user()->hasAnyRole(array('Administrador','Superadmin')))
        <div class="col-md-3 text-center cuadropanover">
            <a href="{{url('ver/asociacion')}}">
                <div class="cuadropan">
                    <img src="{{asset('images/asociacion.png')}}">
                    <h2>Asociación</h2>
                </div>
            </a>
        </div>
@endif
    @if(Auth::user()->hasAnyRole(array('Administrador','Superadmin','Ganadero')))
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
    @if(Auth::user()->hasAnyRole(array('Laboratorio')))
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

</div></div> </div>