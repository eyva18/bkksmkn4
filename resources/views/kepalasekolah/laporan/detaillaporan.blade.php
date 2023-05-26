@extends('layout.kepalasekolah.layout')
@section('css-tambahan')
    <link href="{{ URL::asset('asset/plugins/adminpage/costume.css') }}" rel="stylesheet">
@endsection
@section('page-wrapper')
    <div class="row mt-rs-4">
        <div class="col-sm-4 mb-4 mb-xl-0">
            <div class="d-lg-flex align-items-center">
                <div>
                    <h3 class="text-dark font-weight-bold mb-2">Laporan Detail Semua Tahun - <u>{{ $jurusandata->jurusan }}</u></h3>
                    {{-- @if ($tahunlulusdata != null) Tahun: <u>{{ $tahunlulusdata->tahun_lulus ?? ''}} </u>
                    @endif --}}
                    <h6 class="font-weight-normal mb-2">Bursa Kerja Khusus - SMKN 4 Banjarmasin</h6>
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
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="card border-end">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <div class="d-inline-flex align-items-center">
                                            <h2 class="text-dark mb-1 font-weight-medium">{{ $DataChartStatus['bekerja'] }}</h2>
                                        </div>
                                        <h4 class="mb-0 text-truncate">Total Alumni Bekerja
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card border-end">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <div class="d-inline-flex align-items-center">
                                            <h2 class="text-dark mb-1 font-weight-medium">{{ $DataChartStatus['tidak_bekerja'] }}</h2>
                                        </div>
                                        <h4 class="mb-0 text-truncate">Total Alumni Tidak Bekerja
                                        </h4>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-end">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <div class="d-inline-flex align-items-center">
                                            <h2 class="text-dark mb-1 font-weight-medium">{{ $DataChartStatus['malanjutkan_pendidikan'] }}</h2>
                                        </div>
                                        <h4 class="mb-0 text-truncate">Total Alumni Melanjutkan Pendidikan
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-end">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <div class="d-inline-flex align-items-center">
                                            <h2 class="text-dark mb-1 font-weight-medium">{{ $DataChartStatus['tidakmalanjutkan_pendidikan']}}</h2>
                                        </div>
                                        <h4 class="mb-0 text-truncate">Total Alumni Tidak Melanjutkan Pendidikan
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Alumni Yang Bekerja</h4>
                        <div class="mt-2 position-relative mb-5" style="height:294px;">
                            <canvas id="ds3" height="195px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Alumni Melanjutkan Pendidikan</h4>
                        <div class="mt-2 position-relative mb-5" style="height:294px;">
                            <canvas id="ds4" height="195px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mt-4">
                <div class="card">
                    <div class="card-body">
                        <a href="/kepala-sekolah/report/yearly/all/jurusan/{{ $jurusandata->id }}/export" class="btn btn-lg btn-primary"><i class="fas fa-share-square"></i> Export</a>
                        <div class="table-responsive mt-3">
                            <table id="zero_config" class="table border table-striped table-bordered text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Nama Alumni</th>
                                        <th>Bekerja</th>
                                        <th>Melanjutkan Pendidikan</th>
                                        <th>Nama Universitas</th>
                                        <th>Nama Perusahaan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataalumni as $alumni)
                                    <tr>
                                        <td>{{ $alumni->nama ?? '-'}}</td>
                                        <td>{{ ($statusalumni[$alumni->id]->bekerja ?? '-') == "bekerja" ? '✓' : 'X' }}</td>
                                        <td>{{ ($statusalumni[$alumni->id]->pendidikan ?? '-') == "melanjutkan pendidikan" ? '✓' : 'X' ?? 'X'}}</td>
                                        <td>{{ $statusalumni[$alumni->id]->universitas ?? '-'}}</td>
                                        <td>{{ $statusalumni[$alumni->id]->perusahaan ?? '-'}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $dataalumni->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js-tambahan')
<script>
    //Chart Alumni Bekerja Atau Tidak
    var xValues = ["Bekerja", "Tidak Bekerja"];
    var yValues = [{{ Js::from($DataChartStatus['bekerja']) }}, {{ Js::from($DataChartStatus['tidak_bekerja']) }}];
    new Chart("ds3", {
        type: "pie",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: ["yellow", "purple"],
                data: yValues
            }]
        },
        options: {
            legend: {
                display: true
            }
        }
    });

    //Chart Alumni Pendidikan
    var xValues = ["Melanjutkan Pendidikan", "Tidak Melanjutkan Pendidikan"];
    var yValues = [{{ Js::from($DataChartStatus['malanjutkan_pendidikan']) }},
        {{ Js::from($DataChartStatus['tidakmalanjutkan_pendidikan']) }}
    ];
    new Chart("ds4", {
        type: "pie",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: ["blue", "pink"],
                data: yValues
            }]
        },
        options: {
            legend: {
                display: true
            },
        }
    });
</script>
@endsection
