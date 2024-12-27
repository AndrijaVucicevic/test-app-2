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
                    <li><a href="{{route('users.index')}}"><i class="fa fa-circle-o"></i>{{__('messages.users')}}</a></li>
                    <li><a href="{{route('permissions.index')}}"><i class="fa fa-circle-o"></i> {{__('messages.permissions')}}</a></li>
                </ul>
            </li>
            @endcan
            @if(count($configFiles)>0)
            <li class="treeview menu-open" style="height: auto;">
                <a href="#">
                    <i class="fa fa-users"></i> <span>{{__('messages.menu_imported_data')}}</span>
                    <span class="pull-right-container">
                        <i class=" fa-line-chart"></i>
                    </span>
                </a>
                <ul class="treeview-menu" style="display: block;">
                    @foreach($configFiles as $config)
                    <li><a href="{{route('orders.index',['mainKey'=>$config['mainKey'])}}"><i class="fa fa-circle-o"></i>{{ $config['label'] }}</a></li>
                    @endforeach
                </ul>
            </li>
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