<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('view.dashboard') }}" aria-expanded="false">
                        <i class="fas fa-align-left"></i><span class="hide-menu"> Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('manage.teacher') }}" aria-expanded="false">
                        <i class="m-r-10 mdi mdi-account-circle"></i><span class="hide-menu">Quản lý giáo viên</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('index.student') }}" aria-expanded="false">
                        <i class="m-r-10 mdi mdi-account-circle"></i><span class="hide-menu">Quản lý học sinh</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('index.test.type') }}" aria-expanded="false">
                        <i class="m-r-10 mdi mdi-account-circle"></i><span class="hide-menu">Phân loại đề thi</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('index.test') }}" aria-expanded="false">
                        <i class="m-r-10 mdi mdi-account-circle"></i><span class="hide-menu">Đề thi online</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('index.exersire') }}" aria-expanded="false">
                        <i class="m-r-10 mdi mdi-account-circle"></i><span class="hide-menu">Bài tập</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('index.notification') }}" aria-expanded="false">
                        <i class="fas fa-align-left"></i><span class="hide-menu"> Thông báo</span>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
