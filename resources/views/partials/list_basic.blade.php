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