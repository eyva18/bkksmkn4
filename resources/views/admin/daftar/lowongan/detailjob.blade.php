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
                    <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Detail Lowongan</h3>
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
            <div class="row">
                <!-- column -->
                <div class="col-lg-5 col-md-6">
                    <!-- Card -->
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Detail Lowongan</h3>
                            <h4 class="card-title">{{ $datalowongan->nama ?? '-' }}</h4>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-building color-23"></i> <span
                                        class="mrl-5 text-black">{{ $datalowongan->kategori->nama_kategori ?? '-' }}</span>
                                </li>
                                <li><i class="fas fa-map-marker-alt color-23"></i> <span
                                        class="mrl-5 text-black">{{ $datalowongan->lokasi ?? '-' }}</span></li>
                                <li><i class="fas fa-clock color-23"></i> <span
                                        class="mrl-5 text-black">{{ $datalowongan->tgl_upload ?? '-' }}</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card border-top-300">
                        <div class="col-md-12 p-4">
                            <h4 class="card-title">{{ $datalowongan->dudi->nama ?? '-' }}</h4>
                            <ul class="list-unstyled">
                                <li class="media d-flex align-items-start company-show">
                                    <img class="d-flex me-3 logo-company"
                                        src="{{ URL::asset('images/profileimg/') . '/' . $datalowongan->dudi->logo ?? '-' }}"
                                        alt="Logo Stella Toy1" width="100">
                                    <div class="media-body">
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-building color-23"></i> <span
                                                    class="mrl-5 text-black">{{ $datalowongan->dudi->bidang ?? '-' }}</span>
                                            </li>
                                            <li><i class="fas fa-phone-square color-23"></i> <span
                                                    class="mrl-5 text-black">{{ $datalowongan->dudi->no_telp ?? '-' }}</span>
                                            </li>
                                            <li><i class="fas fa-at color-23"></i> <span
                                                    class="mrl-5 text-black">{{ $datauser->email ?? '-' }}</span></li>
                                            <li><i class="fas fa-map-marker-alt color-23"></i> <span
                                                    class="mrl-5 text-black">{{ $datalowongan->dudi->alamat ?? '-' }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <a href="/admin/administrator/master/company/profile/{{ $datalowongan->dudi->nama }}" class="btn btn-primary full-size-width">Profile Perusahaan</a>
                    </div>
                    <!-- Card -->
                </div>
                <!-- column -->
                <!-- column -->
                <div class="col-md-7">
                    <div class="card border-dark">
                        <div class="card-header bg-dark">
                            <h4 class="mb-0 text-white">Deskripsi Pekerjaan <i class="fas fa-info-circle text-white"></i></h4>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{!! $datalowongan->deskripsi_pekerjaan ?? '-' !!}</p>
                        </div>
                    </div>
                    <div class="card border-dark">
                        <div class="card-header bg-dark">
                            <h4 class="mb-0 text-white">Deskripsi Perusahaan <i class="fas fa-info-circle text-white"></i></h4>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{!! $datalowongan->dudi->deskripsi ?? '-' !!}</p>
                        </div>
                    </div>
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
