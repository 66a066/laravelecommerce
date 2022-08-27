<aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <!-- <img src="{{asset('admin/images/icon/logo.png')}}" alt="Cool Admin"> -->
                    <h4>E-Shop</h4>
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1 ps ps--active-y">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="{{ Request::is('dashboard') ? 'active has-sub' : '' }}">
                        <!-- active has-sub -->
                            <a class="js-arrow" href="{{url('/dashboard')}}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <li class="{{ Request::is('categories') ? 'active has-sub' : '' }}">
                            <a href="{{url('/categories')}}">
                                <i class="fas fa-chart-bar"></i>Categories</a>
                        </li>
                        <li class="{{ Request::is('products') ? 'active has-sub' : '' }}">
                            <a href="{{url('/products')}}">
                                <i class="fas fa-table"></i>Products</a>
                        </li>
                        <li class="{{ Request::is('orders') ? 'active has-sub' : '' }}">
                            <a href="{{url('orders')}}">
                                <i class="far fa-check-square"></i>Orders</a>
                        </li>
                        <li class="{{ Request::is('users') ? 'active has-sub' : '' }}">
                            <a href="{{url('users')}}">
                                <i class="far fa-user"></i>Users</a>
                        </li>
                        <!-- <li>
                            <a href="calendar.html">
                                <i class="fas fa-calendar-alt"></i>Calendar</a>
                        </li> -->
                        <!-- <li>
                            <a href="map.html">
                                <i class="fas fa-map-marker-alt"></i>Maps</a>
                        </li> -->
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Pages</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="login.html">Login</a>
                                </li>
                                <li>
                                    <a href="register.html">Register</a>
                                </li>
                                <li>
                                    <a href="forget-pass.html">Forget Password</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-desktop"></i>UI Elements</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="button.html">Button</a>
                                </li>
                                <li>
                                    <a href="badge.html">Badges</a>
                                </li>
                                <li>
                                    <a href="tab.html">Tabs</a>
                                </li>
                                <li>
                                    <a href="card.html">Cards</a>
                                </li>
                                <li>
                                    <a href="alert.html">Alerts</a>
                                </li>
                                <li>
                                    <a href="progress-bar.html">Progress Bars</a>
                                </li>
                                <li>
                                    <a href="modal.html">Modals</a>
                                </li>
                                <li>
                                    <a href="switch.html">Switchs</a>
                                </li>
                                <li>
                                    <a href="grid.html">Grids</a>
                                </li>
                                <li>
                                    <a href="fontawesome.html">Fontawesome Icon</a>
                                </li>
                                <li>
                                    <a href="typo.html">Typography</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 233px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 112px;"></div></div></div>
        </aside>