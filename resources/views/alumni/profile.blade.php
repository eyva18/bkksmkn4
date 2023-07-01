@extends('layout.alumni.layout')
@section('css-tambahan')
    <link href="{{ URL::asset('asset/plugins/adminpage/costume.css') }}" rel="stylesheet">
@endsection
@section('page-wrapper')
    <div class="row mt-rs-4">
        <div class="col-sm-4 mb-4 mb-xl-0">
            <div class="d-lg-flex align-items-center">
                <div>
                    <h3 class="text-dark fw-bold mb-2">Data Profile Anda</u></h3>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="d-flex align-items-center justify-content-evenly">
                <div class="pe-1 mb-3 mb-xl-0">
                    <a href="/lowongan-kerja" class="btn btn-outline-inverse-info btn-icon-text">
                        Daftar Lowongan
                    </a>
                </div>
                <div class="pe-1 mb-3 mb-xl-0">
                    <a href="/daftar-perusahaan" class="btn btn-outline-inverse-info btn-icon-text">
                        Daftar Perusahaan
                    </a>
                </div>
                <div class="pe-1 mb-3 mb-xl-0">
                    <a href="/profile/{{ $alumni->nama }}" class="btn btn-outline-inverse-info btn-icon-text">
                        Profile Saya
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row-12 mt-3">
        <div class="row-12">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body collapse show">
                        <div class="row">
                            <div class="col-md-9">
                                <h3 class="card-title">Informasi Profil <span style="text-decoration-line: underline;">{{ $alumni->nama }}</span></h3>
                                <h6 class="card-subtitle">Data Personal dan Deskripsi</h6>
                            </div>
                        </div>
                        {{-- @dd($alumni->id) --}}
                        <form action="/profile/{{ $alumni->nama }}/update" method="post" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <input type="hidden" name="id" value="{{ $alumni->id }}">
                            {{-- <input type="hidden" name="id" value="{{ user()->id }}"> --}}
                        <div class="row pdt-20">
                            <div class="col-md-4">
                                <h4 class="text-black m-0">NISN<span class="text-red"> *</span></h4>
                                <p class="text-muted mt-0 text-sm">Nomor Induk Siswa Nasional</p>
                            </div>
                            <div class="col-md-8 pdt-6">
                                <input type="text" name="nisn" class="form-control font-weight-normal  @error('nisn') is-invalid @enderror" autofocus value="{{ old('nisn', $alumni->nisn) }}">
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
                                <input type="text" name="nis" class="form-control font-weight-normal @error('nis') is-invalid @enderror" value="{{ old('nis', $alumni->nis) }}">
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
                                <input type="text" name="nama" class="form-control font-weight-normal @error('nama') is-invalid @enderror" value="{{ old('nama', $alumni->nama) }}">
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
                                <input type="text" name="no_hp" class="form-control font-weight-normal @error('no_hp') is-invalid @enderror"  value="{{ old('no_hp', $alumni->no_hp) }}">
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
                                <input id="biografi" placeholder="Tentang diri anda" class="form-control font-weight-normal @error('biografi') is-invalid @enderror" type="hidden" name="biografi" value="{{ old('biografi', $alumni->biografi) }}">
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
                                        <option selected value="">Agama</option>
                                        @foreach ($dataAgama as $item)
                                        @if (old('agamaId', $alumni->agamaId) == $item->id)
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
                                            @if (old('jenis_kelaminId', $alumni->jenis_kelaminId) == $item->id)
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
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" rows="7" placeholder="Alamat Rumah...">{{ old('alamat', $alumni->alamat) }}</textarea>
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
                                <input type="text" name="tempatTanggalLahir" class="form-control font-weight-normal @error('tempatTanggalLahir') is-invalid @enderror" placeholder="Example: Banjarmasin, 1 Januari 2000" value="{{ old('tempatTanggalLahir', $alumni->tempatTanggalLahir) }}">
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
                                <input type="hidden" name="oldPhotoProfile" value="{{ $alumni->photo_profile }}">
                                <input class="form-control @error('photo_profile') is-invalid @enderror" name="photo_profile" type="file" id="formFile" value="{{ old('photo_profile') }}">
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
                                <input type="hidden" name="oldTranskripNilai" value="{{ $alumni->transkrip_nilai }}">
                                <input class="form-control @error('transkrip_nilai') is-invalid @enderror" name="transkrip_nilai" type="file" id="formFile" value="{{ old('transkrip_nilai') }}">
                                @error('transkrip_nilai')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row-12 my-3">
                            <div class="col">
                                {{-- <h4 class="text-black m-0">Photo Profil<span class="text-red"> *</span></h4> --}}
                                <span class="fw-bold mt-0 text-sm text-red" style="text-decoration: underline">Kosongkan file jika tidak ingin dirubah</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-body collapse show">
                        <div class="row">
                            <div class="col-md-9">
                                <h3 class="card-title">Jurusan & Angkatan <span style="text-decoration-line: underline;">{{ $alumni->nama }}</span></h3>
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
                                        <option selected value="">Jurusan</option>
                                        @foreach ($dataJurusan as $item)
                                            @if (old('kode_jurusanId', $alumni->kode_jurusanId) == $item->id)
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
                                        <option selected value="">Tahun Kelulusan</option>
                                        @foreach ($dataTahunLulus as $item)
                                            @if (old('kode_lulusId', $alumni->kode_lulusId) == $item->id)
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
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-body collapse show">
                        <div class="row">
                            <div class="col-md-9">
                                <h3 class="card-title">Status Alumni</h3>
                            </div>
                        </div>
                        <div class="row mrt-6">
                            <div class="col-md-4">
                                <h4 class="text-black m-0">Status Bekerja<span class="text-red"> *</span></h4>
                                {{-- <p class="text-muted mt-0 text-sm">NISN Siswa</p> --}}
                            </div>
                            <div class="col-md-8 pdt-6">
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="kode_statusbekerjaId">Pilih</label>
                                    <select class="form-select @error('status_bekerja') is-invalid @enderror" id="kode_statusbekerjaId" name="status_bekerja">
                                        <option selected value="">Status Bekerja</option>
                                        @foreach ($dataStatusBekerja as $data)
                                            @if (old('status_bekerja', $dataStatusAlumni->status_bekerja) == $data->id)
                                                <option value="{{ $data->id }}" selected>{{ $data->status_bekerja }}</option>
                                            @else
                                                <option value="{{ $data->id }}">{{ $data->status_bekerja }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('status_bekerja')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mrt-6">
                            <div class="col-md-4">
                                <h4 class="text-black m-0">Status Pendidikan<span class="text-red"> *</span></h4>
                                {{-- <p class="text-muted mt-0 text-sm">NISN Siswa</p> --}}
                            </div>
                            <div class="col-md-8 pdt-6">
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="kode_statusbekerjaId">Pilih</label>
                                    <select class="form-select @error('status_pendidikan') is-invalid @enderror" id="kode_statusbekerjaId" name="status_pendidikan">
                                        <option selected value="">Status Pendidikan</option>
                                        @foreach ($dataStatusPendidikan as $data)
                                            @if (old('status_pendidikan', $dataStatusAlumni->status_pendidikan) == $data->id)
                                                <option value="{{ $data->id }}" selected>{{ $data->status_pendidikan }}</option>
                                            @else
                                                <option value="{{ $data->id }}">{{ $data->status_pendidikan }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('status_pendidikan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row pdt-20">
                            <div class="col-md-4">
                                <h4 class="text-black m-0">Universitas <span class="text-red"> *</span></h4>
                                {{-- <p class="text-muted mt-0 text-sm">Universitas</p> --}}
                            </div>
                            <div class="col-md-8 pdt-6">
                                <input type="text" class="form-control font-weight-normal @error('universitas') is-invalid @enderror" name="universitas" value="{{ old('universitas', $dataStatusAlumni->universitas) }}">
                                @error('universitas')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mrt-6">
                            <div class="col-md-4">
                                <h4 class="text-black m-0">Perusahaan<span class="text-red"> *</span></h4>
                                {{-- <p class="text-muted mt-0 text-sm">Perusahaan</p> --}}
                            </div>
                            <div class="col-md-8 pdt-6">
                                <input type="text" class="form-control font-weight-normal @error('perusahaan') is-invalid @enderror" name="perusahaan" value="{{ old('perusahaan', $dataStatusAlumni->perusahaan) }}">
                                @error('perusahaan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-body collapse show">
                            <div class="row">
                                <div class="col-md-9">
                                    <h3 class="card-title">Pengguna <span style="text-decoration-line: underline;">{{ $alumni->nama }}</span></h3>
                                    <h6 class="card-subtitle">Data Akses Pengguna</h6>
                                </div>
                            </div>
                            <div class="row mrt-6">
                                <div class="col-md-4">
                                    <h4 class="text-black m-0">Username<span class="text-red"> *</span></h4>
                                    <p class="text-muted mt-0 text-sm">Username Alumni</p>
                                </div>
                                <div class="col-md-8 pdt-6">
                                    <input type="text" class="form-control font-weight-normal @error('username') is-invalid @enderror" placeholder="Username Alumni..." name="username" value="{{ old('username', $dataUser->name) }}">
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
                                    <p class="text-muted mt-0 text-sm">E-Mail Alumni</p>
                                </div>
                                <div class="col-md-8 pdt-6">
                                    <input type="email" class="form-control font-weight-normal @error('email') is-invalid @enderror" placeholder="E-Mail Alumni..." name="email" value="{{ old('email', $dataUser->email) }}">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mrt-6">
                                <div class="col-md-4">
                                    <h4 class="text-black m-0">Password<span class="text-red"> *</span></h4>
                                    <p class="text-muted mt-0 text-sm">Password Pengguna Alumni</p>
                                </div>
                                <div class="col-md-8 pdt-6">
                                    <input type="password" class="form-control font-weight-normal @error('password') is-invalid @enderror" placeholder="Password Pengguna Alumni..." name="password" value="{{ old('password') }}">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12 my-3">
                                    <span class="fw-bold mt-0 text-sm text-red" style="text-decoration: underline">Kosongkan password jika tidak ingin dirubah</span>
                                </div>
                            </div>
                            <div class="row mrt-6">
                                <div class="col-md-12 pdt-6" style="text-align: right">
                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                    <button class="btn btn-secondary" type="reset">Batal</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('js-tambahan')
    @endsection
