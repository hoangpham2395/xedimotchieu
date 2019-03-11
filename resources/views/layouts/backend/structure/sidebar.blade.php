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
            <li class="header text-uppercase">{{transb('dashboard.name')}}</li>
            <li id="item-1">
                <a href="{{route('backend.dashboard')}}">
                    <i class="fa fa-dashboard"></i> <span>{{transb('dashboard.name')}}</span>
                </a>
            </li>
            <li class="header text-uppercase">{{transb('management')}}</li>
            <li id="item-2" class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i> <span>{{transb('admin.name')}}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.index')}}"><i class="fa fa-list-ul"></i> {{transb('admin.index')}}</a></li>
                    <li><a href="{{route('admin.create')}}"><i class="fa fa-plus"></i> {{transb('admin.create')}}</a></li>
                </ul>
            </li>
            <li id="item-3">
                <a href="{{route('users.index')}}">
                    <i class="fa fa-users"></i> <span>{{transb('users.name')}}</span>
                </a>
            </li>
            <li id="item-4">
                <a href="{{route('feedbacks.index')}}">
                    <i class="fa fa-commenting"></i> <span>{{transb('feedbacks.name')}}</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<script type="text/javascript">
    
</script>