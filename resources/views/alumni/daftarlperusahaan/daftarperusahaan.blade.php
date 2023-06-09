@extends('layout.alumni.layout')
@section('css-tambahan')
    <link href="{{ URL::asset('asset/plugins/adminpage/costume.css') }}" rel="stylesheet">
@endsection
@section('page-wrapper')
    <div class="row">
        <div class="col-sm-6 mb-4 mb-xl-0">
            <div class="d-lg-flex align-items-center">
                <div>
                    <h3 class="text-dark font-weight-bold mb-2">Daftar Perusahaan Yang Tersedia</h3>
                    <h6 class="font-weight-normal mb-2">Bursa Kerja Khusus - SMKN 4 Banjarmasin </h6>
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
    <div class="row-12">
        <div class="row mt-4">
            <div class="col-sm-12 mr">
                <div class="card">
                    <div class="card-body collapse show">
                        <div class="row">
                            <div class="col-md-9">
                                <h4 class="card-title">Pencarian Perusahaan</h4>
                            </div>
                        </div>
                        <form action="/daftar-perusahaan/search+" method="get">
                            @csrf
                            <div class="row pdt-20">
                                <div class="col-md-8 mb-3">
                                    <input type="text" id="" name="nama_perusahaan" class="form-control"
                                        placeholder="Nama Perusahaan..." style="height: 40px">
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary full-size-width">Cari
                                        Perusahaan</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4 d-flex justify-content-evenly">
            @if ($perusahaan[0] == null)
                <div class="col-sm-12 mr">
                    <div class="card">
                        <div class="card-body collapse show">
                            <div class="row">
                                <div class="col-md-12 text-center mt-3">
                                    <h4 class="card-title">Perusahaan / Dudi Tidak Tersedia</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @foreach ($perusahaan as $dataperusahaan)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-top-black-300 mt-5">
                        <div class="col-md-12 p-4">
                            <h4 class="card-title">{{ $dataperusahaan->nama }}</h4>
                            <ul class="list-unstyled">
                                <li class="media d-flex align-items-start company-show">
                                    <img class="d-flex me-3 logo-company"
                                        src="/images/profileimg/{{ $dataperusahaan->logo }}" alt="Image" width="100">
                                    <div class="media-body">
                                        <ul class="list-unstyled">
                                            <li><i class="mdi mdi-newspaper color-23"></i> <span
                                                    class="mrl-5 text-black">{{ $countlowongan[$dataperusahaan->id] }}
                                                    Lowongan Aktif</span></li>
                                            <li><i class="mdi mdi-clipboard-text color-23"></i> <span
                                                    class="mrl-5 text-black">{{ $dataperusahaan->bidang }}</span></li>
                                            <li><i class="mdi mdi-phone color-23"></i> <span
                                                    class="mrl-5 text-black">{{ $dataperusahaan->no_telp }}</span></li>
                                            <li><i class="mdi mdi-map-marker color-23"></i> <span
                                                    class="mrl-5 text-black">{{ $dataperusahaan->alamat }}</span></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <a href="/perusahaan/profile/{{ $dataperusahaan->nama }}" class="btn btn-primary">Profile
                            Perusahaan</a>
                    </div>
                </div>
            @endforeach
            <div class="pagination d-flex justify-content-center mt-3">{{ $perusahaan->links() }}</div>
        </div>
        <div class="row-12 my-4">
            <div class="col">
                <div class="d-flex justify-content-center bg-primary rounded">
                    <h2 class="text-light p-3">Sekilas Lowongan</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @if ($lowongan[0] == null)
                <div class="col-sm-12 mr">
                    <div class="card">
                        <div class="card-body collapse show">
                            <div class="row">
                                <div class="col-md-12 text-center mt-3">
                                    <h4 class="card-title">Tidak Tersedia</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @foreach ($lowongan as $datalowongan)
                <div class="col-lg-4 col-md-6">
                    <div class="card border-top-black-300 mb-3">
                        <div class="col-md-12 p-4">
                            <h4 class="card-title">{{ $datalowongan->nama }}</h4>
                            <ul class="list-unstyled">
                                <li class="media d-flex align-items-start company-show">
                                    <img class="d-flex me-3 logo-company"
                                        src="/images/profileimg/{{ $datalowongan->dudi->logo }}" alt="Image"
                                        width="100">
                                    <div class="media-body">
                                        <ul class="list-unstyled">
                                            <li><i class="mdi mdi-hospital-building color-23"></i> <span
                                                    class="mrl-5 text-black">{{ $datalowongan->dudi->nama }}</span></li>
                                            <li><i class="mdi mdi-clipboard-outline color-23"></i> <span
                                                    class="mrl-5 text-black">{{ $datalowongan->dudi->bidang }}</span></li>
                                            <li><i class="mdi mdi-calendar color-23"></i> <span
                                                    class="mrl-5 text-black">{{ $datalowongan->tgl_upload }}</span></li>
                                            <li><i class="mdi mdi-map-marker color-23"></i> <span
                                                    class="mrl-5 text-black">{{ $datalowongan->lokasi }}</span></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <a href="/lowongan-kerja/detail/{{ $datalowongan->nama }}" class="btn btn-primary">Detail
                            Lowongan</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endsection
    @section('js-tambahan')
    @endsection
