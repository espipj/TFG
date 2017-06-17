@extends('layout')

@section('contenido-fluid')


  <div class="carousel slide" data-ride="carousel" style="margin-top: -15px">

      <div class="carousel-inner">
          <div class="item active">
              <img src="{{asset('images/vaca3.png')}}">
          </div>
          <div class="item">
              <img src="{{asset('images/vaca2.png')}}">
          </div>
          <div class="item">
              <img src="{{asset('images/vaca1.png')}}">
          </div>
      </div>
  </div>

@endsection
