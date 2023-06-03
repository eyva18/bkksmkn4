@extends('layout.dudi.layout')
@section('css-tambahan')
    <link href="{{ URL::asset('asset/plugins/adminpage/costume.css') }}" rel="stylesheet">
@endsection
@section('page-wrapper')
    <div class="row mt-rs-4">
        <div class="col-sm-4 mb-4 mb-xl-0">
            <div class="d-lg-flex align-items-center">
                <div>
                    <h3 class="text-dark fw-bold mb-2">Selamat Datang <u>{{ Auth::user()->name }}</u></h3>
                    <h5 class="font-weight-normal mb-2">Di Bursa Kerja Khusus SMKN 4 Banjarmasin </h5>
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
            @if (session()->has('success'))
                <div class="alert alert-info" role="alert">
                    <strong>Info!</strong> {{ session('success') }}
                </div>
            @endif
        </div>
        
    </div>
    <div class="row d-flex">
        <div class="col-sm-4 flex-column d-flex stretch-card">
            <div class="row flex-grow">
                <div class="col-sm-12 grid-margin stretch-card">
                    <div class="card bg-dark text-light">
                        <img class="card-img-top img-fluid" src="/images/profileimg/{{ $dataDudi->logo }}"
                            alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title text-light fs-4">{{ $dataDudi->nama }}</h4>
                            <p class="card-text"><i class="mdi mdi-hospital-building text-light"></i> <span
                                    class="status-alumni">Bidang - {{ $dataDudi->bidang }}</span></p>
                            <p class="card-text"><i class="mdi mdi-map-marker text-light"></i> <span
                                    class="status-alumni">{{ $dataDudi->alamat }}</span></p>
                            <p class="card-text"><i class="mdi mdi-email text-light"></i> <span
                                    class="status-alumni">{{ $dataDudi->userdata->email }}</span></p>
                            <p class="card-text"><i class=" mdi mdi-phone text-light"></i> <span
                                    class="status-alumni">{{ $dataDudi->no_telp }}</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-8 flex-column d-flex stretch-card">
            <div class="row">
                <div class="col-sm-12 grid-margin d-flex stretch-card">
                    <div class="card bg-dark text-light"
                        style="border-top: 15px solid white; border-left: 15px solid white;">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between top-card">
                                <h4 class="card-title mb-2 text-light">Deskripsi</h4>
                                <div class="dropdown mb-3">
                                    <button class="icon-button-modal" data-bs-toggle="modal"
                                        data-bs-target="#editdeskripsi"><i
                                            class="mdi mdi-grease-pencil text-primary fs-5"></i></button>
                                </div>
                            </div>
                            <p>{!! $dataDudi->deskripsi !!}</p>
                            <div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-12 my-4">
                <div class="row justify-content-center bg-dark rounded">
                    <div class="col-md-6 text-center">
                        <h2 class="text-light p-3">Sekilas Lowongan Kamu</h2>
                    </div>
                    <div class="col-md-3 text-center">
                        <a href="/company/daftar-lowongan" class="btn btn-primary button-posting">Cek Lowongan</a>
                    </div>
                    <div class="col-md-3 text-center">
                        <a href="/company/lowongan/create" class="btn btn-primary button-posting">+ Lowongan</a>
                    </div>
                </div>
            </div>
            <div class="row">
                @if ($lowongandudi[0] == null)
                <div class="col-sm-12 mr">
                    <div class="card">
                        <div class="card-body collapse show">
                            <div class="row">
                                <div class="col-md-12 text-center mt-3">
                                    <h4 class="card-title">Kamu Belum Menambahkan Lowongan</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @foreach ($lowongandudi as $datalowongan)
                    <div class="col-lg-6 col-md-6">
                        <div class="card border-top-black-300 mt-3">
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
                            <a href="/company/lowongan-kerja/detail/{{ $datalowongan->nama }}" class="btn btn-secondary">Detail
                                Lowongan</a>
                        </div>
                    </div>
                @endforeach
                <div class="pagination d-flex justify-content-center mt-3">{{ $lowongandudi->links() }}</div>
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
                            <form action="/alumni/search+" method="get">
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
                @foreach ($sekilasalumni as $alumni)
                    <div class="col-lg-4 col-md-6">
                        <div class="card border-top-black-300 mt-5">
                            <div class="col-md-12 p-4">
                                <h4 class="card-title">{{ $alumni->nama ?? '-'}}</h4>
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
                            <a href="/company/alumni/profile-detail/{{ $alumni->nama }}" class="btn btn-primary">Profile Alumni</a>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- Modal Biografi Edit --}}
            <div class="modal fade" id="editdeskripsi" tabindex="-1" role="dialog"
                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myLargeModalLabel">Edit Deskripsi</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-hidden="true"></button>
                        </div>
                        <form action="/company/biografi/update" method="post">
                            @method('post')
                            @csrf
                            <input type="hidden" name="id" value="{{ $dataDudi->id }}">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input id="biografi" placeholder="Tentang diri anda"
                                        class="form-control font-weight-normal"
                                        type="hidden" name="biografi"
                                        value="{{ old('biografi', $dataDudi->deskripsi) }}">
                                    <trix-editor input="biografi"></trix-editor>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-danger" data-dismiss="modal">Batalkan</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endsection
        @section('js-tambahan')
        @endsection
