
@extends('layout')
@section('contenido')

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default pcontacto">
                    <div class="panel-heading">Contactar con el administrador</div>
                    <div class="panel-body">
                        <div class="col-sm-6 col-sm-offset-3">
                            {!! Form::open(['url' => 'contacto','class' =>'form-horizontal','id'=>'contact-form']) !!}
                            {!! csrf_field() !!}
                            @if(Auth::user()->email)
                            {!! Form::text('email',Auth::user()->email,['class' => 'form-control', 'placeholder'=>Auth::user()->email,'style="margin-bottom:10px"']) !!}
                            @else
                                {!! Form::text('email',null,['class' => 'form-control', 'placeholder'=>'E-Mail','style="margin-bottom:10px"']) !!}

                            @endif
                            {!! Form::textarea('solicitud', null, ['class' => 'form-control', 'placeholder'=>'Contacto con usted para... ','required','size' => '30x5']) !!}
                            <div class="text-center">
                                <button type="submit" class="btn btn-info contacto"  style="margin-top: 15px"><span class="glyphicon glyphicon-send"></span>
                                    Enviar
                                </button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div></div></div>
        </div>


    @endsection