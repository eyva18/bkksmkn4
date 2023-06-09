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
                <div class="col-md-4">
                    <!-- Card -->
                    <div class="card">
                        <img class="card-img-top img-fluid" src="{{ URL::asset('storage' . '/' . $dataAlumni->photo_profile) }}"
                            height="50%" alt="Card image cap">
                        <div class="card-body">
                            <h3 class="card-title">{{ $dataAlumni->nama }}</h3>
                            <h3>Personal</h3>
                            <ul class="list-unstyled">
                                <li><i class="	fas fa-birthday-cake color-23"></i> <span
                                        class="mrl-5 text-black">{{ $dataAlumni->tempatTanggalLahir }}</span></li>
                                <li><i class="fas fa-heart color-23"></i> <span class="mrl-5 text-black">{{ $dataAlumni->Agama->agama ?? null }}</span></li>
                                <li><i class="fas fa-user color-23"></i> <span class="mrl-5 text-black">{{ $dataAlumni->Jenis_Kelamin->jenis_kelamin ?? null }}</span>
                                </li>
                            </ul>
                            <h3>Contact</h3>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-at color-23"></i> <span
                                        class="mrl-5 text-black">{{ $dataUser->email }}</span></li>
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
                                    <h4 class="mb-0 text-white">Biografi <button class="icon-button-modal" data-bs-toggle="modal" data-bs-target="#editbiografi"><i class="fas fa-pencil-alt text-white mrl-10"></i></button></h4>
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
                                    <h4 class="mb-0 text-white">Pengalaman Kerja <button class="icon-button-modal" data-bs-toggle="modal" data-bs-target="#pengalamankerja"><i class="fas fa-plus text-white mrl-10"></i></button></h4>
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

                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-dark">
                                    <h4 class="mb-0 text-white">Sertifikasi <button class="icon-button-modal" data-bs-toggle="modal" data-bs-target="#sertifikasiModal"><i class="fas fa-plus text-white mrl-10"></i></button></h4>
                                </div>
                                <div class="card-body">
                                    @foreach ($dataSertifikasi as $data)
                                        <div class="row">
                                            <div class="col-6-md d-flex justify-content-center">
                                                <a class="gallery-popup" href="{{ URL::asset('storage/'. $data->file_sertifikasi) }}" aria-label="project-img">
                                                    <img class="img-fluid" src="{{ URL::asset('storage/'. $data->file_sertifikasi) }}" style="width: 120px" alt="project-img">
                                                </a>
                                            </div>
                                            <div class="col-6-md p-3">
                                                <a href="{{ $data->link_sertifikasi }}" style="text-decoration: none"><p class="fw-bold fs-3">{{ $data->nama_sertifikasi }}</p></a>
                                                <h5 class="fw-bold">{{ $data->nama_penerbit }}</h5>
                                                <h5>Diterbitkan : {{ $data->tahun_terbit }}</h5>
                                            </div>
                                            <div class="col-12-md my-2 d-flex justify-content-between">
                                                <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editsertifikat{{ $data->id }}"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletesertifikat{{ $data->id }}"><i class="fas fa-trash"></i></button>
                                            </div>
                                            <hr>
                                        </div>

                                        {{-- Modal Tambah Sertifikasi --}}
                                        <div class="modal fade" id="editsertifikat{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myLargeModalLabel">Folmulir Sertifikasi</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                    </div>
                                                    <form action="/alumni/sertifikasi/update" method="post" enctype="multipart/form-data">
                                                        @method('post')
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                                        <div class="modal-body">
                                                            <div class="row p-2">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="sertifikat" class="content-hidden">Nama Sertifikat <span class="text-red"> *</span></label>
                                                                        <input type="text" id="sertifikat" name="nama_sertifikasi" class="form-control @error('nama_sertifikasi') is-invalid @enderror" value="{{ old('nama_sertifikasi', $data->nama_sertifikasi) }}">
                                                                            @error('nama_sertifikasi')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="instansi" class="content-hidden">Nama Instansi Penerbit<span class="text-red"> *</span></label>
                                                                        <input type="text" id="instansi" name="nama_penerbit" class="form-control @error('nama_penerbit') is-invalid @enderror" value="{{ old('nama_penerbit', $data->nama_penerbit) }}">
                                                                            @error('nama_penerbit')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <input type="checkbox" id="waktuSertifikat" name="waktuSertifikat" class="@error('waktuSertifikat') is-invalid @enderror" value="">
                                                                        <label for="waktuSertifikat">Sertifikat Tidak Akan Kadaluarsa</label>
                                                                        @error('waktuSertifikat')
                                                                            <div class="invalid-feedback">
                                                                                {{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="content-hidden">Tahun Terbit <span class="text-red"> *</span></label>
                                                                        <input type="date" id="example-input-large" name="tahun_terbit" class="form-control @error('tahun_terbit') is-invalid @enderror" value="{{ old('tahun_terbit', $data->tahun_terbit) }}">
                                                                        <p class="card-description fw-medium text-danger mt-2">
                                                                            Data Sebelumnya: {{ $data->tahun_terbit }}.
                                                                        </p>
                                                                        @error('tahun_terbit')
                                                                            <div class="invalid-feedback">
                                                                                {{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="content-hidden">Tahun Kadaluarsa <span class="text-red"> *</span></label>
                                                                        <input type="date" id="example-input-large" name="tahun_kadaluarsa" class="form-control @error('tahun_kadaluarsa') is-invalid @enderror" value="{{ old('tahun_kadaluarsa', $data->tahun_kadaluarsa) }}">
                                                                        <p class="card-description fw-medium text-danger mt-2">
                                                                            Data Sebelumnya: {{ $data->tahun_kadaluarsa }}.
                                                                        </p>
                                                                        @error('tahun_kadaluarsa')
                                                                            <div class="invalid-feedback">
                                                                                {{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="kodesertifikat" class="content-hidden">Kode Sertifikasi<span class="text-red"> *</span></label>
                                                                        <input type="text" id="kodesertifikat" name="kode_sertifikasi" class="form-control @error('kode_sertifikasi') is-invalid @enderror" value="{{ old('kode_sertifikasi', $data->kode_sertifikasi) }}">
                                                                            @error('kode_sertifikasi')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="link" class="content-hidden">Link Sertifikasi<span class="text-red"> *</span></label>
                                                                        <input type="text" id="link" name="link_sertifikasi" class="form-control @error('link_sertifikasi') is-invalid @enderror" value="{{ old('link_sertifikasi', $data->link_sertifikasi) }}">
                                                                            @error('link_sertifikasi')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="fileSertifikat" class="content-hidden">File Sertifikat<span class="text-red"> *</span></label>
                                                                        <input type="hidden" name="oldSertifikasi" value="{{ $data->file_sertifikasi }}">
                                                                        <input class="form-control @error('file_sertifikasi') is-invalid @enderror" name="file_sertifikasi" type="file" id="fileSertifikat" value="{{ old('file_sertifikasi') }}">
                                                                        <p class="card-description fw-medium text-danger mt-2">
                                                                            Kosongkan file jika tidak ingin dirubah.
                                                                        </p>
                                                                        @error('file_sertifikasi')
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
        
                                        {{-- Modal Delete Start --}}
                                        <div id="deletesertifikat{{ $data->id ?? '-' }}" class="modal fade text-light" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content modal-filled bg-danger">
                                                    <div class="modal-body p-4">
                                                        <div class="text-center">
                                                            <i class="dripicons-wrong h1"></i>
                                                            <h4 class="mt-2">Peringatan!</h4>
                                                            <p class="mt-3">Apakan Ingin Melanjutkan Menghapus Data Sertifikasi</p>
                                                            <form action="/alumni/sertifikasi/destroy" method="post">
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
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-dark">
                                    <h4 class="mb-0 text-white">Penghargaan Lomba <button class="icon-button-modal" data-bs-toggle="modal" data-bs-target="#lombaModal"><i class="fas fa-plus text-white mrl-10"></i></button></h4>
                                </div>
                                <div class="card-body">
                                    @foreach ($dataSertifikasiLomba as $data)
                                        <div class="row">
                                            <div class="col-6-md d-flex justify-content-center">
                                                <a class="gallery-popup" href="{{ URL::asset('storage/'.$data->file_sertifikasi) }}" aria-label="project-img">
                                                    <img class="img-fluid" src="{{ URL::asset('storage/'.$data->file_sertifikasi) }}" style="width: 120px" alt="project-img">
                                                </a>
                                            </div>
                                            <div class="col-6-md p-3">
                                                <p class="fw-bold fs-3 text-dark">{{ $data->nama_juara_kompetensi }}</p>
                                                <h5>{{ $data->TingkatPerlombaan->tingkat_lomba }}</h5>
                                                <h5>Didapatkan : {{ $data->tanggal_terbit }}</h5>
                                            </div>
                                            <div class="col-12-md my-2 d-flex justify-content-between">
                                                <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editsertifikatlomba{{ $data->id }}"><i class="fas fa-edit text-light"></i></button>
                                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletesertifikatlomba{{ $data->id }}"><i class="fas fa-trash text-light"></i></button>
                                            </div>
                                            <hr>
                                        </div>
        
                                        {{-- Modal Tambah Sertifikasi Perlombaan --}}
                                        <div class="modal fade" id="editsertifikatlomba{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myLargeModalLabel">Folmulir Sertifikasi Perlombaan</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                    </div>
                                                    <form action="/alumni/sertifikasilomba/update" method="post" enctype="multipart/form-data">
                                                        @method('post')
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                                        <div class="modal-body">
                                                            <div class="row p-2">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="sertifikatLomba" class="content-hidden">Nama Juara Kompetensi <span class="text-red"> *</span></label>
                                                                        <input type="text" id="sertifikatLomba" name="nama_juara_kompetensi" class="form-control @error('nama_juara_kompetensi') is-invalid @enderror" value="{{ old('nama_juara_kompetensi', $data->nama_juara_kompetensi) }}">
                                                                            @error('nama_juara_kompetensi')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="tingkatLomba" class="content-hidden">Tingkat Perlombaan <span class="text-red"> *</span></label>
                                                                        <select class="form-select full-size-width  @error('tingkat_perlombaan') is-invalid @enderror" id="tingkatLomba" name="tingkat_perlombaan">
                                                                            <option selected>Tingkat Perlombaan</option>
                                                                            @foreach ($dataTingkatPerlombaan as $item)
                                                                                @if (old('tingkat_perlombaan', $data->tingkat_perlombaan) == $item->id)
                                                                                    <option value="{{ $item->id }}" selected>{{ $item->tingkat_lomba }}</option>
                                                                                @else
                                                                                    <option value="{{ $item->id }}">{{ $item->tingkat_lomba }}</option>
                                                                                @endif
                                                                            @endforeach
                                                                        </select>
                                                                        @error('tingkat_perlombaan')
                                                                            <div class="invalid-feedback">
                                                                                {{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <input type="checkbox" id="waktusertifikat" name="waktuSertifikat" class="@error('waktuSertifikat') is-invalid @enderror" value="">
                                                                        <label for="waktusertifikat">Sertifikat Tidak Akan Kadaluarsa</label>
                                                                        @error('waktuSertifikat')
                                                                            <div class="invalid-feedback">
                                                                                {{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="content-hidden">Tahun Terbit <span class="text-red"> *</span></label>
                                                                        <input type="date" id="example-input-large" name="tanggal_terbit" class="form-control @error('tanggal_terbit') is-invalid @enderror" value="{{ old('tanggal_terbit') }}">
                                                                        <p class="card-description fw-medium text-danger mt-2">
                                                                            Data Sebelumnya: {{ $data->tanggal_terbit }}.
                                                                        </p>
                                                                        @error('tanggal_terbit')
                                                                            <div class="invalid-feedback">
                                                                                {{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="content-hidden">Tahun Kadaluarsa <span class="text-red"> *</span></label>
                                                                        <input type="date" id="example-input-large" name="tanggal_kadaluarsa" class="form-control @error('tanggal_kadaluarsa') is-invalid @enderror" value="{{ old('tanggal_kadaluarsa') }}">
                                                                        <p class="card-description fw-medium text-danger mt-2">
                                                                            Data Sebelumnya: {{ $data->tanggal_kadaluarsa }}.
                                                                        </p>
                                                                        @error('tanggal_kadaluarsa')
                                                                            <div class="invalid-feedback">
                                                                                {{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="fileSertifikat" class="content-hidden">File Sertifikat Perlombaan<span class="text-red"> *</span></label>
                                                                        <input type="hidden" name="oldSertifikasi" value="{{ $data->file_sertifikasi }}">
                                                                        <input class="form-control @error('file_sertifikasi') is-invalid @enderror" name="file_sertifikasi" type="file" id="fileSertifikat" value="{{ old('file_sertifikasi') }}">
                                                                        <p class="card-description fw-medium text-danger mt-2">
                                                                            Kosongkan file jika tidak ingin dirubah.
                                                                        </p>
                                                                        @error('file_sertifikasi')
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
        
                                        {{-- Modal Delete Start --}}
                                        <div id="deletesertifikatlomba{{ $data->id ?? '-' }}" class="modal fade text-light" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content modal-filled bg-danger">
                                                    <div class="modal-body p-4">
                                                        <div class="text-center">
                                                            <i class="dripicons-wrong h1"></i>
                                                            <h4 class="mt-2">Peringatan!</h4>
                                                            <p class="mt-3">Apakan Ingin Melanjutkan Menghapus Data Penghargaan Lomba?</p>
                                                            <form action="/alumni/sertifikasilomba/destroy" method="post">
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
                                    @endforeach
                                </div>
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
                                    <div class="form-group mb-2">
                                        <label class="content-hidden">Tahun Berakhir <span class="text-red"> *</span></label>
                                        <input type="date" id="example-input-large" name="tahun_akhir_pendidikan" class="form-control @error('tahun_akhir_pendidikan') is-invalid @enderror" value="{{ old('tahun_akhir_pendidikan') }}">
                                        @error('tahun_akhir_pendidikan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" id="checkstatus" name="checkstatus" class="@error('') is-invalid @enderror" value="">
                                        <label for="checkstatus">Masih Bersekolah Sampai Sekarang</label>
                                        @error('')
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

        {{-- Modal Tambah Sertifikasi --}}
        <div class="modal fade" id="sertifikasiModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Folmulir Sertifikasi</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <form action="/alumni/sertifikasi/store" method="post" enctype="multipart/form-data">
                        @method('post')
                        @csrf
                        <input type="hidden" name="id" value="{{ $dataAlumni->id }}">
                        <div class="modal-body">
                            <div class="row p-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="sertifikat" class="content-hidden">Nama Sertifikat <span class="text-red"> *</span></label>
                                        <input type="text" id="sertifikat" name="nama_sertifikasi" class="form-control @error('nama_sertifikasi') is-invalid @enderror" value="{{ old('nama_sertifikasi') }}">
                                            @error('nama_sertifikasi')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="instansi" class="content-hidden">Nama Instansi Penerbit<span class="text-red"> *</span></label>
                                        <input type="text" id="instansi" name="nama_penerbit" class="form-control @error('nama_penerbit') is-invalid @enderror" value="{{ old('nama_penerbit') }}">
                                            @error('nama_penerbit')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="checkbox" id="waktuSertifikat" name="waktuSertifikat" class="@error('waktuSertifikat') is-invalid @enderror" value="">
                                        <label for="waktuSertifikat">Sertifikat Tidak Akan Kadaluarsa</label>
                                        @error('waktuSertifikat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="content-hidden">Tahun Terbit <span class="text-red"> *</span></label>
                                        <input type="date" id="example-input-large" name="tahun_terbit" class="form-control @error('tahun_terbit') is-invalid @enderror" value="{{ old('tahun_terbit') }}">
                                        @error('tahun_terbit')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="content-hidden">Tahun Kadaluarsa <span class="text-red"> *</span></label>
                                        <input type="date" id="example-input-large" name="tahun_kadaluarsa" class="form-control @error('tahun_kadaluarsa') is-invalid @enderror" value="{{ old('tahun_kadaluarsa') }}">
                                        @error('tahun_kadaluarsa')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kodesertifikat" class="content-hidden">Kode Sertifikasi<span class="text-red"> *</span></label>
                                        <input type="text" id="kodesertifikat" name="kode_sertifikasi" class="form-control @error('kode_sertifikasi') is-invalid @enderror" value="{{ old('kode_sertifikasi') }}">
                                            @error('kode_sertifikasi')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="link" class="content-hidden">Link Sertifikasi<span class="text-red"> *</span></label>
                                        <input type="text" id="link" name="link_sertifikasi" class="form-control @error('link_sertifikasi') is-invalid @enderror" value="{{ old('link_sertifikasi') }}">
                                            @error('link_sertifikasi')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="fileSertifikat" class="content-hidden">File Sertifikat<span class="text-red"> *</span></label>
                                        <input class="form-control @error('file_sertifikasi') is-invalid @enderror" name="file_sertifikasi" type="file" id="fileSertifikat" value="{{ old('file_sertifikasi') }}">
                                        @error('file_sertifikasi')
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

        {{-- Modal Tambah Sertifikasi Perlombaan --}}
        <div class="modal fade" id="lombaModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Folmulir Sertifikasi Perlombaan</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <form action="/alumni/sertifikasilomba/store" method="post" enctype="multipart/form-data">
                        @method('post')
                        @csrf
                        <input type="hidden" name="id" value="{{ $dataAlumni->id }}">
                        <div class="modal-body">
                            <div class="row p-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="sertifikatLomba" class="content-hidden">Nama Juara Kompetensi <span class="text-red"> *</span></label>
                                        <input type="text" id="sertifikatLomba" name="nama_juara_kompetensi" class="form-control @error('nama_juara_kompetensi') is-invalid @enderror" value="{{ old('nama_juara_kompetensi') }}">
                                            @error('nama_juara_kompetensi')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="tingkatLomba" class="content-hidden">Tingkat Perlombaan <span class="text-red"> *</span></label>
                                        <select class="form-select full-size-width  @error('tingkat_perlombaan') is-invalid @enderror" id="tingkatLomba" name="tingkat_perlombaan">
                                            <option selected>Tingkat Perlombaan</option>
                                            @foreach ($dataTingkatPerlombaan as $data)
                                                @if (old('tingkat_perlombaan') == $data->id)
                                                    <option value="{{ $data->id }}" selected>{{ $data->tingkat_lomba }}</option>
                                                @else
                                                    <option value="{{ $data->id }}">{{ $data->tingkat_lomba }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('tingkat_perlombaan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="checkbox" id="waktusertifikat" name="waktuSertifikat" class="@error('waktuSertifikat') is-invalid @enderror" value="">
                                        <label for="waktusertifikat">Sertifikat Tidak Akan Kadaluarsa</label>
                                        @error('waktuSertifikat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="content-hidden">Tahun Terbit <span class="text-red"> *</span></label>
                                        <input type="date" id="example-input-large" name="tanggal_terbit" class="form-control @error('tanggal_terbit') is-invalid @enderror" value="{{ old('tanggal_terbit') }}">
                                        @error('tanggal_terbit')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="content-hidden">Tahun Kadaluarsa <span class="text-red"> *</span></label>
                                        <input type="date" id="example-input-large" name="tanggal_kadaluarsa" class="form-control @error('tanggal_kadaluarsa') is-invalid @enderror" value="{{ old('tanggal_kadaluarsa') }}">
                                        @error('tanggal_kadaluarsa')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="fileSertifikat" class="content-hidden">File Sertifikat Perlombaan<span class="text-red"> *</span></label>
                                        <input class="form-control @error('file_sertifikasi') is-invalid @enderror" name="file_sertifikasi" type="file" id="fileSertifikat" value="{{ old('file_sertifikasi') }}">
                                        @error('file_sertifikasi')
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
