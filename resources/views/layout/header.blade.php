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
                        <a href="{{ url('admin/employee/list') }}"
                            class="nav-link @if (Request::segment(2) == 'employee') active @endif">
                            <i class="nav-icon fa-solid fa-user-tag"></i>
                            <p>
                                បញ្ជីឈ្មោះ Employee
                            </p>
                        </a>
                    </li>
                    <li class="nav-item {{ in_array(Request::segment(2), ['CEO','HR_manager','CFO','teamLeader']) ? 'menu-is-opening menu-open' : '' }}">
                        <a href="#" class="nav-link {{ in_array(Request::segment(2), ['CEO','HR_manager','CFO','teamLeader']) ? 'active' : '' }}">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                                Approver
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="{{ in_array(Request::segment(2), ['CEO','HR_manager','CFO','teamLeader']) ? 'display:block;' : 'display:none;' }}">
                            <li class="nav-item">
                                <a href="{{ url('admin/CEO/list') }}" class="nav-link {{ Request::segment(2) == 'CEO' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>បញ្ជីឈ្មោះ CEO</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/HR_manager/list') }}" class="nav-link {{ Request::segment(2) == 'HR_manager' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>បញ្ជីឈ្មោះ HR Manager</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/CFO/list') }}" class="nav-link {{ Request::segment(2) == 'CFO' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>បញ្ជីឈ្មោះ CFO</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/teamLeader/list') }}" class="nav-link {{ Request::segment(2) == 'teamLeader' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>បញ្ជីឈ្មោះ TeamLeader</p>
                                </a>
                            </li>
                        </ul>
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
                    <li class="nav-item">
                        <a href="{{ url('admin/request/requestlist') }}"
                            class="nav-link @if (Request::segment(2) == 'request') active @endif">
                            <i class="nav-icon fa-solid fa-rectangle-list"></i>
                            <p>
                                ការស្នើសុំ
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/myAccount') }}"
                            class="nav-link  @if (Request::segment(2) == 'myAccount') active @endif">
                            <i class="nav-icon fa-solid fa-user"></i>
                            <p>
                                ព័ត៌មានផ្ទាល់ខ្លួន
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/change_password') }}"
                            class="nav-link  @if (Request::segment(2) == 'change_password') active @endif">
                            <i class="nav-icon fa-solid fa-cash-register"></i>
                            <p>
                                ផ្លាស់ប្ដូរលេខសម្ងាត់
                            </p>
                        </a>
                    </li>
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
                    <li class="nav-item">
                        <a href="{{ url('deptAdmin/dashboard') }}"
                            class="nav-link  @if (Request::segment(2) == 'dashboard') active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                ផ្ទាំងគ្រប់គ្រង
                            </p>
                        </a>
                    </li>

                    <li class="nav-item {{ in_array(Request::segment(2), ['CEO','HR_manager','CFO','teamLeader','employee']) ? 'menu-is-opening menu-open' : '' }}">
                        <a href="#" class="nav-link {{ in_array(Request::segment(2), ['CEO','HR_manager','CFO','teamLeader','employee']) ? 'active' : '' }}">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                                Department Role
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="{{ in_array(Request::segment(2), ['CEO','HR_manager','CFO','teamLeader','employee']) ? 'display:block;' : 'display:none;' }}">
                            <li class="nav-item">
                                <a href="{{ url('deptAdmin/CEO/list') }}" class="nav-link {{ Request::segment(2) == 'CEO' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>បញ្ជីឈ្មោះ CEO</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('deptAdmin/HR_manager/list') }}" class="nav-link {{ Request::segment(2) == 'HR_manager' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>បញ្ជីឈ្មោះ HR Manager</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('deptAdmin/CFO/list') }}" class="nav-link {{ Request::segment(2) == 'CFO' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>បញ្ជីឈ្មោះ CFO</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('deptAdmin/teamLeader/list') }}" class="nav-link {{ Request::segment(2) == 'teamLeader' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>បញ្ជីឈ្មោះ TeamLeader</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('deptAdmin/employee/list') }}" class="nav-link {{ Request::segment(2) == 'employee' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>បញ្ជីឈ្មោះ Employee</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('deptAdmin/department') }}"
                            class="nav-link  @if (Request::segment(2) == 'department') active @endif">
                            <i class="nav-icon fa-solid fa-building"></i>
                            <p>
                                ដេប៉ាតឺម៉ង់
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('deptAdmin/type_Request/list') }}"
                            class="nav-link  @if (Request::segment(2) == 'type_Request') active @endif">
                            <i class="nav-icon fa-solid fa-code-pull-request"></i>
                            <p>
                                ប្រភេទនៃការសើ្នសុំ
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('deptAdmin/assign_department_request/list') }}"
                            class="nav-link  @if (Request::segment(2) == 'assign_department_request') active @endif">
                            <i class="fa-solid fa-person-circle-check"></i>
                            <p>
                                បញ្ជីដេប៉ាតីម៉ង់នៃការស្មើសុំ
                            </p>
                        </a>
                    </li> 
                    <li class="nav-item">
                        <a href="{{ url('deptAdmin/assign_department_approver/list') }}"
                            class="nav-link  @if (Request::segment(2) == 'assign_department_approver') active @endif">
                            <i class="fa-solid fa-person-circle-check"></i>
                            <p>
                                មុខដំណែងក្នុងនាយកដ្ឋាន
                            </p>
                        </a>
                    </li> 
                    <li class="nav-item">
                        <a href="{{ url('deptAdmin/myAccount') }}"
                            class="nav-link  @if (Request::segment(2) == 'myAccount') active @endif">
                            <i class="nav-icon fa-solid fa-user"></i>
                            <p>
                                ព័ត៌មានផ្ទាល់ខ្លួន
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('deptAdmin/change_password') }}"
                            class="nav-link  @if (Request::segment(2) == 'change_password') active @endif">
                            <i class="nav-icon fa-solid fa-cash-register"></i>
                            <p>
                                ផ្លាស់ប្ដូរលេខសម្ងាត់
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
                        <a href="{{ url('CEO/myRequest') }}"
                            class="nav-link  @if (Request::segment(2) == 'myRequest') active @endif">
                            <i class="nav-icon fa-solid fa-user"></i>
                            <p>
                                បញ្ជីឈ្មោះអ្នកស្នើសុំ
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('CEO/myAccount') }}"
                            class="nav-link  @if (Request::segment(2) == 'myAccount') active @endif">
                            <i class="nav-icon fa-solid fa-user"></i>
                            <p>
                                ព័ត៌មានផ្ទាល់ខ្លួន
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('CEO/change_password') }}"
                            class="nav-link  @if (Request::segment(2) == 'change_password') active @endif">
                            <i class="nav-icon fa-solid fa-cash-register"></i>
                            <p>
                                ផ្លាស់ប្ដូរលេខសម្ងាត់
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
                        <a href="{{ url('HR_manager/myRequest') }}"
                            class="nav-link  @if (Request::segment(2) == 'myRequest') active @endif">
                            <i class="nav-icon fa-solid fa-user"></i>
                            <p>
                                បញ្ជីឈ្មោះអ្នកស្នើសុំ
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('HR_manager/myAccount') }}"
                            class="nav-link  @if (Request::segment(2) == 'myAccount') active @endif">
                            <i class="nav-icon fa-solid fa-user"></i>
                            <p>
                                ព័ត៌មានផ្ទាល់ខ្លួន
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('HR_manager/change_password') }}"
                            class="nav-link  @if (Request::segment(2) == 'change_password') active @endif">
                            <i class="nav-icon fa-solid fa-cash-register"></i>
                            <p>
                                ផ្លាស់ប្ដូរលេខសម្ងាត់
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
                        <a href="{{ url('CFO/myRequest') }}"
                            class="nav-link  @if (Request::segment(2) == 'myRequest') active @endif">
                            <i class="nav-icon fa-solid fa-user"></i>
                            <p>
                                បញ្ជីឈ្មោះអ្នកស្នើសុំ
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('CFO/myAccount') }}"
                            class="nav-link  @if (Request::segment(2) == 'myAccount') active @endif">
                            <i class="nav-icon fa-solid fa-user"></i>
                            <p>
                                ព័ត៌មានផ្ទាល់ខ្លួន
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('CFO/change_password') }}"
                            class="nav-link  @if (Request::segment(2) == 'change_password') active @endif">
                            <i class="nav-icon fa-solid fa-cash-register"></i>
                            <p>
                                ផ្លាស់ប្ដូរលេខសម្ងាត់
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
                    <li class="nav-item">
                        <a href="{{ url('teamleader/dashboard') }}"
                            class="nav-link  @if (Request::segment(2) == 'dashboard') active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                ផ្ទាំងគ្រប់គ្រង
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('teamleader/mydepartment_type_request') }}"
                            class="nav-link  @if (Request::segment(2) == 'mydepartment_type_request') active @endif">
                            <i class="nav-icon fa-solid fa-user"></i>
                            <p>
                                ដេប៉ាតឺម៉ង់ និង​​ សំណើរ
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('teamleader/myRequest') }}"
                            class="nav-link  @if (Request::segment(2) == 'myRequest') active @endif">
                            <i class="nav-icon fa-solid fa-user"></i>
                            <p>
                                បញ្ជីឈ្មោះអ្នកស្នើសុំ
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('teamleader/myAccount') }}"
                            class="nav-link  @if (Request::segment(2) == 'myAccount') active @endif">
                            <i class="nav-icon fa-solid fa-user"></i>
                            <p>
                                ព័ត៌មានផ្ទាល់ខ្លួន
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('teamleader/change_password') }}"
                            class="nav-link  @if (Request::segment(2) == 'change_password') active @endif">
                            <i class="nav-icon fa-solid fa-cash-register"></i>
                            <p>
                                ផ្លាស់ប្ដូរលេខសម្ងាត់
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
                    <li class="nav-item">
                        <a href="{{ url('employee/dashboard') }}"
                            class="nav-link  @if (Request::segment(2) == 'dashboard') active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                ផ្ទាំងគ្រប់គ្រង
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('employee/formRequest') }}"
                        {{-- <a href="{{ url('employee/formRequest') }}" --}}
                            class="nav-link  @if (Request::segment(2) == 'request') active @endif">
                            <i class="nav-icon fa-solid fa-hand"></i>
                            <p>
                                បញ្ជីនៃការស្នើសុំ
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('employee/myAccount') }}"
                            class="nav-link  @if (Request::segment(2) == 'myAccount') active @endif">
                            <i class="nav-icon fa-solid fa-user"></i>
                            <p>
                                ព័ត៌មានផ្ទាល់ខ្លួន
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('employee/change_password') }}"
                            class="nav-link  @if (Request::segment(2) == 'change_password') active @endif">
                            <i class="nav-icon fa-solid fa-cash-register"></i>
                            <p>
                                ផ្លាស់ប្ដូរលេខសម្ងាត់
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

