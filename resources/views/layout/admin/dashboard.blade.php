<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="{{ URL::asset('images/homepage/logo.png') }}">
    <title>Dashboard - Bursa Kerja Khusus - SMKN 4 Banjarmasin</title>
    <link href="{{ URL::asset('asset/plugins/adminpage/extra-libs/c3/c3.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('asset/plugins/adminpage/libs/chartist/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('asset/plugins/adminpage/extra-libs/jvector/jquery-jvectormap-2.0.2.css') }}"
        rel="stylesheet" />
    <link href="{{ URL::asset('asset/plugins/adminpage/dist/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('asset/plugins/adminpage/costume.css') }}" rel="stylesheet">
    @yield('css-tambahan')
</head>

<body>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-lg">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-lg-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-brand">
                        <!-- Logo icon -->
                        <a href="#" class="pdl-10">
                            <span class="text-logo">ADMIN - BKK</span>
                        </a>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-lg-none waves-effect waves-light" href="javascript:void(0)"
                        data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                            class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <p class="navbar-nav float-left me-auto ms-3 ps-1">
                        Bursa Kerja Khusus - SMKN 4 Banjarmasin
                    </p>
                    <ul class="navbar-nav float-end">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <img src="{{ URL::asset('images/profileimg/'.Auth::user()->photo_profile) }}" alt="user"
                                    class="rounded-circle" width="40">
                                <span class="ms-2 d-none d-lg-inline-block"><span
                                        class="text-dark">{{ Auth::user()->name }}</span> <i data-feather="chevron-down"
                                        class="svg-icon"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-right user-dd animated flipInY">
                                <a class="dropdown-item" href="javascript:void(0)"><i data-feather="settings"
                                        class="svg-icon me-2 ms-1"></i>
                                    Pusat Keamanan</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();"><i
                                        data-feather="power" class="svg-icon me-2 ms-1"></i>
                                    Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="/admin/dashboard"
                                aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                                    class="hide-menu">Beranda</span></a></li>
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Data</span></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                                aria-expanded="false"><i class="fas fa-angle-right"></i><span class="hide-menu">Data
                                    Master </span></a>
                            <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                <li class="sidebar-item"><a href="/admin/administrator/master/department" class="sidebar-link"><span
                                            class="hide-menu"> Jurusan
                                        </span></a>
                                </li>
                                <li class="sidebar-item"><a href="/admin/administrator/master/graduation-year" class="sidebar-link"><span
                                            class="hide-menu"> Tahun Angkatan
                                        </span></a>
                                </li>
                                <li class="sidebar-item"><a href="/admin/administrator/master/category"
                                        class="sidebar-link"><span class="hide-menu"> Kategori Pekerjaan
                                        </span></a>
                                <li class="sidebar-item"><a href="/admin/administrator/master/import"
                                        class="sidebar-link"><span class="hide-menu"> Import
                                        </span></a></li>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                                aria-expanded="false"><i class="fas fa-angle-right"></i><span
                                    class="hide-menu">Daftar </span></a>
                            <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                <li class="sidebar-item"><a href="/admin/administrator/master/company" class="sidebar-link"><span
                                            class="hide-menu"> Perusahaan
                                        </span></a>
                                </li>
                                <li class="sidebar-item"><a href="/admin/administrator/master/alumni" class="sidebar-link"><span
                                            class="hide-menu"> Alumni
                                        </span></a>
                                </li>
                                <li class="sidebar-item"><a href="/admin/administrator/master/job"
                                        class="sidebar-link"><span class="hide-menu"> Lowongan
                                        </span></a></li>
                            </ul>
                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                            aria-expanded="false"><i class="fas fa-angle-right"></i><span
                                class="hide-menu">Laporan </span></a>
                        <ul aria-expanded="false" class="collapse  first-level base-level-line">
                            <li class="sidebar-item"><a href="/admin/administrator/master/report/yearly" class="sidebar-link"><span
                                        class="hide-menu"> Laporan Tahun
                                        Kelulusan
                                    </span></a>
                            </li>
                            </li>

                        </ul>
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
        @yield('page-wrapper')
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ URL::asset('asset/plugins/adminpage/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('asset/plugins/adminpage/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="{{ URL::asset('asset/plugins/adminpage/dist/js/app-style-switcher.js') }}"></script>
    <script src="{{ URL::asset('asset/plugins/adminpage/dist/js/feather.min.js') }}"></script>
    <script src="{{ URL::asset('asset/plugins/adminpage/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}">
    </script>
    <script src="{{ URL::asset('asset/plugins/adminpage/dist/js/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ URL::asset('asset/plugins/adminpage/dist/js/custom.min.js') }}"></script>
    <!--This page JavaScript -->
    <script src="{{ URL::asset('asset/plugins/adminpage/extra-libs/c3/d3.min.js') }}"></script>
    <script src="{{ URL::asset('asset/plugins/adminpage/extra-libs/c3/c3.min.js') }}"></script>
    <script src="{{ URL::asset('asset/plugins/adminpage/libs/chartist/dist/chartist.min.js') }}"></script>
    <script
        src="{{ URL::asset('asset/plugins/adminpage/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}">
    </script>
    <script src="{{ URL::asset('asset/plugins/adminpage/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ URL::asset('asset/plugins/adminpage/extra-libs/jvector/jquery-jvectormap-world-mill-en.js') }}">
    </script>
    <script src="{{ URL::asset('asset/plugins/adminpage/dist/js/pages/dashboards/dashboard1.min.js') }}"></script>
    @yield('js-tambahan')
</body>

</html>
