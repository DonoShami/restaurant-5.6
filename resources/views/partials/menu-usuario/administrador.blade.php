<ul class="sidebar-menu" data-widget="tree">
        <li class="header">Restaurant</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="{{url('/sistema')}}"><i class="fas fa-link"></i> <span>Inicio</span></a></li>
        <li><a href="{{ url('/sistema/orden') }}"><i class="fas fa-link"></i> <span>Crear Pedido</span></a></li>
        <li><a href="{{ url('/sistema/carta') }}"><i class="fas fa-link"></i> <span>Carta</span></a></li>
        <li class="header">
          Configuraciones Admin
          
        </li>
        <li class="treeview">
          <a href="#"><i class="fas fa-link"></i> <span>Configuraciones</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('/sistema/zona')}}">Zonas</a></li>
            <li><a href="{{url('/sistema/tipodocumento')}}">Tipos de Documento</a></li>
            <li><a href="{{url('/sistema/tipousuario')}}">Tipos de Usuario</a></li>
            <li><a href="{{url('/sistema/restaurant')}}">Restaurant</a></li>
            <li><a href="{{url('/sistema/menu')}}">Menu</a></li>
            <li><a href="{{url('/sistema/permiso')}}">Permiso</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fas fa-hamburger"></i> <span>Patio de Ventas</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('/sistema/mesa')}}">Mesa</a></li>
            <li><a href="{{url('/sistema/producto')}}">Producto</a></li>
            <li><a href="{{url('/sistema/estado_mesas')}}">Estados Mesas</a></li>
            <li><a href="{{url('/sistema/tipo_orden')}}">Tipo Orden</a></li>
          </ul>
        </li>
      </ul>