@if(Auth::user()->hasAnyRole(array('Administrador','Laboratorio')))
    <a href="{{url('ver/asociacion')}}" role="button" class="btn btn-primary btn-lg" aria-pressed="true">Asociacion</a>

    <a href="{{url('ver/ganaderia')}}" role="button" class="btn btn-primary btn-lg" aria-pressed="true">Ganadería</a>
@endif
@if(Auth::user()->hasAnyRole(array('Administrador','Ganadero')))
<a href="{{url('ver/ganado')}}" role="button" class="btn btn-primary btn-lg" aria-pressed="true">Ganado</a>
<a href="{{route('verexplotacion')}}" role="button" class="btn btn-primary btn-lg" aria-pressed="true">Explotación</a>
@endif
@if(Auth::user()->hasAnyRole(array('Laboratorio')))
    <a href="{{route('vermuestra')}}" role="button" class="btn btn-primary btn-lg" aria-pressed="true">Muestra</a>
@endif

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
@endif

</div>