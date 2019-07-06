<li class="treeview">
    <a href="{{url('/')}}"><i class="fas fa-link"></i> <span>Configuraciones</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="">Rol</a></li>
        <li><a href="">Menu</a></li>
        <li><a href="">Menu Crear</a></li>
        <li><a href="">{{session()->get('rol_nombre')}}</a></li>
        
    </ul>
</li>