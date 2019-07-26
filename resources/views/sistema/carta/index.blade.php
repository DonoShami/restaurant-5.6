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
            <i class="fas fa-plus"></i><span> NUEVA CARTA</span>
        </a>
        
    </div>
    @if (!empty($data[0]))
    <div class="box-body">
        <table class="table table-bordered table-hover dataTable" id="tabla-data">
            <thead>                    	
                <tr>
                    @foreach ($headers as $header)
                        <th>{{strtoupper($header)}}</th>
                    @endforeach
                        <th>Estado</th>
                        <th>Seleccionar Menú</th>
                </tr>                
            </thead>
            <tbody>
                @foreach ($data as $key => $ele)
                <tr>
                    @foreach ($headers as $header)
                    <td>{{$ele->$header}}</td>
                    @endforeach
                    
                        @if ($ele->estado == '0')
                              <td>  <span class="label label-warning">Inactivo</span></td>
                              <td>
                                <div class="listado-item-ele"><a href="{{'\sistema'.$action.'/'.$ele->id}}/edit"><i class="fa  fa-check-square"> Seleccionar</i></a></div>
                                </td>
                        @endif
                        @if ($ele->estado == '1')
                            <td>   
                                <span class="label label-success">Activo</span>
                                <input type="hidden" name="carta_activa" value="{{$ele->id}}" readonly="readonly">
                            </td>
                            <td></td>
                        @endif
                        
                        
                    
                    
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    @endif
</div>
<div class="container-crud">
    <div class="opciones">
        <button id="" type="button" class="btn btn-primary btn-flat btn-block" data-toggle="modal" data-target="#modal-default1" ><span class="fa fa-list"></span>  LISTA DE PRODUCTOS</button>
    </div>
    <div class="box-body">
            
            <table class="table table-bordered table-hover dataTable" id="tabla-data-productos">
                <thead>                    	
                    <tr>
                            <th>#</th>
                            <th>PRODUCTO</th>
                            <th>CODIGO PRODUCTO</th>
                            <th>STOCK</th>
                            <th>CATEGORIA</th>
                            <th>Quitar</th>
                    </tr>                
                </thead>
                <tbody id="productos_body">
                    @foreach ($data2 as $key => $items)
                    <tr>
                        
                        <td>{{$items->id}}</td>
                        <td>{{$items->productos[0]['nombre']}}</td>
                        <td>{{$items->productos[0]['codigo']}}</td>
                                    <!--@foreach ($items->productos as  $prod)
                                        <td>{{$prod->codigo}}</td>
                                        <td>{{$prod->nombre}}</td>
                                    @endforeach-->
                        <td><input type="number" value="0" min="0" max="1000" step="1"/></td>
                        <td>
                            <select id="pet-select">
                                <option value="">Seleccionar</option>
                                <option value="entrada">Entrada</option>
                                <option value="extra">Extra</option>
                                <option value="bebida">Bebida</option>
                            </select>
                        </td>
                        <td>
                                    
                            <div class="listado-item-ele"><button onclick="eliminarFila({{$items->id}})" class="btn btn-danger">X</button></div>
                        </td>
                    </tr>
                    @endforeach
    
                </tbody>
            </table>
        </div>
</div>
<div class="col-xs-12">
                <div class="text-center">
                    <button  type="button" class="btn btn-success" id="guardarPedido()">Guardar</button>
                </div>
            </div>
@endsection
@include('sistema.carta.modal-producto')
@section("scripts")
<script>
    $(document).on("click",".btn-agregarprod",function(){
        alert("bton presionado");
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
                console.log("res= "+ JSON.stringify(respuesta));
                cargarDatos();
            }
        });
    }
    function cargarDatos(){
        $.ajax({
            url: "/sistema/carta-item",
            type: 'GET',//llama a index de CartaItem Controlador
            success: function (respuesta) {
                ga=respuesta[0].productos[0]['nombre'];
                
                var htmlproducto = "";
                    for(i=0;i<respuesta.length;i++)
                    {
                        htmlproducto += "<tr>"+
                        "<td>" + respuesta[i]['id'] + "</td>"+
                        "<td>" + respuesta[i].productos[0]['nombre'] + "</td>"+
                        "<td>" + respuesta[i].productos[0]['codigo'] + "</td>"+
                        "<td>" +respuesta[i]['stock']
                            + "</td>"+ "<td>categoria</td>"+
                        "<td><div class='listado-item-ele'><button class='btn btn-danger' onclick='eliminarFila("+ respuesta[i]['id'] +")'>X</button></div></td>"+
                    "</tr>";
                    }
                        
                
                $('#tabla-data-productos tbody').html(htmlproducto);
            }
        });
    }
    function eliminarFila(id_prod)
    {
        
        var data = {
            //id : id_prod,
            _token: $('input[name=_token]').val()
        };alert("pulsado" + id_prod);
        $.ajax({
            url: "/sistema/carta-item/delete/"+id_prod+"",
            type: 'DELETE',//llama a index de CartaItem Controlador
            data: data,
            success: function (respuesta) {
                //alert("dddd");
               console.log(respuesta);
               cargarDatos();
            }
        });
    }
    $("#buscarprod").on("keyup", function(){
        console.log($(this).val());
        var data = {
            valor : $(this).val(),
            _token: $('input[name=_token]').val()
        };
        $.ajax({
            url: "/sistema/carta/buscar",
            type: "POST",
            //dataType:"json",
            data:data,
            success:function(data){
                console.log(data);
                html="";
                for(i=0;i<data.length;i++)
                {	
                    if(data[i]!="")
                    {	
                        html+="<tr>";
                            html+="<td>"+data[i]['id']+"</td>";
                            html+="<td>"+data[i]['codigo']+"</td>";
                            html+="<td>"+data[i]['nombre']+"</td>";
                            html+="<td>"+ parseFloat(data[i]['precio']).toFixed(2)+"</td>";
                            html+="<td></td>";
                            
                            html+="<td>";
                                html+="<div class='btn-group'>";
                                    html+="<button type='button' class='btn btn-success btn-agregarprod' value='"+data[i]['id']+"*"+data[i]['codigo']+"*"+data[i]['nombre']+"'>";
                                        html+="<span class='fa fa-plus'></span>";
                                    html+="</button>";
                                html+="</div>";
                            html+="</td></tr>";
                    }
                   
                }
                $('#busqueda_producto').html(html);
                
            }
        });
    });
    
</script>
@endsection