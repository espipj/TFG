<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Innovagenomics</title>


    <link rel="icon" href="{{asset('images/favicon.ico')}}">
    <!-- Bootstrap --><!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/stylesheet.css')}}">

    <!-- Fuentes google-->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,300,400,600,700,800" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <meta name="theme-color" content="#00557d">
    @yield('head')
</head>

<body id="top">
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#topFixedNavbar1"
                    aria-expanded="false"><span class="sr-only">Menú</span>Menú
            </button>
            <a class="navbar-brand" href="#top"></a></div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="topFixedNavbar1">
            <ul class="nav navbar-nav">
                <li {{{ (Request::is('/') ? 'class=active' : '') }}}><a href="{{route('landing')}}">Inicio</a></li>
                @if(!Auth::guest())

                    <li {{{ (Request::is('panel') ? 'class=active' : '') }}}><a href="{{route('home')}}">Panel</a></li>

                    @if(Auth::user()->hasAnyRole(array('Administrador','SuperAdmin')))
                        <li {{{ (Request::is('ver/asociacion*') ? 'class=active' : '') }}}><a
                                    href="{{route('verasociacion')}}">Asociación</a>

                        </li>
                    @endif
                    @if(Auth::user()->hasAnyRole(array('Administrador','SuperAdmin','Ganadero')))
                        <li {{{ (Request::is('ver/ganaderia*') ? 'class=active' : '') }}}><a
                                    href="{{route('verganaderia')}}">Ganadería</a>
                        </li>

                    @endif
                    @if(Auth::user()->hasAnyRole(array('Administrador','Ganadero','SuperAdmin')))
                        <li {{{ (Request::is('ver/ganado*') ? 'class=active' : '') }}}><a
                                    href="{{route('verganado')}}">Ganado</a></li>
                        <li {{{ (Request::is('ver/explotacion*') ? 'class=active' : '') }}}><a
                                    href="{{route('verexplotacion')}}">Explotación</a></li>
                    @endif

                    @if(Auth::user()->hasAnyRole(array('Laboratorio','SuperAdmin')))
                        <li {{{ (Request::is('ver/muestra*') ? 'class=active' : '') }}}><a
                                    href="{{route('vermuestra')}}">Muestra</a></li>
                        <li {{{ (Request::is('ver/gen*') ? 'class=active' : '') }}}><a
                                    href="{{route('vergen')}}">Genética</a></li>
                    @endif
                    @if(Auth::user()->hasAnyRole(array('SuperAdmin')))
                        <li {{{ (Request::is('ver/usuario*') ? 'class=active' : '') }}}><a
                                    href="{{route('verusuario')}}">Usuarios</a></li>
                    @endif
                @endif
                <li><a href="#contacto">Contacto</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{route('login')}}">Iniciar Sesión</a></li>
                    <li><a href="{{route('register')}}">Registrarse</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{route('logout')}}">Cerrar sesión</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

<!-- Cambiar imagenes a carousel para que ocupen el ancho, 1600*600-->
<div class="container-fluid">

    @yield('contenido-fluid')
</div>
<div class="container">
    @yield('contenido')

</div>


<footer class="footer" id="contacto">
    <div class="col-xs-12 col-md-10 col-md-offset-1">
        <div class="col-sm-6">
            <h2>Innovagenomics S.L</h2>
            <p><a href="https://goo.gl/maps/bW1paiWRDbF2">Parque Científico USAL<br>
                    Edif. CIALE Lab 4<br>
                    C/ Del Duero s/n<br>
                    37185 Villamayor (Salamanca)</a></p>
            <h3>Contacta con nosotros mediante:</h3>
            <ul>
                <li>E-Mail: <a href="mailto:innovagenomics@gmail.com">innovagenomics@gmail.com</a></li>
                <li>Telf: <a href="tel:675686587">675 686 587</a></li>
                <li>WebMaster: <a href="mailto:espipj@gmail.com">espipj@gmail.com</a></li>
            </ul>
        </div>
        <div class="col-sm-6 col-xs-12">
            <div id="mapa"></div>
        </div>
    </div>
</footer>

<!-- Latest compiled and minified JavaScript -->
<!-- Ya arriba <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
-->
<!-- Include all compiled plugins (below), or include individual files as needed -->


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJqnlOaz4UniyxcIbDB1xSu1RzwiE1nRQ"></script>
<script src="{{asset('js/jquery-3.2.1.min.js')}}" type="text/javascript"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script src="{{asset('js/controller.js')}}" type="text/javascript"></script>
@yield('scripts')
</body>
</html>
