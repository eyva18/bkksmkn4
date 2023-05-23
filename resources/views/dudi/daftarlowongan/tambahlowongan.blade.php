@extends('layout.dudi.layout')
@section('css-tambahan')
    <link href="{{ URL::asset('asset/plugins/adminpage/costume.css') }}" rel="stylesheet">
@endsection
@section('page-wrapper')
    <div class="row mt-rs-4">
        <div class="col-sm-4 mb-4 mb-xl-0">
            <div class="d-lg-flex align-items-center">
                <div>
                    <h3 class="text-dark font-weight-bold mb-2">Tambah Lowongan Lowongan</h3>
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
                                <h3 class="card-title">Informasi Lowongan Pekerjaan </h3>
                                <h6 class="card-subtitle">Data Informasi dan Deskripsi</h6>
                            </div>
                        </div>
                        <form action="/company/lowongan/{{ $dataDudi->nama }}/new" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="iddudi" value="{{ $dataDudi->id }}">
                            <div class="row pdt-20">
                                <div class="col-md-4">
                                    <h4 class="text-black m-0">Posisi Lowongan / Judul Lowongan <span class="text-red">
                                            *</span>
                                    </h4>
                                    <p class="text-muted mt-0 text-sm">Posisi / Judul Lowongan Pekerjaan</p>
                                </div>
                                <div class="col-md-8 pdt-6">
                                    <input type="text" name="nama" class="form-control font-weight-normal"
                                        placeholder="Posisi / Judul Lowongan Pekerjaan">
                                </div>
                            </div>
                            <div class="row pdt-20">
                                <div class="col-md-4">
                                    <h4 class="text-black m-0">Jangkauan Gaji <span class="text-red"> *</span></h4>
                                    <p class="text-muted mt-0 text-sm">Jangkauan Gaji Yang Ditawarkan</p>
                                </div>
                                <div class="col-md-8 pdt-6">
                                    <input type="text" name="gaji" class="form-control font-weight-normal"
                                        placeholder="Contoh: 1 juta - 2 juta">
                                </div>
                            </div>
                            <div class="row mrt-6">
                                <div class="col-md-4">
                                    <h4 class="text-black m-0">Lokasi Pekerjaan<span class="text-red"> *</span></h4>
                                    <p class="text-muted mt-0 text-sm">Lokasi Penempatan Pekerjaan</p>
                                </div>
                                <div class="col-md-8 pdt-6">
                                    <input type="text" name="lokasi" class="form-control font-weight-normal"
                                        placeholder="Daerah, Kota atau Kabupatens">
                                </div>
                            </div>
                            <div class="row pdt-20">
                                <div class="col-md-4">
                                    <h4 class="text-black m-0">Spesialisasi Pekerjaan<span class="text-red"> *</span></h4>
                                    <p class="text-muted mt-0 text-sm">Keahlian Pekerjaan</p>
                                </div>
                                <div class="col-md-8 pdt-6">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="inputGroupSelect01">Pilih</label>
                                        <select class="form-select" id="inputGroupSelect01" name="id_kategoti_pekerjaan">
                                            <option selected="">Spesialis Pekerjaan</option>
                                            @foreach ($category as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row pdt-20">
                                <div class="col-md-4">
                                    <h4 class="text-black m-0">Deskripsi Lowongan Pekerjaan <span class="text-red"> *</span>
                                    </h4>
                                    <p class="text-muted mt-0 text-sm">Deskripsi Pekerjaan ( Persyaratan, Job Desk, Benefit
                                        )</p>
                                </div>
                                <div class="col-md-8">
                                    <input id="deskripsi" placeholder="Tentang diri anda"
                                        class="form-control font-weight-normal" type="hidden" name="deskripsi"
                                        value="{{ old('biografi') }}">
                                    <trix-editor input="deskripsi"></trix-editor>
                                </div>
                            </div>
                            <div class="row mrt-6">
                                <div class="col-md-12 pdt-6" style="text-align: right">
                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                    <a class="btn btn-secondary" href="/company/daftar-lowongan">Cencel</a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js-tambahan')
@endsection
