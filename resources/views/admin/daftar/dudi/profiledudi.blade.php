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
                    <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Profile Perusahaan</h3>
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
                <div class="col-lg-4 col-md-6">
                    <!-- Card -->
                    <div class="card">
                        <img class="card-img-top img-fluid" src="{{ URL::asset('images/profileimg/').'/'.$datadudi->logo }}" height="50%"
                            alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title">{{ $datadudi->nama ?? '-' }}</h4>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-building color-23"></i> <span class="mrl-5 text-black">{{ $datadudi->bidang ?? '-'}}</span></li>
                                <li><i class="fas fa-map-marker-alt color-23"></i> <span class="mrl-5 text-black">{{ $datadudi->alamat ?? '-'}}</span></li>
                                <li><i class="far fa-envelope color-23"></i> <span
                                        class="mrl-5 text-black">{{ $userdudi->email ?? '-'}}</span></li>
                                <li><i class="fas fa-phone-square color-23"></i> <span
                                        class="mrl-5 text-black">{{ $datadudi->no_telp ?? '-'}}</span></li>
                            </ul>
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <a href="/admin/administrator/master/company/edit/{{ $datadudi->nama }}" class="btn btn-secondary">Ubah Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card -->
                </div>
                <!-- column -->
                <!-- column -->
                <div class="col-md-8">
                    <div class="card border-dark">
                        <div class="card-header bg-dark">
                            <h4 class="mb-0 text-white">Biografi <i class="fas fa-info-circle text-white"></i></h4>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{!! $datadudi->deskripsi ?? '-' !!}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-7 align-self-center">
                    <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Daftar Lowongan</h3>
                </div>
            </div>
            <div class="row mt-4">
                @if ($lowongan[0] == null)
                <div class="col-sm-12 mr">
                    <div class="card">
                        <div class="card-body collapse show">
                            <div class="row">
                                <div class="col-md-12 text-center mt-3">
                                    <h4 class="card-title">Lowongan Tidak Tersedia</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @foreach ($lowongan as $data)
                <div class="col-md-6">
                    <div class="card border-top-black-300">
                        <div class="col-md-12 p-4">
                            <h4 class="card-title">{{ $data->nama ?? '-'}}</h4>
                            <ul class="list-unstyled">
                                <li class="media d-flex align-items-start">
                                    <img class="d-flex me-3 logo-company" src="/images/profileimg/{{ $data->dudi->logo }}"
                                        alt="Logo Test" width="100">
                                    <div class="media-body">
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-building color-23"></i> <span
                                                class="mrl-5 text-black">{{ $data->dudi->nama ?? '-'}}</span></li>
                                            <li><i class="fas fa-far fa-clipboard color-23"></i> <span
                                                    class="mrl-5 text-black">{{ $data->kategori->nama_kategori ?? '-'}}</span></li>
                                            <li><i class="far fa-calendar-alt color-23"></i> <span
                                                    class="mrl-5 text-black">{{ $data->tgl_upload ?? '-'}}</span></li>
                                            <li><i class="fas fa-map-marker-alt color-23"></i> <span
                                                    class="mrl-5 text-black">{{ $data->lokasi ?? '-'}}</span></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <a href="/admin/administrator/master/company/{{ $data->dudi->nama }}/job/{{  $data->nama }}"
                                        class="btn btn-primary text-white full-size-width">Detail Lowongan</a>
                    </div>
                </div>
                @endforeach
            <div class="pagination">{{ $lowongan->links() }}</div>
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
