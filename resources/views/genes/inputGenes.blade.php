@extends('layout')
@section('contenido')

    @if (Auth::guest())
        @include('partials.permission')
    @elseif($permiso=="sinpermiso")
        @include('partials.role-permission')
    @else

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">Modificar datos genéticos</div>
                        <div class="panel-body">
                            @include('partials.errors')


                            {!! Form::open(['url' => 'anadir/genes','class' =>'form-horizontal']) !!}
                            {!! csrf_field() !!}
                            {!! Form::hidden('ganado_id',$ganado->id) !!}


                            <div class="form-group">
                                <label class="col-md-4 control-label">TGLA227</label>
                                @if(isset($ganado->gen))
                                    <div class="col-md-3">
                                        {!! Form::text('tgla227_1', $ganado->gen->marcadores[0][0], ['class' => 'form-control', 'placeholder'=>$ganado->gen->marcadores[0][0],'required']) !!}
                                    </div>
                                    <div class="col-md-3">
                                        {!! Form::text('tgla227_2', $ganado->gen->marcadores[0][1], ['class' => 'form-control', 'placeholder'=>$ganado->gen->marcadores[0][1],'required']) !!}
                                    </div>

                                @else
                                    <div class="col-md-3">
                                        {!! Form::text('tgla227_1', null, ['class' => 'form-control', 'placeholder'=>'Alelo 1','required']) !!}
                                    </div>
                                    <div class="col-md-3">
                                        {!! Form::text('tgla227_2', null, ['class' => 'form-control', 'placeholder'=>'Alelo 2','required']) !!}
                                    </div>
                                @endif
                            </div>


                            <div class="form-group">
                                <label class="col-md-4 control-label">BM2113</label>
                                @if(isset($ganado->gen))
                                    <div class="col-md-3">
                                        {!! Form::text('bm2113_1', $ganado->gen->marcadores[1][0], ['class' => 'form-control', 'placeholder'=>$ganado->gen->marcadores[1][0],'required']) !!}
                                    </div>
                                    <div class="col-md-3">
                                        {!! Form::text('bm2113_2', $ganado->gen->marcadores[1][1], ['class' => 'form-control', 'placeholder'=>$ganado->gen->marcadores[1][1],'required']) !!}
                                    </div>

                                @else
                                    <div class="col-md-3">
                                        {!! Form::text('bm2113_1', null, ['class' => 'form-control', 'placeholder'=>'Alelo 1','required']) !!}
                                    </div>
                                    <div class="col-md-3">
                                        {!! Form::text('bm2113_2', null, ['class' => 'form-control', 'placeholder'=>'Alelo 2','required']) !!}
                                    </div>
                                @endif
                            </div>


                            <div class="form-group">
                                <label class="col-md-4 control-label">TGLA53</label>
                                @if(isset($ganado->gen))
                                    <div class="col-md-3">
                                        {!! Form::text('tgla53_1', $ganado->gen->marcadores[2][0], ['class' => 'form-control', 'placeholder'=>$ganado->gen->marcadores[2][0],'required']) !!}
                                    </div>
                                    <div class="col-md-3">
                                        {!! Form::text('tgla53_2', $ganado->gen->marcadores[2][1], ['class' => 'form-control', 'placeholder'=>$ganado->gen->marcadores[2][1],'required']) !!}
                                    </div>

                                @else

                                    <div class="col-md-3">
                                        {!! Form::text('tgla53_1', null, ['class' => 'form-control', 'placeholder'=>'Alelo 1','required']) !!}
                                    </div>
                                    <div class="col-md-3">
                                        {!! Form::text('tgla53_2', null, ['class' => 'form-control', 'placeholder'=>'Alelo 2','required']) !!}
                                    </div>
                                @endif
                            </div>


                            <div class="form-group">
                                <label class="col-md-4 control-label">ETH10</label>
                                @if(isset($ganado->gen))
                                    <div class="col-md-3">
                                        {!! Form::text('eth10_1', $ganado->gen->marcadores[3][0], ['class' => 'form-control', 'placeholder'=>$ganado->gen->marcadores[3][0],'required']) !!}
                                    </div>
                                    <div class="col-md-3">
                                        {!! Form::text('eth10_2', $ganado->gen->marcadores[3][1], ['class' => 'form-control', 'placeholder'=>$ganado->gen->marcadores[3][1],'required']) !!}
                                    </div>

                                @else

                                    <div class="col-md-3">
                                        {!! Form::text('eth10_1', null, ['class' => 'form-control', 'placeholder'=>'Alelo 1','required']) !!}
                                    </div>
                                    <div class="col-md-3">
                                        {!! Form::text('eth10_2', null, ['class' => 'form-control', 'placeholder'=>'Alelo 2','required']) !!}
                                    </div>
                                @endif
                            </div>


                            <div class="form-group">
                                <label class="col-md-4 control-label">SPS115</label>
                                @if(isset($ganado->gen))
                                    <div class="col-md-3">
                                        {!! Form::text('sps115_1', $ganado->gen->marcadores[4][0], ['class' => 'form-control', 'placeholder'=>$ganado->gen->marcadores[4][0],'required']) !!}
                                    </div>
                                    <div class="col-md-3">
                                        {!! Form::text('sps115_2', $ganado->gen->marcadores[4][1], ['class' => 'form-control', 'placeholder'=>$ganado->gen->marcadores[4][1],'required']) !!}
                                    </div>

                                @else
                                    <div class="col-md-3">
                                        {!! Form::text('sps115_1', null, ['class' => 'form-control', 'placeholder'=>'Alelo 1','required']) !!}
                                    </div>
                                    <div class="col-md-3">
                                        {!! Form::text('sps115_2', null, ['class' => 'form-control', 'placeholder'=>'Alelo 2','required']) !!}
                                    </div>
                                @endif
                            </div>


                            <div class="form-group">
                                <label class="col-md-4 control-label">TGLA126</label>
                                @if(isset($ganado->gen))
                                    <div class="col-md-3">
                                        {!! Form::text('tgla126_1', $ganado->gen->marcadores[5][0], ['class' => 'form-control', 'placeholder'=>$ganado->gen->marcadores[5][0],'required']) !!}
                                    </div>
                                    <div class="col-md-3">
                                        {!! Form::text('tgla126_2', $ganado->gen->marcadores[5][1], ['class' => 'form-control', 'placeholder'=>$ganado->gen->marcadores[5][1],'required']) !!}
                                    </div>

                                @else
                                    <div class="col-md-3">
                                        {!! Form::text('tgla126_1', null, ['class' => 'form-control', 'placeholder'=>'Alelo 1','required']) !!}
                                    </div>
                                    <div class="col-md-3">
                                        {!! Form::text('tgla126_2', null, ['class' => 'form-control', 'placeholder'=>'Alelo 2','required']) !!}
                                    </div>
                                @endif
                            </div>


                            <div class="form-group">
                                <label class="col-md-4 control-label">TGLA122</label>
                                @if(isset($ganado->gen))
                                    <div class="col-md-3">
                                        {!! Form::text('tgla122_1', $ganado->gen->marcadores[6][0], ['class' => 'form-control', 'placeholder'=>$ganado->gen->marcadores[6][0],'required']) !!}
                                    </div>
                                    <div class="col-md-3">
                                        {!! Form::text('tgla122_2', $ganado->gen->marcadores[6][1], ['class' => 'form-control', 'placeholder'=>$ganado->gen->marcadores[6][1],'required']) !!}
                                    </div>

                                @else
                                    <div class="col-md-3">
                                        {!! Form::text('tgla122_1', null, ['class' => 'form-control', 'placeholder'=>'Alelo 1','required']) !!}
                                    </div>
                                    <div class="col-md-3">
                                        {!! Form::text('tgla122_2', null, ['class' => 'form-control', 'placeholder'=>'Alelo 2','required']) !!}
                                    </div>
                                @endif
                            </div>


                            <div class="form-group">
                                <label class="col-md-4 control-label">INRA23</label>
                                @if(isset($ganado->gen))
                                    <div class="col-md-3">
                                        {!! Form::text('inra023_1', $ganado->gen->marcadores[7][0], ['class' => 'form-control', 'placeholder'=>$ganado->gen->marcadores[7][0],'required']) !!}
                                    </div>
                                    <div class="col-md-3">
                                        {!! Form::text('inra023_2', $ganado->gen->marcadores[7][1], ['class' => 'form-control', 'placeholder'=>$ganado->gen->marcadores[7][1],'required']) !!}
                                    </div>

                                @else
                                    <div class="col-md-3">
                                        {!! Form::text('inra023_1', null, ['class' => 'form-control', 'placeholder'=>'Alelo 1','required']) !!}
                                    </div>
                                    <div class="col-md-3">
                                        {!! Form::text('inra023_2', null, ['class' => 'form-control', 'placeholder'=>'Alelo 2','required']) !!}
                                    </div>
                                @endif
                            </div>


                            <div class="form-group">
                                <label class="col-md-4 control-label">BM1818</label>
                                @if(isset($ganado->gen))
                                    <div class="col-md-3">
                                        {!! Form::text('bm1818_1', $ganado->gen->marcadores[8][0], ['class' => 'form-control', 'placeholder'=>$ganado->gen->marcadores[8][0],'required']) !!}
                                    </div>
                                    <div class="col-md-3">
                                        {!! Form::text('bm1818_2', $ganado->gen->marcadores[8][1], ['class' => 'form-control', 'placeholder'=>$ganado->gen->marcadores[8][1],'required']) !!}
                                    </div>

                                @else
                                    <div class="col-md-3">
                                        {!! Form::text('bm1818_1', null, ['class' => 'form-control', 'placeholder'=>'Alelo 1','required']) !!}
                                    </div>
                                    <div class="col-md-3">
                                        {!! Form::text('bm1818_2', null, ['class' => 'form-control', 'placeholder'=>'Alelo 2','required']) !!}
                                    </div>
                                @endif
                            </div>


                            <div class="form-group">
                                <label class="col-md-4 control-label">ETH3</label>
                                @if(isset($ganado->gen))
                                    <div class="col-md-3">
                                        {!! Form::text('eth3_1', $ganado->gen->marcadores[9][0], ['class' => 'form-control', 'placeholder'=>$ganado->gen->marcadores[9][0],'required']) !!}
                                    </div>
                                    <div class="col-md-3">
                                        {!! Form::text('eth3_2', $ganado->gen->marcadores[9][1], ['class' => 'form-control', 'placeholder'=>$ganado->gen->marcadores[9][1],'required']) !!}
                                    </div>

                                @else
                                    <div class="col-md-3">
                                        {!! Form::text('eth3_1', null, ['class' => 'form-control', 'placeholder'=>'Alelo 1','required']) !!}
                                    </div>
                                    <div class="col-md-3">
                                        {!! Form::text('eth3_2', null, ['class' => 'form-control', 'placeholder'=>'Alelo 2','required']) !!}
                                    </div>
                                @endif
                            </div>


                            <div class="form-group">
                                <label class="col-md-4 control-label">ETH225</label>
                                @if(isset($ganado->gen))
                                    <div class="col-md-3">
                                        {!! Form::text('eth225_1', $ganado->gen->marcadores[10][0], ['class' => 'form-control', 'placeholder'=>$ganado->gen->marcadores[10][0],'required']) !!}
                                    </div>
                                    <div class="col-md-3">
                                        {!! Form::text('eth225_2', $ganado->gen->marcadores[10][1], ['class' => 'form-control', 'placeholder'=>$ganado->gen->marcadores[10][1],'required']) !!}
                                    </div>

                                @else
                                    <div class="col-md-3">
                                        {!! Form::text('eth225_1', null, ['class' => 'form-control', 'placeholder'=>'Alelo 1','required']) !!}
                                    </div>
                                    <div class="col-md-3">
                                        {!! Form::text('eth225_2', null, ['class' => 'form-control', 'placeholder'=>'Alelo 2','required']) !!}
                                    </div>
                                @endif
                            </div>


                            <div class="form-group">
                                <label class="col-md-4 control-label">BM1824</label>
                                @if(isset($ganado->gen))
                                    <div class="col-md-3">
                                        {!! Form::text('bm1824_1', $ganado->gen->marcadores[11][0], ['class' => 'form-control', 'placeholder'=>$ganado->gen->marcadores[11][0],'required']) !!}
                                    </div>
                                    <div class="col-md-3">
                                        {!! Form::text('bm1824_2', $ganado->gen->marcadores[11][1], ['class' => 'form-control', 'placeholder'=>$ganado->gen->marcadores[11][1],'required']) !!}
                                    </div>

                                @else
                                    <div class="col-md-3">
                                        {!! Form::text('bm1824_1', null, ['class' => 'form-control', 'placeholder'=>'Alelo 1','required']) !!}
                                    </div>
                                    <div class="col-md-3">
                                        {!! Form::text('bm1824_2', null, ['class' => 'form-control', 'placeholder'=>'Alelo 2','required']) !!}
                                    </div>
                                @endif
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary" style="margin-right: 15px;">
                                        Guardar
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