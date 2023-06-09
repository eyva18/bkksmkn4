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
                    <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Daftar Lowongan Kerja</h3>
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
                            <h4 class="card-title">Pencarian Lowongan</h4>
                        </div>
                    </div>
                    <div class="row pdt-20">
                        <div class="col-md-9">
                            <form action="/admin/administrator/master/job/search" method="GET">
                                @csrf
                                <input type="text" id="example-input-large" name="nama_lowongan"
                                    class="form-control form-control-lg" placeholder="Kata Kunci Lowongan">
                        </div>
                        <div class="col-md-3 pdt-6">
                            <button type="submit" class="btn btn-primary pdt- full-size-width">Cari
                                Lowongan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @if ($datalowongan[0] == null)
                <div class="col-sm-12 mr">
                    <div class="card">
                        <div class="card-body collapse show">
                            <div class="row">
                                <div class="col-md-12 text-center mt-3">
                                    <h4 class="card-title">Tidak Tersedia</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @foreach ($datalowongan as $lowongan)
                    <div class="col-md-6">
                        <div class="card border-top-300">
                            <div class="col-md-12 p-4">
                                <h4 class="card-title">{{ $lowongan->nama ?? '-' }}</h4>
                                <ul class="list-unstyled">
                                    <li class="media d-flex align-items-start job-show">
                                        <img class="d-flex me-3 logo-job"
                                            src="{{ URL::asset('images/profileimg/') . '/' . $lowongan->dudi->logo }}"
                                            alt="Logo {{ $lowongan->dudi->nama }}" width="100">
                                        <div class="media-body">
                                            <ul class="list-unstyled">
                                                <li><i class="fas fa-building color-23"></i> <span
                                                        class="mrl-5 text-black">{{ $lowongan->dudi->nama ?? '-' }}</span>
                                                </li>
                                                <li><i class="fas fa-map-marker-alt color-23"></i> <span
                                                        class="mrl-5 text-black">{{ $lowongan->lokasi ?? '-' }}</span></li>
                                                <li><i class="fas fa-clipboard-list color-23"></i> <span
                                                        class="mrl-5 text-black">{{ $lowongan->kategori->nama_kategori ?? '-' }}</span>
                                                </li>
                                                <li><i class="fas fa-clock color-23"></i> <span
                                                        class="mrl-5 text-black">{{ $lowongan->tgl_upload ?? '-' }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <a href="/admin/administrator/master/company/profile/{{ $lowongan->dudi->nama }}" class="btn btn-primary full-size-width">Profile Perusahaan</a>
                            <ul class="list-unstyled d-flex none-mbt">
                                <li class="half-size-width">
                                    <a href="/admin/administrator/master/company/{{ $lowongan->dudi->nama }}/job/{{  $lowongan->nama }}"
                                        class="btn btn-warning text-white full-size-width">Detail Lowongan</a>
                                </li>
                                <li class="half-size-width">
                                    <button type="button" class="btn btn-danger text-white full-size-width"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deletemodal{{ $lowongan->id }}">Hapus</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    {{-- Modal Delete Start --}}
                    <div id="deletemodal{{ $lowongan->id }}" class="modal fade" tabindex="-1" role="dialog"
                        aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content modal-filled bg-danger">
                                <div class="modal-body p-4">
                                    <div class="text-center">
                                        <i class="dripicons-wrong h1"></i>
                                        <h4 class="mt-2">Peringatan!</h4>
                                        <p class="mt-3">Apakan Ingin Melanjutkan Menghapus data: <br> ID:
                                            {{ $lowongan->id }}
                                            | {{ $lowongan->nama }}</p>
                                        <form action="/admin/administrator/master/job/delete" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <input type="hidden" name="id" id="newsletter-id"
                                                    class="form-control form-control-lg" value="{{ $lowongan->id }}">
                                            </div>
                                            <button type="submit" class="btn btn-light my-2"
                                                data-bs-dismiss="modal">Delete</button>
                                        </form>
                                        <button type="button" class="btn btn-success"
                                            data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Modal Delete End --}}
                @endforeach
            </div>
            <div class="pagination d-flex justify-content-center mt-3">{{ $datalowongan->links() }}</div>
        </div>
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer text-center text-muted">
            © 2023 - 2024 Bursa Kerja Khusus — SMK Negeri 4 Banjarmasin 
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
