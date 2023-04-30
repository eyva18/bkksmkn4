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
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Dashboard</h3>
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
                <!-- *************************************************************** -->
                <!-- Start First Cards -->
                <!-- *************************************************************** -->
                <div class="row">
                    <div class="col-sm-6 col-lg-4">
                        <div class="card border-end">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <div class="d-inline-flex align-items-center">
                                            <h2 class="text-dark mb-1 font-weight-medium">{{$totalAlumni}}</h2>
                                        </div>
                                        <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Alumni
                                        </h6>
                                    </div>
                                    <div class="ms-auto mt-md-3 mt-lg-0">
                                        <span class="opacity-7 text-muted"><i
                                                class="fas fa-users icon-count"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card border-end">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <div class="d-inline-flex align-items-center">
                                            <h2 class="text-dark mb-1 font-weight-medium">{{ $totalperusahaan }}</h2>
                                        </div>
                                        <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total
                                            Perusahaan
                                        </h6>
                                    </div>
                                    <div class="ms-auto mt-md-3 mt-lg-0">
                                        <span class="opacity-7 text-muted"><i
                                                class="fas fa-building icon-count"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card border-end">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <div class="d-inline-flex align-items-center">
                                            <h2 class="text-dark mb-1 font-weight-medium">{{ $totallowongan }}</h2>
                                        </div>
                                        <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total
                                            Lowongan
                                        </h6>
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
                <!-- *************************************************************** -->
                <!-- End First Cards -->
                <!-- *************************************************************** -->
                <!-- *************************************************************** -->
                <!-- Start Charts Section -->
                <!-- *************************************************************** -->
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Jumlah Alumni Per Tahun</h4>
                                <div class="mt-2" style="height:283px; width:100%;">
                                <canvas id="ds1" height="195px"></canvas>
                                </div>
                                <ul class="list-style-none mb-0">
                                    @foreach ($datatahunlulusan as $tahunlulusdata)
                                    <li>
                                        <i class="fas fa-circle text-secondary font-10 me-2"></i>
                                        <span class="text-muted">{{ $tahunlulusdata->tahun_lulus ?? '-' }}</span>
                                        <span class="text-dark float-end font-weight-medium">{{ $datatahunlulusanalumni[$tahunlulusdata->tahun_lulus] ?? '-'}} Alumni</span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Jumlah Alumni Per Tahun</h4>
                                <div class="mt-4 position-relative" style="height:294px;">
                                    <canvas id="ds2" height="195px"></canvas>
                                </div>
                                <ul class="list-inline text-center mt-5 mb-2">
                                    <li class="list-inline-item text-muted fst-italic">Alumni Tahun Ini</li>
                                </ul>
                            </div>
                        </div>
                    </div>
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
                                <h4 class="card-title">Lowongan Semua Perusahaan</h4>
                                <div class="mt-4 position-relative" style="height:294px;">
                                    <canvas id="ds5" height="100"></canvas>
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
                © 2023 - 2024 Bursa Kerja Khusus — SMK Negeri 4 Banjarmasin by Taufiq Ari Rahman
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
<script>
// Chart Alumni Pertahun
var labeltahunllulus =  {{ Js::from($LabelCharttahunlulus) }};
var datatahunlulus =  {{ Js::from($DataCharttahunlulus) }};
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
        legend: {display: false},
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
var LabelsChartJurusan =  {{ Js::from($LabelsChartJurusan) }};
var DataChartJurusan =  {{ Js::from($DataChartJurusan) }};
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
    legend: {display: false},
    title: {
      display: true,
      text: "Alumni Per Jurusan"
    }
  }
});
//Chart Alumni Bekerja Atau Tidak
var xValues = ["Bekerja", "Tidak Bekerja"];
var yValues = [{{ Js::from($DataChartStatus["bekerja"]) }}, {{ Js::from($DataChartStatus["tidak_bekerja"]) }}];
new Chart("ds3", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: true}
}
});

//Chart Alumni Pendidikan
var xValues = ["Melanjutkan Pendidikan", "Tidak Melanjutkan Pendidikan"];
var yValues = [{{ Js::from($DataChartStatus["malanjutkan_pendidikan"]) }}, {{ Js::from($DataChartStatus["tidakmalanjutkan_pendidikan"]) }}];
new Chart("ds4", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: ["blue","pink"],
      data: yValues
    }]
  },
  options: {
    legend: {display: true},
}
});

//Chart Lowongan
var LabelLowonganDudi = {{ Js::from($LabelLowonganDudi) }};
var DataLowonganKerja = {{ Js::from($DataLowonganKerja) }};
var barColors = ["red", "green","blue","orange","blue", "red", "green","blue","orange","blue", "red", "green","blue","orange","blue"];

new Chart("ds5", {
  type: "bar",
  data: {
    labels: LabelLowonganDudi,
    datasets: [{
      backgroundColor: barColors,
      data: DataLowonganKerja
    }]
  },
  options: {
    legend: {display: false},
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