@extends('layout.dudi.layout')
@section('css-tambahan')
    <link href="{{ URL::asset('asset/plugins/adminpage/costume.css') }}" rel="stylesheet">
@endsection
@section('page-wrapper')
    <div class="row mt-rs-4">
        <div class="col-sm-4 mb-4 mb-xl-0">
            <div class="d-lg-flex align-items-center">
                <div>
                    <h3 class="text-dark font-weight-bold mb-2">Daftar Lowongan</h3>
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
    <div class="row">
        <div class="col-md-12">
            @if (session()->has('successdelete'))
                <div class="alert alert-info" role="alert">
                    <strong>Info!</strong> {{ session('successdelete') }}
                </div>
            @endif
        </div>
    </div>
    <div class="row mt-4 card pdb-55">
        <div class="col-sm-12 mr mt-4">
            <div class="card">
                <div class="card-body collapse show">
                    <div class="row">
                        <div class="col-md-12 text-center mt-3">
                            <h4 class="card-title">Lowongan Anda <a href="/company/lowongan/create"
                                    class="btn btn-primary mrl-28">+ Posting Lowongan</a></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($lowongandudi[0] == null)
            <div class="col-sm-12 mt-3">
                <div class="card">
                    <div class="card-body collapse show">
                        <div class="row">
                            <div class="col-md-12 text-center mt-3">
                                <h4 class="card-title">Anda Belum Menambahkan Lowongan</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            @foreach ($lowongandudi as $datalowongan)
                <div class="col-lg-4 col-md-6">
                    <div class="card border-top-black-300 mt-5">
                        <div class="col-md-12 p-4">
                            <h4 class="card-title">{{ $datalowongan->nama }}</h4>
                            <ul class="list-unstyled">
                                <li class="media d-flex align-items-start company-show">
                                    <img class="d-flex me-3 logo-company"
                                        src="/images/profileimg/{{ $datalowongan->dudi->logo }}" alt="Logo Test"
                                        width="100">
                                    <div class="media-body">
                                        <ul class="list-unstyled">
                                            <li><i class="mdi mdi-hospital-building color-23"></i> <span
                                                    class="mrl-5 text-black">{{ $datalowongan->dudi->nama }}</span></li>
                                            <li><i class="mdi mdi-clipboard-outline color-23"></i> <span
                                                    class="mrl-5 text-black">{{ $datalowongan->dudi->bidang }}</span>
                                            </li>
                                            <li><i class="mdi mdi-calendar color-23"></i> <span
                                                    class="mrl-5 text-black">{{ $datalowongan->tgl_upload }}</span></li>
                                            <li><i class="mdi mdi-map-marker color-23"></i> <span
                                                    class="mrl-5 text-black">{{ $datalowongan->lokasi }}</span></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <a href="/company/lowongan-kerja/detail/{{ $datalowongan->nama }}"
                            class="btn btn-primary full-size-width bdr-0">Detail Lowongan</a>
                        <ul class="list-unstyled d-flex none-mbt">
                            <li class="half-size-width">
                                <a href="/company/lowongan-kerja/edit/{{ $datalowongan->nama }}" class="btn btn-warning text-white full-size-width bdr-0">Edit</a>
                            </li>
                            <li class="half-size-width">
                                <button type="button" class="btn btn-danger text-white full-size-width bdr-0"
                                    data-bs-toggle="modal" data-bs-target="#deletemodal{{ $datalowongan->id }}">Delete</button>
                            </li>
                        </ul>
                    </div>
                </div>
                {{-- Modal Delete Start --}}
                <div id="deletemodal{{ $datalowongan->id }}" class="modal fade" tabindex="-1" role="dialog"
                    aria-hidden="true">
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
                                            <input type="hidden" name="id" id="newsletter-id"
                                                class="form-control form-control-lg" value="{{ $datalowongan->id }}">
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
            @endforeach
        </div>
        <div class="pagination d-flex justify-content-center mt-3">{{ $lowongandudi->links() }}</div>
    </div>
    <div class="row-12">
        <div class="row mt-4 mb-3">
            <div class="card">
                <div class="card-body collapse show">
                    <div class="row">
                        <div class="col-md-12 text-center mt-3">
                            <h4 class="card-title"><u>Semua Lowongan</u></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-sm-12 mr">
                <div class="card">
                    <div class="card-body collapse show">
                        <div class="row">
                            <div class="col-md-9">
                                <h4 class="card-title">Pencarian Lowongan</h4>
                            </div>
                        </div>
                        <form action="/company/daftar-lowongan/search+" method="get">
                            @csrf
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <select class="form-select full-size-width" id="inputGroupSelect01" name="category">
                                        <option selected="" value="">Spesialis Pekerjaan</option>
                                        @foreach ($category as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <input type="text" id="" name="nama_lowongan" class="form-control"
                                        placeholder="Nama Lowongan..." style="height: 40px">
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary full-size-width">Cari
                                        Lowongan</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @if ($alllowongan[0] == null)
            <div class="col-sm-12 mr">
                <div class="card">
                    <div class="card-body collapse show">
                        <div class="row">
                            <div class="col-md-12 text-center mt-3">
                                <h4 class="card-title">Lowongan Tidak Tersedia</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-sm-12 mt-3">
            <div class="row">
                @foreach ($alllowongan as $datalowongan)
                    <div class="col-lg-4 col-md-6">
                        <div class="card border-top-black-300 mt-5">
                            <div class="col-md-12 p-4">
                                <h4 class="card-title">{{ $datalowongan->nama }}</h4>
                                <ul class="list-unstyled">
                                    <li class="media d-flex align-items-start company-show">
                                        <img class="d-flex me-3 logo-company"
                                            src="/images/profileimg/{{ $datalowongan->dudi->logo }}" alt="Logo Test"
                                            width="100">
                                        <div class="media-body">
                                            <ul class="list-unstyled">
                                                <li><i class="mdi mdi-hospital-building color-23"></i> <span
                                                        class="mrl-5 text-black">{{ $datalowongan->dudi->nama }}</span>
                                                </li>
                                                <li><i class="mdi mdi-clipboard-outline color-23"></i> <span
                                                        class="mrl-5 text-black">{{ $datalowongan->dudi->bidang }}</span>
                                                </li>
                                                <li><i class="mdi mdi-calendar color-23"></i> <span
                                                        class="mrl-5 text-black">{{ $datalowongan->tgl_upload }}</span>
                                                </li>
                                                <li><i class="mdi mdi-map-marker color-23"></i> <span
                                                        class="mrl-5 text-black">{{ $datalowongan->lokasi }}</span></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <a href="/company/lowongan-kerja/detail/{{ $datalowongan->nama }}"
                                class="btn btn-primary">Detail
                                Lowongan</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="pagination d-flex justify-content-center mt-3">{{ $alllowongan->links() }}</div>
        </div>
    </div>
@endsection
@section('js-tambahan')
@endsection
