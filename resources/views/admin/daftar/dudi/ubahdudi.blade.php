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
                    <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Merubah Profile Perusahaan</h3>
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
                            <h3 class="card-title">Informasi Profil <u>{{ $datadudi->nama ??'-' }}</u></h3>
                            <h6 class="card-subtitle">Data Personal dan Deskripsi</h6>
                        </div>
                    </div>
                    <form action="/admin/administrator/master/company/update" method="POST" enctype="multipart/form-data">
                        @csrf
                            <input type="hidden" name="id" class="form-control font-weight-normal"
                                value="{{ $datadudi->id ?? '-' }}">
                    <div class="row pdt-20">
                        <div class="col-md-4">
                            <h4 class="text-black m-0">Nama Perusahaan<span class="text-red"> *</span></h4>
                            <p class="text-muted mt-0 text-sm">Nama Lengkap Perusahaan</p>
                        </div>
                        <div class="col-md-8 pdt-6">
                            <input type="text" name="nama" class="form-control font-weight-normal"
                                value="{{ $datadudi->nama ?? '-' }}">
                        </div>
                    </div>
                    <div class="row mrt-6">
                        <div class="col-md-4">
                            <h4 class="text-black m-0">Bidang Perusahaan<span class="text-red"> *</span></h4>
                            <p class="text-muted mt-0 text-sm">Bidang Operasi Perusahaan</p>
                        </div>
                        <div class="col-md-8 pdt-6">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01">Pilih</label>
                                <select class="form-select" id="inputGroupSelect01" name="bidang">
                                    @foreach ($bidangdata as $item)
                                    <option value="{{ $item->nama_kategori ?? '-' }}" {{ $datadudi->bidang==$item->nama_kategori ? 'selected' : ''  }}>{{ $item->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div> 
                    <div class="row mrt-6">
                        <div class="col-md-4">
                            <h4 class="text-black m-0">No Telpon<span class="text-red"> *</span></h4>
                            <p class="text-muted mt-0 text-sm">No WhatsApp Perusahaan</p>
                        </div>
                        <div class="col-md-8 pdt-6">
                            <input type="text" name="no_telp" class="form-control font-weight-normal"
                                value="{{ $datadudi->no_telp ?? '-' }}">
                        </div>
                    </div>
                    <div class="row pdt-20">
                        <div class="col-md-4">
                            <h4 class="text-black m-0">Deskripsi<span class="text-red"> *</span></h4>
                            <p class="text-muted mt-0 text-sm">Deskripsi Perusahaan Anda</p>
                        </div>
                        <div class="col-md-8">
                            <input id="deskripsi" value="{{ $datadudi->deskripsi ?? '-' }}" class="form-control font-weight-normal" type="hidden" name="deskripsi" value="{{ old('biografi') }}" >
                            <trix-editor input="deskripsi"></trix-editor>
                        </div>
                    </div>
                    <div class="row mrt-6">
                        <div class="col-md-4">
                            <h4 class="text-black m-0">Alamat Perusahaan<span class="text-red"> *</span></h4>
                            <p class="text-muted mt-0 text-sm">Alamat Perusahaan Anda</p>
                        </div>
                        <div class="col-md-8 pdt-6">
                            <div class="form-group">
                                <textarea class="form-control" name="alamat" rows="3">{{ $datadudi->alamat ??'-' }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <h4 class="text-black m-0">Logo Perusahaan<span class="text-red"> *</span></h4>
                            <p class="text-muted mt-0 text-sm">Kosongkan untuk tidak merubah Logo</p>
                        </div>
                        <div class="col-md-8 pdt-6">
                            <input class="form-control" name="logo" type="file" id="formFile">
                        </div>
                    </div>
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
                                value="{{ $dudiakun->email ??'-' }}" name="email">
                        </div>
                    </div>
                    <div class="row mrt-6">
                        <div class="col-md-4">
                            <h4 class="text-black m-0">Username<span class="text-red"> *</span></h4>
                            <p class="text-muted mt-0 text-sm">Username Perusahaan</p>
                        </div>
                        <div class="col-md-8 pdt-6">
                            <input type="text" class="form-control font-weight-normal"
                                value="{{ $dudiakun->name ??'-' }}" name="username">
                        </div>
                    </div>
                    <div class="row mrt-6">
                        <div class="col-md-4">
                            <h4 class="text-black m-0">Password<span class="text-red"> *</span></h4>
                            <p class="text-muted mt-0 text-sm">Kosongkan Untuk Tidak Mengubah Password</p>
                        </div>
                        <div class="col-md-8 pdt-6">
                            <input type="text" class="form-control font-weight-normal"
                                value="" name="password">
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
