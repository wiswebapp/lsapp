<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{adminAssets('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            <a href="{{route('admin')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-user"></i>
              <p>Admin<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.adminuser')}}" class="nav-link">
                  <i class="fas fa-sm fa-arrow-right"></i>&nbsp;Admin Users
                </a>
              </li>              
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{route('admin')}}" class="nav-link">
              <i class="nav-icon fas fa-user-alt"></i>
              <p>Register Users</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('admin')}}" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Post Data</p>
            </a>
          </li>

        </ul>
      </nav>
    </div>
  </aside>