<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
      <i class="nav-icon fas fa-edit"></i>
      <p>
        Authorization settings
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{route('users.index')}}" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>All Users</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('roles.index')}}" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Roles</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('permissions.index')}}" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Permissions</p>
        </a>
      </li>
    </ul>
  </li>
