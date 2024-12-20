<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="height: auto;">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu tree" data-widget="tree">
            @can('showUserManagement', auth()->user())
            <li class="treeview menu-open" style="height: auto;">
                <a href="#">
                    <i class="fa fa-users"></i> <span>{{__('messages.menu_user_management')}}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu" style="display: block;">
                    <li><a href="../index.html"><i class="fa fa-circle-o"></i>{{__('messages.users')}}</a></li>
                    <li><a href="../index2.html"><i class="fa fa-circle-o"></i> {{__('messages.permissions')}}</a></li>
                </ul>
            </li>
            @endcan
            <li class="active">
                <a href="widgets.html">
                    <i class="fa fa-th"></i> <span>Widgets</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-green">new</small>
                    </span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>