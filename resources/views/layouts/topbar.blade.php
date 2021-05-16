<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header">
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                    class="ti-menu ti-close"></i></a>
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <a class="navbar-brand" href="{{ route('view.dashboard') }}">
                <img src="{{ asset('img/Artboard1.png') }}" alt="homepage" class="light-logo img-fluid" width="100%" />

            </a>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Toggle which is visible on mobile only -->
            <!-- ============================================================== -->
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-left mr-auto">
                <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light"
                        href="javascript:void(0)" data-sidebartype="mini-sidebar"><i
                            class="mdi mdi-menu font-24"></i></a></li>

                <li class="nav-item"><a href="{{ route('view.coupons') }}" class="nav-link"><i
                            class="icon-grid"></i><span class="hide-menu"> Coupons </span></a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle " href="#"
                        id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <span class="d-none d-md-block"><i class="icon-people"></i> Upload <i
                                class="fa fa-angle-down"></i></span>
                        <span class="d-block d-md-none"><i class="fa fa-plus"></i></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        {{-- <a class="dropdown-item" title="" href="{{ route('view.start.screen') }}">Upload image start screen</a>
                        <a class="dropdown-item" title="" href="{{ route('view.upload.category') }}">Upload image main menu</a> --}}
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle " href="#"
                        id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <span class="d-none d-md-block"><i class="icon-people"></i> Calendar <i class="fa fa-angle-down"></i></span>
                        <span class="d-block d-md-none"><i class="fa fa-plus"></i></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        {{-- <a class="dropdown-item" title="" href="{{ route('view.calender.daily') }}">Daily</a>
                        <a class="dropdown-item" title="" href="{{ route('view.calender.holiday') }}">Holiday</a> --}}
                    </div>
                </li>
        </ul>
        <!-- ============================================================== -->
        <!-- Right side toggle and nav items -->
        <!-- ============================================================== -->
        <ul class="navbar-nav float-right">
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href=""
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img
                        src="{{ asset('xtreme/assets/images/users/1.jpg') }}" alt="user" class="rounded-circle"
                        width="31"></a>
                <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                    <span class="with-arrow"><span class="bg-primary"></span></span>
                    <div class="d-flex no-block align-items-center p-15 bg-primary text-white m-b-10">
                        <div class=""><img src="{{ asset('xtreme/assets/images/users/1.jpg') }}" alt="user"
                                class="img-circle" width="60"></div>
                        <div class="m-l-10">
                            <h4 class="m-b-0">{{ (Auth::check()) ? Auth::user()->name : '' }}</h4>
                            <p class=" m-b-0">{{ (Auth::check()) ? Auth::user()->email : '' }}</p>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:void(0)"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                            class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                    <form id="logout-form" action="" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
        </ul>
        </div>
    </nav>
</header>
