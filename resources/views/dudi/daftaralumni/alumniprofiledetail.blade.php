@extends('layout.dudi.layout')
@section('css-tambahan')
    <link href="{{ URL::asset('asset/plugins/adminpage/costume.css') }}" rel="stylesheet">
@endsection
@section('page-wrapper')
<div class="row mt-rs-4">
    <div class="col-sm-4 mb-4 mb-xl-0">
        <div class="d-lg-flex align-items-center">
            <div>
                <h3 class="text-dark font-weight-bold mb-2">Detail Profile Alumi</h3>
                <h6 class="font-weight-normal mb-2">Alumni SMKN 4 Banjarmasin: <u>{{ $dataAlumni->nama }}</u></h6>
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
</div>
<div class="row-12 my-4">
    <div class="col">
        <div class="d-flex justify-content-center bg-primary rounded">
            <h2 class="text-light p-3">Sekilas Alumni Lainnya</h2>
        </div>
    </div>
</div>
<div class="row d-flex justify-content-between">
    @if ($alumnisekilas[0] == null)
    <div class="col-sm-12 mr">
        <div class="card">
            <div class="card-body collapse show">
                <div class="row">
                    <div class="col-md-12 text-center mt-3">
                        <h4 class="card-title">Alumni Lainnya Tidak Tersedia</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
<div class="row mt-4">
    @foreach ($alumnisekilas as $alumni)
        <div class="col-lg-4 col-md-6">
            <div class="card border-top-black-300 mt-5">
                <div class="col-md-12 p-4">
                    <h4 class="card-title">{{ $alumni->nama }}</h4>
                    <ul class="list-unstyled">
                        <li class="media d-flex align-items-start company-show">
                            <img class="d-flex me-3 logo-company"
                                src="{{ URL::asset('storage') . '/' . $alumni->photo_profile }}" alt="Logo Test"
                                width="100">
                            <div class="media-body">
                                <ul class="list-unstyled">
                                    <li class="card-text"><i class="mdi mdi-calendar-clock  text-black"></i> <span class="status-alumni">Lulus Tahun - {{ $alumni->tahunlulus->tahun_lulus }}</span></li>
                                    <li class="card-text"><i class="mdi mdi-school text-black"></i> <span class="status-alumni">{{ $alumni->jurusan->jurusan }}</span></li>
                                    <li class="card-text"><i class="mdi mdi-cake-layered  text-black"></i> <span class="status-alumni">{{ $alumni->tempatTanggalLahir }}</span></li>
                                    <li class="card-text"><i class=" mdi mdi-account text-black"></i> <span class="status-alumni">{{ $alumni->Jenis_Kelamin->jenis_kelamin }}</span></li>
                                    <li class="card-text"><i class="mdi mdi-phone text-black"></i> <span class="status-alumni">{{ $alumni->no_hp }}</span></li>
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
</div>
@endsection
@section('js-tambahan')
@endsection
