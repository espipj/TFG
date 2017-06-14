<div class="row">
    <h1>Panel de Inicio:</h1>
</div>
<div class="row">
@if(Auth::user()->hasAnyRole(array('Administrador','Laboratorio','Superadmin')))
    <a href="{{url('ver/asociacion')}}"><div class="col-md-3 text-center cuadropan">
            <img src="{{asset('images/asociacion.png')}}">
            <h2>Asociación</h2>
        </div></a>

    <a href="{{url('ver/ganaderia')}}"><div class="col-md-3 text-center cuadropan">

            <img src="{{asset('images/ganaderia.png')}}">
            <h2>Ganadería</h2>
        </div></a>
@endif
@if(Auth::user()->hasAnyRole(array('Administrador','Ganadero','Superadmin')))
    <a href="{{url('ver/ganado')}}"><div class="col-md-3 text-center cuadropan">

            <img src="{{asset('images/ganado.png')}}">
            <h2>Ganado</h2>
        </div></a>
    <a href="{{route('verexplotacion')}}"><div class="col-md-3 text-center cuadropan">

            <img src="{{asset('images/explotacion.png')}}">
            <h2>Explotación</h2>
        </div></a>
@endif
    @if(Auth::user()->hasAnyRole(array('Laboratorio','Superadmin')))
        <a href="{{route('vermuestra')}}"><div class="col-md-3 text-center cuadropan">

                <img src="{{asset('images/muestra.png')}}">
                <h2>Muestra</h2>
            </div></a>
        <a href="{{route('vergen')}}"><div class="col-md-3 text-center cuadropan">

                <img src="{{asset('images/gen.png')}}">
                <h2>Genética</h2>
            </div></a>
    @endif
    @if(Auth::user()->hasAnyRole(array('Superadmin')))
        <a href="{{route('verusuario')}}"><div class="col-md-3 text-center cuadropan">

                <img src="{{asset('images/usuarios.png')}}">
                <h2>Usuarios</h2>
        </div>
        </a>
    @endif

</div>