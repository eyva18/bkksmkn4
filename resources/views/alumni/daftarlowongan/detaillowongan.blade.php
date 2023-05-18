@extends('layout.alumni.layout')
@section('css-tambahan')
    <link href="{{ URL::asset('asset/plugins/adminpage/costume.css') }}" rel="stylesheet">
@endsection
@section('page-wrapper')
    <div class="row">
        <div class="col-sm-6 mb-4 mb-xl-0">
            <div class="d-lg-flex align-items-center">
                <div>
                    <h3 class="text-dark font-weight-bold mb-2">Detail Lowongan </h3>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
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
                    <a href="/profile/{{ $dataAlumni->nama }}" class="btn btn-outline-inverse-info btn-icon-text">
                        Profile Saya
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-sm-4 flex-column d-flex stretch-card">
            <div class="row flex-grow">
                <div class="col-sm-12 grid-margin stretch-card">
                    <div class="card">
                        <img class="card-img-top img-fluid"
                            src="/images/profileimg/{{ $datalowongan->dudi->logo ?? null}}"
                            alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title">{{ $datalowongan->nama ?? '-'}}</h4>
                            <p class="card-text"><i class="mdi mdi-hospital-building text-black"></i> <span class="status-alumni">{{ $datalowongan->dudi->nama ?? '-'}}</span></p>
                            <p class="card-text"><i class="mdi mdi-map-marker text-black"></i> <span class="status-alumni">{{ $datalowongan->lokasi ?? '-'}}</span></p>
                            <p class="card-text"><i class="mdi mdi-calendar text-black"></i> <span class="status-alumni">{{ $datalowongan->tgl_upload ?? '-'}}</span></p>
                            <p class="card-text"><i class="mdi mdi-clipboard-outline text-black"></i> <span class="status-alumni">{{ $datalowongan->kategori->nama_kategori ?? '-'}}</span></p>
                            <p class="card-text"><i class=" mdi mdi-currency-usd  text-black"></i> <span class="status-alumni">{{ $datalowongan->gaji ?? '-'}}</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-8 flex-column d-flex stretch-card">
            <div class="row">
                <div class="col-sm-12 col-lg-6 grid-margin d-flex stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between top-card">
                                <h4 class="card-title mb-2">Deskripsi Pekerjaan</h4>
                            </div>
                            {{ $datalowongan->deskripsi_pekerjaan ?? '-'}}
                            <div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-6 grid-margin d-flex stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between top-card">
                                <h4 class="card-title mb-2">Deskripsi Perusahaan</h4>
                            </div>
                            {{ $datalowongan->deskripsi_perusahaan ?? '-'}}
                            <div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-6 mb-3">
                    <div class="card border-top-blue-300">
                        <div class="col-md-12 p-4">
                            <h4 class="card-title">{{ $datalowongan->dudi->nama ?? '-'}}</h4>
                            <ul class="list-unstyled">
                                <li class="media d-flex align-items-start company-show">
                                    <img class="d-flex me-3 logo-company" src="/images/profileimg/{{ $datalowongan->dudi->logo ?? '-'}}" alt="Logo Test" width="100">
                                    <div class="media-body">
                                        <ul class="list-unstyled">
                                            <li><i class="mdi mdi-clipboard-text  color-23"></i> <span class="mrl-5 text-black">{{ $datalowongan->dudi->bidang ?? '-'}}</span></li>
                                            <li><i class="mdi mdi-phone color-23"></i> <span class="mrl-5 text-black">{{ $datalowongan->dudi->no_telp ?? '-'}}</span></li>
                                            <li><i class="mdi mdi-map-marker  color-23"></i> <span class="mrl-5 text-black">{{ $datalowongan->dudi->alamat ?? '-'}}</span></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <a href="/perusahaan/{{ $datalowongan->dudi->nama }}" class="btn btn-primary">Detail Perusahaan</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row-12 my-4">
            <div class="col">
                <div class="d-flex justify-content-center bg-primary rounded">
                    <h2 class="text-light p-3">Sekilas Lowongan Lainnya</h2>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-between">
            @if ($lowongansekilas[0] == null)
            <div class="col-sm-12 mr">
                <div class="card">
                    <div class="card-body collapse show">
                        <div class="row">
                            <div class="col-md-12 text-center mt-3">
                                <h4 class="card-title">Lowongan Lainnya Tidak Tersedia</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
            @foreach ($lowongansekilas as $item)
            <div class="col-md-6 col-lg-4">
                <div class="card border-top-black-300 mb-3">
                    <div class="col-md-12 p-4">
                        <h4 class="card-title">{{ $item->nama }}</h4>
                        <ul class="list-unstyled">
                            <li class="media d-flex align-items-start company-show">
                                <img class="d-flex me-3 logo-company" src="/images/profileimg/{{ $item->dudi->logo }}" alt="Logo Test" width="100">
                                <div class="media-body">
                                    <ul class="list-unstyled">
                                        <li><i class="mdi mdi-hospital-building color-23"></i> <span class="mrl-5 text-black">{{ $item->dudi->nama }}</span></li>
                                        <li><i class="mdi mdi-clipboard-outline color-23"></i> <span class="mrl-5 text-black">{{ $item->kategori->nama_kategori }}</span></li>
                                        <li><i class="mdi mdi-calendar color-23"></i> <span class="mrl-5 text-black">{{ $item->tgl_upload }}</span></li>
                                        <li><i class="mdi mdi-map-marker color-23"></i> <span class="mrl-5 text-black">{{ $item->kategori->nama_kategori }}</span></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <a href="/lowongan-kerja/detail/{{ $item->nama }}" class="btn btn-primary">Detail Lowongan</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endsection
    @section('js-tambahan')
    @endsection
