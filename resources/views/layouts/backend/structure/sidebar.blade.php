<aside class="main-sidebar sidebar-custom">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{getAvatarDefault()}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Admin</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li id="dashboard">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="header">EMPLOYEES</li>
            <li id="employees" class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i> <span>Employees</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-list-ul"></i> List of Employees</a></li>
                    <li><a href="#"><i class="fa fa-plus"></i> Add new employees</a></li>
                </ul>
            </li>
            <li id="jobs">
                <a href="#">
                    <i class="fa fa-suitcase"></i> <span>Jobs</span>
                </a>
            </li>
            <li class="header">ADMIN</li>
            <li id="admin" class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i> <span>Admin</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.index')}}"><i class="fa fa-list-ul"></i> List of Admin</a></li>
                    <li><a href="{{route('admin.create')}}"><i class="fa fa-plus"></i> Add new admin</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<script type="text/javascript">
    
</script>