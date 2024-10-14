<header class="app-header">

    <!-- Start::main-header-container -->
    <div class="main-header-container container-fluid">

        <!-- Start::header-content-left -->
        <div class="header-content-left">

            <!-- Start::header-element -->
            <div class="header-element">
                <div class="horizontal-logo">
                    <a href="{{url('index')}}" class="header-logo">
                        <img src="{{asset('build/assets/images/brand-logos/desktop-logo.png')}}" alt="logo" class="desktop-logo">
                        <img src="{{asset('build/assets/images/brand-logos/toggle-logo.png')}}" alt="logo" class="toggle-logo">
                        <img src="{{asset('build/assets/images/brand-logos/desktop-dark.png')}}" alt="logo" class="desktop-dark">
                        <img src="{{asset('build/assets/images/brand-logos/toggle-dark.png')}}" alt="logo" class="toggle-dark">
                        <img src="{{asset('build/assets/images/brand-logos/desktop-white.png')}}" alt="logo" class="desktop-white">
                        <img src="{{asset('build/assets/images/brand-logos/toggle-white.png')}}" alt="logo" class="toggle-white">
                    </a>
                </div>
            </div>
            <!-- End::header-element -->

            <!-- Start::header-element -->
            <div class="header-element">
                <!-- Start::header-link -->
                <a aria-label="Hide Sidebar" class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle" data-bs-toggle="sidebar" href="javascript:void(0);"><span></span></a>
                <!-- End::header-link -->
            </div>
            <!-- End::header-element -->

        </div>
        <!-- End::header-content-left -->

        <!-- Start::header-content-right -->
        <div class="header-content-right">

            <!-- Start::header-element -->
            <!--div class="header-element header-search"-->
            <!-- Start::header-link -->
            <!--a href="javascript:void(0);" class="header-link" data-bs-toggle="modal" data-bs-target="#searchModal">
                                <i class="bx bx-search-alt-2 header-link-icon"></i>
                            </a-->
            <!-- End::header-link -->
            <!--/div-->
            <!-- End::header-element -->

            <!-- Start::header-element -->
            <!--div class="header-element header-fullscreen"-->
            <!-- Start::header-link -->
            <!--a onclick="openFullscreen();" href="javascript:void(0);" class="header-link">
                                <i class="bx bx-fullscreen full-screen-open header-link-icon"></i>
                                <i class="bx bx-exit-fullscreen full-screen-close header-link-icon d-none"></i>
                            </a-->
            <!-- End::header-link -->
            <!--/div-->
            <!-- End::header-element -->

            <!-- Start::header-element -->
            <div class="header-element">
                <!-- Start::header-link|dropdown-toggle -->
                <a href="javascript:void(0);" class="header-link dropdown-toggle" id="mainHeaderProfile" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <!--div class="me-sm-2 me-0">
                                        <img src="{{asset('build/assets/images/faces/9.jpg')}}" alt="img" width="32" height="32" class="rounded-circle">
                                    </div-->
                        <div class="d-sm-block d-none">
                            <p class="fw-semibold mb-0 lh-1">@auth{{Auth::user()->name}}@endauth</p>
                            <span class="op-7 fw-normal d-block fs-11">@auth{{Auth::user()->empresa}}@endauth</span>
                        </div>
                    </div>
                </a>
                <!-- End::header-link|dropdown-toggle -->
                <ul class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end" aria-labelledby="mainHeaderProfile">
                    <!--li><a class="dropdown-item d-flex" href="javascript:void(0);"><i class="ti ti-user-circle fs-18 me-2 op-7"></i>Profile</a></li>
                                <li><a class="dropdown-item d-flex" href="javascript:void(0);"><i class="ti ti-inbox fs-18 me-2 op-7"></i>Inbox <span class="badge bg-success-transparent ms-auto">25</span></a></li>
                                <li><a class="dropdown-item d-flex border-block-end" href="javascript:void(0);"><i class="ti ti-clipboard-check fs-18 me-2 op-7"></i>Task Manager</a></li>
                                <li><a class="dropdown-item d-flex" href="javascript:void(0);"><i class="ti ti-adjustments-horizontal fs-18 me-2 op-7"></i>Settings</a></li>
                                <li><a class="dropdown-item d-flex border-block-end" href="javascript:void(0);"><i class="ti ti-wallet fs-18 me-2 op-7"></i>Bal: $7,12,950</a></li>
                                <li><a class="dropdown-item d-flex" href="javascript:void(0);"><i class="ti ti-headset fs-18 me-2 op-7"></i>Support</a></li-->
                    @if(auth()->user() && auth()->user()->isAdmin())
                    <li><a class="dropdown-item d-flex" href="{{url('sitios')}}"><i class="ti ti-inbox fs-18 me-2 op-7"></i>Sitios</a></li>
                    <li><a class="dropdown-item d-flex" href="{{url('torres')}}"><i class="ti ti-adjustments-horizontal fs-18 me-2 op-7"></i>Torres</a></li>
                    <li><a class="dropdown-item d-flex" href="{{url('addUsuario')}}"><i class="ti ti-user-circle fs-18 me-2 op-7"></i>Agregar Usuario</a></li>
                    @endif
                    <li><a class="dropdown-item d-flex" href="{{url('signin-basic')}}"><i class="ti ti-logout fs-18 me-2 op-7"></i>Log Out</a></li>
                </ul>
            </div>
            <!-- End::header-element -->

            <!-- Start::header-element -->
            @if (Gate::allows('admin'))
            <div class="header-element">
                <!-- Start::header-link|switcher-icon -->
                <a href="javascript:void(0);" class="header-link switcher-icon" data-bs-toggle="offcanvas" data-bs-target="#switcher-canvas">
                    <i class="bx bx-cog header-link-icon"></i>
                </a>
                <!-- End::header-link|switcher-icon -->
            </div>
            @endif
            <!-- End::header-element -->

        </div>
        <!-- End::header-content-right -->

    </div>
    <!-- End::main-header-container -->

</header>