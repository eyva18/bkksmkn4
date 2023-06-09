@extends('layout.kepalasekolah.layout')
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
                        <p class="card-text"><i class="mdi mdi-calendar-clock  text-light"></i> <span class="status-alumni">Lulus - {{ $dataAlumni->tahunlulus->tahun_lulus ?? '-'}}</span></p>
                        <p class="card-text"><i class="mdi mdi-school text-light"></i> <span class="status-alumni">{{ $dataAlumni->jurusan->jurusan ?? '-'}}</span></p>
                        <p class="card-text"><i class="mdi mdi-cake-layered  text-light"></i> <span class="status-alumni">{{ $dataAlumni->tempatTanggalLahir ?? '-'}}</span></p>
                        <p class="card-text"><i class=" mdi mdi-account text-light"></i> <span class="status-alumni">{{ $dataAlumni->Jenis_Kelamin->jenis_kelamin ?? '-'}}</span></p>
                        <p class="card-text"><i class="mdi mdi-phone text-light"></i> <span class="status-alumni">{{ $dataAlumni->no_hp ?? '-'}}</span></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-12 grid-margin stretch-card">
                <div class="card text-bg-dark mb-3" style="max-width: 18rem;">
                    <div class="card-header bg-dark">
                        <h5 class="fw-bold pt-2 fs-4 text-light">Kegiatan Alumni Sekarang
                            
                        </h5>
                    </div>
                    <div class="card-body bg-dark text-light">
                        <p class="card-text"><i class="mdi mdi-bookmark-check  text-light"></i> <span
                                class="status-alumni">{{ $dataStatusAlumni->StatusBekerja->status_bekerja }}</span></p>
                        <p class="card-text"><i class="mdi mdi-bookmark-check  text-light"></i> <span
                                class="status-alumni">{{ $dataStatusAlumni->StatusPendidikan->status_pendidikan }}</span>
                        </p>
                        <hr>
                        <p class="card-text"><b>Rincian</b></p>
                        <p class="card-text"><i class="mdi mdi-office-building text-light"></i> <span
                            class="status-alumni">{{ $dataStatusAlumni->perusahaan ?? '-' }}</span></p>
                        <p class="card-text"><i class="mdi mdi-chair-school text-light"></i> <span
                                class="status-alumni">{{ $dataStatusAlumni->universitas ?? '-' }}</span></p>
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
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="fw-bold pt-2 text-dark">Sertifikasi</h4>
                    </div>
                    <div class="card-body">
                        @foreach ($dataSertifikasi as $data)
                            <div class="row">
                                <div class="col-6-md d-flex justify-content-center">
                                    <a class="gallery-popup"
                                        href="{{ URL::asset('storage/' . $data->file_sertifikasi) }}"
                                        aria-label="project-img">
                                        <img class="img-fluid"
                                            src="{{ URL::asset('storage/' . $data->file_sertifikasi) }}"
                                            style="width: 120px" alt="project-img">
                                    </a>
                                </div>
                                <div class="col-6-md p-3">
                                    <a href="{{ $data->link_sertifikasi }}" style="text-decoration: none">
                                        <p class="fw-bold fs-5">{{ $data->nama_sertifikasi }}</p>
                                    </a>
                                    <h5 class="fw-bold">{{ $data->nama_penerbit }}</h5>
                                    <h5>Diterbitkan : {{ $data->tahun_terbit }}</h5>
                                </div>
                                <hr>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 grid-margin d-flex stretch-card">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="fw-bold pt-2 text-dark">Penghargaan Lomba</h4>
                    </div>
                    <div class="card-body">
                        @foreach ($dataSertifikasiLomba as $data)
                            <div class="row">
                                <div class="col-6-md d-flex justify-content-center">
                                    <a class="gallery-popup"
                                        href="{{ URL::asset('storage/' . $data->file_sertifikasi) }}"
                                        aria-label="project-img">
                                        <img class="img-fluid"
                                            src="{{ URL::asset('storage/' . $data->file_sertifikasi) }}"
                                            style="width: 120px" alt="project-img">
                                    </a>
                                </div>
                                <div class="col-6-md p-3">
                                    <p class="fw-bold fs-5 text-dark">{{ $data->nama_juara_kompetensi }}</p>
                                    <h5>{{ $data->TingkatPerlombaan->tingkat_lomba }}</h5>
                                    <h5>Didapatkan : {{ $data->tanggal_terbit }}</h5>
                                </div>
                                <hr>
                            </div>
                        @endforeach
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
</div>
</div>
@endsection
@section('js-tambahan')
@endsection
