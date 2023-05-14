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
                    <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Tambah Alumni</h3>
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
                    <form action="/alumni/store" method="post" enctype="multipart/form-data">
                    @method('post')
                    @csrf
                    <div class="row pdt-20">
                        <div class="col-md-4">
                            <h4 class="text-black m-0">NISN<span class="text-red"> *</span></h4>
                            <p class="text-muted mt-0 text-sm">Nomor Induk Siswa Nasional</p>
                        </div>
                        <div class="col-md-8 pdt-6">
                            <input type="text" name="nisn" class="form-control font-weight-normal  @error('nisn') is-invalid @enderror" required value="{{ old('nisn') }}" autofocus>
                            @error('nisn')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row pdt-20">
                        <div class="col-md-4">
                            <h4 class="text-black m-0">NIS<span class="text-red"> *</span></h4>
                            <p class="text-muted mt-0 text-sm">Nomor Induk Siswa Sekolah</p>
                        </div>
                        <div class="col-md-8 pdt-6">
                            <input type="text" name="nis" class="form-control font-weight-normal @error('nis') is-invalid @enderror" required value="{{ old('nis') }}">
                            @error('nis')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row pdt-20">
                        <div class="col-md-4">
                            <h4 class="text-black m-0">Nama Siswa<span class="text-red"> *</span></h4>
                            <p class="text-muted mt-0 text-sm">Nama Siswa Sesuai Akta Kelahiran</p>
                        </div>
                        <div class="col-md-8 pdt-6">
                            <input type="text" name="nama" class="form-control font-weight-normal @error('nama') is-invalid @enderror" required value="{{ old('nama') }}">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row pdt-20">
                        <div class="col-md-4">
                            <h4 class="text-black m-0">No Handphone <span class="text-red"> *</span></h4>
                            <p class="text-muted mt-0 text-sm">Nomor Handphone / Telepon / Whatsapp</p>
                        </div>
                        <div class="col-md-8 pdt-6">
                            <input type="text" name="no_hp" class="form-control font-weight-normal @error('no_hp') is-invalid @enderror"  required value="{{ old('no_hp') }}">
                            @error('no_hp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row pdt-20">
                        <div class="col-md-4">
                            <h4 class="text-black m-0">Bio <span class="text-red"> *</span></h4>
                            <p class="text-muted mt-0 text-sm">Biografi Anda</p>
                        </div>
                        <div class="col-md-8">
                            <input id="biografi" placeholder="Tentang diri anda" class="form-control font-weight-normal @error('biografi') is-invalid @enderror" type="hidden" name="biografi" value="{{ old('biografi') }}" required>
                            <trix-editor input="biografi"></trix-editor>
                            @error('biografi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mrt-6">
                        <div class="col-md-4">
                            <h4 class="text-black m-0">Agama<span class="text-red"> *</span></h4>
                            <p class="text-muted mt-0 text-sm">Agama / Kepercayaan</p>
                        </div>
                        <div class="col-md-8 pdt-6">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="agamaId">Pilih</label>
                                <select class="form-select @error('agamaId') is-invalid @enderror" id="agamaId" name="agamaId" >
                                    <option selected>Agama</option>
                                    @foreach ($dataAgama as $item)
                                    @if (old('agamaId') == $item->id)
                                        <option value="{{ $item->id }}" selected>{{ $item->agama }}</option>
                                    @else
                                        <option value="{{ $item->id }}">{{ $item->agama }}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @error('agamaId')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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
                                <label class="input-group-text" for="jenis_kelaminId">Pilih</label>
                                <select class="form-select @error('jenis_kelaminId') is-invalid @enderror" id="jenis_kelaminId" name="jenis_kelaminId">
                                    <option selected>Jenis Kelamin</option>
                                    @foreach ($dataJenisKelamin as $item)
                                        @if (old('jenis_kelaminId') == $item->id)
                                            <option value="{{ $item->id }}" selected>{{ $item->jenis_kelamin }}</option>
                                        @else
                                            <option value="{{ $item->id }}">{{ $item->jenis_kelamin }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('jenis_kelaminId')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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
                                <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" rows="7" placeholder="Alamat Rumah..." required>{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row pdt-20">
                        <div class="col-md-4">
                            <h4 class="text-black m-0">Tempat Lahir, Tanggal Lahir <span class="text-red"> *</span></h4>
                            <p class="text-muted mt-0 text-sm">Tempat Lahir, Tanggal Lahir</p>
                        </div>
                        <div class="col-md-8 pdt-6">
                            <input type="text" name="tempatTanggalLahir" class="form-control font-weight-normal @error('tempatTanggalLahir') is-invalid @enderror" placeholder="Example: Banjarmasin, 1 Januari 2000" required value="{{ old('tempatTanggalLahir') }}">
                            @error('tempatTanggalLahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <h4 class="text-black m-0">Photo Profil<span class="text-red"> *</span></h4>
                            <p class="text-muted mt-0 text-sm">Pas Photo, diutamakan Formal</p>
                        </div>
                        <div class="col-md-8 pdt-6">
                            <input class="form-control @error('photo_profile') is-invalid @enderror" name="photo_profile" type="file" id="formFile" required value="{{ old('photo_profile') }}">
                            @error('photo_profile')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <h4 class="text-black m-0">Transkrip Nilai <span class="text-red"> *</span></h4>
                            <p class="text-muted mt-0 text-sm">Transkrip Terakhir</p>
                        </div>
                        <div class="col-md-8 pdt-6">
                            <input class="form-control @error('transkrip_nilai') is-invalid @enderror" name="transkrip_nilai" type="file" id="formFile" required value="{{ old('transkrip_nilai') }}">
                            @error('transkrip_nilai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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
                            <h4 class="text-black m-0">Jurusan<span class="text-red"> *</span></h4>
                            <p class="text-muted mt-0 text-sm">Jurusan Alumni</p>
                        </div>
                        <div class="col-md-8 pdt-6">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="kode_jurusanId">Pilih</label>
                                <select class="form-select @error('kode_jurusanId') is-invalid @enderror" id="kode_jurusanId" name="kode_jurusanId">
                                    <option selected="">Jurusan</option>
                                    @foreach ($dataJurusan as $item)
                                        @if (old('kode_jurusanId') == $item->id)
                                            <option value="{{ $item->id }}" selected>{{ $item->jurusan }}</option>
                                        @else
                                            <option value="{{ $item->id }}">{{ $item->jurusan }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('kode_jurusanId')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row pdt-20">
                        <div class="col-md-4">
                            <h4 class="text-black m-0">Tahun Kelulusan<span class="text-red"> *</span></h4>
                            <p class="text-muted mt-0 text-sm">Tahun Kelulusan Alumni</p>
                        </div>
                        <div class="col-md-8 pdt-6">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="kode_lulusId">Pilih</label>
                                <select class="form-select @error('kode_lulusId') is-invalid @enderror" id="kode_lulusId" name="kode_lulusId">
                                    <option selected>Tahun Kelulusan</option>
                                    @foreach ($dataTahunLulus as $item)
                                        @if (old('kode_lulusId') == $item->id)
                                            <option value="{{ $item->id }}" selected>{{ $item->tahun_lulus }}</option>
                                        @else
                                            <option value="{{ $item->id }}">{{ $item->tahun_lulus }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('kode_lulusId')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mrt-6">
                        <div class="col-md-12 pdt-6" style="text-align: right">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                            <a class="btn btn-secondary" href="/alumni">Batal</a>
                        </div>
                    </div>
                </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body collapse show">
                    <form action="/alumni/buat-akun/" method="post" enctype="multipart/form-data">
                        @method('post')
                        @csrf
                        <div class="row">
                            <div class="col-md-9">
                                <h3 class="card-title">Pengguna</h3>
                                <h6 class="card-subtitle">Data Akses Pengguna</h6>
                            </div>
                        </div>
                        <div class="row mrt-6">
                            <div class="col-md-4">
                                <h4 class="text-black m-0">Username<span class="text-red"> *</span></h4>
                                <p class="text-muted mt-0 text-sm">Username Perusahaan</p>
                            </div>
                            <div class="col-md-8 pdt-6">
                                <input type="text" class="form-control font-weight-normal @error('username') is-invalid @enderror" placeholder="Username Perusahaan..." name="username" value="{{ old('username') }}">
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row pdt-20">
                            <div class="col-md-4">
                                <h4 class="text-black m-0">E-Mail<span class="text-red"> *</span></h4>
                                <p class="text-muted mt-0 text-sm">E-Mail Perusahaan</p>
                            </div>
                            <div class="col-md-8 pdt-6">
                                <input type="email" class="form-control font-weight-normal @error('email') is-invalid @enderror" placeholder="E-Mail Perusahaan..." name="email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mrt-6">
                            <div class="col-md-12 pdt-6" style="text-align: right">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                                <button class="btn btn-primary" type="reset">Batal</button>
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
