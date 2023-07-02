@extends('layout.kepalasekolah.layout')
@section('css-tambahan')
    <link href="{{ URL::asset('asset/plugins/adminpage/costume.css') }}" rel="stylesheet">
@endsection
@section('page-wrapper')

<div class="row mt-rs-4">
    <div class="col-sm-4 mb-4 mb-xl-0">
        <div class="d-lg-flex align-items-center">
            <div>
                <h3 class="text-dark font-weight-bold mb-2">Daftar Alumni</h3>
                <h6 class="font-weight-normal mb-2">Alumni-Alumni Yang Telah Lulus Dari SMKN 4 Banjarmasin</h6>
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
    <div class="row-12 mt-4">
        <div class="row-12">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body collapse show">
                        <div class="row">
                            <div class="col-md-9">
                                <h4 class="card-title">Pencarian Alumni</h4>
                            </div>
                        </div>
                        <form action="/kepala-sekolah/alumni/search+" method="get">
                            @csrf
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <select class="form-select full-size-width" id="inputGroupSelect01" name="idjurusan">
                                        <option selected="">Jurusan</option>
                                        @foreach ($jurusan as $item)
                                            <option value="{{ $item->id }}">{{ $item->jurusan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <select class="form-select full-size-width" id="inputGroupSelect01" name="idtahunlulus">
                                        <option selected="">Tahun Lulus</option>
                                        @foreach ($tahunlulus as $item)
                                            <option value="{{ $item->id }}">{{ $item->tahun_lulus }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <input type="text" id="nama_alumni" name="nama_alumni" class="form-control" placeholder="Nama Alumni" value="{{ request('nama_alumni') }}">
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary full-size-width">Cari
                                        Alumni</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            @foreach ($Alumnidata as $alumni)
                <div class="col-lg-4 col-md-6">
                    <div class="card border-top-black-300 mt-5">
                        <div class="col-md-12 p-4">
                            <h4 class="card-title">{{ $alumni->nama }}</h4>
                            <p class="card-description text-primary">
                                Kelengkapan Profile {{ $percentasaeprofile[$alumni->nisn] }}
                            </p>
                            <ul class="list-unstyled">
                                <li class="media d-flex align-items-start company-show">
                                    <img class="d-flex me-3 logo-company"
                                        src="{{ URL::asset('storage') . '/' . $alumni->photo_profile }}" alt="Image"
                                        width="100">
                                    <div class="media-body">
                                        <ul class="list-unstyled">
                                            <li class="card-text"><i class="mdi mdi-calendar-clock  text-black"></i> <span class="status-alumni">Lulus Tahun - {{ $alumni->tahunlulus->tahun_lulus ?? '-'}}</span></li>
                                            <li class="card-text"><i class="mdi mdi-school text-black"></i> <span class="status-alumni">{{ $alumni->jurusan->jurusan ?? '-'}}</span></li>
                                            <li class="card-text"><i class="mdi mdi-cake-layered  text-black"></i> <span class="status-alumni">{{ $alumni->tempatTanggalLahir ?? '-'}}</span></li>
                                            <li class="card-text"><i class=" mdi mdi-account text-black"></i> <span class="status-alumni">{{ $alumni->Jenis_Kelamin->jenis_kelamin ?? '-'}}</span></li>
                                            <li class="card-text"><i class="mdi mdi-phone text-black"></i> <span class="status-alumni">{{ $alumni->no_hp ?? '-'}}</span></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <a href="/kepala-sekolah/alumni/profile-detail/{{ $alumni->nama }}" class="btn btn-primary">Profile Alumni</a>
                    </div>
                </div>
            @endforeach
            <div class="pagination d-flex justify-content-center mt-3">{{ $Alumnidata->links() }}</div>
        </div>
    </div>
    @endsection
    @section('js-tambahan')
    @endsection
