@extends('layout')

@section('contenido-fluid')
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="text-center">
            <h1>Software de Gestión Ganadera y Análisis Genético</h1>
        </div></div>
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
@endsection
