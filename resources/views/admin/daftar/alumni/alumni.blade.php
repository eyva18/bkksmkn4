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
                    <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Daftar Alumni</h3>
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
            <div class="card">
                <div class="card-body collapse show">
                    <div class="row">
                        <div class="col-md-9">
                            <h4 class="card-title">Pencarian Alumni</h4>
                        </div>
                        <div class="col-md-3">
                            <a href="/alumni/create" class="btn btn-secondary full-size-width" style="border-radius:8px ">Tambah Alumni</a>
                        </div>
                    </div>
                <form action="/alumni" method="GET">
                    @method('get')
                    @csrf
                    <div class="row pdt-20 mb-4">
                        <div class="col-md-3 mb-2">
                            <select class="form-select full-size-width" id="idjurusan" name="idjurusan" value="{{ request('idjurusan') }}">
                                <option selected>Jurusan</option>
                                @foreach ($datajurusan as $item)
                                    @if(request('idjurusan') == $item->id)
                                        <option value="{{ $item->id ?? '-'}}" selected>{{ $item->jurusan ?? '-'}}</option>
                                    @else
                                        <option value="{{ $item->id ?? '-'}}">{{ $item->jurusan ?? '-'}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <select class="form-select full-size-width" id="idtahunlulus" name="idtahunlulus" value="{{ request('idtahunlulus') }}">
                                <option selected>Tahun Lulus</option>
                                @foreach ($datatahunlulus as $item)
                                    @if (request('idtahunlulus') == $item->id)
                                        <option value="{{ $item->id ?? '-'}}"selected>{{ $item->tahun_lulus ?? '-'}}</option>
                                    @else
                                        <option value="{{ $item->id ?? '-'}}">{{ $item->tahun_lulus ?? '-'}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <input type="text" id="nama_alumni" name="nama_alumni" class="form-control" placeholder="Nama Alumni" value="{{ request('nama_alumni') }}">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary full-size-width" style="border-radius: 8px">Cari Alumni</button>
                        </div>
                    </div>
                </form>
            <div class="row">
                <div class="col-md-12">
                    @if (session()->has('success'))
                        <div class="alert alert-info" role="alert">
                            <strong>Info!</strong> {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                @if ($dataalumni[0] == null)
                <div class="col-sm-12 mr">
                    <div class="card">
                        <div class="card-body collapse show">
                            <div class="row">
                                <div class="col-md-12 text-center mt-3">
                                    <h4 class="card-title">Tidak Tersedia</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @foreach ($dataalumni as $alumni)
                    <div class="col-md-6">
                        <div class="card border-top-300">
                            <div class="col-md-12 p-4">
                                <h4 class="card-title">{{ $alumni->nama ?? '-' }}</h4>
                                <p class="card-description text-primary">
                                    Kelengkapan Profile {{ $percentasaeprofile[$alumni->nisn] }}
                                </p>
                                <ul class="list-unstyled">
                                    <li class="media d-flex align-items-start alumni-show">
                                        <img class="d-flex me-3 logo-alumni"
                                            src="{{ URL::asset('storage') . '/' . $alumni->photo_profile }}"
                                            alt="Logo {{ $alumni->nama }}" width="20%" style="max-height: 200">
                                        <div class="media-body">
                                            <ul class="list-unstyled">
                                                <li><i class="fas fa-key color-23"></i> <span
                                                    class="mrl-10 text-black text-capitalize">{{ $alumni->nis ?? '-' }}</span>
                                                <li><i class="fas fa-graduation-cap color-23"></i> <span
                                                        class="mrl-5 text-black">{{ $alumni->jurusan->jurusan ?? '-' }} -
                                                        {{ $alumni->tahunlulus->tahun_lulus ?? '-' }}</span></li>
                                                <li><i class="fas fa-birthday-cake color-23"></i> <span
                                                        class="mrl-10 text-black text-capitalize">{{ $alumni->tempatTanggalLahir ?? '-' }}</span>
                                                </li>
                                                <li><i class="fas fa-user color-23"></i> <span
                                                        class="mrl-10 text-black text-capitalize">{{ $alumni->Jenis_Kelamin->jenis_kelamin ?? '-' }}</span>
                                                </li>
                                                <li><i class="fas fa-fas fa-phone color-23"></i> <span class="mrl-10 text-black text-capitalize">{{ $alumni->no_hp ?? '-' }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <form action="/alumni/{{ $alumni->nama }}/show" method="get">
                                @method('get')
                                @csrf
                                <input type="hidden" name="id" class="form-control form-control-lg" value="{{ $alumni->id }}">
                                <button class="btn btn-primary full-size-width">Profile Alumni</button>
                            </form>
                            <ul class="list-unstyled d-flex none-mbt">
                                <li class="full-size-width">
                                    <button type="button" class="btn btn-danger text-white full-size-width"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deletemodal{{ $alumni->id ?? '-' }}">Hapus</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    {{-- Modal Delete Start --}}
                    <div id="deletemodal{{ $alumni->id ??'-' }}" class="modal fade" tabindex="-1" role="dialog"
                        aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content modal-filled bg-danger">
                                <div class="modal-body p-4">
                                    <div class="text-center">
                                        <i class="dripicons-wrong h1"></i>
                                        <h4 class="mt-2">Peringatan!</h4>
                                        <p class="mt-3">Apakan Ingin Melanjutkan Menghapus data: <br> NISN:
                                            {{ $alumni->nisn }}
                                            | {{ $alumni->nama }}</p>
                                        <form action="/alumni/{{ $alumni->nama }}/destroy" method="post">
                                            @method('post')
                                            @csrf
                                            <input type="hidden" name="id" id="newsletter-id" class="form-control form-control-lg" value="{{ $alumni->id }}">
                                            <button type="submit" class="btn btn-light my-2" >Delete</button>
                                        </form>
                                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Modal Delete End --}}
                @endforeach
                <div class="d-flex flex-column">{{ $dataalumni->links() }}</div>
                <br>
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
@endsection
