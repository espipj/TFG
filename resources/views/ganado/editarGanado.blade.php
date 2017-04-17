@extends('layout')


@section('contenido')


    <h1>Datos de la res:</h1>
    <p>Modifique los campos que desee editar.</p>

    {!! Form::open(['url' => 'editar/ganado/completed','class' =>'form-horizontal']) !!}
        {!! csrf_field() !!}
        Crotal:
       {!! Form::text('crotal', $ganado->crotal, ['class' => 'form-control', 'placeholder'=>$ganado->crotal,'required']) !!}

        Sexo: <br>
        @foreach($sexos as $sexo)
            @if($sexo->nombre != $ganado->sexo->nombre)
                <label class="radio-inline"><input type="radio" name="sexo_id" value="{{$sexo->id}}">{{$sexo->nombre}}
                </label>
            @else
                <label class="radio-inline"><input type="radio" name="sexo_id" value="{{$sexo->id}}" checked="checked">{{$sexo->nombre}}
                </label>
            @endif
        @endforeach
        <br>
        Fecha de nacimiento:
        <input type="date" name="fecha_nacimiento" class="form-control" value="{{ $ganado->fecha_nacimiento}}"></input>
        Ganadería:
        {!! Form::select('ganaderia_id',$ganaderias,$ganado->ganaderia->id,['placeholder'=>' -- Selecciona una opción -- ','class'=>'form-control','required']) !!}

        <input type="hidden" name="ganado_id" value="{{$ganado->id}}">
        <button type="submit" class="btn btn-primary">Confirmar</button>
    </form>


@endsection
