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
<h4>Hola {{$user->name}},</h4>

<p>Acabamos de recibir una solicitud para cambiar tu contraseña.</p>
<p>Para resetear tu contraseña: <a class="btn btn-info btn-sm" href="{{ url('password/reset/'.$token) }}">Resetear</a></p>
</body>
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
