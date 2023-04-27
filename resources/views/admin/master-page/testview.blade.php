@extends('layout.admin.dashboard')
@section('css-tambahan')
@endsection
@section('page-wrapper')
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-7 align-self-center">
                    <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Daftar Perusahaan</h3>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <div class="card">
                <div class="card-body collapse show">
                    <div class="row">
                        <div class="col-md-9">
                            <h4 class="card-title">Pencarian Perusahaan</h4>
                        </div>
                        <div class="col-md-3">
                            <a href="javascript:void(0)" class="btn btn-primary full-size-width">Tambah Perusahaan</a>

                        </div>
                    </div>
                    <div class="row pdt-20">
                        <div class="col-md-9">
                            <form action="">
                                @csrf
                                <input type="text" id="example-input-large" name="nama_perusahaan"
                                    class="form-control form-control-lg" placeholder="Nama Perusahaan">
                        </div>
                        <div class="col-md-3 pdt-6">
                            <button type="submit" class="btn btn-primary pdt- full-size-width">Cari
                                Perusahaan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card border-top-300">
                        <div class="col-md-12 p-4">
                            <h4 class="card-title">PT. PURNA GRAHA JELITA HOTEL</h4>
                            <ul class="list-unstyled">
                                <li class="media d-flex align-items-start">
                                    <img class="d-flex me-3 logo-company" src="{{ URL::asset('images/profileimg/ph.png') }}"
                                        alt="Generic placeholder image" width="100">
                                    <div class="media-body">
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-newspaper color-23"></i> <span class="mrl-5 text-black">1
                                                    Lowongan Aktif</span></li>
                                            <li><i class="fas fa-building color-23"></i> <span
                                                    class="mrl-5 text-black">Hotel atau Pariwisata</span></li>
                                            <li><i class="fas fa-phone-square color-23"></i> <span
                                                    class="mrl-5 text-black">+6285103412211</span></li>
                                            <li><i class="fas fa-map-marker-alt color-23"></i> <span
                                                    class="mrl-5 text-black">Jl. A. Yani Km 5 No. 651 Pemurus Baru
                                                    Banjarmasin Selatan</span></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <a href="javascript:void(0)" class="btn btn-primary">Profile Perusahaan</a>
                        <ul class="list-unstyled d-flex none-mbt">
                            <li class="half-size-width">
                                <a href="javascript:void(0)" class="btn btn-warning text-white full-size-width">Masuk</a>
                            </li>
                            <li class="half-size-width">
                                <a href="javascript:void(0)" class="btn btn-danger text-white full-size-width">Hapus</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card border-top-300">
                        <div class="col-md-12 p-4">
                            <h4 class="card-title">PT. PURNA GRAHA JELITA HOTEL</h4>
                            <ul class="list-unstyled">
                                <li class="media d-flex align-items-start">
                                    <img class="d-flex me-3 logo-company" src="{{ URL::asset('images/profileimg/ph.png') }}"
                                        alt="Generic placeholder image" width="100">
                                    <div class="media-body">
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-newspaper color-23"></i> <span class="mrl-5 text-black">1
                                                    Lowongan Aktif</span></li>
                                            <li><i class="fas fa-building color-23"></i> <span
                                                    class="mrl-5 text-black">Hotel atau Pariwisata</span></li>
                                            <li><i class="fas fa-phone-square color-23"></i> <span
                                                    class="mrl-5 text-black">+6285103412211</span></li>
                                            <li><i class="fas fa-map-marker-alt color-23"></i> <span
                                                    class="mrl-5 text-black">Jl. A. Yani Km 5 No. 651 Pemurus Baru
                                                    Banjarmasin Selatan</span></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <a href="javascript:void(0)" class="btn btn-primary">Profile Perusahaan</a>
                        <ul class="list-unstyled d-flex none-mbt">
                            <li class="half-size-width">
                                <a href="javascript:void(0)" class="btn btn-warning text-white full-size-width">Masuk</a>
                            </li>
                            <li class="half-size-width">
                                <a href="javascript:void(0)" class="btn btn-danger text-white full-size-width">Hapus</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-top-300">
                        <div class="col-md-12 p-4">
                            <h4 class="card-title">PT. PURNA GRAHA JELITA HOTEL</h4>
                            <ul class="list-unstyled">
                                <li class="media d-flex align-items-start">
                                    <img class="d-flex me-3 logo-company" src="{{ URL::asset('images/profileimg/ph.png') }}"
                                        alt="Generic placeholder image" width="100">
                                    <div class="media-body">
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-newspaper color-23"></i> <span class="mrl-5 text-black">1
                                                    Lowongan Aktif</span></li>
                                            <li><i class="fas fa-building color-23"></i> <span
                                                    class="mrl-5 text-black">Hotel atau Pariwisata</span></li>
                                            <li><i class="fas fa-phone-square color-23"></i> <span
                                                    class="mrl-5 text-black">+6285103412211</span></li>
                                            <li><i class="fas fa-map-marker-alt color-23"></i> <span
                                                    class="mrl-5 text-black">Jl. A. Yani Km 5 No. 651 Pemurus Baru
                                                    Banjarmasin Selatan</span></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <a href="javascript:void(0)" class="btn btn-primary">Profile Perusahaan</a>
                        <ul class="list-unstyled d-flex none-mbt">
                            <li class="half-size-width">
                                <a href="javascript:void(0)" class="btn btn-warning text-white full-size-width">Masuk</a>
                            </li>
                            <li class="half-size-width">
                                <a href="javascript:void(0)" class="btn btn-danger text-white full-size-width">Hapus</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-top-300">
                        <div class="col-md-12 p-4">
                            <h4 class="card-title">PT. PURNA GRAHA JELITA HOTEL</h4>
                            <ul class="list-unstyled">
                                <li class="media d-flex align-items-start">
                                    <img class="d-flex me-3 logo-company"
                                        src="{{ URL::asset('images/profileimg/ph.png') }}" alt="Generic placeholder image"
                                        width="100">
                                    <div class="media-body">
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-newspaper color-23"></i> <span class="mrl-5 text-black">1
                                                    Lowongan Aktif</span></li>
                                            <li><i class="fas fa-building color-23"></i> <span
                                                    class="mrl-5 text-black">Hotel atau Pariwisata</span></li>
                                            <li><i class="fas fa-phone-square color-23"></i> <span
                                                    class="mrl-5 text-black">+6285103412211</span></li>
                                            <li><i class="fas fa-map-marker-alt color-23"></i> <span
                                                    class="mrl-5 text-black">Jl. A. Yani Km 5 No. 651 Pemurus Baru
                                                    Banjarmasin Selatan</span></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <a href="javascript:void(0)" class="btn btn-primary">Profile Perusahaan</a>
                        <ul class="list-unstyled d-flex none-mbt">
                            <li class="half-size-width">
                                <a href="javascript:void(0)" class="btn btn-warning text-white full-size-width">Masuk</a>
                            </li>
                            <li class="half-size-width">
                                <a href="javascript:void(0)" class="btn btn-danger text-white full-size-width">Hapus</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer text-center text-muted">
            © 2023 - 2024 Bursa Kerja Khusus — SMK Negeri 4 Banjarmasin by Taufiq Ari Rahman
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
@endsection
@section('js-tambahan')
    <script src="{{ URL::asset('asset/plugins/adminpage/chart/chartjs/Chart.js') }}"></script>
    <script src="{{ URL::asset('asset/plugins/adminpage/chart/chart_dashboard.js') }}"></script>
@endsection
