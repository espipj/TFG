@extends('layout')


@section('contenido')

    @if (Auth::guest())
        @include('partials.permission')
    @else
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">Registrar Ganadería</div>
          <div class="panel-body">
            @include('partials.errors')


            {!! Form::open(['url' => 'registrar/ganaderia','class' =>'form-horizontal']) !!}
              {!! csrf_field() !!}

              <div class="form-group">
                <label class="col-md-4 control-label">Nombre</label>
                <div class="col-md-6">
                  {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder'=>'Nombre','required']) !!}
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-4 control-label">Dirección postal</label>
                <div class="col-md-6">
                  {!! Form::text('direccion', null, ['class' => 'form-control', 'placeholder'=>'Direccion','required']) !!}
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-4 control-label">Asociación</label>
                <div class="col-md-6">
                  {!! Form::select('asociacion_id',$asociaciones,null,['placeholder'=>' -- Selecciona una opción -- ','class'=>'form-control','required']) !!}
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
