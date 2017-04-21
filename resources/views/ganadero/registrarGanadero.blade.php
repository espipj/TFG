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
          <div class="panel-heading">Registrar Ganadero</div>
          <div class="panel-body">
            @include('partials.errors')

            {!! Form::open(['url' => 'registrar/ganadero','class' =>'form-horizontal']) !!}

              {!! csrf_field() !!}

              <div class="form-group">
                <label class="col-md-4 control-label">Nombre</label>
                <div class="col-md-6">
                  {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder'=>'Nombre','required']) !!}
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-4 control-label">Primer Apellido</label>
                <div class="col-md-6">
                  {!! Form::text('apellido1', null, ['class' => 'form-control', 'placeholder'=>'Primer Apellido','required']) !!}
                </div>
              </div>


              <div class="form-group">
                <label class="col-md-4 control-label">Segundo Apellido</label>
                <div class="col-md-6">
                  {!! Form::text('apellido2', null, ['class' => 'form-control', 'placeholder'=>'Segundo Apellido','required']) !!}
                </div>
              </div>


              <div class="form-group">
                <label class="col-md-4 control-label">DNI</label>
                <div class="col-md-6">
                  {!! Form::text('dni', null, ['class' => 'form-control', 'placeholder'=>'DNI','required']) !!}
                </div>
              </div>



              <div class="form-group">
                <label class="col-md-4 control-label">E-Mail</label>
                <div class="col-md-6">
                  {!! Form::email('email', null, ['class' => 'form-control', 'placeholder'=>'E-Mail','required']) !!}
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-4 control-label">Teléfono</label>
                <div class="col-md-6">
                  {!! Form::text('telefono', null, ['class' => 'form-control', 'placeholder'=>'Teléfono','required']) !!}
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
                    Crear
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
