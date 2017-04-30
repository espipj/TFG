@extends('layout')


@section('contenido')
  @if (Auth::guest())
    @include('partials.permission')
  @else

  @include('partials.errors')


  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">Registrar Explotación</div>
          <div class="panel-body">
            @include('partials.errors')

            {!! Form::open(['url' => 'registrar/explotacion','class' =>'form-horizontal']) !!}

              {!! csrf_field() !!}

              <div class="form-group">
                  <label class="col-md-4 control-label">Código de Explotación</label>
                  <div class="col-md-6">
                      {!! Form::text('codigo_explotacion', null, ['class' => 'form-control', 'placeholder'=>'CEA','required']) !!}
                  </div>
              </div>

              <div class="form-group">
                  <label class="col-md-4 control-label">Municipio</label>
                  <div class="col-md-6">
                      {!! Form::text('municipio', null, ['class' => 'form-control', 'placeholder'=>'Municipio','required']) !!}
                  </div>
              </div>


              <div class="form-group">
                <label class="col-md-4 control-label">Ganadería</label>
                <div class="col-md-6">
                  @if(!empty($Ganaderia))
                    {!! Form::select('ganaderia_id',$ganaderias,$Ganaderia,['placeholder'=>' -- Selecciona una opción -- ','class'=>'form-control','required']) !!}
                  @else
                    {!! Form::select('ganaderia_id',$ganaderias,null,['placeholder'=>' -- Selecciona una opción -- ','class'=>'form-control','required']) !!}
                  @endif
                </div>
              </div>



              <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                  <button type="submit" class="btn btn-primary" style="margin-right: 15px;">
                    Registrar
                  </button>
                </div>
              </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif
@endsection
