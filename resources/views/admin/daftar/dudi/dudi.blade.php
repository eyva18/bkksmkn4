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
                            <a href="/admin/administrator/master/company/create" class="btn btn-primary full-size-width">Tambah Perusahaan</a>

                        </div>
                    </div>
                    <div class="row pdt-20">
                        <div class="col-md-9">
                            <form action="/admin/administrator/master/company/search" method="GET">
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
                @foreach ($datadudi as $dudi)                    
                <div class="col-md-6">
                    <div class="card border-top-300">
                        <div class="col-md-12 p-4">
                            <h4 class="card-title">{{ $dudi->nama ?? '-'}}</h4>
                            <ul class="list-unstyled">
                                <li class="media d-flex align-items-start">
                                    <img class="d-flex me-3 logo-company" src="{{ URL::asset('images/profileimg/').'/'.$dudi->logo }}"
                                        alt="Logo {{ $dudi->nama }}" width="100">
                                    <div class="media-body">
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-newspaper color-23"></i> <span class="mrl-5 text-black">{{ $lowongan[$dudi->id] }}
                                                    Lowongan Aktif</span></li>
                                            <li><i class="fas fa-building color-23"></i> <span
                                                    class="mrl-5 text-black">{{ $dudi->bidang ?? '-'}}</span></li>
                                            <li><i class="fas fa-phone-square color-23"></i> <span
                                                    class="mrl-5 text-black">{{ $dudi->no_telp ?? '-'}}</span></li>
                                            <li><i class="fas fa-map-marker-alt color-23"></i> <span
                                                    class="mrl-5 text-black">{{ $dudi->alamat ?? '-'}}</span></li>
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
                                <button type="button" class="btn btn-danger text-white full-size-width" data-bs-toggle="modal"
                                                        data-bs-target="#deletemodal{{ $dudi->id }}">Hapus</button>
                            </li>
                        </ul>
                    </div>
                </div>
                            {{-- Modal Delete Start --}}
            <div id="deletemodal{{ $dudi->id }}" class="modal fade" tabindex="-1" role="dialog"
                aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content modal-filled bg-danger">
                        <div class="modal-body p-4">
                            <div class="text-center">
                                <i class="dripicons-wrong h1"></i>
                                <h4 class="mt-2">Peringatan!</h4>
                                <p class="mt-3">Apakan Ingin Melanjutkan Menghapus data: <br> ID: {{ $dudi->id }}
                                    | {{ $dudi->nama }}</p>
                                <form action="/admin/administrator/master/company/delete" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <input type="hidden" name="id" id="newsletter-id"
                                            class="form-control form-control-lg" value="{{ $dudi->id }}">
                                    </div>
                                    <button type="submit" class="btn btn-light my-2"
                                        data-bs-dismiss="modal">Delete</button>
                                </form>
                                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Modal Delete End --}}
                @endforeach
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
