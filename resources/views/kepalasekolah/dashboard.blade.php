@extends('layout.kepalasekolah.layout')
@section('css-tambahan')
    <link href="{{ URL::asset('asset/plugins/adminpage/costume.css') }}" rel="stylesheet">
@endsection
@section('page-wrapper')
    <div class="row mt-rs-4">
        <div class="col-sm-4 mb-4 mb-xl-0">
            <div class="d-lg-flex align-items-center">
                <div>
                    <h3 class="text-dark fw-bold mb-2">Selamat Datang Kepala Sekolah <br><u> {{ Auth::user()->name }}</u>
                    </h3>
                    <h5 class="font-weight-normal mb-2">Di Bursa Kerja Khusus SMKN 4 Banjarmasin </h5>
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
                        <img class="card-img-top img-fluid" src="/images/profileimg/{{ Auth()->user()->photo_profile }}"
                            alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title text-light fs-4">{{ $dataKepalaSekolah->nama }}</h4>
                            <p class="card-text"><i class="mdi mdi-mdi mdi-account-check  text-light"></i> <span
                                    class="status-alumni">Jabatan - Kepala Sekolah</span></p>
                            <p class="card-text"><i class="mdi mdi-calendar text-light"></i> <span
                                    class="status-alumni">{{ $dataKepalaSekolah->tahun_jabatan }}</span></p>
                            <p class="card-text"><i class="mdi mdi-hospital-building text-light"></i> <span
                                    class="status-alumni">SMKN 4 BANJARMASIN</span></p>
                            <p class="card-text"><i class="mdi mdi-attachment  text-light"></i> <span
                                    class="status-alumni">NPSN - 30304270</span></p>
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
                                <h4 class="card-title mb-2 text-light">Kutipan</h4>
                                <div class="dropdown mb-3">
                                    <button class="icon-button-modal" data-bs-toggle="modal"
                                        data-bs-target="#editdeskripsi"><i
                                            class="mdi mdi-grease-pencil text-primary fs-5"></i></button>
                                </div>
                            </div>
                            <p>{!! $dataKepalaSekolah->kutipan !!}</p>
                            <div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="card bg-primary text-light border-end" style="border-left: 15px solid white">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-light mb-1 font-weight-medium">{{ $totalAlumni }}</h2>
                                    </div>
                                    <h6 class="font-weight-normal mb-0 w-100 text-truncate">Total Alumni</h6>
                                </div>
                                <div class="ms-auto mt-md-3 mt-lg-0">
                                    <span><i class="mdi mdi-mdi mdi-account  text-light" style="font-size: 35px"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card bg-primary text-light border-end" style="border-left: 15px solid white">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-light mb-1 font-weight-medium">{{ $totalperusahaan }}</h2>
                                    </div>
                                    <h6 class="font-weight-normal mb-0 w-100 text-truncate">Total Perusahaan</h6>
                                </div>
                                <div class="ms-auto mt-md-3 mt-lg-0">
                                    <span><i class="mdi mdi-hospital-building  text-light"
                                            style="font-size: 35px"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="card bg-primary text-light border-end" style="border-left: 15px solid white">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-light mb-1 font-weight-medium">{{ $totallowongan }}</h2>
                                    </div>
                                    <h6 class="font-weight-normal mb-0 w-100 text-truncate">Total Lowongan</h6>
                                </div>
                                <div class="ms-auto mt-md-3 mt-lg-0">
                                    <span><i class="mdi mdi-newspaper  text-light" style="font-size: 35px"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-12 my-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Jumlah Alumni Per Tahun</h4>
                    <div class="mt-2" style="min-width:100%;">
                        <canvas id="ds1" height="195px"></canvas>
                    </div>
                    <div class="mt-3">
                        <ul class="list-style-none mb-0">
                            @foreach ($datatahunlulusan as $tahunlulusdata)
                                <li>
                                    <i class="fas fa-circle text-secondary font-10 me-2"></i>
                                    <span class="text-muted">{{ $tahunlulusdata->tahun_lulus ?? '-' }}</span>
                                    <span
                                        class="text-dark float-end font-weight-medium">{{ $datatahunlulusanalumni[$tahunlulusdata->tahun_lulus] ?? '-' }}
                                        Alumni</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 my-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Jumlah Alumni Per Tahun</h4>
                    <div class="mt-4 position-relative" style="min-width:295px;">
                        <canvas id="ds2" width="195px"></canvas>
                    </div>
                    <ul class="list-inline text-center mt-5 mb-2">
                        <li class="list-inline-item text-muted fst-italic">Alumni Tahun Ini</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('js-tambahan')
        <script>
            // Chart Alumni Pertahun
            var labeltahunllulus = {{ Js::from($LabelCharttahunlulus) }};
            var datatahunlulus = {{ Js::from($DataCharttahunlulus) }};
            var ctx = document.getElementById("ds1").getContext('2d');
            var ds1 = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labeltahunllulus,
                    datasets: [{
                        label: 'Alumni',
                        data: datatahunlulus,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });

            //Chart Alumni Tahun Sekarang
            var LabelsChartJurusan = {{ Js::from($LabelsChartJurusan) }};
            var DataChartJurusan = {{ Js::from($DataChartJurusan) }};
            var barColors = [
                "#fcba03",
                "#a103fc",
                "#b33daf",
                "#6dc73a",
                "#cede1d",
                "#1d7ede",
                "#de1d47",
            ];

            new Chart("ds2", {
                type: "doughnut",
                data: {
                    labels: LabelsChartJurusan,
                    datasets: [{
                        backgroundColor: barColors,
                        data: DataChartJurusan
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: "Alumni Per Jurusan"
                    }
                }
            });
        </script>
    @endsection
