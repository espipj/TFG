@extends('layout')

@section('contenido')
    <div class="card" style="margin-bottom: 20px">
        <div class="card-content"><span class="card-title"><h1>Importar/Exportar Ganaderia</h1></span>
            <div class="col-sm-6">
                <p>Para importar una o varias ganaderías necesitamos un fichero de excel con los siguientes atributos
                    <strong>obligatorios:</strong></p>
                <ul>
                    <li>nombre</li>
                    <li>sigla</li>
                    <li>email</li>
                    <li>telefono</li>
                </ul>
            </div>
            <div class="col-sm-6">
                <p>Además si se desea que también se cree una explotación asociada a la ganadería o se asocie la
                    ganadería a una asociación, son <strong>opcionales</strong>:</p>
                <ul>
                    <li>explotacion_codigo y explotacion_municipio (ambos son obligatorios para que se asocie una
                        explotación a la ganadería)
                    </li>
                    <li>asociacion (obligatorio si se quiere que una asociacion sea responsable de la ganadería)</li>
                    <li>id (campo totalmente opcional)</li>
                </ul>
            </div>
            <div class="col-sm-12">
                <p>A continuación podemos ver un archivo ejemplo:</p>
            </div>
            <div class="text-center">
                <img src="{{asset('images/fichero_ganaderia.png')}}" style="width: 90%">
            </div>

        </div>
    </div>
    <div class="card" style="margin-bottom: 20px">
        <div class="card-content"><span class="card-title"><h1>Importar/Exportar Ganado</h1></span>
            <div class="col-sm-6">
                <p>Para importar uno o varios ganados necesitamos un fichero de excel con los siguientes atributos
                    <strong>obligatorios:</strong></p>
                <ul>
                    <li>fecha_de_nacimiento</li>
                    <li>crotal</li>
                    <li>padre (crotal del padre)</li>
                    <li>madre (crotal del madre)</li>
                    <li>capa (N/C, Negra/Cárdena)</li>
                    <li>sexo (H/M, Hembra/Macho)</li>
                    <li>estado (Vivo/Muerto)</li>
                </ul>
            </div>
            <div class="col-sm-6">
                <p>Además si se desea que también se cree una explotación asociada a la ganadería o se asocie la
                    ganadería a una asociación, son <strong>opcionales</strong>:</p>
                <ul>
                    <li>ganaderia (obligatorio si se quiere que un ganado sea asociado a una ganadería)</li>
                    <li>sigla (obligatorio si se quiere que un ganado sea asociado a una ganadería)</li>
                </ul>
            </div>
            <div class="col-sm-12">
                <p>A continuación podemos ver un archivo ejemplo:</p>
            </div>
            <div class="text-center">
                <img src="{{asset('images/fichero_ganado.png')}}" style="width: 90%">
            </div>

        </div>
    </div>
    <div class="card" style="margin-bottom: 20px">
        <div class="card-content"><span class="card-title"><h1>Importar/Exportar Explotación Ganadera</h1></span>
            <div class="col-sm-6">
                <p>Para importar una o varias explotaciones necesitamos un fichero de excel con los siguientes atributos
                    <strong>obligatorios:</strong></p>
                <ul>
                    <li>codigo_explotacion</li>
                    <li>municipio</li>
                </ul>
            </div>
            <div class="col-sm-6">
                <p>Además si se desea que también se cree una explotación asociada a una ganadería es <strong>opcional</strong>:</p>
                <ul>
                    <li>ganaderia
                    </li>
                </ul>
            </div>
            <div class="col-sm-12">
                <p>A continuación podemos ver un archivo ejemplo:</p>
            </div>
            <div class="text-center">
                <img src="{{asset('images/fichero_explotacion.png')}}" style="width: 90%">
            </div>

        </div>
    </div>
    <div class="card" style="margin-bottom: 30px">
        <div class="card-content"><span class="card-title"><h1>Importar/Exportar Genes</h1></span>
            <div class="col-sm-6">
                <p>Para importar uno o varios genes necesitamos un fichero de excel con los siguientes atributos
                    <strong>obligatorios:</strong></p>
                <ul>
                    <li>crotal</li>
                    <li>genes</li>
                </ul>
            </div>
            <div class="col-sm-12">
                <p>A continuación podemos ver un archivo ejemplo:</p>
            </div>
            <div class="text-center">
                <img src="{{asset('images/fichero_gen.png')}}" style="width: 90%;margin-top: 20px;">
            </div>

        </div>
    </div>

@endsection