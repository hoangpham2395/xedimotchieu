<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
        <span class="logo-mini"><b>{{getConstant('APP_NAME_SHORT')}}</b></span>
        <span class="logo-lg">{{getConstant('BACKEND_NAME')}}</span>
    </a>
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{getAvatarDefault()}}" class="user-image" alt="User Image">
                        <span class="hidden-xs">Admin</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{getAvatarDefault()}}" class="img-circle" alt="User Image">
                            <p>
                                {{getCurrentAdmin()->username}} - Admin of <strong>{{getConstant('APP_NAME')}}</strong>
                                <small>{{getCurrentAdmin()->getRoleType()}}</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{route('admin.edit', ['id' => getCurrentAdmin()->id])}}" class="btn btn-default btn-flat">{{transa('edit')}}</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{route('admin.logout')}}" class="btn btn-default btn-flat">{{transa('logout')}}</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>