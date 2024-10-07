    <div class="left-side-menu">

        <div class="h-100" data-simplebar>
            <div id="sidebar-menu">

                <ul id="side-menu">

                    <li>
                        <a href="{{ url('/dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span> Dashboard</span>
                        </a>
                    </li>
                    <!-- <li>
                        {{-- {{ route('pos') }} --}}
                        <a href="">
                            <span class="badge bg-pink float-end">Hot</span>
                            <i class="fas fa-cart-plus"></i>
                            <span> POS </span>
                        </a>
                    </li> -->
                    @can('user management')
                        <li>
                            <a href="#sidebarEcommerce" data-bs-toggle="collapse">
                                <i class="fas fa-users"></i>
                                <span>Staff Management</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarEcommerce">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{ route('all.user') }}">Employees</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endcan

                    @can('menu management')
                        <li>
                            <a href="#sidebarEcommerce" data-bs-toggle="collapse">
                                <i class="fas fa-utensils"></i>
                                <span>Menu Management</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarEcommerce">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{ route('all.category') }}">Categories</a>
                                    </li>
                                </ul>
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{ route('all.menu') }}">Menus</a>
                                    </li>
                                </ul>

                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{ route('all.modifier') }}">Modifiers</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="#sidebarEcommerce" data-bs-toggle="collapse">
                                <i class="fas fa-utensils"></i>
                                <span>Oder Management</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarEcommerce">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{ route('add.oder') }}">add Oder</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('pending.oder') }}">Pending Oder</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('complete.order') }}">Complete Oder</a>
                                    </li>
                                </ul>

                            </div>
                        </li>
                        <li>
                            <a href="#sidebarEcommerce" data-bs-toggle="collapse">
                                <i class="fas fa-utensils"></i>
                                <span>Table Management</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarEcommerce">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{ route('all.table') }}">add Table</a>
                                    </li>
                                </ul>

                            </div>
                        </li>
                    @endcan
                </ul>
            </div>
            </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>

    </div>
