@extends('layout.admin.dashboard')
@section('css-tambahan')
    <link rel="stylesheet"
        href="{{ URL::asset('asset/plugins/adminpage/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet"
        href="{{ URL::asset('asset/plugins/adminpage/extra-libs/datatables.net-bs4/css/responsive.dataTables.min.css') }}">
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
                    <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Data Tahun Kelulusan</h3>
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
            <!-- *************************************************************** -->
            <!-- Start First Cards -->
            <!-- *************************************************************** -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Tahun Kelulusan SMKN 4 - BKK <button type="button" class="btn waves-effect waves-light btn-success"
                                data-bs-toggle="modal" data-bs-target="#modalnewdata">Tambah Tahun Kelulusan +</button></h4>
                            <div class="table-responsive">
                                <table id="zero_config" class="table border table-striped table-bordered text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>KODE KELULUSAN</th>
                                            <th>TAHUN KELULUSAN</th>
                                            <th>JUMLAH ALUMNI</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datatahunlulusan as $tahunlulusan)
                                            <tr>
                                                <td>{{ $tahunlulusan->id }}</td>
                                                <td>{{ $tahunlulusan->tahun_lulus }}</td>
                                                <td>{{ $datatahunlulusanalumni[$tahunlulusan->id] }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                        data-bs-target="#edittahun_lulus{{ $tahunlulusan->id }}">Edit</button>
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deletemodal{{ $tahunlulusan->id }}">Delete</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
            <div class="modal fade" id="modalnewdata" tabindex="-1" role="dialog"
                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myLargeModalLabel">Tambah Data Tahun Kelulusan</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        </div>
                        <form action="/admin/administrator/master/graduation-year/newdata" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="newsletter-tahun_lulus" class="content-hidden">Tahun Lulus</label>
                                    <input type="text" name="tahun_lulus" id="newsletter-tahun_lulus"
                                        class="form-control form-control-lg" placeholder="Tahun Lulus" autocomplete="off">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batalkan</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <!-- Modal -->
        @foreach ($datatahunlulusan as $datatahunlulus)
            {{-- Modal Edit --}}
            <div class="modal fade" id="edittahun_lulus{{ $datatahunlulus->id }}" tabindex="-1" role="dialog"
                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myLargeModalLabel">Edit Tahun Kelulusan</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        </div>
                        <form action="/admin/administrator/master/graduation-year/update" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="hidden" name="id" id="newsletter-id"
                                        class="form-control form-control-lg" value="{{ $datatahunlulus->id }}">
                                </div>
                                <div class="form-group">
                                    <label for="newsletter-tahun_lulus" class="content-hidden">Nama Tahun Lulus</label>
                                    <input type="text" name="tahun_lulus" id="newsletter-tahun_lulus"
                                        class="form-control form-control-lg" placeholder="Nama Tahun Lulus"
                                        value="{{ $datatahunlulus->tahun_lulus }}" autocomplete="off">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batalkan</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- Modal Edit End --}}
            {{-- Modal Delete Start --}}
            <div id="deletemodal{{ $datatahunlulus->id }}" class="modal fade" tabindex="-1" role="dialog"
                aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content modal-filled bg-danger">
                        <div class="modal-body p-4">
                            <div class="text-center">
                                <i class="dripicons-wrong h1"></i>
                                <h4 class="mt-2">Peringatan!</h4>
                                <p class="mt-3">Apakan Ingin Melanjutkan Menghapus data: <br> ID: {{ $datatahunlulus->id }}
                                    | {{ $datatahunlulus->tahun_lulus }}</p>
                                <form action="/admin/administrator/master/graduation-year/delete" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <input type="hidden" name="id" id="newsletter-id"
                                            class="form-control form-control-lg" value="{{ $datatahunlulus->id }}">
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
        <!-- End Modal -->

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
    <script src="{{ URL::asset('asset/plugins/adminpage/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ URL::asset('asset/plugins/adminpage/extra-libs/sparkline/sparkline.js') }}"></script>
    <script src="{{ URL::asset('asset/plugins/adminpage/extra-libs/datatables.net/js/jquery.dataTables.min.js') }}">
    </script>
    <script
        src="{{ URL::asset('asset/plugins/adminpage/extra-libs/datatables.net-bs4/js/dataTables.responsive.min.js') }}">
    </script>
    <script src="{{ URL::asset('asset/plugins/adminpage/dist/js/pages/datatable/datatable-basic.init.js') }}"></script>
@endsection
