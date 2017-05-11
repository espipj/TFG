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