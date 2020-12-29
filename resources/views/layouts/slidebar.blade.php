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
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('index.exersire.type') }}" aria-expanded="false">
                        <i class="m-r-10 mdi mdi-account-circle"></i><span class="hide-menu">Dạng bài tập</span>
                    </a>
                </li>

                {{-- <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="m-r-10 mdi mdi-calendar-blank"></i><span class="hide-menu">Work time</span></a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" style="text-indent:30px" href="{{ route('view.calender.daily') }}" aria-expanded="false">
                                <span class="hide-menu"> Daily</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" style="text-indent:30px" href="{{ route('view.calender.holiday') }}" aria-expanded="false">
                                <span class="hide-menu"> Holiday</span>
                            </a>
                        </li>
                    </ul>
                </li> --}}


            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
