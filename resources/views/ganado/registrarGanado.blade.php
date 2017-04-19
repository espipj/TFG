@extends('layout')


@section('contenido')
    @if (Auth::guest())
        @include('partials.permission')
    @else

    @include('partials.errors')

    <form method="POST" class="form" action="{{url('registrar/ganado')}}">
        {!! csrf_field() !!}
        Crotal:
        <input type="text" name="crotal" class="form-control" placeholder="Crotal" value="{{ old('crotal')}}"></input>
        Sexo: <br>
        @foreach($sexos as $sexo)
            <label class="radio-inline"> <input type="radio" name="sexo_id" value="{{$sexo->id}}" {{ (old("sexo_id") == $sexo->id ? "selected":"") }}>{{$sexo->nombre}}
            </label>
        @endforeach
        <br>
        Fecha de nacimiento:
        <input type="date" name="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento')}}"></input>
        Ganadería:
            @if($Ganaderia==null)
                {!! Form::select('ganaderia_id',$ganaderias,null,['placeholder'=>' -- Selecciona una opción -- ','class'=>'form-control','required']) !!}
            @else
                {!! Form::select('ganaderia_id',$ganaderias,$Ganaderia,['placeholder'=>' -- Selecciona una opción -- ','class'=>'form-control','required']) !!}
            @endif
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
    @endif
@endsection
