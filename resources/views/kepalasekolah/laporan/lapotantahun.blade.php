@extends('layout.kepalasekolah.layout')
@section('css-tambahan')
    <link href="{{ URL::asset('asset/plugins/adminpage/costume.css') }}" rel="stylesheet">
@endsection
@section('page-wrapper')
    <div class="row mt-rs-4">
        <div class="col-sm-4 mb-4 mb-xl-0">
            <div class="d-lg-flex align-items-center">
                <div>
                    <h3 class="text-dark font-weight-bold mb-2">Laporan Bursa Kerja Khusus @if ($tahunlulusdata != null)
                            Tahun: <u>{{ $tahunlulusdata->tahun_lulus ?? '' }} </u>
                        @endif
                    </h3>
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
                <div class="row">
                    <div class="col-md-6">
                        <div class="card border-end">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <div class="d-inline-flex align-items-center">
                                            <h2 class="text-dark mb-1 font-weight-medium">{{ $totalperusahaan }}</h2>
                                        </div>
                                        <h4 class="mb-0 text-truncate">Total Perusahaan Terdaftar
                                        </h4>
                                    </div>
                                    <div class="ms-auto mt-md-3 mt-lg-0">
                                        <span class="opacity-7 text-muted"><i class="fas fa-building icon-count"></i></span>
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
                                            <h2 class="text-dark mb-1 font-weight-medium">{{ $totallowongan }}</h2>
                                        </div>
                                        <h4 class="mb-0 text-truncate">Total
                                            Lowongan Terdaftar
                                        </h4>
                                    </div>
                                    <div class="ms-auto mt-md-3 mt-lg-0">
                                        <span class="opacity-7 text-muted"><i
                                                class="fas fa-newspaper icon-count"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row-12 mt-3">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body collapse show">
                        <div class="row">
                            <div class="col-md-9">
                                <h4 class="card-title">Pilih Tahun Kelulusan</h4>
                            </div>
                        </div>
                        <form action="/kepala-sekolah/report/yeary/pick/" method="GET">
                            @method('get')
                            @csrf
                            <div class="row">
                                <div class="col-md-9 mb-3">
                                    <select class="form-select full-size-width" id="idtahunlulus" name="idtahunlulus"
                                        value="{{ request('idtahunlulus') }}">
                                        <option selected value="">Tahun Lulus</option>
                                        @foreach ($tahunlulus as $item)
                                            @if (request('idtahunlulus') == $item->id)
                                                <option value="{{ $item->id }}" selected>{{ $item->tahun_lulus }}
                                                </option>
                                            @else
                                                <option value="{{ $item->id }}">{{ $item->tahun_lulus }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary full-size-width">Submit</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Alumni Yang Bekerja</h4>
                        <div class="mt-4 position-relative" style="min-width:294px;">
                            <canvas id="ds3" height="195px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Alumni Melanjutkan Pendidikan</h4>
                        <div class="mt-4 position-relative" style="min-width:294px;">
                            <canvas id="ds4" height="195px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 mt-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Alumni Per Jurusan</h4>
                        <div class="mt-4 position-relative" style="min-width:294px;">
                            <canvas id="ds5" width="100"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mt-4">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="zero_config" class="table border table-striped table-bordered text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Nama Jurusan</th>
                                        <th>Total Alumni Kuliah</th>
                                        <th>Total Alumni Bekerja</th>
                                        <th>Total Alumni</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orginDataJurusan as $data)
                                        <tr>
                                            <td>{{ $data->jurusan }}</td>
                                            <td>{{ $dataalumnikuliah[$data->id] }}</td>
                                            <td>{{ $dataalumnibekerja[$data->id] }}</td>
                                            <td>{{ $datajurusanalumni[$data->id] }}</td>
                                            <td>
                                                @if ($tahunlulusdata == null)
                                                <a href="/kepala-sekolah/report/yearly/all/jurusan/{{ $data->id }}"
                                                    class="btn btn-secondary">Detail</a>                                                        
                                                @else
                                                <a href="/kepala-sekolah/report/yearly/{{ $tahunlulusdata->tahun_lulus ?? ''}}/jurusan/{{ $data->id }}" class="btn btn-secondary">Detail</a> 
                                                @endif
                                                </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
        //Chart Alumni Per Jurusan
        var LabelJurusan = {{ Js::from($LabelJurusan) }};
        var DataJurusan = {{ Js::from($DataJurusan) }};
        var barColors = ["red", "green", "blue", "orange", "blue", "red", "green", "blue", "orange", "blue", "red", "green",
            "blue", "orange", "blue"
        ];

        new Chart("ds5", {
            type: "bar",
            data: {
                labels: LabelJurusan,
                datasets: [{
                    backgroundColor: barColors,
                    data: DataJurusan
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
    </script>
@endsection
