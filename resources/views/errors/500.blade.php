@extends('layout')


@section('contenido')

   <div class="col-sm-6 col-sm-offset-3">
       <div class="card" style="margin-bottom: 30px">
           <div class="card-content">
               <div class="card-title"><h1>¡Error!</h1></div>
               <img src="{{asset('images/vaca_errorf.png')}}" style="width: 50%;"/>
               <h3>La información que buscas no esta en nuestra base de datos.</h3>
           </div>
       </div>


   </div>
@endsection
