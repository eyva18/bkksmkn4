@extends('layout.dudi.layout')
@section('css-tambahan')
    <link href="{{ URL::asset('asset/plugins/adminpage/costume.css') }}" rel="stylesheet">
@endsection
@section('page-wrapper')
    <div class="row mt-rs-4">
        <div class="col-sm-4 mb-4 mb-xl-0">
            <div class="d-lg-flex align-items-center">
                <div>
                    <h3 class="text-dark font-weight-bold mb-2">Detail Lowongan {{ $datalowongan->nama }}</h3>
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
    <div class="row mt-4">
        <div class="col-sm-4 flex-column d-flex stretch-card">
            <div class="row flex-grow">
                <div class="col-sm-12 grid-margin stretch-card">
                    <div class="card">
                        <img class="card-img-top img-fluid" src="/images/profileimg/{{ $datalowongan->dudi->logo ?? null }}"
                            alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title">{{ $datalowongan->nama ?? '-' }}</h4>
                            <p class="card-text"><i class="mdi mdi-hospital-building text-black"></i> <span
                                    class="status-alumni">{{ $datalowongan->dudi->nama ?? '-' }}</span></p>
                            <p class="card-text"><i class="mdi mdi-map-marker text-black"></i> <span
                                    class="status-alumni">{{ $datalowongan->lokasi ?? '-' }}</span></p>
                            <p class="card-text"><i class="mdi mdi-calendar text-black"></i> <span
                                    class="status-alumni">{{ $datalowongan->tgl_upload ?? '-' }}</span></p>
                            <p class="card-text"><i class="mdi mdi-clipboard-outline text-black"></i> <span
                                    class="status-alumni">{{ $datalowongan->kategori->nama_kategori ?? '-' }}</span></p>
                            <p class="card-text"><i class=" mdi mdi-currency-usd  text-black"></i> <span
                                    class="status-alumni">{{ $datalowongan->gaji ?? '-' }}</span></p>
                            @if ($datalowongan->id_dudi == $dataDudi->id)
                                <p class="card-text">
                                <div class="row">
                                    <a href="/company/lowongan-kerja/edit/{{ $datalowongan->nama }}" class="btn btn-primary text-white status-alumni">Edit Lowongan</a>
                                    <button type="button" class="btn btn-danger text-white mt-2"
                                    data-bs-toggle="modal" data-bs-target="#deletelowongan">Delete Lowongan</button>
                                </div>
                                </p>
                            @endif
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
                            {!! $datalowongan->deskripsi_pekerjaan ?? '-' !!}
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
                            {!! $datalowongan->dudi->deskripsi ?? '-' !!}
                            <div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-6 mb-3">
                    <div class="card border-top-blue-300">
                        <div class="col-md-12 p-4">
                            <h4 class="card-title">{{ $datalowongan->dudi->nama ?? '-' }}</h4>
                            <ul class="list-unstyled">
                                <li class="media d-flex align-items-start company-show">
                                    <img class="d-flex me-3 logo-company"
                                        src="/images/profileimg/{{ $datalowongan->dudi->logo ?? '-' }}" alt="Logo Test"
                                        width="100">
                                    <div class="media-body">
                                        <ul class="list-unstyled">
                                            <li><i class="mdi mdi-clipboard-text  color-23"></i> <span
                                                    class="mrl-5 text-black">{{ $datalowongan->dudi->bidang ?? '-' }}</span>
                                            </li>
                                            <li><i class="mdi mdi-phone color-23"></i> <span
                                                    class="mrl-5 text-black">{{ $datalowongan->dudi->no_telp ?? '-' }}</span>
                                            </li>
                                            <li><i class="mdi mdi-map-marker  color-23"></i> <span
                                                    class="mrl-5 text-black">{{ $datalowongan->dudi->alamat ?? '-' }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Delete Start --}}
    <div id="deletelowongan" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm text-white">
            <div class="modal-content modal-filled bg-danger">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <i class="dripicons-wrong h1"></i>
                        <h4 class="mt-2">Peringatan!</h4>
                        <p class="mt-3">Apakan Ingin Melanjutkan Menghapus data: <br> ID: {{ $datalowongan->id }}
                            | {{ $datalowongan->nama }}</p>
                        <form action="/company/lowongan/delete" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="id" id="newsletter-id" class="form-control form-control-lg"
                                    value="{{ $datalowongan->id }}">
                            </div>
                            <button type="submit" class="btn btn-light my-2 text-red"
                                data-bs-dismiss="modal">Delete</button>
                        </form>
                        <button type="button" class="btn btn-success text-white" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js-tambahan')
@endsection
