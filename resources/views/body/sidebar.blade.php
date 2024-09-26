    <div class="left-side-menu">

        <div class="h-100" data-simplebar>

            <!-- User box -->


            <!--- Sidemenu -->
            <div id="sidebar-menu">

                <ul id="side-menu">

                    <li class="menu-title">Navigation</li>

                    <li>
                        <a href="{{ url('/dashboard') }}">
                            <i class="mdi mdi-view-dashboard-outline"></i>
                            <span> Dashboards </span>
                        </a>
                    </li>


                    <li>
                        {{-- {{ route('pos') }} --}}
                        <a href="">
                            <span class="badge bg-pink float-end">Hot</span>
                            <i class="fas fa-cart-plus"></i>
                            <span> POS </span>
                        </a>
                    </li>




                    <li class="menu-title mt-2">Apps</li>
                    <li>
                        <a href="#sidebarEcommerce" data-bs-toggle="collapse">
                            <i class="fas fa-user-friends"></i>
                            <span> Category Manage </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarEcommerce">
                            <ul class="nav-second-level">
                                <li>
                                    {{-- {{ route('all.employee') }} --}}
                                    <a href="{{ route('all.category') }}">All Category</a>
                                </li>
                                <li>
                                    {{-- {{ route('add.employee') }} --}}
                                    <a href="">Add Category </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#sidebarEcommerce" data-bs-toggle="collapse">
                            <i class="fas fa-user-friends"></i>
                            <span> Menu List Manage </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarEcommerce">
                            <ul class="nav-second-level">
                                <li>
                                    {{-- {{ route('all.employee') }} --}}
                                    <a href="{{ route('all.menu') }}">All Menu</a>
                                </li>
                                <li>
                                    {{-- {{ route('add.employee') }} --}}
                                    <a href="">Add Category </a>
                                </li>
                            </ul>
                        </div>
                    </li>






                    <li class="menu-title mt-2">Custom</li>





                </ul>
            </div>
            </li>
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

    </div>
