@extends('layout.admin.dashboard')
@section('css-tambahan')
@endsection
@section('page-wrapper')
    <!-- ============================================================== -->
    <!-- Page wrapper -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-7 align-self-center">
                    <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Profile Alumni</h3>
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
                <!-- column -->
                <div class="col-lg-4 col-md-6">
                    <!-- Card -->
                    <div class="card">
                        {{-- @dd($dataAlumni->photo_profile) --}}
                        <img class="card-img-top img-fluid" src="{{ URL::asset('storage' . '/' . $dataAlumni->photo_profile) }}"
                            height="50%" alt="Card image cap">
                        <div class="card-body">
                            <h3 class="card-title">{{ $dataAlumni->nama }}</h3>
                            <h3>Personal</h3>
                            <ul class="list-unstyled">
                                <li><i class="	fas fa-birthday-cake color-23"></i> <span
                                        class="mrl-5 text-black">{{ $dataAlumni->tempatTanggalLahir }}</span></li>
                                <li><i class="fas fa-heart color-23"></i> <span class="mrl-5 text-black">{{ $dataAlumni->Agama->agama }}</span></li>
                                <li><i class="fas fa-user color-23"></i> <span class="mrl-5 text-black">{{ $dataAlumni->Jenis_Kelamin->jenis_kelamin }}</span>
                                </li>
                            </ul>
                            <h3>Contact</h3>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-at color-23"></i> <span
                                        class="mrl-5 text-black">{{ Auth()->user()->email }}</span></li>
                                <li><i class="fas fa-phone color-23"></i> <span
                                        class="mrl-5 text-black">{{ $dataAlumni->no_hp }}</span></li>
                            </ul>
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <form action="/alumni/{{ $dataAlumni->nama }}/edit" method="post">
                                        @method('get')
                                        @csrf
                                        <input type="hidden" name="id" class="form-control form-control-lg" value="{{ $dataAlumni->id }}">
                                        <button type="submit" class="btn btn-light my-2" >Ubah Profile</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card -->
                </div>
                <!-- column -->
                <!-- column -->
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card border-dark">
                                <div class="card-header bg-dark">
                                    <h4 class="mb-0 text-white">Biografi <button class="icon-button-modal"
                                            data-bs-toggle="modal" data-bs-target="#editbiografi"><i
                                                class="fas fa-pencil-alt text-white mrl-10"></i></button></h4>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">{!! $dataAlumni->biografi !!}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card border-dark">
                                <div class="card-header bg-dark">
                                    <h4 class="mb-0 text-white">Riwayat Pendidikan <button class="icon-button-modal" data-bs-toggle="modal" data-bs-target="#addriwayatpendidikan"><i class="fas fa-plus text-white mrl-10"></i></button></h4>
                                </div>
                                @foreach ($dataPendidikan as $riwayat)
                                    <div class="card-body">
                                        <h3 class="card-text text-black">{{ $riwayat->nama_instansi }} <button class="icon-button-modal" data-bs-toggle="modal" data-bs-target="#editpendidikan{{ $riwayat->id }}"><i class="fas fa-pencil-alt text-black mrl-10"></i></button></h3>
                                        <p>{{ $riwayat->Pendidikan->jenis_pendidikan }} - Nilai Rata-Rata : {{ $riwayat->nilai_rata_rata }} <br>Lulus Tahun : {{ $riwayat->tahun_akhir_pendidikan }}</p>
                                        <h3>
                                            <button type="button" class="icon-button-modal" data-bs-toggle="modal" data-bs-target="#deletePendidikanmodal{{ $riwayat->id ??'-' }}">
                                                <i class="fas fa-trash-alt text-red mrl-20"></i>
                                            </button>
                                        </h3>
                                        <hr>
                                    </div>
                                    {{-- Modal Delete Start --}}
                                    <div id="deletePendidikanmodal{{ $riwayat->id ??'-' }}" class="modal fade" tabindex="-1" role="dialog"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content modal-filled bg-danger">
                                                <div class="modal-body p-4">
                                                    <div class="text-center">
                                                        <i class="dripicons-wrong h1"></i>
                                                        <h4 class="mt-2">Peringatan!</h4>
                                                        <p class="mt-3">Apakan Ingin Melanjutkan Menghapus Data Pendidikan</p>
                                                        <form action="/alumni/pendidikan/delete" method="post">
                                                            @method('post')
                                                            @csrf
                                                            <input type="hidden" name="id" id="newsletter-id" class="form-control form-control-lg" value="{{ $riwayat->id }}">
                                                            <button type="submit" class="btn btn-light my-2">Delete</button>
                                                        </form>
                                                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Modal Delete End --}}

                                    {{-- Modal Edit Riwayat Pendidikan --}}        
                                    <div class="modal fade" id="editpendidikan{{ $riwayat->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myLargeModalLabel">Formulir Riwayat Pendidikan</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                </div>
                                                <form action="/alumni/pendidikan/update" method="post">
                                                    @method('post')
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $riwayat->id }}">
                                                    <input type="hidden" name="nisn" value="{{ $dataAlumni->nisn }}">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="newsletter-kategori" class="content-hidden">Nama Instansi <span class="text-red"> *</span></label>
                                                                    {{-- @dd($dataPendidikan->nama_instansi) --}}
                                                                    <input type="text" id="example-input-large" name="nama_instansi" class="form-control @error('nama_instansi') is-invalid @enderror" value="{{ old('nama_instansi', $riwayat->nama_instansi) }}">
                                                                    @error('nama_instansi')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="newsletter-kategori" class="content-hidden">Jenis Pendidikan <span class="text-red"> *</span></label>
                                                                    <select class="form-select full-size-width @error('jenis_pendidikan') is-invalid @enderror" name="jenis_pendidikan" id="jenis_pendidikan">
                                                                        <option selected>Jenis Pendidikan</option>
                                                                        @foreach ($dataJenisPendidikan as $item)
                                                                            @if (old('jenis_pendidikan', $riwayat->jenis_pendidikan) == $item->id)
                                                                                <option value="{{ $item->id }}" selected>{{ $item->jenis_pendidikan }}</option>
                                                                            @else
                                                                                <option value="{{ $item->id }}">{{ $item->jenis_pendidikan }}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                    @error('jenis_pendidikan')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="newsletter-kategori" class="content-hidden">Nilai Rata - Rata <span class="text-red"> *</span></label>
                                                                    <input type="text" id="example-input-large" name="nilai_rata_rata" class="form-control @error('nilai_rata_rata') is-invalid @enderror" value="{{ old('nilai_rata_rata', $riwayat->nilai_rata_rata) }}">
                                                                    @error('nilai_rata_rata')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="content-hidden">Tahun Dimulai <span class="text-red"> *</span></label>
                                                                    <input type="date" id="example-input-large" name="tahun_awal_pendidikan" class="form-control @error('tahun_awal_pendidikan') is-invalid @enderror">
                                                                    <p class="card-description fw-medium">
                                                                        Data Sebelumnya: {{ $riwayat->tahun_awal_pendidikan }}.
                                                                    </p>
                                                                    @error('tahun_awal_pendidikan')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="content-hidden">Tahun Berakhir <span class="text-red"> *</span></label>
                                                                    <input type="date" id="example-input-large" name="tahun_akhir_pendidikan" class="form-control @error('tahun_akhir_pendidikan', $riwayat->tahun_akhir_pendidikan) is-invalid @enderror">
                                                                    <p class="card-description fw-medium">
                                                                        Data Sebelumnya: {{ $riwayat->tahun_akhir_pendidikan }}.
                                                                    </p>
                                                                    @error('tahun_akhir_pendidikan')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="reset" class="btn btn-danger" data-dismiss="modal">Batalkan</button>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card border-dark">
                                <div class="card-header bg-dark">
                                    <h4 class="mb-0 text-white">Pengalaman Kerja <button class="icon-button-modal"
                                            data-bs-toggle="modal" data-bs-target="#pengalamankerja"><i
                                                class="fas fa-plus text-white mrl-10"></i></i></a></h4>
                                </div>
                                @foreach ($dataPekerjaan as $data)
                                    <div class="card-body">
                                        <h3 class="card-text text-black">{{ $data->bidang }} <button class="icon-button-modal" data-bs-toggle="modal" data-bs-target="#editpekerjaan{{ $data->id }}"><i class="fas fa-pencil-alt text-black mrl-10"></i></button></h3>
                                        <p>{{ $data->nama_perusahaan }} - {{ $data->Pekerjaan->jenis_pekerjaan }} <br>{{ $data->tahun_awal_pekerjaan }} - {{ $data->tahun_akhir_pekerjaan }}</p>
                                        <h3>
                                            <button type="button" class="icon-button-modal" data-bs-toggle="modal" data-bs-target="#deletePekerjaanModal{{ $data->id ??'-' }}"><i class="fas fa-trash-alt text-red mrl-20"></i>
                                            </button>
                                        </h3>
                                        <hr>
                                    </div>
                                    {{-- Modal Delete Start --}}
                                    <div id="deletePekerjaanModal{{ $data->id ??'-' }}" class="modal fade" tabindex="-1" role="dialog"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content modal-filled bg-danger">
                                                <div class="modal-body p-4">
                                                    <div class="text-center">
                                                        <i class="dripicons-wrong h1"></i>
                                                        <h4 class="mt-2">Peringatan!</h4>
                                                        <p class="mt-3">Apakan Ingin Melanjutkan Menghapus Data Pekerjaan</p>
                                                        <form action="/alumni/pekerjaan/delete" method="post">
                                                            @method('post')
                                                            @csrf
                                                            <input type="hidden" name="id" id="newsletter-id" class="form-control form-control-lg" value="{{ $data->id }}">
                                                            <button type="submit" class="btn btn-light my-2">Delete</button>
                                                        </form>
                                                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Modal Delete End --}}

                                    {{-- Modal Update Pengalaman Kerja --}}
                                    <div class="modal fade" id="editpekerjaan{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel">Folmulir Riwayat Pekerjaan</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                            </div>
                                            <form action="/alumni/pekerjaan/update" method="post">
                                                @method('post')
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $data->id }}">
                                                <input type="hidden" name="nisn" value="{{ $dataAlumni->nisn }}">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="newsletter-kategori" class="content-hidden">Nama Perusahaan <span class="text-red"> *</span></label>
                                                                <input type="text" id="example-input-large" name="nama_perusahaan" class="form-control @error('nama_perusahaan') is-invalid @enderror" value="{{ old('nama_perusahaan', $data->nama_perusahaan) }}">
                                                                    @error('nama_perusahaan')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="newsletter-kategori" class="content-hidden">Jenis Kepegawaian <span class="text-red"> *</span></label>
                                                                <select class="form-select full-size-width  @error('jenis_pekerjaan') is-invalid @enderror" id="inputGroupSelect01" name="jenis_pekerjaan">
                                                                    <option selected>Jenis Kepegawaian</option>
                                                                    @foreach ($dataJenisPekerjaan as $item)
                                                                        @if (old('jenis_pekerjaan', $data->jenis_pekerjaan) == $item->id)
                                                                            <option value="{{ $item->id }}" selected>{{ $item->jenis_pekerjaan }}</option>
                                                                        @else
                                                                            <option value="{{ $item->id }}">{{ $item->jenis_pekerjaan }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                                @error('jenis_pekerjaan')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="newsletter-kategori" class="content-hidden">Bidang <span class="text-red"> *</span></label>
                                                                <input type="text" id="example-input-large" name="bidang" class="form-control @error('bidang') is-invalid @enderror" value="{{ old('bidang', $data->bidang) }}">
                                                                @error('bidang')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="content-hidden">Tahun Dimulai <span class="text-red"> *</span></label>
                                                                <input type="date" id="example-input-large" name="tahun_awal_pekerjaan" class="form-control @error('tahun_awal_pekerjaan') is-invalid @enderror">
                                                                <p class="card-description fw-medium">
                                                                    Data Sebelumnya: {{ $data->tahun_awal_pekerjaan }}.
                                                                </p>
                                                                @error('tahun_awal_pekerjaan')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="content-hidden">Tahun Berakhir <span class="text-red"> *</span></label>
                                                                <input type="date" id="example-input-large" name="tahun_akhir_pekerjaan" class="form-control @error('tahun_akhir_pekerjaan') is-invalid @enderror">
                                                                <p class="card-description fw-medium">
                                                                    Data Sebelumnya: {{ $data->tahun_akhir_pekerjaan }}.
                                                                </p>
                                                                @error('tahun_akhir_pekerjaan')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="reset" class="btn btn-danger" data-dismiss="modal">Batalkan</button>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
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
        <!-- ============================================================== -->
        <!-- Start Modal -->
        <!-- ============================================================== -->
        {{-- Modal Biografi Edit --}}
        <div class="modal fade" id="editbiografi" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Edit Biografi</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <form action="/alumni/biografi/update" method="post">
                        @method('post')
                        @csrf
                        <input type="hidden" name="id" value="{{ $dataAlumni->id }}">
                        <div class="modal-body">
                            <div class="form-group">
                                <input id="biografi" placeholder="Tentang diri anda" class="form-control font-weight-normal @error('biografi') is-invalid @enderror" type="hidden" name="biografi" value="{{ old('biografi', $dataAlumni->biografi) }}">
                                <trix-editor input="biografi"></trix-editor>
                                @error('biografi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-danger" data-dismiss="modal">Batalkan</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- Modal Tambah Riwayat Pendidikan --}}
        <div class="modal fade" id="addriwayatpendidikan" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Formulir Riwayat Pendidikan</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <form action="/alumni/pendidikan/store" method="post">
                        @method('post')
                        @csrf
                        <input type="hidden" name="id" value="{{ $dataAlumni->id }}">
                        <input type="hidden" name="nisn" value="{{ $dataAlumni->nisn }}">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="newsletter-kategori" class="content-hidden">Nama Instansi <span class="text-red"> *</span></label>
                                        <input type="text" id="example-input-large" name="nama_instansi" class="form-control @error('nama_instansi') is-invalid @enderror" value="{{ old('nama_instansi') }}">
                                        @error('nama_instansi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="newsletter-kategori" class="content-hidden">Jenis Pendidikan <span class="text-red"> *</span></label>
                                        <select class="form-select full-size-width @error('jenis_pendidikan') is-invalid @enderror" name="jenis_pendidikan" id="jenis_pendidikan">
                                            <option selected>Jenis Pendidikan</option>
                                            @foreach ($dataJenisPendidikan as $item)
                                                @if (old('jenis_pendidikan') == $item->id)
                                                    <option value="{{ $item->id }}" selected>{{ $item->jenis_pendidikan }}</option>
                                                @else
                                                    <option value="{{ $item->id }}">{{ $item->jenis_pendidikan }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('jenis_pendidikan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="newsletter-kategori" class="content-hidden">Nilai Rata - Rata <span class="text-red"> *</span></label>
                                        <input type="text" id="example-input-large" name="nilai_rata_rata" class="form-control @error('nilai_rata_rata') is-invalid @enderror" value="{{ old('nilai_rata_rata') }}">
                                        @error('nilai_rata_rata')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="content-hidden">Tahun Dimulai <span class="text-red"> *</span></label>
                                        <input type="date" id="example-input-large" name="tahun_awal_pendidikan" class="form-control @error('tahun_awal_pendidikan') is-invalid @enderror" value="{{ old('tahun_awal_pendidikan') }}">
                                        @error('tahun_awal_pendidikan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="content-hidden">Tahun Berakhir <span class="text-red"> *</span></label>
                                        <input type="date" id="example-input-large" name="tahun_akhir_pendidikan" class="form-control @error('tahun_akhir_pendidikan') is-invalid @enderror" value="{{ old('tahun_akhir_pendidikan') }}">
                                        @error('tahun_akhir_pendidikan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-danger" data-dismiss="modal">Batalkan</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Modal Tambah Pengalaman Kerja --}}
        {{-- Ali kena yang buat edit riwayat nya kena copy dari sini aja nah kepanjangan wkwkwk --}}
        <div class="modal fade" id="pengalamankerja" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Folmulir Riwayat Pekerjaan</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <form action="/alumni/pekerjaan/store" method="post">
                        @method('post')
                        @csrf
                        <input type="hidden" name="id" value="{{ $dataAlumni->id }}">
                        <input type="hidden" name="nisn" value="{{ $dataAlumni->nisn }}">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="newsletter-kategori" class="content-hidden">Nama Perusahaan <span class="text-red"> *</span></label>
                                        <input type="text" id="example-input-large" name="nama_perusahaan" class="form-control @error('nama_perusahaan') is-invalid @enderror" value="{{ old('nama_perusahaan') }}">
                                            @error('nama_perusahaan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="newsletter-kategori" class="content-hidden">Jenis Kepegawaian <span class="text-red"> *</span></label>
                                        <select class="form-select full-size-width  @error('jenis_pekerjaan') is-invalid @enderror" id="inputGroupSelect01" name="jenis_pekerjaan">
                                            <option selected>Jenis Kepegawaian</option>
                                            @foreach ($dataJenisPekerjaan as $item)
                                                @if (old('jenis_pekerjaan') == $item->id)
                                                    <option value="{{ $item->id }}" selected>{{ $item->jenis_pekerjaan }}</option>
                                                @else
                                                    <option value="{{ $item->id }}">{{ $item->jenis_pekerjaan }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('jenis_pekerjaan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="newsletter-kategori" class="content-hidden">Bidang <span class="text-red"> *</span></label>
                                        <input type="text" id="example-input-large" name="bidang" class="form-control @error('bidang') is-invalid @enderror" value="{{ old('bidang') }}">
                                        @error('bidang')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="content-hidden">Tahun Dimulai <span class="text-red"> *</span></label>
                                        <input type="date" id="example-input-large" name="tahun_awal_pekerjaan" class="form-control @error('tahun_awal_pekerjaan') is-invalid @enderror" value="{{ old('tahun_awal_pekerjaan') }}">
                                        @error('tahun_awal_pekerjaan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="content-hidden">Tahun Berakhir <span class="text-red"> *</span></label>
                                        <input type="date" id="example-input-large" name="tahun_akhir_pekerjaan" class="form-control @error('tahun_akhir_pekerjaan') is-invalid @enderror" value="{{ old('tahun_akhir_pekerjaan') }}">
                                        @error('tahun_akhir_pekerjaan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-danger" data-dismiss="modal">Batalkan</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Modal  -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
@endsection
@section('js-tambahan')
    <script src="{{ URL::asset('asset/plugins/adminpage/chart/chartjs/Chart.js') }}"></script>
    <script src="{{ URL::asset('asset/plugins/adminpage/chart/chart_dashboard.js') }}"></script>
@endsection
