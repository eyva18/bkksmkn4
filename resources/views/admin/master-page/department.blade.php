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
                    <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Data Jurusan</h3>
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
                            <h4 class="card-title">Jurusan SMKN 4 - BKK <button type="button" class="btn waves-effect waves-light btn-success"
                                data-bs-toggle="modal" data-bs-target="#modalnewdata">Tambah Jurusan +</button></h4>
                            <div class="table-responsive">
                                <table id="zero_config" class="table border table-striped table-bordered text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>KODE JURUSAN</th>
                                            <th>NAMA JURUSAN</th>
                                            <th>JUMLAH ALUMNI</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datajurusan as $jurusandata)
                                            <tr>
                                                <td>{{ $jurusandata->id }}</td>
                                                <td>{{ $jurusandata->jurusan }}</td>
                                                <td>{{ $datajurusanalumni[$jurusandata->id] }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                        data-bs-target="#editjurusan{{ $jurusandata->id }}">Edit</button>
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deletemodal{{ $jurusandata->id }}">Delete</button>
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
                            <h4 class="modal-title" id="myLargeModalLabel">Tambah Data Jurusan</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        </div>
                        <form action="/admin/administrator/master/department/newdata" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="newsletter-jurusan" class="content-hidden">Nama Jurusan</label>
                                    <input type="text" name="jurusan" id="newsletter-jurusan"
                                        class="form-control form-control-lg" placeholder="Nama Jurusan" autocomplete="off">
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
        @foreach ($datajurusan as $jurusanedit)
            {{-- Modal Edit --}}
            <div class="modal fade" id="editjurusan{{ $jurusanedit->id }}" tabindex="-1" role="dialog"
                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myLargeModalLabel">Edit Jurusan</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        </div>
                        <form action="/admin/administrator/master/department/update" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="hidden" name="id" id="newsletter-id"
                                        class="form-control form-control-lg" value="{{ $jurusanedit->id }}">
                                </div>
                                <div class="form-group">
                                    <label for="newsletter-jurusan" class="content-hidden">Nama Jurusan</label>
                                    <input type="text" name="jurusan" id="newsletter-jurusan"
                                        class="form-control form-control-lg" placeholder="Nama Jurusan"
                                        value="{{ $jurusanedit->jurusan }}" autocomplete="off">
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
            <div id="deletemodal{{ $jurusanedit->id }}" class="modal fade" tabindex="-1" role="dialog"
                aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content modal-filled bg-danger">
                        <div class="modal-body p-4">
                            <div class="text-center">
                                <i class="dripicons-wrong h1"></i>
                                <h4 class="mt-2">Peringatan!</h4>
                                <p class="mt-3">Apakan Ingin Melanjutkan Menghapus data: <br> ID: {{ $jurusanedit->id }}
                                    | {{ $jurusanedit->jurusan }}</p>
                                <form action="/admin/administrator/master/department/delete" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <input type="hidden" name="id" id="newsletter-id"
                                            class="form-control form-control-lg" value="{{ $jurusanedit->id }}">
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
