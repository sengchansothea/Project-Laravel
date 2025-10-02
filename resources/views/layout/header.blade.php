<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link" style="text-align: center;">
        <span class="brand-text font-weight-light" style="font-weight: bold !important;font-size: 20px;">Web
            Development</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }} {{ Auth::user()->last_name }}</a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @if (Auth::user()->user_type == 1)
                    <li class="nav-header">Administration</li>
                    <li class="nav-item">
                        <a href="{{ url('admin/dashboard') }}"
                            class="nav-link @if (Request::segment(2) == 'dashboard') active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                ផ្ទាំងគ្រប់គ្រង
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/admin/list') }}"
                            class="nav-link @if (Request::segment(2) == 'admin') active @endif">
                            <i class="nav-icon fas fa-user-gear"></i>
                            <p>
                                បញ្ជីឈ្មោះ Admin
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/department_admin/list') }}"
                            class="nav-link @if (Request::segment(2) == 'department_admin') active @endif">
                            <i class="nav-icon fas fa-user-gear"></i>
                            <p>
                                បញ្ជីឈ្មោះ Dept Admin
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/CEO/list') }}"
                            class="nav-link @if (Request::segment(2) == 'CEO') active @endif">
                            <i class="nav-icon fa-solid fa-clipboard-user"></i>
                            <p>
                                បញ្ជីឈ្មោះ CEO
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/HR_manager/list') }}"
                            class="nav-link @if (Request::segment(2) == 'HR_manager') active @endif">
                            <i class="nav-icon fa-solid fa-user-shield"></i>
                            <p>
                                បញ្ជីឈ្មោះ HR Manager
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/CFO/list') }}"
                            class="nav-link @if (Request::segment(2) == 'CFO') active @endif">
                            <i class="nav-icon fa-solid fa-user-shield"></i>
                            <p>
                                បញ្ជីឈ្មោះ CFO
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/teamleader/list') }}"
                            class="nav-link @if (Request::segment(2) == 'teamleader') active @endif">
                            <i class="nav-icon fa-solid fa-user-tag"></i>
                            <p>
                                បញ្ជីឈ្មោះ TeamLeader
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/employee/list') }}"
                            class="nav-link @if (Request::segment(2) == 'employee') active @endif">
                            <i class="nav-icon fa-solid fa-user-tag"></i>
                            <p>
                                បញ្ជីឈ្មោះ Employee
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">System Administration</li>
                    <li class="nav-item">
                        <a href="{{ url('admin/user_management/list') }}"
                            class="nav-link @if (Request::segment(2) == 'user_management') active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                អ្នកប្រើប្រាស់ប្រព័ន្ធ
                            </p>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="{{ url('admin/department_management/list') }}"
                            class="nav-link @if (Request::segment(2) == 'department_management') active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                អ្នកគ្រប់គ្រងផ្នែក
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/permission_management/list') }}"
                            class="nav-link @if (Request::segment(2) == 'permission_management') active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                អ្នកអនុញ្ញាតប្រព័ន្ធ
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/general_settings/list') }}"
                            class="nav-link @if (Request::segment(2) == 'general_settings') active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                ការកំណត់ទូទៅ
                            </p>
                        </a>
                    </li> --}}

                    <li class="nav-header">ការកំណត់</li>
                    <li class="nav-item">
                        <a href="{{ url('/logout') }}" class="nav-link @if (Request::segment(1) == 'logout') active @endif">
                            <i class="nav-icon fas fa-lock"></i>
                            <p>
                                ចាកចេញ
                            </p>
                        </a>
                    </li>
                @elseif (Auth::user()->user_type == 2)
                    <li class="nav-item menu-open">
                        <a href="{{ url('deptAdmin/dashboard') }}"
                            class="nav-link  @if (Request::segment(2) == 'dashboard') active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                ផ្ទាំងគ្រប់គ្រង
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/logout') }}"
                            class="nav-link @if (Request::segment(1) == 'logout') active @endif">
                            <i class="nav-icon fas fa-lock"></i>
                            <p>
                                ចាកចេញ
                            </p>
                        </a>
                    </li>
                @elseif (Auth::user()->user_type == 3)
                    <li class="nav-item menu-open">
                        <a href="{{ url('CEO/dashboard') }}"
                            class="nav-link  @if (Request::segment(2) == 'dashboard') active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                ផ្ទាំងគ្រប់គ្រង
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/logout') }}"
                            class="nav-link @if (Request::segment(1) == 'logout') active @endif">
                            <i class="nav-icon fas fa-lock"></i>
                            <p>
                                ចាកចេញ
                            </p>
                        </a>
                    </li>
                @elseif (Auth::user()->user_type == 4)
                    <li class="nav-item menu-open">
                        <a href="{{ url('HR_manager/dashboard') }}"
                            class="nav-link  @if (Request::segment(2) == 'dashboard') active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                ផ្ទាំងគ្រប់គ្រង
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/logout') }}"
                            class="nav-link @if (Request::segment(1) == 'logout') active @endif">
                            <i class="nav-icon fas fa-lock"></i>
                            <p>
                                ចាកចេញ
                            </p>
                        </a>
                    </li>
                @elseif (Auth::user()->user_type == 5)
                    <li class="nav-item menu-open">
                        <a href="{{ url('CFO/dashboard') }}"
                            class="nav-link  @if (Request::segment(2) == 'dashboard') active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                ផ្ទាំងគ្រប់គ្រង
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/logout') }}"
                            class="nav-link @if (Request::segment(1) == 'logout') active @endif">
                            <i class="nav-icon fas fa-lock"></i>
                            <p>
                                ចាកចេញ
                            </p>
                        </a>
                    </li>
                @elseif (Auth::user()->user_type == 6)
                    <li class="nav-item menu-open">
                        <a href="{{ url('teamleader/dashboard') }}"
                            class="nav-link  @if (Request::segment(2) == 'dashboard') active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                ផ្ទាំងគ្រប់គ្រង
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/logout') }}"
                            class="nav-link @if (Request::segment(1) == 'logout') active @endif">
                            <i class="nav-icon fas fa-lock"></i>
                            <p>
                                ចាកចេញ
                            </p>
                        </a>
                    </li>             
                @elseif (Auth::user()->user_type == 7)
                    <li class="nav-item menu-open">
                        <a href="{{ url('employee/dashboard') }}"
                            class="nav-link  @if (Request::segment(2) == 'dashboard') active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                ផ្ទាំងគ្រប់គ្រង
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/logout') }}"
                            class="nav-link @if (Request::segment(1) == 'logout') active @endif">
                            <i class="nav-icon fas fa-lock"></i>
                            <p>
                                ចាកចេញ
                            </p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

