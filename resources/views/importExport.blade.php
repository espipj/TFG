@extends('layout')

@section('contenido')

    <div class="container">
        <a href="{{ URL::to('downloadExcel/xls') }}">
            <button class="btn btn-success">Download Excel xls</button>
        </a>
        <a href="{{ URL::to('downloadExcel/xlsx') }}">
            <button class="btn btn-success">Download Excel xlsx</button>
        </a>
        <a href="{{ URL::to('downloadExcel/csv') }}">
            <button class="btn btn-success">Download CSV</button>
        </a>
        <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ URL::to('importExcel') }}"
              class="form-horizontal" method="post" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <input type="file" name="import_file"/>
            <button class="btn btn-primary">Import File</button>
        </form>
    </div>

@endsection