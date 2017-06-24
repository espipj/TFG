<div class="table-responsive geninfo">
    <table class="table table-bordered">
        <thead>
        <tr class="header text-center info">
            <th>Marcador</th>
            <th colspan="2">{{$ganadoinfo->crotal}}</th>
        </tr>
        </thead>
        <tbody>
@foreach($ganadoinfo->gen->marcadores as $key=>$marcador)

                <tr class="text-center">
                    <td class="info">{{$ganadoinfo->gen->nombres[$key]}}</td>
                    <td>{{$marcador[0]}}</td>
                    <td>{{$marcador[1]}}</td>
                </tr>
    @endforeach
        </tbody>
    </table>

</div>