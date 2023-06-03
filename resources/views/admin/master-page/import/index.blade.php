@extends('layout.admin.dashboard')
@section('css-tambahan')
    <link href="{{ URL::asset('asset/plugins/adminpage/costume.css') }}" rel="stylesheet">
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
                    <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Data Import</h3>
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
                <div class="col-md-12">
                    @if (session()->has('success'))
                        <div class="alert alert-info" role="alert">
                            <strong>Info!</strong> {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="card">
                <div class="card-body collapse show">
                    <div class="row">
                        <div class="col-md-9">
                            <h4 class="card-title">Import Data</h4>
                        </div>
                    </div>
                    <div class="row pdt-20">
                        <div class="col-md-9 pdt-6 mt-3">
                            Catatan:
                            <ul>
                                <li><b>* Username dan Password Secara Default adalah NISN Alumni Tersebut</b></li>
                                <li>* Mohon dipastikan Data Dapodik Terlebih dahulu sebelum melakukan import</li>
                                <li>* Apabila Terjadi Duplikasi NISN dan NIS maka Akan Terjadi Error</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body collapse show">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="card-title">Data Import Excel</h4>
                        </div>
                    </div>
                    <form action="/admin/administrator/master/import/data/excel" method="post" enctype="multipart/form-data">
                        @csrf
                    <div class="row pdt-20">
                        <div class="col-md-6">
                            <div class="input-group">
                                <label class="input-group-text" for="tipe_import">Pilih</label>
                                <select class="form-select" id="tipe_import" name="tipe_import">
                                    <option selected value="">Tipe Import</option>
                                    <option value="alumni">Import Alumni</option>
                                    <option value="perusahaan">Import Perusahaan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <input class="form-control" name="fileimport" type="file" id="formFile">
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4 pdt-6 mt-3">
                            <button type="submit" class="btn btn-primary pdt- full-size-width">Import</button>
                            </form>
                        </div>
                        <div class="col-md-4 mt-3 pdt-6">
                            <a href="#" class="btn btn-primary full-size-width" onclick="formatImportFunction()"><i
                                    class="fas fa-list-ul"></i> Lihat Format dan
                                Aturan</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card" id="formatImport" style="display: none">
                <div class="card-body">
                    <h4 class="card-title mb-3">Format dan Aturan Import Excel</h4>
                    <ul class="nav nav-tabs nav-bordered mb-3" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a href="#home-b1" data-bs-toggle="tab" aria-expanded="false" class="nav-link"
                                aria-selected="false" role="tab" tabindex="-1">
                                <i class="mdi mdi-home-variant d-lg-none d-block me-1"></i>
                                <span class="d-none d-lg-block">Import Alumni</span>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="#profile-b1" data-bs-toggle="tab" aria-expanded="true" class="nav-link active"
                                aria-selected="true" role="tab">
                                <i class="mdi mdi-account-circle d-lg-none d-block me-1"></i>
                                <span class="d-none d-lg-block">Import Perusahaan</span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane" id="home-b1" role="tabpanel">
                            <div class="row">
                                <div class="col-md-8">
                                    <h3 class="">Import Alumni</h3>
                                </div>
                                <div class="col-md-4">
                                    <a class="btn btn-primary"
                                        href="/admin/administrator/master/import/alumni/format-download"><i
                                            class="fas fa-download"></i> Download Format</a>
                                </div>
                            </div>
                            <div class="table-responsive mt-4">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="color: black !Important">Kolom</th>
                                            <th scope="col" style="color: black !Important">Aturan</th>
                                            <th scope="col" style="color: black !Important">Contoh</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>nisn</td>
                                            <td>Wajib</td>
                                            <td>00123532343</td>
                                        </tr>
                                        <tr>
                                            <td>nis</td>
                                            <td>Wajib</td>
                                            <td>00123532343</td>
                                        </tr>
                                        <tr>
                                            <td>nama</td>
                                            <td>Wajib</td>
                                            <td>Muhammad Imamul Azmi </td>
                                        </tr>
                                        <tr>
                                            <td>jenis_kelaminId</td>
                                            <td>Wajib Pilihan: Laki-Laki = 1, Perempuan = 2</td>
                                            <td>1 (Pilih 1: Laki-Laki)</td>
                                        </tr>
                                        <tr>
                                            <td>agamaId</td>
                                            <td>Wajib Pilihan: Islam = 1, Kristen = 2, Hindu = 3, Budha = 4, Konghucu = 5
                                            </td>
                                            <td>1 (Pilih 1: Islam)</td>
                                        </tr>
                                        <tr>
                                            <td>tempat_lahir</td>
                                            <td>Optional</td>
                                            <td>Banjarmasin</td>
                                        </tr>
                                        <tr>
                                            <td>tanggal_lahir</td>
                                            <td>Optional</td>
                                            <td>05-02-2000</td>
                                        </tr>
                                        <tr>
                                            <td>no_hp</td>
                                            <td>Optional</td>
                                            <td>+6282158021732</td>
                                        </tr>
                                        <tr>
                                            <td>alamat</td>
                                            <td>Optional</td>
                                            <td>Jl. Brig Jend. Hasan Basri No.7</td>
                                        </tr>
                                        <tr>
                                            <td>kode_jurusanid</td>
                                            <td>Wajib</td>
                                            <td>Terdapat di Halaman Ini bagian Kode Jurusan </td>
                                        </tr>
                                        <tr>
                                            <td>kode_lulusid</td>
                                            <td>Wajib</td>
                                            <td>Terdapat di Halaman Ini bagian Kode Kelulusan </td>
                                        </tr>
                                        <tr>
                                            <td>username</td>
                                            <td>Username akan diisi dengan NISN Alumni</td>
                                            <td>00123532343</td>
                                        </tr>
                                        <tr>
                                            <td>email</td>
                                            <td>Wajib Apabila Username Kosong</td>
                                            <td>example.web@gmail.com</td>
                                        </tr>
                                        <tr>
                                            <td>password</td>
                                            <td>Password akan diisi dengan NISN Alumni</td>
                                            <td>00123532343</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane active show" id="profile-b1" role="tabpanel">
                            <div class="row">
                                <div class="col-md-8">
                                    <h3 class="">Import Perusahaan</h3>
                                </div>
                                <div class="col-md-4">
                                    <a class="btn btn-primary"
                                        href="/admin/administrator/master/import/perusahaan/format-download"><i
                                            class="fas fa-download"></i> Download Format</a>
                                </div>
                            </div>
                            <div class="table-responsive mt-4">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="color: black !Important">Kolom</th>
                                            <th scope="col" style="color: black !Important">Aturan</th>
                                            <th scope="col" style="color: black !Important">Contoh</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>nama</td>
                                            <td>Wajib</td>
                                            <td>PT Example Perusahaan</td>
                                        </tr>
                                        <tr>
                                            <td>bidang</td>
                                            <td>Wajib</td>
                                            <td>Manufaktur</td>
                                        </tr>
                                        <tr>
                                            <td>no_telp</td>
                                            <td>Tidak Wajib, Diharapkan WhatsApp </td>
                                            <td>+6282158021732</td>
                                        </tr>
                                        <tr>
                                            <td>alamat</td>
                                            <td>Tidak Wajib</td>
                                            <td>Jl. Brig Jend. Hasan Basri No.7</td>
                                        </tr>
                                        <tr>
                                            <td>username</td>
                                            <td>Wajib Apabila E-Mail Kosong</td>
                                            <td>exampleUsername</td>
                                        </tr>
                                        <tr>
                                            <td>email</td>
                                            <td>Wajib Apabila Username Kosong</td>
                                            <td>example.web@gmail.com</td>
                                        </tr>
                                        <tr>
                                            <td>password</td>
                                            <td>Wajib</td>
                                            <td>examplepassword123</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div> <!-- end card-body-->
            </div>
            <div class="card">
                <div class="card-body collapse show">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="card-title">Status Import</h4>
                        </div>
                    </div>
                    <div class="row pdt-20">
                        <div class="col-md-3">
                            <p><b>Waktu</b></p>
                        </div>
                        <div class="col-md-3">
                            <p><b>Tipe</b></p>
                        </div>
                        <div class="col-md-3">
                            <p><b>Status</b></p>
                        </div>
                        <div class="col-md-3">
                            <p>#</p>
                        </div>
                        @foreach ($statusImport as $item)
                        <div class="col-md-3">
                            <p>{{ $item->waktu }}</p>
                        </div>
                        <div class="col-md-3">
                            <p>{{ $item->tipe }}</p>
                        </div>
                        <div class="col-md-3">
                            <p>{{ $item->status }}</p>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#fill-dark-modal">Detail</button>
                        </div>
                        {{-- Start Modal Here --}}
                        <div id="fill-dark-modal" class="modal fade" tabindex="-1" aria-labelledby="fill-dark-modalLabel" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content modal-filled bg-dark">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="fill-dark-modalLabel">Status Import: {{ $item->tipe }} - {{ $item->waktu }}</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                    </div>
                                    <div class="modal-body text-green-500">
                                        {{ $item->deskripsi }}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div>
                        {{-- End Modal Here --}}
                        @endforeach
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
    <script>
        function formatImportFunction() {
            var x = document.getElementById("formatImport");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>
@endsection
