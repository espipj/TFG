@extends('layout')

@section('contenido-fluid')
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="text-center">
                <h1>Software de Gestión Ganadera y Análisis Genético</h1>
            </div>
        </div>
    </div>
    <div class="carousel slide" data-ride="carousel" style="margin-top: -15px">

        <div class="carousel-inner">
            <div class="item active">
                <img src="{{asset('images/vaca4.png')}}" class="img-responsive">
            </div>
            <div class="item">
                <img src="{{asset('images/vaca5.png')}}" class="img-responsive">
            </div>
            <div class="item">
                <img src="{{asset('images/vaca6.png')}}" class="img-responsive">
            </div>
        </div>
    </div>
    <div class="container" style="padding-bottom: 40px">
        <div class="row">
            <div class="col-sm-6">
                    <h2>Participantes en el proyecto:</h2>

            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-content">
<span class="card-title">
    Alumno
</span>
                    <p>Nombre: Pablo</p>
                    <p>Apellidos: Espinosa Bermejo</p>
                    <p>Rol: Estudiante de Ingeniería informática</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-content">
<span class="card-title">
    Tutor
</span>
                    <p>Nombre: Fernando</p>
                    <p>Apellidos: De la Prieta Pintado</p>
                    <p>Rol: Tutor (Ingeniero Informático)</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-content">
<span class="card-title">
    Tutor
</span>
                    <p>Nombre: Juan</p>
                    <p>Apellidos: Ramos</p>
                    <p>Rol: Tutor (Biólogo)</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-content">
<span class="card-title">
    Tutor
</span>
                    <p>Nombre: Elena</p>
                    <p>Apellidos: Solera Segura</p>
                    <p>Rol: Tutor (Biólogo y Empresa)</p>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
