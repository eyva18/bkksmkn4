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
                            <a href="/admin/administrator/master/alumni/create"
                                class="btn btn-primary full-size-width">Tambah Alumni</a>

                        </div>
                    </div>
                    <div class="row pdt-20">
                        <div class="col-md-3">
                            <form action="/admin/administrator/master/alumni" method="GET">
                                @method('GET')
                                @csrf
                            <select class="form-select full-size-width" id="idjurusan" name="idjurusan" value="{{ request('idjurusan') }}">
                                <option selected>Jurusan</option>
                                @foreach ($datajurusan as $item)
                                    @if(request('idjurusan') == $item->id)
                                        <option value="{{ $item->id }}" selected>{{ $item->jurusan }}</option>
                                    @else
                                        <option value="{{ $item->id }}">{{ $item->jurusan }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select full-size-width" id="idtahunlulus" name="idtahunlulus" value="{{ request('idtahunlulus') }}">
                                <option selected>Tahun Lulus</option>
                                @foreach ($datatahunlulus as $item)
                                    @if (request('idtahunlulus') == $item->id)
                                        <option value="{{ $item->id }}"selected>{{ $item->tahun_lulus }}</option>
                                    @else
                                        <option value="{{ $item->id }}">{{ $item->tahun_lulus }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                                <input type="text" id="nama_alumni" name="nama_alumni"
                                    class="form-control" placeholder="Nama Alumni" value="{{ request('nama_alumni') }}">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary full-size-width">Cari
                                Alumni</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($dataalumni as $alumni)
                    <div class="col-md-6">
                        <div class="card border-top-300">
                            <div class="col-md-12 p-4">
                                <h4 class="card-title">{{ $alumni->nama ?? '-' }}</h4>
                                <ul class="list-unstyled">
                                    <li class="media d-flex align-items-start">
                                        <img class="d-flex me-3 logo-alumni"
                                            src="{{ URL::asset('images/profileimg/') . '/' . $alumni->photo_profile }}"
                                            alt="Logo {{ $alumni->nama }}" width="20%" style="max-height: 200">
                                        <div class="media-body">
                                            <ul class="list-unstyled">
                                                <li><i class="fas fa-key color-23"></i> <span
                                                    class="mrl-10 text-black text-capitalize">{{ $alumni->NIS ?? '-' }}</span>
                                                <li><i class="fas fa-graduation-cap color-23"></i> <span
                                                        class="mrl-5 text-black">{{ $alumni->jurusan->jurusan ?? '-' }} -
                                                        {{ $alumni->tahunlulus->tahun_lulus ?? '-' }}</span></li>
                                                <li><i class="fas fa-birthday-cake color-23"></i> <span
                                                        class="mrl-10 text-black text-capitalize">{{ $alumni->TTL ?? '-' }}</span>
                                                </li>
                                                <li><i class="fas fa-user color-23"></i> <span
                                                        class="mrl-10 text-black text-capitalize">{{ $alumni->jk ?? '-' }}</span>
                                                </li>
                                                <li><i class="fas fa-fas fa-phone color-23"></i> <span
                                                        class="mrl-10 text-black text-capitalize">{{ $alumni->no_hp ?? '-' }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <form
                                action="/admin/administrator/master/alumni/profile/{{ str_replace(' ', '-', $alumni->nama) }}"
                                method="post">
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" name="id" id="newsletter-id"
                                        class="form-control form-control-lg" value="{{ $alumni->id }}">
                                </div>
                                <button type="submit" class="btn btn-primary full-size-width">Profile Alumni</button>
                            </form>
                            <ul class="list-unstyled d-flex none-mbt">
                                <li class="half-size-width">
                                    <a href="javascript:void(0)"
                                        class="btn btn-warning text-white full-size-width">Masuk</a>
                                </li>
                                <li class="half-size-width">
                                    <button type="button" class="btn btn-danger text-white full-size-width"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deletemodal{{ $alumni->id }}">Hapus</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    {{-- Modal Delete Start --}}
                    <div id="deletemodal{{ $alumni->id }}" class="modal fade" tabindex="-1" role="dialog"
                        aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content modal-filled bg-danger">
                                <div class="modal-body p-4">
                                    <div class="text-center">
                                        <i class="dripicons-wrong h1"></i>
                                        <h4 class="mt-2">Peringatan!</h4>
                                        <p class="mt-3">Apakan Ingin Melanjutkan Menghapus data: <br> ID:
                                            {{ $alumni->id }}
                                            | {{ $alumni->nama }}</p>
                                        <form action="/admin/alumni/{{ $alumni->id }}" method="post">
                                            @method('delete')
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
    <script src="{{ URL::asset('asset/plugins/adminpage/chart/chart_dashboard.js') }}"></script>
@endsection
