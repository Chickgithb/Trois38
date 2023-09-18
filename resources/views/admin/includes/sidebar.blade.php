<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('assets/admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview {{ ( request()->is('admin/generalSettings*') || request()->is('admin/finance_calenders*') || request()->is('admin/branches*') || request()->is('admin/departements*') || request()->is('admin/ShitsTypes*') ) ? 'menu-open':'' }}">
          <a href="#" class="nav-link {{ ( request()->is('admin/generalSettings*') || request()->is('admin/finance_calenders*') || request()->is('admin/branches*') || request()->is('admin/departements*') || request()->is('admin/ShitsTypes*') ) ? 'active':'' }}">

            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              قاءمة الضبط
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin_panel_settings') }}" class="nav-link {{ (request()->is('admin/generalSettings*'))?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>الضبط العام</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('finance_calenders.index') }}" class="nav-link {{ (request()->is('admin/finance_calenders*'))?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>السنوات المالية</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('branches.index') }}" class="nav-link {{ (request()->is('admin/branches*'))?'active':'' }} ">
                <i class="far fa-circle nav-icon"></i>
                <p>الفروع</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('ShitsTypes.index') }}" class="nav-link {{ (request()->is('admin/ShitsTypes*'))?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>انواع الشفتات</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('departements.index') }}" class="nav-link {{ (request()->is('admin/departements*'))?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>الإدارات</p>
              </a>
            </li>


          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
