<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link">
        {!! Html::image('backend/img/AdminLTELogo.png', 'AdminLTE Logo', array('class' => 'brand-image img-circle elevation-3')) !!}
        <span class="brand-text font-weight-light">Saral Nilami</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                {!! Html::image('backend/img/user2-160x160.jpg', 'User Image', array('class' => 'img-circle elevation-3')) !!}
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                        
                      
                            <i class="nav-icon fa fa-dashboard"></i> Dashboard
                        
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/pages" class="nav-link {{ ( Request::is('pages') || Request::is('page*') ) ? 'active' : '' }}">
                        <i class="nav-icon fa fa-file"></i>
                       
                            Pages
                        
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/items" class="nav-link {{ ( Request::is('items') || Request::is('item*') ) ? 'active' : '' }}">
                        <i class="nav-icon fa fa-cloud"></i>
                       
                            Items
                        
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/products" class="nav-link {{ ( Request::is('products')  || Request::is('product*') ) ? 'active' : '' }}">
                        <i class="nav-icon fa fa-bandcamp"></i>
                       
                            Products
                                            </a>
                </li>

                <li class="nav-item">
                    <a href="/galleries" class="nav-link {{ ( Request::is('galleries') || Request::is('gallery*') ) ? 'active' : '' }}">
                        <i class="nav-icon fa fa-file-image-o"></i>
                       
                            Galleries
                       
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/members" class="nav-link {{ ( Request::is('members') || Request::is('member*') ) ? 'active' : '' }}">
                        <i class="nav-icon fa fa-users"></i>
                        
                            Members
                        
                    </a>
                </li>

                {{--<li class="nav-item">--}}
                    {{--<a href="/top-bids" class="nav-link {{ ( Request::is('top-bids') || Request::is('top-bid*') ) ? 'active' : '' }}">--}}
                        {{--<i class="nav-icon fa fa-gavel"></i>--}}
                            {{--Top Bids--}}
                    {{--</a>--}}
                {{--</li>--}}

                <li class="nav-item has-treeview {{ Request::is('bids*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('bids*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-gavel"></i>
                            Bids
                            <i class="right fa fa-angle-right"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/bids" class="nav-link {{ Request::is('bids') ? 'active' : '' }}">
                                <i class="fa fa-circle-o nav-icon"></i>
                                New Bids
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/bids/confirmed" class="nav-link {{ Request::is('bids/confirmed') ? 'active' : '' }}">
                                <i class="fa fa-circle-o nav-icon"></i>
                                Confirmed Bids
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="/activities" class="nav-link {{ ( Request::is('activities') || Request::is('activity*') ) ? 'active' : '' }}">
                        <i class="nav-icon fa fa-tasks"></i>
                        
                            Activities
                        
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>