@extends('layout.admin.dashboard')
@section('css-tambahan')
@endsection
@section('page-wrapper')
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-7 align-self-center">
                    <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Laporan Detail <u>{{ $tahunlulusdata->tahun_lulus ?? ''}} </u></h3>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 col-lg-6">
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
                <div class="col-sm-6 col-lg-6">
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
                                    <span class="opacity-7 text-muted"><i class="fas fa-newspaper icon-count"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body collapse show">
                    <div class="row">
                        <div class="col-md-9">
                            <h4 class="card-title">Pilih Tahun Kelulusan</h4>
                        </div>
                    </div>
                    <div class="row pdt-20">
                        <div class="col-md-9">
                            <form action="/admin/administrator/master/report/yeary/pick/" method="GET">
                                @csrf
                                <select class="form-select full-size-width" id="inputGroupSelect01" name="idtahunlulus">
                                    <option selected="">Tahun Lulus</option>
                                    @foreach ($tahunlulus as $item)
                                        <option value="{{ $item->id }}">{{ $item->tahun_lulus }}</option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary pdt- full-size-width">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Alumni Yang Bekerja</h4>
                            <div class="mt-4 position-relative" style="height:294px;">
                                <canvas id="ds3" height="195px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Alumni Melanjutkan Pendidikan</h4>
                            <div class="mt-4 position-relative" style="height:294px;">
                                <canvas id="ds4" height="195px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Alumni Per Jurusan</h4>
                            <div class="mt-4 position-relative" style="height:294px;">
                                <canvas id="ds5" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="col-lg-12">
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
                                                        <a href="/admin/administrator/master/report/yearly/{{ $tahunlulusdata->tahun_lulus ?? ''}}/jurusan/{{ $data->id }}" class="btn btn-info">Detail</a>
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
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer text-center text-muted">
            © 2023 - 2024 Bursa Kerja Khusus — SMK Negeri 4 Banjarmasin 
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
@endsection
@section('js-tambahan')
    <script src="{{ URL::asset('asset/plugins/adminpage/chart/chartjs/Chart.js') }}"></script>
    <script src="{{ URL::asset('asset/plugins/adminpage/chart/chart_dashboard.js') }}"></script>
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
