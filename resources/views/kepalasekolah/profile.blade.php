@extends('layout.kepalasekolah.layout')
@section('css-tambahan')
    <link href="{{ URL::asset('asset/plugins/adminpage/costume.css') }}" rel="stylesheet">
@endsection
@section('page-wrapper')
    <div class="row mt-rs-4">
        <div class="row mt-rs-4">
            <div class="col-sm-4 mb-4 mb-xl-0">
                <div class="d-lg-flex align-items-center">
                    <div>
                        <h3 class="text-dark font-weight-bold mb-2">Profile Anda</u></h3>
                        <h6 class="font-weight-normal mb-2">Bursa Kerja Khusus - SMKN 4 Banjarmasin</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="d-flex align-items-center justify-content-evenly">
                    <div class="pe-1 mb-3 mb-xl-0">
                        <a href="/kepala-sekolah/daftar-alumni" class="btn btn-outline-inverse-info btn-icon-text">
                            Daftar Alumni
                        </a>
                    </div>
                    <div class="pe-1 mb-3 mb-xl-0">
                        <a href="/kepala-sekolah/daftar-perusahaan" class="btn btn-outline-inverse-info btn-icon-text">
                            Daftar Perusahaan
                        </a>
                    </div>
                    <div class="pe-1 mb-3 mb-xl-0">
                        <a href="/kepala-sekolah/report/yearly" class="btn btn-outline-inverse-info btn-icon-text">
                            Laporan Tahun Kelulusan
                        </a>
                    </div>
                    <div class="pe-1 mb-3 mb-xl-0">
                        <a href="/kepala-sekolah/profile/{{ Auth()->user()->name }}"
                            class="btn btn-outline-inverse-info btn-icon-text">
                            Edit Profile
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
                                    <h3 class="card-title">Informasi Profil <span
                                            style="text-decoration-line: underline;">{{ $dataKepalaSekolah->nama }}</span></h3>
                                    <h6 class="card-subtitle">Data Personal dan Deskripsi</h6>
                                </div>
                            </div>
                            <form action="/kepala-sekolah/profile/{{ $dataKepalaSekolah->nama }}/update" method="post"
                                enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <input type="hidden" name="id" value="{{ $dataKepalaSekolah->id }}">
                                <div class="row pdt-20">
                                    <div class="col-md-4">
                                        <h4 class="text-black m-0">Nama Kepala Sekolah<span class="text-red"> *</span></h4>
                                        <p class="text-muted mt-0 text-sm">Nama Lengkap Kepala Sekolah</p>
                                    </div>
                                    <div class="col-md-8 pdt-6">
                                        <input type="text" name="nama"
                                            class="form-control font-weight-normal @error('nama') is-invalid @enderror"
                                            value="{{ old('nama', $dataKepalaSekolah->nama) }}">
                                        @error('nama')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row pdt-20">
                                    <div class="col-md-4">
                                        <h4 class="text-black m-0">Kutipan <span class="text-red"> *</span></h4>
                                        <p class="text-muted mt-0 text-sm">Kutipan Yang Ingin Anda Sampaikan</p>
                                    </div>
                                    <div class="col-md-8">
                                        <input id="kutipan" placeholder="Kutipan Anda..."
                                            class="form-control font-weight-normal @error('kutipan') is-invalid @enderror"
                                            type="hidden" name="kutipan"
                                            value="{{ old('kutipan', $dataKepalaSekolah->kutipan) }}">
                                        <trix-editor input="kutipan"></trix-editor>
                                        @error('kutipan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row pdt-20">
                                    <div class="col-md-4">
                                        <h4 class="text-black m-0">Lama Menjabat <span class="text-red"> *</span></h4>
                                        <p class="text-muted mt-0 text-sm">Lama Menjabat Sebagai Kepala Sekolah</p>
                                    </div>
                                    <div class="col-md-8 pdt-6">
                                        <input type="text" name="tahun_jabatan"
                                            class="form-control font-weight-normal @error('tahun_jabatan') is-invalid @enderror"
                                            value="{{ old('tahun_jabatan', $dataKepalaSekolah->tahun_jabatan) }}">
                                        @error('tahun_jabatan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mrt-6">
                                    <div class="col-md-4">
                                        <h4 class="text-black m-0">Jenis Kelamin<span class="text-red"> *</span></h4>
                                        <p class="text-muted mt-0 text-sm">Jenis Kelamin Anda</p>
                                    </div>
                                    <div class="col-md-8 pdt-6">
                                        <div class="input-group mb-3">
                                            <label class="input-group-text" for="jenis_kelamin">Pilih</label>
                                            <select class="form-select @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin">
                                                <option selected>Jenis Kelamin</option>
                                                @foreach ($dataJenisKelamin as $item)
                                                    @if (old('jenis_kelamin', $dataKepalaSekolah->jenis_kelamin) == $item->id)
                                                        <option value="{{ $item->id }}" selected>{{ $item->jenis_kelamin }}</option>
                                                    @else
                                                        <option value="{{ $item->id }}">{{ $item->jenis_kelamin }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('jenis_kelamin')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row pdt-20">
                                    <div class="col-md-4">
                                        <h4 class="text-black m-0">NO Telepon <span class="text-red"> *</span></h4>
                                        <p class="text-muted mt-0 text-sm">Bisa Saja Isikan Nomor Telepon Sekolah</p>
                                    </div>
                                    <div class="col-md-8 pdt-6">
                                        <input type="text" name="no_telp"
                                            class="form-control font-weight-normal @error('no_telp') is-invalid @enderror"
                                            value="{{ old('no_telp', $dataKepalaSekolah->no_telp) }}">
                                        @error('no_telp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <h4 class="text-black m-0">Photo Profile<span class="text-red"> *</span></h4>
                                        <p class="text-muted mt-0 text-sm">Photo Profile Yang Ingin Anda Gunakan</p>
                                    </div>
                                    <div class="col-md-8 pdt-6">
                                        <input type="hidden" name="oldphoto_profile" value="{{ $dataKepalaSekolah->photo_profile }}">
                                        <input class="form-control @error('photo_profile') is-invalid @enderror"
                                            name="photo_profile" type="file" id="formFile"
                                            value="{{ old('photo_profile') }}">
                                        @error('photo_profile')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row-12 my-3">
                                    <div class="col">
                                        <span class="fw-bold mt-0 text-sm text-red"
                                            style="text-decoration: underline">Kosongkan file jika tidak ingin
                                            dirubah</span>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-body collapse show">
                            <div class="row">
                                <div class="col-md-9">
                                    <h3 class="card-title">Pengguna <span
                                            style="text-decoration-line: underline;">{{ $dataKepalaSekolah->nama }}</span></h3>
                                    <h6 class="card-subtitle">Data Akses Pengguna</h6>
                                </div>
                            </div>
                            <div class="row mrt-6">
                                <div class="col-md-4">
                                    <h4 class="text-black m-0">Username<span class="text-red"> *</span></h4>
                                    <p class="text-muted mt-0 text-sm">Username Kepala Sekolah</p>
                                </div>
                                <div class="col-md-8 pdt-6">
                                    <input type="text"
                                        class="form-control font-weight-normal @error('username') is-invalid @enderror"
                                        placeholder="Username..." name="username"
                                        value="{{ old('username', $dataUser->name) }}">
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
                                    <p class="text-muted mt-0 text-sm">E-Mail Kepala Sekolah</p>
                                </div>
                                <div class="col-md-8 pdt-6">
                                    <input type="email"
                                        class="form-control font-weight-normal @error('email') is-invalid @enderror"
                                        placeholder="E-Mail..." name="email"
                                        value="{{ old('email', $dataUser->email) }}">
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
                                    <p class="text-muted mt-0 text-sm">Password Pengguna User</p>
                                </div>
                                <div class="col-md-8 pdt-6">
                                    <input type="password"
                                        class="form-control font-weight-normal @error('password') is-invalid @enderror"
                                        placeholder="Password Pengguna..." name="password"
                                        value="{{ old('password') }}">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12 my-3">
                                    <span class="fw-bold mt-0 text-sm text-red"
                                        style="text-decoration: underline">Kosongkan password jika tidak ingin
                                        dirubah</span>
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
