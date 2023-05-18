@extends('layout.alumni.layout')
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
                    <a href="/profile" class="btn btn-outline-inverse-info btn-icon-text">
                        Profile Saya
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row d-flex">
        <div class="col-sm-4 flex-column d-flex stretch-card">
            <div class="row flex-grow">
                <div class="col-sm-12 grid-margin stretch-card">
                    <div class="card bg-dark text-light">
                        <img class="card-img-top img-fluid"
                            src="{{ URL::asset('storage' . '/' . $dataAlumni->photo_profile) }}"
                            alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title text-light fs-4">{{ $dataAlumni->nama }}</h4>
                            <p class="card-text"><i class="mdi mdi-calendar-clock  text-light"></i> <span class="status-alumni">Lulus - {{ $dataAlumni->tahunlulus->tahun_lulus }}</span></p>
                            <p class="card-text"><i class="mdi mdi-school text-light"></i> <span class="status-alumni">{{ $dataAlumni->jurusan->jurusan }}</span></p>
                            <p class="card-text"><i class="mdi mdi-cake-layered  text-light"></i> <span class="status-alumni">{{ $dataAlumni->tempatTanggalLahir }}</span></p>
                            <p class="card-text"><i class=" mdi mdi-account text-light"></i> <span class="status-alumni">{{ $dataAlumni->Jenis_Kelamin->jenis_kelamin }}</span></p>
                            <p class="card-text"><i class="mdi mdi-phone text-light"></i> <span class="status-alumni">{{ $dataAlumni->no_hp }}</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-8 flex-column d-flex stretch-card">
            <div class="row">
                <div class="col-sm-12 grid-margin d-flex stretch-card">
                    <div class="card bg-dark text-light" style="border-top: 15px solid white; border-left: 15px solid white;">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between top-card">
                                <h4 class="card-title mb-2 text-light">Biografi</h4>
                                <div class="dropdown">
                                    <a href="#" class="text-success btn btn-link  px-1"><i
                                            class="mdi mdi-grease-pencil text-primary"></i></a>
                                </div>
                            </div>
                            <p>{!! $dataAlumni->biografi !!}</p>
                            <div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6 grid-margin d-flex stretch-card">
                    <div class="card bg-dark text-light" style="border-left: 15px solid white">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between top-card">
                                <h4 class="card-title mb-2 text-light">Riwayat Pendidikan</h4>
                                <div class="dropdown">
                                    <a href="#" class="text-success btn btn-link  px-1"><i class="mdi mdi-plus text-primary"></i></a>
                                </div>
                            </div>
                            @foreach ($dataPendidikan as $data)
                                <div>
                                    <h3 class="card-text fw-bolder">{{ $data->nama_instansi }}</h3>
                                    <p>{{ $data->Pendidikan->jenis_pendidikan }} - Skor : {{ $data->nilai_rata_rata }} <br>Lulus Tahun : {{ $data->tahun_akhir_pendidikan }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 grid-margin d-flex stretch-card">
                    <div class="card bg-dark text-light" style="border-left: 15px solid white">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between top-card">
                                <h4 class="card-title mb-2 text-light">Pengalaman Kerja</h4>
                                <div class="dropdown">
                                    <a href="#" class="text-success btn btn-link  px-1"><i class="mdi mdi-plus text-primary"></i></a>
                                </div>
                            </div>
                            @foreach ($dataPekerjaan as $data)
                                <div>
                                    <h3 class="card-text fw-bold">{{ $data->bidang }}</h3>
                                    <p class="fw-bold">{{ $data->nama_perusahaan }} - {{ $data->Pekerjaan->jenis_pekerjaan }}</p>
                                    <p>{{ $data->tahun_awal_pekerjaan }} - {{ $data->tahun_akhir_pekerjaan }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 grid-margin d-flex stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between top-card">
                                <h4 class="card-title mb-2">Sertifikasi</h4>
                                <div class="dropdown">
                                    <a href="#" class="text-success btn btn-link  px-1"><i
                                            class="mdi mdi-plus text-primary"></i></a>
                                </div>
                            </div>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Est iure laborum rem vero quam. Neque
                            voluptatem officia unde necessitatibus porro.
                            <div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 grid-margin d-flex stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between top-card">
                                <h4 class="card-title mb-2">Penghargaan Lomba</h4>
                                <div class="dropdown">
                                    <a href="#" class="text-success btn btn-link  px-1"><i
                                            class="mdi mdi-plus text-primary"></i></a>
                                </div>
                            </div>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Est iure laborum rem vero quam. Neque
                            voluptatem officia unde necessitatibus porro.
                            <div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row-12">
            <div class="row-12">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body collapse show">
                            <div class="row">
                                <div class="col-md-9">
                                    <h4 class="card-title">Pencarian Lowongan</h4>
                                </div>
                            </div>
                            <form action="/lowongan-kerja/search+" method="get">
                            @csrf
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <select class="form-select full-size-width" id="inputGroupSelect01" name="category">
                                        <option selected="">Spesialis Pekerjaan</option>
                                        <option value="1">Category Pekerjaan 1</option>
                                        <option value="2">Category Pekerjaan 2</option>
                                        <option value="3">Category Pekerjaan 3</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                        <input type="text" id="" name="nama_lowongan" class="form-control" placeholder="Kata Kunci Lowongan" style="height: 40px">
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
            <div class="row mt-4">
                @foreach ($lowongan as $datalowongan)            
                    <div class="col-lg-4 col-md-6">
                        <div class="card border-top-black-300 mt-5">
                            <div class="col-md-12 p-4">
                                <h4 class="card-title">{{ $datalowongan->nama }}</h4>
                                <ul class="list-unstyled">
                                    <li class="media d-flex align-items-start company-show">
                                        <img class="d-flex me-3 logo-company" src="/images/profileimg/{{ $datalowongan->dudi->logo }}" alt="Logo Test" width="100">
                                        <div class="media-body">
                                            <ul class="list-unstyled">
                                                <li><i class="mdi mdi-hospital-building color-23"></i> <span class="mrl-5 text-black">{{ $datalowongan->dudi->nama }}</span></li>
                                                <li><i class="mdi mdi-clipboard-outline color-23"></i> <span class="mrl-5 text-black">{{ $datalowongan->dudi->bidang }}</span></li>
                                                <li><i class="mdi mdi-calendar color-23"></i> <span class="mrl-5 text-black">{{ $datalowongan->tgl_upload }}</span></li>
                                                <li><i class="mdi mdi-map-marker color-23"></i> <span class="mrl-5 text-black">{{ $datalowongan->lokasi }}</span></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <a href="/lowongan-kerja/detail/{{ $datalowongan->nama }}" class="btn btn-primary">Detail Lowongan</a>
                        </div>
                    </div>
                @endforeach
                <div class="pagination">{{ $lowongan->links() }}</div>
            </div>
            <div class="row my-4">
                <div class="col">
                    <div class="d-flex justify-content-center bg-primary rounded">
                        <h2 class="text-light p-3">Sekilas Perusahaan</h2>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-evenly">
                @foreach ($datadudi as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-top-blue-300 mb-3">
                        <div class="col-md-12 p-4">
                            <h4 class="card-title">{{ $item->nama }}</h4>
                            <ul class="list-unstyled">
                                <li class="media d-flex align-items-start company-show">
                                    <img class="d-flex me-3 logo-company" src="/images/profileimg/ph.png" alt="Logo Test" width="100">
                                    <div class="media-body">
                                        <ul class="list-unstyled">
                                            <li><i class="mdi mdi-newspaper color-23"></i> <span class="mrl-5 text-black">{{ $countlowongan[$item->id] }} Lowongan Aktif </span></li>
                                            <li><i class="mdi mdi-clipboard-text  color-23"></i> <span class="mrl-5 text-black">{{ $item->bidang }}</span></li>
                                            <li><i class="mdi mdi-phone color-23"></i> <span class="mrl-5 text-black">{{ $item->no_telp }}</span></li>
                                            <li><i class="mdi mdi-map-marker  color-23"></i> <span class="mrl-5 text-black">{{ $item->alamat }}</span></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <a href="/perusahaan/{{ $item->nama }}" class="btn btn-primary">Detail Perusahaan</a>
                    </div>
                </div>
                @endforeach
            </div>
    @endsection
    @section('js-tambahan')
    @endsection
