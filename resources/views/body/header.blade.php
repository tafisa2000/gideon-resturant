 <div class="navbar-custom bg-warning">
     <div class="container-fluid bg-success">
         <ul class="list-unstyled topnav-menu float-end mb-0">

             <li class="d-none d-lg-block">
                <!-- <h3>Restorant</h3> -->
                 <!-- <form class="app-search">
                     <div class="app-search-box dropdown">
                         <div class="input-group">
                             <input type="search" class="form-control" placeholder="Search..." id="top-search">
                             <button class="btn input-group-text" type="submit">
                                 <i class="fe-search"></i>
                             </button>
                         </div>

                     </div>
                 </form> -->
             </li>

             <li class="dropdown d-inline-block d-lg-none">
                 <!-- <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-bs-toggle="dropdown"
                     href="#" role="button" aria-haspopup="false" aria-expanded="false">
                     <i class="fe-search noti-icon"></i>
                 </a>
                 <div class="dropdown-menu dropdown-lg dropdown-menu-end p-0">
                     <form class="p-3">
                         <input type="text" class="form-control" placeholder="Search ..."
                             aria-label="Recipient's username">
                     </form>
                 </div> -->
             </li>

             <li class="dropdown d-none d-lg-inline-block">
                 <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen"
                     href="#">
                     <i class="fe-maximize noti-icon"></i>
                 </a>
             </li>

             <li class="dropdown notification-list topbar-dropdown">
                 <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#"
                     role="button" aria-haspopup="false" aria-expanded="false">
                     <i class="fe-bell noti-icon"></i>
                     <span class="badge bg-danger rounded-circle noti-icon-badge">9</span>
                 </a>


                 <div class="dropdown-menu dropdown-menu-end dropdown-lg">

                     <div class="dropdown-item noti-title">
                         <h5 class="m-0">
                            <b><span class="float-end">
                                 <a href="" class="text-dark">
                                     <small>Clear All</small>
                                 </a>
                             </span>Notification
                            </b>
                             
                         </h5>
                     </div>

                     <div class="noti-scroll" data-simplebar>
                         <a href="javascript:void(0);" class="dropdown-item notify-item">
                             <div class="notify-icon bg-info">
                                 <i class="mdi mdi-comment-account-outline"></i>
                             </div>
                             <p class="notify-details">Notification 1
                                 <small class="text-muted">4 days ago</small>
                             </p>
                         </a>
                     </div>

                     <a href="javascript:void(0);"
                         class="dropdown-item text-center text-primary notify-item notify-all">
                         View all
                         <i class="fe-arrow-right"></i>
                     </a>
                 </div>
             </li>
   
             <li class="dropdown notification-list topbar-dropdown">
                 <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown"
                     href="#" role="button" aria-haspopup="false" aria-expanded="false">

                     <img src="#"
                         alt="user-image" class="rounded-circle">
                     <span class="pro-user-name ms-1">
                        <i class="mdi mdi-chevron-down"></i>
                     </span>
                 </a>
                 <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                     <a href="#" class="dropdown-item notify-item">
                         <i class="fe-user"></i>
                         <span>My Account</span>
                     </a>
                     <a href="javascript:void(0);" class="dropdown-item notify-item">
                         <i class="fe-settings"></i>
                         <span>Settings</span>
                     </a>
                     <a href="#" class="dropdown-item notify-item">
                         <i class="fe-lock"></i>
                         <span>Change Password </span>
                     </a>
                     <div class="dropdown-divider"></div>
                     <a href="#" class="dropdown-item notify-item">
                         <i class="fe-log-out"></i>
                         <span>Logout</span>
                     </a>
                 </div>
             </li>
         </ul>

        
         <div class="logo-box">
             <a href="index.html" class="logo logo-dark text-center">
                 <span class="logo-sm">
                     <img src="#" alt="" height="22">
                     <!-- <span class="logo-lg-text-light">UBold</span> -->
                 </span>
                 <span class="logo-lg">
                     <img src="{{ asset('backend/assets/images/logo-dark.png') }}" alt="" height="20">
                     <!-- <span class="logo-lg-text-light">U</span> -->
                 </span>
             </a>

             <a href="index.html" class="logo logo-light text-center">
                 <span class="logo-sm">
                     <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="" height="22">
                 </span>
                 <span class="logo-lg">
                     <img src="{{ asset('backend/assets/images/logo-light.png') }}" alt="" height="20">
                 </span>
             </a>
         </div>

         <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
             <li>
                 <button class="button-menu-mobile waves-effect waves-light">
                     <i class="fe-menu"></i>
                 </button>
             </li>
             <li>
                 <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                     <div class="lines">
                         <span></span>
                         <span></span>
                         <span></span>
                     </div>
                 </a>
            </li>
         </ul>
         
         <div class="clearfix"></div>
     </div>
 </div>
