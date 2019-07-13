@extends('layout.sistema')

@section('content')
<div class="container-crud">
    @if (session('confirmacion'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul>
                <li>{{ session('confirmacion') }}</li>
            </ul>
        </div>
    @endif
    <div class="opciones">
        <a class="btn btn-primary" href="{{ url('/sistema'.$action.'/create') }}" role="button">
            <i class="fas fa-plus"></i><span>NUEVO</span>
        </a>
        <input type="text" name="carta_activa" value="1" readonly="readonly">
    </div>
    @if (!empty($data[0]))
    <div class="box-body">
        <table class="table table-bordered table-hover dataTable" id="tabla-data">
            <thead>                    	
                <tr>
                    @foreach ($headers as $header)
                        <th>{{strtoupper($header)}}</th>
                    @endforeach
                        <th>VER/EDITAR</th>
                </tr>                
            </thead>
            <tbody>
                @foreach ($data as $key => $ele)
                <tr>
                    @foreach ($headers as $header)
                    <td>{{$ele->$header}}</td>
                        @endforeach
                    <td>
                        <div class="listado-item-ele"><a href="{{'\sistema'.$action.'/'.$ele->id}}/edit"><i class="far fa-edit"></i></a></div>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    @endif
</div>
<div class="container-crud">
    <div class="opciones">
        <button id="" type="button" class="btn btn-primary btn-flat btn-block" data-toggle="modal" data-target="#modal-default1" ><span class="fa fa-list"></span> Lista</button>
    </div>
    <div class="box-body">
            <table class="table table-bordered table-hover dataTable" id="tabla-data">
                <thead>                    	
                    <tr>
                            <th>#</th>
                            <th>PRODUCTO</th>
                            <th>CODIGO PRODUCTO</th>
                            <th>STOCK</th>
                            <th>OPCIONES</th>
                    </tr>                
                </thead>
                <tbody>
                    @foreach ($data2 as $key => $items)
                    <tr>
                        
                            <td>{{$items->id}}</td>
                            @foreach ($items->productos as  $prod)
                                <td>{{$prod->codigo}}</td>
                                <td>{{$prod->nombre}}</td>
                            @endforeach
                    <td>{{$items->stock}}</td>
                    
                        <td>
                            <div class="listado-item-ele"><a href="{{'\sistema'.$action.'/'.$ele->id}}/edit"><i class="far fa-edit"></i></a></div>
                        </td>
                    </tr>
                    @endforeach
    
                </tbody>
            </table>
        </div>
</div>
@endsection
@include('sistema.carta.modal-producto')
@section("scripts")
<script>
    $('.btn-agregarprod').on("click",function() {
        valores = $(this).val();
            valor_item = valores.split("*");
        var data = {
            carta_id: $('input[name=carta_activa]').val(),
            producto_id: valor_item[0],
            stock: 0,
            _token: $('input[name=_token]').val()
        };
        ajaxRequest('/sistema/carta-item', data);
    });

    function ajaxRequest (url, data) {
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function (respuesta) {
                console.log("ya mano"+ JSON.stringify(respuesta));
            }
        });
    }
    
</script>
@endsection