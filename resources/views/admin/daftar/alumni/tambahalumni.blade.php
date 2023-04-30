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
                    <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Tambah Alumni </h3>
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
                            <h3 class="card-title">Informasi Profil</h3>
                            <h6 class="card-subtitle">Data Personal dan Deskripsi</h6>
                        </div>
                    </div>
                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="row pdt-20">
                        <div class="col-md-4">
                            <h4 class="text-black m-0">NISN<span class="text-red"> *</span></h4>
                            <p class="text-muted mt-0 text-sm">Nomor Induk Siswa Nasional</p>
                        </div>
                        <div class="col-md-8 pdt-6">
                            <input type="text" name="nisn" class="form-control font-weight-normal">
                        </div>
                    </div>
                    <div class="row pdt-20">
                        <div class="col-md-4">
                            <h4 class="text-black m-0">NIS<span class="text-red"> *</span></h4>
                            <p class="text-muted mt-0 text-sm">Nomor Induk Siswa Sekolah</p>
                        </div>
                        <div class="col-md-8 pdt-6">
                            <input type="text" name="nis" class="form-control font-weight-normal">
                        </div>
                    </div>
                    <div class="row pdt-20">
                        <div class="col-md-4">
                            <h4 class="text-black m-0">No Handphone <span class="text-red"> *</span></h4>
                            <p class="text-muted mt-0 text-sm">Nomor Handphone / Telepon / Whatsapp</p>
                        </div>
                        <div class="col-md-8 pdt-6">
                            <input type="text" name="no_hp" class="form-control font-weight-normal">
                        </div>
                    </div>
                    <div class="row pdt-20">
                        <div class="col-md-4">
                            <h4 class="text-black m-0">Bio <span class="text-red"> *</span></h4>
                            <p class="text-muted mt-0 text-sm">Biografi Anda</p>
                        </div>
                        <div class="col-md-8">
                            <textarea name="biografi" class="form-control font-weight-normal" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="row mrt-6">
                        <div class="col-md-4">
                            <h4 class="text-black m-0">Agama<span class="text-red"> *</span></h4>
                            <p class="text-muted mt-0 text-sm">Agama / Kepercayaan</p>
                        </div>
                        <div class="col-md-8 pdt-6">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01">Pilih</label>
                                <select class="form-select" id="inputGroupSelect01" name="agama">
                                    <option selected="">Agana</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen Protestan">Kristen Protestan</option>
                                    <option value="Kristen Katolik">Kristen Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Konghucu">Konghucu</option>

                                </select>
                            </div>
                        </div>
                    </div> 
                    <div class="row mrt-6">
                        <div class="col-md-4">
                            <h4 class="text-black m-0">Jenis Kelamin<span class="text-red"> *</span></h4>
                            <p class="text-muted mt-0 text-sm">Jenis Kelamin Anda</p>
                        </div>
                        <div class="col-md-8 pdt-6">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01">Pilih</label>
                                <select class="form-select" id="inputGroupSelect01" name="agama">
                                    <option selected="">Jenis Kelamin</option>
                                    <option value="laki-laki">Laki-Laki</option>
                                    <option value="perempuan">Perempuan</option>

                                </select>
                            </div>
                        </div>
                    </div> 
                    <div class="row mrt-6">
                        <div class="col-md-4">
                            <h4 class="text-black m-0">Alamat<span class="text-red"> *</span></h4>
                            <p class="text-muted mt-0 text-sm">Alamat Domisi Anda</p>
                        </div>
                        <div class="col-md-8 pdt-6">
                            <div class="form-group">
                                <textarea class="form-control" name="deskripsi" rows="7" placeholder="Deskripsi Perusahaan..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row pdt-20">
                        <div class="col-md-4">
                            <h4 class="text-black m-0">Tempat Lahir, Tanggal Lahir <span class="text-red"> *</span></h4>
                            <p class="text-muted mt-0 text-sm">Tempat Lahir, Tanggal Lahir</p>
                        </div>
                        <div class="col-md-8 pdt-6">
                            <input type="text" name="ttl" class="form-control font-weight-normal" placeholder="Example: Banjarmasin, 1 Januari 0000">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <h4 class="text-black m-0">Photo Profil<span class="text-red"> *</span></h4>
                            <p class="text-muted mt-0 text-sm">Pas Photo, diutamakan Formal</p>
                        </div>
                        <div class="col-md-8 pdt-6">
                            <input class="form-control" name="logo" type="file" id="formFile">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <h4 class="text-black m-0">Transkrip Nilai <span class="text-red"> *</span></h4>
                            <p class="text-muted mt-0 text-sm">Transkrip Terakhir</p>
                        </div>
                        <div class="col-md-8 pdt-6">
                            <input class="form-control" name="transkripnilai" type="file" id="formFile">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body collapse show">
                    <div class="row">
                        <div class="col-md-9">
                            <h3 class="card-title">Jurusan & Angkatan</h3>
                            <h6 class="card-subtitle">Data Jurusan dan Angkatan Tahun Alumni </h6>
                        </div>
                    </div>
                    <div class="row pdt-20">
                        <div class="col-md-4">
                            <h4 class="text-black m-0">Tahun Kelulusan<span class="text-red"> *</span></h4>
                            <p class="text-muted mt-0 text-sm">Tahun Kelulusan Alumni</p>
                        </div>
                        <div class="col-md-8 pdt-6">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01">Pilih</label>
                                <select class="form-select" id="inputGroupSelect01" name="tahun_lulus">
                                    <option selected="">Tahun Lulus</option>
                                    <option value="#">#</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row pdt-20">
                        <div class="col-md-4">
                            <h4 class="text-black m-0">Jurusan<span class="text-red"> *</span></h4>
                            <p class="text-muted mt-0 text-sm">Jurusan Alumni</p>
                        </div>
                        <div class="col-md-8 pdt-6">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01">Pilih</label>
                                <select class="form-select" id="inputGroupSelect01" name="jurusan">
                                    <option selected="">Jurusan</option>
                                    <option value="#">#</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mrt-6">
                        <div class="col-md-12 pdt-6" style="text-align: right">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                            <a class="btn btn-secondary" href="/admin/administrator/master/company">Cencel</a>
                        </div>
                    </div>
                </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body collapse show">
                    <div class="row">
                        <div class="col-md-9">
                            <h3 class="card-title">Pengguna</h3>
                            <h6 class="card-subtitle">Data Akses Pengguna</h6>
                        </div>
                    </div>
                    <div class="row pdt-20">
                        <div class="col-md-4">
                            <h4 class="text-black m-0">E-Mail<span class="text-red"> *</span></h4>
                            <p class="text-muted mt-0 text-sm">E-Mail Perusahaan</p>
                        </div>
                        <div class="col-md-8 pdt-6">
                            <input type="text" class="form-control font-weight-normal"
                                placeholder="E-Mail Perusahaan..." name="email">
                        </div>
                    </div>
                    <div class="row mrt-6">
                        <div class="col-md-4">
                            <h4 class="text-black m-0">Username<span class="text-red"> *</span></h4>
                            <p class="text-muted mt-0 text-sm">Username Perusahaan</p>
                        </div>
                        <div class="col-md-8 pdt-6">
                            <input type="text" class="form-control font-weight-normal"
                                placeholder="Username Perusahaan..." name="username">
                        </div>
                    </div>
                    <div class="row mrt-6">
                        <div class="col-md-4">
                            <h4 class="text-black m-0">Password<span class="text-red"> *</span></h4>
                            <p class="text-muted mt-0 text-sm">Password Pengguna Perusahaan</p>
                        </div>
                        <div class="col-md-8 pdt-6">
                            <input type="text" class="form-control font-weight-normal"
                                placeholder="Password Pengguna Perusahaan..." name="password">
                        </div>
                    </div>
                    <div class="row mrt-6">
                        <div class="col-md-12 pdt-6" style="text-align: right">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                            <a class="btn btn-secondary" href="/admin/administrator/master/company">Cencel</a>
                        </div>
                    </div>
                </form>
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
