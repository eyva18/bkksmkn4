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
                    <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Laporan Detail - <strong> {{ $jurusandata->jurusan }} </strong></h3>
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
                                        <h2 class="text-dark mb-1 font-weight-medium">{{ $DataChartStatus['bekerja'] }}</h2>
                                    </div>
                                    <h4 class="mb-0 text-truncate">Total Alumni Bekerja
                                    </h4>
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
                                        <h2 class="text-dark mb-1 font-weight-medium">{{ $DataChartStatus['tidak_bekerja'] }}</h2>
                                    </div>
                                    <h4 class="mb-0 text-truncate">Total Alumni Tidak Bekerja
                                    </h4>
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
                                        <h2 class="text-dark mb-1 font-weight-medium">{{ $DataChartStatus['malanjutkan_pendidikan'] }}</h2>
                                    </div>
                                    <h4 class="mb-0 text-truncate">Total Alumni Melanjutkan Pendidikan
                                    </h4>
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
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <a href="/admin/administrator/master/report/yearly/all/jurusan/{{ $jurusandata->id }}/export" class="btn btn-lg btn-primary"><i class="fas fa-share-square"></i> Export</a>
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
    </script>
@endsection
