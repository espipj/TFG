@extends('layout')

@section('contenido-fluid')


  <div class="carousel slide" data-ride="carousel" style="margin-top: -15px">

      <div class="carousel-inner">
          <div class="item active">
              <img src="{{asset('images/land.png')}}" alt="Raza morucha">
          </div>
          <div class="item">
              <img src="{{asset('images/land1.png')}}" alt="Raza morucha 1">
          </div>
      </div>
  </div>

@endsection
