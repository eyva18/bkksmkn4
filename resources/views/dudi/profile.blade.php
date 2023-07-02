@extends('layout.dudi.layout')
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
                        <a href="/company/daftar-alumni" class="btn btn-outline-inverse-info btn-icon-text">
                            Daftar Alumni
                        </a>
                    </div>
                    <div class="pe-1 mb-3 mb-xl-0">
                        <a href="/company/daftar-lowongan" class="btn btn-outline-inverse-info btn-icon-text">
                            Daftar Lowongan
                        </a>
                    </div>
                    <div class="pe-1 mb-3 mb-xl-0">
                        <a href="/company/profile/{{ $dataDudi->nama }}" class="btn btn-outline-inverse-info btn-icon-text">
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
                                            style="text-decoration-line: underline;">{{ $dataDudi->nama }}</span></h3>
                                    <h6 class="card-subtitle">Data Personal dan Deskripsi</h6>
                                </div>
                            </div>
                            <form action="/company/profile/{{ $dataDudi->nama }}/update" method="post"
                                enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <input type="hidden" name="id" value="{{ $dataDudi->id }}">
                                <div class="row pdt-20">
                                    <div class="col-md-4">
                                        <h4 class="text-black m-0">Nama Perusahaan<span class="text-red"> *</span></h4>
                                        <p class="text-muted mt-0 text-sm">Nama Lengkap Perusahaan</p>
                                    </div>
                                    <div class="col-md-8 pdt-6">
                                        <input type="text" name="nama"
                                            class="form-control font-weight-normal @error('nama') is-invalid @enderror"
                                            value="{{ old('nama', $dataDudi->nama) }}">
                                        @error('nama')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row pdt-20">
                                    <div class="col-md-4">
                                        <h4 class="text-black m-0">Bidang Perusahaan<span class="text-red"> *</span></h4>
                                        <p class="text-muted mt-0 text-sm">Bidang Operasi Perusahaan</p>
                                    </div>
                                    <div class="col-md-8 pdt-6">
                                        <input type="text" name="bidang"
                                            class="form-control font-weight-normal @error('bidang') is-invalid @enderror"
                                            value="{{ old('bidang', $dataDudi->bidang) }}">
                                        @error('bidang')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row pdt-20">
                                    <div class="col-md-4">
                                        <h4 class="text-black m-0">No Telpon <span class="text-red"> *</span></h4>
                                        <p class="text-muted mt-0 text-sm">No WhatsApp Perusahaan</p>
                                    </div>
                                    <div class="col-md-8 pdt-6">
                                        <input type="text" name="no_telp"
                                            class="form-control font-weight-normal @error('no_telp') is-invalid @enderror"
                                            value="{{ old('no_telp', $dataDudi->no_telp) }}">
                                        @error('no_telp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row pdt-20">
                                    <div class="col-md-4">
                                        <h4 class="text-black m-0">Deskripsi <span class="text-red"> *</span></h4>
                                        <p class="text-muted mt-0 text-sm">Deskripsi Perusahaan Anda</p>
                                    </div>
                                    <div class="col-md-8">
                                        <input id="deskripsi" placeholder="Tentang diri anda"
                                            class="form-control font-weight-normal @error('deskripsi') is-invalid @enderror"
                                            type="hidden" name="deskripsi"
                                            value="{{ old('deskripsi', $dataDudi->deskripsi) }}">
                                        <trix-editor input="deskripsi"></trix-editor>
                                        @error('deskripsi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mrt-6">
                                    <div class="col-md-4">
                                        <h4 class="text-black m-0">Alamat<span class="text-red"> *</span></h4>
                                        <p class="text-muted mt-0 text-sm">Alamat Domisi Anda</p>
                                    </div>
                                    <div class="col-md-8 pdt-6">
                                        <div class="form-group">
                                            <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" rows="7"
                                                placeholder="Alamat Rumah...">{{ old('alamat', $dataDudi->alamat) }}</textarea>
                                            @error('alamat')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <h4 class="text-black m-0">Logo Perusahaan<span class="text-red"> *</span></h4>
                                        <p class="text-muted mt-0 text-sm">Diutamakan Ukuran 300x300</p>
                                    </div>
                                    <div class="col-md-8 pdt-6">
                                        <input type="hidden" name="oldlogo" value="{{ $dataDudi->logo }}">
                                        <input class="form-control @error('logo') is-invalid @enderror"
                                            name="logo" type="file" id="formFile"
                                            value="{{ old('logo') }}">
                                        @error('logo')
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
                                            style="text-decoration-line: underline;">{{ $dataDudi->nama }}</span></h3>
                                    <h6 class="card-subtitle">Data Akses Pengguna</h6>
                                </div>
                            </div>
                            <div class="row mrt-6">
                                <div class="col-md-4">
                                    <h4 class="text-black m-0">Username<span class="text-red"> *</span></h4>
                                    <p class="text-muted mt-0 text-sm"></p>
                                </div>
                                <div class="col-md-8 pdt-6">
                                    <input type="text"
                                        class="form-control font-weight-normal @error('username') is-invalid @enderror"
                                        placeholder="..." name="username"
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
                                    <p class="text-muted mt-0 text-sm"></p>
                                </div>
                                <div class="col-md-8 pdt-6">
                                    <input type="email"
                                        class="form-control font-weight-normal @error('email') is-invalid @enderror"
                                        placeholder="..." name="email"
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
                                    <p class="text-muted mt-0 text-sm">Password Pengguna Perusahaan</p>
                                </div>
                                <div class="col-md-8 pdt-6">
                                    <input type="password"
                                        class="form-control font-weight-normal @error('password') is-invalid @enderror"
                                        placeholder="Password Pengguna Perusahaan..." name="password"
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
