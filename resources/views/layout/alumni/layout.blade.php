<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard - Bursa Kerja Khusus - SMKN 4 Banjarmasin</title>
    <!-- base:css -->
    <link rel="stylesheet" href="{{ URL::asset('asset/plugins/alumnipage/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('asset/plugins/alumnipage/vendors/base/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ URL::asset('asset/plugins/alumnipage/css/style.css') }}">
    @yield('css-tambahan')
    
    <!-- endinject -->
    <link rel="icon" type="image/png" href="{{ URL::asset('images/homepage/logo.png') }}">
  </head>
  <body>
    <div class="container-scroller">
    <div class="horizontal-menu">
      <nav class="navbar top-navbar col-lg-12 col-12 p-0">
        <div class="container-fluid">
          <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center mrl-10">
                <a class="navbar-brand brand-logo" href="index.html"><img src="{{ URL::asset('images/homepage/logo.png') }}" alt="logo" style="height: 60px !important" /></a>
                <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{ URL::asset('images/homepage/logo.png') }}" style="height: 45px !important" alt="logo"/></a>
            </div>
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                  <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                    <span class="nav-profile-name">Johnson</span>
                    <img src="{{ URL::asset('images/profileimg/'.Auth::user()->photo_profile) }}" alt="profile"/>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                      <a class="dropdown-item">
                        <i class="mdi mdi-settings text-primary"></i>
                        Pengaturan
                      </a>
                      <a class="dropdown-item">
                        <i class="mdi mdi-logout text-primary"></i>
                        Logout
                      </a>
                  </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
              <span class="mdi mdi-menu"></span>
            </button>
          </div>
        </div>
      </nav>
      <nav class="bottom-navbar">
        <div class="container">
            <ul class="nav page-navigation">
              <li class="nav-item">
                <a class="nav-link" href="index.html">
                  <i class="mdi mdi-file-document-box menu-icon"></i>
                  <span class="menu-title">Beranda</span>
                </a>
              </li>
              <li class="nav-item">
                  <a href="pages/forms/basic_elements.html" class="nav-link">
                    <i class=" mdi mdi-newspaper menu-icon"></i>
                    <span class="menu-title">Daftar Lowongan</span>
                    <i class="menu-arrow"></i>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="pages/charts/chartjs.html" class="nav-link">
                    <i class=" mdi mdi-hospital-building menu-icon"></i>
                    <span class="menu-title">Daftar Perusahaan</span>
                    <i class="menu-arrow"></i>
                  </a>
              </li>
            </ul>
        </div>
      </nav>
    </div>
    <!-- partial -->
		<div class="container-fluid page-body-wrapper">
			<div class="main-panel">
				<div class="content-wrapper">
                    @yield('page-wrapper')
				</div>
				<!-- content-wrapper ends -->
				<!-- partial:partials/_footer.html -->
				<footer class="footer mt-5">
          <div class="footer-wrap">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">© 2023 - 2024 Bursa Kerja Khusus — <a href="https://smkn4bjm.sch.id/" target="_blank">SMK Negeri 4 Banjarmasin</a> by Taufiq Ari Rahman & Husain Ali Ridha</span>
            </div>
          </div>
        </footer>
				<!-- partial -->
			</div>
			<!-- main-panel ends -->
		</div>
		<!-- page-body-wrapper ends -->
    </div>
		<!-- container-scroller -->
    <!-- base:js -->
    <script src="{{ URL::asset('asset/plugins/alumnipage/vendors/base/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{ URL::asset('asset/plugins/alumnipage/js/template.js') }}"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <!-- End plugin js for this page -->
    <script src="{{ URL::asset('asset/plugins/alumnipage/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ URL::asset('asset/plugins/alumnipage/vendors/progressbar.js/progressbar.min.js') }}"></script>
		<script src="{{ URL::asset('asset/plugins/alumnipage/vendors/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js') }}"></script>
		<script src="{{ URL::asset('asset/plugins/alumnipage/vendors/justgage/raphael-2.1.4.min.js') }}"></script>
		<script src="{{ URL::asset('asset/plugins/alumnipage/vendors/justgage/justgage.js') }}"></script>
    <!-- Custom js for this page-->
    <script src="{{ URL::asset('asset/plugins/alumnipage/js/dashboard.js') }}"></script>
    <!-- End custom js for this page-->
    @yield('js-tambahan')
  </body>
</html>