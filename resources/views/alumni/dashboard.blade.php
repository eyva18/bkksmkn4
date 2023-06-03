@extends('layout.alumni.layout')
@section('css-tambahan')
    <link href="{{ URL::asset('asset/plugins/adminpage/costume.css') }}" rel="stylesheet">
@endsection
@section('page-wrapper')
    <div class="row mt-rs-4">
        <div class="col-sm-4 mb-4 mb-xl-0">
            <div class="d-lg-flex align-items-center">
                <div>
                    <h3 class="text-dark fw-bold mb-2">Selamat Datang <u>{{ Auth::user()->name }}</u></h3>
                    <h5 class="font-weight-normal mb-2">Di Bursa Kerja Khusus SMKN 4 Banjarmasin </h5>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="d-flex align-items-center justify-content-evenly">
                <div class="pe-1 mb-3 mb-xl-0">
                    <a href="/lowongan-kerja" class="btn btn-outline-inverse-info btn-icon-text">
                        Daftar Lowongan
                    </a>
                </div>
                <div class="pe-1 mb-3 mb-xl-0">
                    <a href="/daftar-perusahaan" class="btn btn-outline-inverse-info btn-icon-text">
                        Daftar Perusahaan
                    </a>
                </div>
                <div class="pe-1 mb-3 mb-xl-0">
                    <a href="/profile/{{ $dataAlumni->nama }}" class="btn btn-outline-inverse-info btn-icon-text">
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
                        <img class="card-img-top img-fluid"
                            src="{{ URL::asset('storage' . '/' . $dataAlumni->photo_profile) }}" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title text-light fs-4">{{ $dataAlumni->nama ?? '-'}} ~ {{ $dataAlumni->nisn ?? '-'}}</h4>
                            <p class="card-text"><i class="mdi mdi-calendar-clock  text-light"></i> <span
                                    class="status-alumni">Lulus - {{ $dataAlumni->tahunlulus->tahun_lulus ?? '-'}}</span></p>
                            <p class="card-text"><i class="mdi mdi-school text-light"></i> <span
                                    class="status-alumni">{{ $dataAlumni->jurusan->jurusan ?? '-'}}</span></p>
                            <p class="card-text"><i class="mdi mdi-cake-layered  text-light"></i> <span
                                    class="status-alumni">{{ $dataAlumni->tempatTanggalLahir ?? '-'}}</span></p>
                            <p class="card-text"><i class=" mdi mdi-account text-light"></i> <span
                                    class="status-alumni">{{ $dataAlumni->Jenis_Kelamin->jenis_kelamin ?? '-'}}</span></p>
                            <p class="card-text"><i class="mdi mdi-phone text-light"></i> <span
                                    class="status-alumni">{{ $dataAlumni->no_hp ?? '-'}}</span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 grid-margin stretch-card">
                    <div class="card text-bg-dark mb-3" style="max-width: 18rem;">
                        <div class="card-header bg-dark">
                            <h5 class="fw-bold pt-2 fs-4 text-light">Status Alumni</h5>
                        </div>
                        <div class="card-body bg-dark text-light">
                            <p class="card-text"><i class="mdi mdi-office text-light"></i> <span
                                    class="status-alumni">{{ $dataStatusAlumni->StatusBekerja->status_bekerja }}</span></p>
                            <p class="card-text"><i class="mdi mdi-school text-light"></i> <span
                                    class="status-alumni">{{ $dataStatusAlumni->StatusPendidikan->status_pendidikan }}</span>
                            </p>
                            <p class="card-text"><i class="mdi mdi-chair-school text-light"></i> <span
                                    class="status-alumni">{{ $dataStatusAlumni->universitas ?? '-' }}</span></p>
                            <p class="card-text"><i class="mdi mdi-office-building text-light"></i> <span
                                    class="status-alumni">{{ $dataStatusAlumni->perusahaan ?? '-' }}</span></p>
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
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="fw-bold pt-2 text-light">Biografi</h4>
                            <button class="icon-button-modal" data-bs-toggle="modal" data-bs-target="#editbiografi"><i
                                    class="mdi mdi-grease-pencil text-primary fs-5"></i></button>
                        </div>
                        <div class="card-body">
                            <p>{!! $dataAlumni->biografi !!}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6 grid-margin d-flex stretch-card">
                    <div class="card bg-dark text-light" style="border-left: 15px solid white">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="fw-bold pt-2 text-light">Riwayat Pendidikan</h4>
                            <button class="icon-button-modal" data-bs-toggle="modal"
                                data-bs-target="#addriwayatpendidikan"><i
                                    class="mdi mdi-plus text-primary fs-5"></i></button>
                        </div>
                        <div class="card-body">
                            @foreach ($dataPendidikan as $data)
                                <h3 class="card-text fw-bolder">{{ $data->nama_instansi }} <button
                                        class="icon-button-modal" data-bs-toggle="modal"
                                        data-bs-target="#editpendidikan{{ $data->id }}"><i
                                            class="mdi mdi-pencil text-light fs-4"></i></button></h3>
                                <p>{{ $data->Pendidikan->jenis_pendidikan }} - Skor : {{ $data->nilai_rata_rata }}
                                    <br>Lulus Tahun : {{ $data->tahun_akhir_pendidikan }}
                                </p>
                                <h3><button type="button" class="icon-button-modal" data-bs-toggle="modal"
                                        data-bs-target="#deletePendidikanmodal{{ $data->id ?? '-' }}"><i
                                            class="mdi mdi-delete text-danger fs-4"></i></button></h3>
                                <hr>

                                {{-- Modal Edit Riwayat Pendidikan --}}
                                <div class="modal fade text-dark" id="editpendidikan{{ $data->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel">Formulir Riwayat Pendidikan
                                                </h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-hidden="true"></button>
                                            </div>
                                            <form action="/profile/riwayatpendidikan/update" method="post">
                                                @method('post')
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $data->id }}">
                                                <input type="hidden" name="nisn" value="{{ $dataAlumni->nisn }}">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="newsletter-kategori"
                                                                    class="content-hidden">Nama Instansi <span
                                                                        class="text-red"> *</span></label>
                                                                <input type="text" id="example-input-large"
                                                                    name="nama_instansi"
                                                                    class="form-control @error('nama_instansi') is-invalid @enderror"
                                                                    value="{{ old('nama_instansi', $data->nama_instansi) }}">
                                                                @error('nama_instansi')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="newsletter-kategori"
                                                                    class="content-hidden">Jenis Pendidikan <span
                                                                        class="text-red"> *</span></label>
                                                                <select
                                                                    class="form-select full-size-width @error('jenis_pendidikan') is-invalid @enderror"
                                                                    name="jenis_pendidikan" id="jenis_pendidikan">
                                                                    <option selected>Jenis Pendidikan</option>
                                                                    @foreach ($dataJenisPendidikan as $item)
                                                                        @if (old('jenis_pendidikan', $data->jenis_pendidikan) == $item->id)
                                                                            <option value="{{ $item->id }}" selected>
                                                                                {{ $item->jenis_pendidikan }}</option>
                                                                        @else
                                                                            <option value="{{ $item->id }}">
                                                                                {{ $item->jenis_pendidikan }}</option>
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
                                                                <label for="newsletter-kategori"
                                                                    class="content-hidden">Nilai Rata - Rata <span
                                                                        class="text-red"> *</span></label>
                                                                <input type="text" id="example-input-large"
                                                                    name="nilai_rata_rata"
                                                                    class="form-control @error('nilai_rata_rata') is-invalid @enderror"
                                                                    value="{{ old('nilai_rata_rata', $data->nilai_rata_rata) }}">
                                                                @error('nilai_rata_rata')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="content-hidden">Tahun Dimulai <span
                                                                        class="text-red"> *</span></label>
                                                                <input type="date" id="example-input-large"
                                                                    name="tahun_awal_pendidikan"
                                                                    class="form-control @error('tahun_awal_pendidikan') is-invalid @enderror"
                                                                    value="{{ old('tahun_awal_pendidikan') }}">
                                                                <p class="card-description fw-medium mt-2">
                                                                    Data Sebelumnya: {{ $data->tahun_awal_pendidikan }}.
                                                                </p>
                                                                @error('tahun_awal_pendidikan')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group mb-2">
                                                                <label class="content-hidden">Tahun Berakhir <span
                                                                        class="text-red"> *</span></label>
                                                                <input type="date" id="tahun_akhir"
                                                                    name="tahun_akhir_pendidikan"
                                                                    class="form-control @error('tahun_akhir_pendidikan') is-invalid @enderror"
                                                                    value="{{ old('tahun_akhir_pendidikan') }}">
                                                                <p class="card-description fw-medium mt-2">
                                                                    Data Sebelumnya: {{ $data->tahun_akhir_pendidikan }}.
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
                                                    <button type="reset" class="btn btn-danger"
                                                        data-dismiss="modal">Batalkan</button>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- Modal Edit Riwayat Pendidikan End --}}

                                {{-- Modal Delete Start --}}
                                <div id="deletePendidikanmodal{{ $data->id ?? '-' }}" class="modal fade" tabindex="-1"
                                    role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content modal-filled bg-danger">
                                            <div class="modal-body p-4">
                                                <div class="text-center">
                                                    <i class="dripicons-wrong h1"></i>
                                                    <h4 class="mt-2">Peringatan!</h4>
                                                    <p class="mt-3">Apakan Ingin Melanjutkan Menghapus Data Pendidikan
                                                    </p>
                                                    <form action="/profile/riwayatpendidikan/delete" method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <input type="hidden" name="id" id="newsletter-id"
                                                            class="form-control form-control-lg"
                                                            value="{{ $data->id }}">
                                                        <button type="submit" class="btn btn-light my-2">Delete</button>
                                                    </form>
                                                    <button type="button" class="btn btn-success"
                                                        data-bs-dismiss="modal">Cancel</button>
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
                <div class="col-sm-12 col-md-6 grid-margin d-flex stretch-card">
                    <div class="card bg-dark text-light" style="border-left: 15px solid white">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="fw-bold pt-2 text-light">Pengalaman Kerja</h4>
                            <button class="icon-button-modal" data-bs-toggle="modal" data-bs-target="#pengalamankerja"><i
                                    class="mdi mdi-plus text-primary fs-5"></i></button>
                        </div>
                        <div class="card-body">
                            @foreach ($dataPekerjaan as $data)
                                <h3 class="card-text fw-bold">{{ $data->bidang }} <button class="icon-button-modal"
                                        data-bs-toggle="modal" data-bs-target="#editpekerjaan{{ $data->id }}"><i
                                            class="mdi mdi-pencil text-light fs-4"></i></button></h3>
                                <p class="fw-bold">{{ $data->nama_perusahaan }} - {{ $data->Pekerjaan->jenis_pekerjaan }}
                                </p>
                                <p>{{ $data->tahun_awal_pekerjaan }} - {{ $data->tahun_akhir_pekerjaan }}</p>
                                <h3><button type="button" class="icon-button-modal" data-bs-toggle="modal"
                                        data-bs-target="#deletePekerjaanModal{{ $data->id ?? '-' }}"><i
                                            class="mdi mdi-delete text-danger fs-4"></i></button></h3>
                                <hr>

                                {{-- Modal Update Pengalaman Kerja --}}
                                <div class="modal fade text-dark" id="editpekerjaan{{ $data->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel">Folmulir Riwayat Pekerjaan
                                                </h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-hidden="true"></button>
                                            </div>
                                            <form action="/profile/riwayatpekerjaan/update" method="post">
                                                @method('post')
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $data->id }}">
                                                <input type="hidden" name="nisn" value="{{ $dataAlumni->nisn }}">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="newsletter-kategori"
                                                                    class="content-hidden">Nama Perusahaan <span
                                                                        class="text-red"> *</span></label>
                                                                <input type="text" id="example-input-large"
                                                                    name="nama_perusahaan"
                                                                    class="form-control @error('nama_perusahaan') is-invalid @enderror"
                                                                    value="{{ old('nama_perusahaan', $data->nama_perusahaan) }}">
                                                                @error('nama_perusahaan')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="newsletter-kategori"
                                                                    class="content-hidden">Jenis Kepegawaian <span
                                                                        class="text-red"> *</span></label>
                                                                <select
                                                                    class="form-select full-size-width  @error('jenis_pekerjaan') is-invalid @enderror"
                                                                    id="inputGroupSelect01" name="jenis_pekerjaan">
                                                                    <option selected>Jenis Kepegawaian</option>
                                                                    @foreach ($dataJenisPekerjaan as $item)
                                                                        @if (old('jenis_pekerjaan', $data->jenis_pekerjaan) == $item->id)
                                                                            <option value="{{ $item->id }}" selected>
                                                                                {{ $item->jenis_pekerjaan }}</option>
                                                                        @else
                                                                            <option value="{{ $item->id }}">
                                                                                {{ $item->jenis_pekerjaan }}</option>
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
                                                                <label for="newsletter-kategori"
                                                                    class="content-hidden">Bidang <span class="text-red">
                                                                        *</span></label>
                                                                <input type="text" id="example-input-large"
                                                                    name="bidang"
                                                                    class="form-control @error('bidang') is-invalid @enderror"
                                                                    value="{{ old('bidang', $data->bidang) }}">
                                                                @error('bidang')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="content-hidden">Tahun Dimulai <span
                                                                        class="text-red"> *</span></label>
                                                                <input type="date" id="example-input-large"
                                                                    name="tahun_awal_pekerjaan"
                                                                    class="form-control @error('tahun_awal_pekerjaan') is-invalid @enderror">
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
                                                                <label class="content-hidden">Tahun Berakhir <span
                                                                        class="text-red"> *</span></label>
                                                                <input type="date" id="example-input-large"
                                                                    name="tahun_akhir_pekerjaan"
                                                                    class="form-control @error('tahun_akhir_pekerjaan') is-invalid @enderror">
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
                                                    <button type="reset" class="btn btn-danger"
                                                        data-dismiss="modal">Batalkan</button>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- Modal Update Pengalaman Kerja End --}}

                                {{-- Modal Delete Start --}}
                                <div id="deletePekerjaanModal{{ $data->id ?? '-' }}" class="modal fade" tabindex="-1"
                                    role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content modal-filled bg-danger">
                                            <div class="modal-body p-4">
                                                <div class="text-center">
                                                    <i class="dripicons-wrong h1"></i>
                                                    <h4 class="mt-2">Peringatan!</h4>
                                                    <p class="mt-3">Apakan Ingin Melanjutkan Menghapus Data Pekerjaan</p>
                                                    <form action="/profile/riwayatpekerjaan/delete" method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <input type="hidden" name="id" id="newsletter-id"
                                                            class="form-control form-control-lg"
                                                            value="{{ $data->id }}">
                                                        <button type="submit" class="btn btn-light my-2">Delete</button>
                                                    </form>
                                                    <button type="button" class="btn btn-success"
                                                        data-bs-dismiss="modal">Cancel</button>
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
                <div class="col-sm-12 col-md-6 grid-margin d-flex stretch-card">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="fw-bold pt-2 text-dark">Sertifikasi</h4>
                            <button class="icon-button-modal" data-bs-toggle="modal"
                                data-bs-target="#sertifikasiModal"><i class="mdi mdi-plus text-primary fs-5"></i></button>
                        </div>
                        <div class="card-body">
                            @foreach ($dataSertifikasi as $data)
                                <div class="row">
                                    <div class="col-6-md d-flex justify-content-center">
                                        <a class="gallery-popup"
                                            href="{{ URL::asset('storage/' . $data->file_sertifikasi) }}"
                                            aria-label="project-img">
                                            <img class="img-fluid"
                                                src="{{ URL::asset('storage/' . $data->file_sertifikasi) }}"
                                                style="width: 120px" alt="project-img">
                                        </a>
                                    </div>
                                    <div class="col-6-md p-3">
                                        <a href="{{ $data->link_sertifikasi }}" style="text-decoration: none">
                                            <p class="fw-bold fs-5">{{ $data->nama_sertifikasi }}</p>
                                        </a>
                                        <h5 class="fw-bold">{{ $data->nama_penerbit }}</h5>
                                        <h5>Diterbitkan : {{ $data->tahun_terbit }}</h5>
                                        <h5>Berakhir : {{ $data->tahun_kadaluarsa }}</h5>
                                    </div>
                                    <div class="col-12-md my-2 d-flex justify-content-between">
                                        <button class="btn btn-secondary" data-bs-toggle="modal"
                                            data-bs-target="#editsertifikat{{ $data->id }}"><i
                                                class="mdi mdi-pencil text-dark"></i></button>
                                        <button class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deletesertifikat{{ $data->id }}"><i
                                                class="mdi mdi-delete text-dark"></i></button>
                                    </div>
                                    <hr>
                                </div>

                                {{-- Modal Tambah Sertifikasi --}}
                                <div class="modal fade" id="editsertifikat{{ $data->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel">Folmulir Sertifikasi</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-hidden="true"></button>
                                            </div>
                                            <form action="/profile/sertifikasi/update" method="post"
                                                enctype="multipart/form-data">
                                                @method('post')
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $data->id }}">
                                                <div class="modal-body">
                                                    <div class="row p-2">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="sertifikat" class="content-hidden">Nama
                                                                    Sertifikat <span class="text-red"> *</span></label>
                                                                <input type="text" id="sertifikat"
                                                                    name="nama_sertifikasi"
                                                                    class="form-control @error('nama_sertifikasi') is-invalid @enderror"
                                                                    value="{{ old('nama_sertifikasi', $data->nama_sertifikasi) }}">
                                                                @error('nama_sertifikasi')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="instansi" class="content-hidden">Nama Instansi
                                                                    Penerbit<span class="text-red"> *</span></label>
                                                                <input type="text" id="instansi" name="nama_penerbit"
                                                                    class="form-control @error('nama_penerbit') is-invalid @enderror"
                                                                    value="{{ old('nama_penerbit', $data->nama_penerbit) }}">
                                                                @error('nama_penerbit')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="content-hidden">Tahun Terbit <span
                                                                        class="text-red"> *</span></label>
                                                                <input type="date" id="example-input-large"
                                                                    name="tahun_terbit"
                                                                    class="form-control @error('tahun_terbit') is-invalid @enderror"
                                                                    value="{{ old('tahun_terbit', $data->tahun_terbit) }}">
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
                                                                <label class="content-hidden">Tahun Kadaluarsa <span
                                                                        class="text-red"> *</span></label>
                                                                <input type="date" id="example-input-large"
                                                                    name="tahun_kadaluarsa"
                                                                    class="form-control @error('tahun_kadaluarsa') is-invalid @enderror"
                                                                    value="{{ old('tahun_kadaluarsa', $data->tahun_kadaluarsa) }}">
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
                                                                <label for="kodesertifikat" class="content-hidden">Kode
                                                                    Sertifikasi<span class="text-red"> *</span></label>
                                                                <input type="text" id="kodesertifikat"
                                                                    name="kode_sertifikasi"
                                                                    class="form-control @error('kode_sertifikasi') is-invalid @enderror"
                                                                    value="{{ old('kode_sertifikasi', $data->kode_sertifikasi) }}">
                                                                @error('kode_sertifikasi')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="link" class="content-hidden">Link
                                                                    Sertifikasi<span class="text-red"> *</span></label>
                                                                <input type="text" id="link"
                                                                    name="link_sertifikasi"
                                                                    class="form-control @error('link_sertifikasi') is-invalid @enderror"
                                                                    value="{{ old('link_sertifikasi', $data->link_sertifikasi) }}">
                                                                @error('link_sertifikasi')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="fileSertifikat" class="content-hidden">File
                                                                    Sertifikat<span class="text-red"> *</span></label>
                                                                <input type="hidden" name="oldSertifikasi"
                                                                    value="{{ $data->file_sertifikasi }}">
                                                                <input
                                                                    class="form-control @error('file_sertifikasi') is-invalid @enderror"
                                                                    name="file_sertifikasi" type="file"
                                                                    id="fileSertifikat"
                                                                    value="{{ old('file_sertifikasi') }}">
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
                                                    <button type="reset" class="btn btn-danger"
                                                        data-dismiss="modal">Batalkan</button>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                {{-- Modal Delete Start --}}
                                <div id="deletesertifikat{{ $data->id ?? '-' }}" class="modal fade text-light"
                                    tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content modal-filled bg-danger">
                                            <div class="modal-body p-4">
                                                <div class="text-center">
                                                    <i class="dripicons-wrong h1"></i>
                                                    <h4 class="mt-2">Peringatan!</h4>
                                                    <p class="mt-3">Apakan Ingin Melanjutkan Menghapus Data Sertifikasi
                                                    </p>
                                                    <form action="/profile/sertifikasi/destroy" method="post">
                                                        @method('post')
                                                        @csrf
                                                        <input type="hidden" name="id" id="newsletter-id"
                                                            class="form-control form-control-lg"
                                                            value="{{ $data->id }}">
                                                        <button type="submit" class="btn btn-light my-2">Delete</button>
                                                    </form>
                                                    <button type="button" class="btn btn-success"
                                                        data-bs-dismiss="modal">Cancel</button>
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
                <div class="col-sm-12 col-md-6 grid-margin d-flex stretch-card">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="fw-bold pt-2 text-dark">Penghargaan Lomba</h4>
                            <button class="icon-button-modal" data-bs-toggle="modal" data-bs-target="#lombaModal"><i
                                    class="mdi mdi-plus text-primary fs-5"></i></button>
                        </div>
                        <div class="card-body">
                            @foreach ($dataSertifikasiLomba as $data)
                                <div class="row">
                                    <div class="col-6-md d-flex justify-content-center">
                                        <a class="gallery-popup"
                                            href="{{ URL::asset('storage/' . $data->file_sertifikasi) }}"
                                            aria-label="project-img">
                                            <img class="img-fluid"
                                                src="{{ URL::asset('storage/' . $data->file_sertifikasi) }}"
                                                style="width: 120px" alt="project-img">
                                        </a>
                                    </div>
                                    <div class="col-6-md p-3">
                                        <p class="fw-bold fs-5 text-dark">{{ $data->nama_juara_kompetensi }}</p>
                                        <h5>{{ $data->TingkatPerlombaan->tingkat_lomba }}</h5>
                                        <h5>Didapatkan : {{ $data->tanggal_terbit }}</h5>
                                        <h5>Berakhir : {{ $data->tanggal_kadaluarsa }}</h5>
                                    </div>
                                    <div class="col-12-md my-2 d-flex justify-content-between">
                                        <button class="btn btn-secondary" data-bs-toggle="modal"
                                            data-bs-target="#editsertifikatlomba{{ $data->id }}"><i
                                                class="mdi mdi-pencil text-dark"></i></button>
                                        <button class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deletesertifikatlomba{{ $data->id }}"><i
                                                class="mdi mdi-delete text-dark"></i></button>
                                    </div>
                                    <hr>
                                </div>

                                {{-- Modal Tambah Sertifikasi Perlombaan --}}
                                <div class="modal fade" id="editsertifikatlomba{{ $data->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel">Folmulir Sertifikasi
                                                    Perlombaan</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-hidden="true"></button>
                                            </div>
                                            <form action="/profile/sertifikasilomba/update" method="post"
                                                enctype="multipart/form-data">
                                                @method('post')
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $data->id }}">
                                                <div class="modal-body">
                                                    <div class="row p-2">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="sertifikatLomba" class="content-hidden">Nama
                                                                    Juara Kompetensi <span class="text-red">
                                                                        *</span></label>
                                                                <input type="text" id="sertifikatLomba"
                                                                    name="nama_juara_kompetensi"
                                                                    class="form-control @error('nama_juara_kompetensi') is-invalid @enderror"
                                                                    value="{{ old('nama_juara_kompetensi', $data->nama_juara_kompetensi) }}">
                                                                @error('nama_juara_kompetensi')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="tingkatLomba" class="content-hidden">Tingkat
                                                                    Perlombaan <span class="text-red"> *</span></label>
                                                                <select
                                                                    class="form-select full-size-width  @error('tingkat_perlombaan') is-invalid @enderror"
                                                                    id="tingkatLomba" name="tingkat_perlombaan">
                                                                    <option selected>Tingkat Perlombaan</option>
                                                                    @foreach ($dataTingkatPerlombaan as $item)
                                                                        @if (old('tingkat_perlombaan', $data->tingkat_perlombaan) == $item->id)
                                                                            <option value="{{ $item->id }}" selected>
                                                                                {{ $item->tingkat_lomba }}</option>
                                                                        @else
                                                                            <option value="{{ $item->id }}">
                                                                                {{ $item->tingkat_lomba }}</option>
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
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="content-hidden">Tahun Terbit <span
                                                                        class="text-red"> *</span></label>
                                                                <input type="date" id="example-input-large"
                                                                    name="tanggal_terbit"
                                                                    class="form-control @error('tanggal_terbit') is-invalid @enderror"
                                                                    value="{{ old('tanggal_terbit') }}">
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
                                                                <label class="content-hidden">Tahun Kadaluarsa <span
                                                                        class="text-red"> *</span></label>
                                                                <input type="date" id="example-input-large"
                                                                    name="tanggal_kadaluarsa"
                                                                    class="form-control @error('tanggal_kadaluarsa') is-invalid @enderror"
                                                                    value="{{ old('tanggal_kadaluarsa') }}">
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
                                                                <label for="fileSertifikat" class="content-hidden">File
                                                                    Sertifikat Perlombaan<span class="text-red">
                                                                        *</span></label>
                                                                <input type="hidden" name="oldSertifikasi"
                                                                    value="{{ $data->file_sertifikasi }}">
                                                                <input
                                                                    class="form-control @error('file_sertifikasi') is-invalid @enderror"
                                                                    name="file_sertifikasi" type="file"
                                                                    id="fileSertifikat"
                                                                    value="{{ old('file_sertifikasi') }}">
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
                                                    <button type="reset" class="btn btn-danger"
                                                        data-dismiss="modal">Batalkan</button>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                {{-- Modal Delete Start --}}
                                <div id="deletesertifikatlomba{{ $data->id ?? '-' }}" class="modal fade text-light"
                                    tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content modal-filled bg-danger">
                                            <div class="modal-body p-4">
                                                <div class="text-center">
                                                    <i class="dripicons-wrong h1"></i>
                                                    <h4 class="mt-2">Peringatan!</h4>
                                                    <p class="mt-3">Apakan Ingin Melanjutkan Menghapus Data Penghargaan
                                                        Lomba?</p>
                                                    <form action="/profile/sertifikasilomba/destroy" method="post">
                                                        @method('post')
                                                        @csrf
                                                        <input type="hidden" name="id" id="newsletter-id"
                                                            class="form-control form-control-lg"
                                                            value="{{ $data->id }}">
                                                        <button type="submit" class="btn btn-light my-2">Delete</button>
                                                    </form>
                                                    <button type="button" class="btn btn-success"
                                                        data-bs-dismiss="modal">Cancel</button>
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
        <div class="row-12">
            <div class="row-12">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body collapse show">
                            <div class="row">
                                <div class="col-md-9">
                                    <h4 class="card-title">Pencarian Lowongan</h4>
                                </div>
                            </div>
                            <form action="/lowongan-kerja/search+" method="get">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <select class="form-select full-size-width" id="inputGroupSelect01"
                                            name="category">
                                            <option selected="">Spesialis Pekerjaan</option>
                                            @foreach ($category as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <input type="text" id="" name="nama_lowongan" class="form-control"
                                            placeholder="Kata Kunci Lowongan" style="height: 40px">
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary full-size-width">Cari
                                            Lowongan</button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                @foreach ($lowongan as $datalowongan)
                    <div class="col-lg-4 col-md-6">
                        <div class="card border-top-black-300 mt-5">
                            <div class="col-md-12 p-4">
                                <h4 class="card-title">{{ $datalowongan->nama }}</h4>
                                <ul class="list-unstyled">
                                    <li class="media d-flex align-items-start company-show">
                                        <img class="d-flex me-3 logo-company"
                                            src="/images/profileimg/{{ $datalowongan->dudi->logo }}" alt="Logo Test"
                                            width="100">
                                        <div class="media-body">
                                            <ul class="list-unstyled">
                                                <li><i class="mdi mdi-hospital-building color-23"></i> <span
                                                        class="mrl-5 text-black">{{ $datalowongan->dudi->nama }}</span>
                                                </li>
                                                <li><i class="mdi mdi-clipboard-outline color-23"></i> <span
                                                        class="mrl-5 text-black">{{ $datalowongan->dudi->bidang }}</span>
                                                </li>
                                                <li><i class="mdi mdi-calendar color-23"></i> <span
                                                        class="mrl-5 text-black">{{ $datalowongan->tgl_upload }}</span>
                                                </li>
                                                <li><i class="mdi mdi-map-marker color-23"></i> <span
                                                        class="mrl-5 text-black">{{ $datalowongan->lokasi }}</span></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <a href="/lowongan-kerja/detail/{{ $datalowongan->nama }}" class="btn btn-primary">Detail
                                Lowongan</a>
                        </div>
                    </div>
                @endforeach
                <div class="pagination d-flex justify-content-center mt-3">{{ $lowongan->links() }}</div>
            </div>
            <div class="row my-4">
                <div class="col">
                    <div class="d-flex justify-content-center bg-primary rounded">
                        <h2 class="text-light p-3">Sekilas Perusahaan</h2>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-evenly">
                @foreach ($datadudi as $item)
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-top-blue-300 mb-3">
                            <div class="col-md-12 p-4">
                                <h4 class="card-title">{{ $item->nama }}</h4>
                                <ul class="list-unstyled">
                                    <li class="media d-flex align-items-start company-show">
                                        <img class="d-flex me-3 logo-company" src="/images/profileimg/ph.png"
                                            alt="Logo Test" width="100">
                                        <div class="media-body">
                                            <ul class="list-unstyled">
                                                <li><i class="mdi mdi-newspaper color-23"></i> <span
                                                        class="mrl-5 text-black">{{ $countlowongan[$item->id] }} Lowongan
                                                        Aktif </span></li>
                                                <li><i class="mdi mdi-clipboard-text  color-23"></i> <span
                                                        class="mrl-5 text-black">{{ $item->bidang }}</span></li>
                                                <li><i class="mdi mdi-phone color-23"></i> <span
                                                        class="mrl-5 text-black">{{ $item->no_telp }}</span></li>
                                                <li><i class="mdi mdi-map-marker  color-23"></i> <span
                                                        class="mrl-5 text-black">{{ $item->alamat }}</span></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <a href="/perusahaan/{{ $item->nama }}" class="btn btn-primary">Detail Perusahaan</a>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Modal Biografi Edit --}}
            <div class="modal fade" id="editbiografi" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myLargeModalLabel">Edit Biografi</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-hidden="true"></button>
                        </div>
                        <form action="/profile/biografi/update" method="post">
                            @method('post')
                            @csrf
                            <input type="hidden" name="id" value="{{ $dataAlumni->id }}">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input id="biografi" placeholder="Tentang diri anda"
                                        class="form-control font-weight-normal @error('biografi') is-invalid @enderror"
                                        type="hidden" name="biografi"
                                        value="{{ old('biografi', $dataAlumni->biografi) }}">
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
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-hidden="true"></button>
                        </div>
                        <form action="/profile/riwayatpendidikan/store" method="post">
                            @method('post')
                            @csrf
                            <input type="hidden" name="id" value="{{ $dataAlumni->id }}">
                            <input type="hidden" name="nisn" value="{{ $dataAlumni->nisn }}">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="newsletter-kategori" class="content-hidden">Nama Instansi <span
                                                    class="text-red"> *</span></label>
                                            <input type="text" id="example-input-large" name="nama_instansi"
                                                class="form-control @error('nama_instansi') is-invalid @enderror"
                                                value="{{ old('nama_instansi') }}">
                                            @error('nama_instansi')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="newsletter-kategori" class="content-hidden">Jenis Pendidikan <span
                                                    class="text-red"> *</span></label>
                                            <select
                                                class="form-select full-size-width @error('jenis_pendidikan') is-invalid @enderror"
                                                name="jenis_pendidikan" id="jenis_pendidikan">
                                                <option selected>Jenis Pendidikan</option>
                                                @foreach ($dataJenisPendidikan as $item)
                                                    @if (old('jenis_pendidikan') == $item->id)
                                                        <option value="{{ $item->id }}" selected>
                                                            {{ $item->jenis_pendidikan }}</option>
                                                    @else
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->jenis_pendidikan }}</option>
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
                                            <label for="newsletter-kategori" class="content-hidden">Nilai Rata - Rata
                                                <span class="text-red"> *</span></label>
                                            <input type="text" id="example-input-large" name="nilai_rata_rata"
                                                class="form-control @error('nilai_rata_rata') is-invalid @enderror"
                                                value="{{ old('nilai_rata_rata') }}">
                                            @error('nilai_rata_rata')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="content-hidden">Tahun Dimulai <span class="text-red">
                                                    *</span></label>
                                            <input type="date" id="example-input-large" name="tahun_awal_pendidikan"
                                                class="form-control @error('tahun_awal_pendidikan') is-invalid @enderror"
                                                value="{{ old('tahun_awal_pendidikan') }}">
                                            @error('tahun_awal_pendidikan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label class="content-hidden">Tahun Berakhir <span class="text-red">
                                                    *</span></label>
                                            <input type="date" id="tahunberakhir_tambah" name="tahun_akhir_pendidikan"
                                                class="form-control @error('tahun_akhir_pendidikan') is-invalid @enderror"
                                                value="{{ old('tahun_akhir_pendidikan') }}">
                                            @error('tahun_akhir_pendidikan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <p class="card-description fw-medium text-danger mt-2">
                                            Kosongkan tahun berakhir jika masih bersekolah.
                                        </p>
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
            <div class="modal fade" id="pengalamankerja" tabindex="-1" role="dialog"
                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myLargeModalLabel">Folmulir Riwayat Pekerjaan</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-hidden="true"></button>
                        </div>
                        <form action="/profile/riwayatpekerjaan/store" method="post">
                            @method('post')
                            @csrf
                            <input type="hidden" name="id" value="{{ $dataAlumni->id }}">
                            <input type="hidden" name="nisn" value="{{ $dataAlumni->nisn }}">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="newsletter-kategori" class="content-hidden">Nama Perusahaan <span
                                                    class="text-red"> *</span></label>
                                            <input type="text" id="example-input-large" name="nama_perusahaan"
                                                class="form-control @error('nama_perusahaan') is-invalid @enderror"
                                                value="{{ old('nama_perusahaan') }}">
                                            @error('nama_perusahaan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="newsletter-kategori" class="content-hidden">Jenis Kepegawaian
                                                <span class="text-red"> *</span></label>
                                            <select
                                                class="form-select full-size-width  @error('jenis_pekerjaan') is-invalid @enderror"
                                                id="inputGroupSelect01" name="jenis_pekerjaan">
                                                <option selected>Jenis Kepegawaian</option>
                                                @foreach ($dataJenisPekerjaan as $item)
                                                    @if (old('jenis_pekerjaan') == $item->id)
                                                        <option value="{{ $item->id }}" selected>
                                                            {{ $item->jenis_pekerjaan }}</option>
                                                    @else
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->jenis_pekerjaan }}</option>
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
                                            <label for="newsletter-kategori" class="content-hidden">Bidang <span
                                                    class="text-red"> *</span></label>
                                            <input type="text" id="example-input-large" name="bidang"
                                                class="form-control @error('bidang') is-invalid @enderror"
                                                value="{{ old('bidang') }}">
                                            @error('bidang')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="content-hidden">Tahun Dimulai <span class="text-red">
                                                    *</span></label>
                                            <input type="date" id="example-input-large" name="tahun_awal_pekerjaan"
                                                class="form-control @error('tahun_awal_pekerjaan') is-invalid @enderror"
                                                value="{{ old('tahun_awal_pekerjaan') }}">
                                            @error('tahun_awal_pekerjaan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="content-hidden">Tahun Berakhir <span class="text-red">
                                                    *</span></label>
                                            <input type="date" id="example-input-large" name="tahun_akhir_pekerjaan"
                                                class="form-control @error('tahun_akhir_pekerjaan') is-invalid @enderror"
                                                value="{{ old('tahun_akhir_pekerjaan') }}">
                                            @error('tahun_akhir_pekerjaan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <p class="card-description fw-medium text-danger mt-2">
                                            Kosongkan tahun berakhir jika masih bekerja.
                                        </p>
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
            <div class="modal fade" id="sertifikasiModal" tabindex="-1" role="dialog"
                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myLargeModalLabel">Folmulir Sertifikasi</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-hidden="true"></button>
                        </div>
                        <form action="/profile/sertifikasi/store" method="post" enctype="multipart/form-data">
                            @method('post')
                            @csrf
                            <input type="hidden" name="id" value="{{ $dataAlumni->id }}">
                            <input type="hidden" name="nisn" value="{{ $dataAlumni->nisn }}">
                            <div class="modal-body">
                                <div class="row p-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="sertifikat" class="content-hidden">Nama Sertifikat <span
                                                    class="text-red"> *</span></label>
                                            <input type="text" id="sertifikat" name="nama_sertifikasi"
                                                class="form-control @error('nama_sertifikasi') is-invalid @enderror"
                                                value="{{ old('nama_sertifikasi') }}">
                                            @error('nama_sertifikasi')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="instansi" class="content-hidden">Nama Instansi Penerbit<span
                                                    class="text-red"> *</span></label>
                                            <input type="text" id="instansi" name="nama_penerbit"
                                                class="form-control @error('nama_penerbit') is-invalid @enderror"
                                                value="{{ old('nama_penerbit') }}">
                                            @error('nama_penerbit')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="content-hidden">Tahun Terbit <span class="text-red">
                                                    *</span></label>
                                            <input type="date" id="example-input-large" name="tahun_terbit"
                                                class="form-control @error('tahun_terbit') is-invalid @enderror"
                                                value="{{ old('tahun_terbit') }}">
                                            @error('tahun_terbit')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="content-hidden">Tahun Kadaluarsa <span class="text-red">
                                                    *</span></label>
                                            <input type="date" id="example-input-large" name="tahun_kadaluarsa"
                                                class="form-control @error('tahun_kadaluarsa') is-invalid @enderror"
                                                value="{{ old('tahun_kadaluarsa') }}">
                                            @error('tahun_kadaluarsa')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <p class="card-description fw-medium text-danger mt-2">
                                                Kosongkan tahun kadaluarsa jika sertifikat berlaku seumur hidup.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kodesertifikat" class="content-hidden">Kode Sertifikasi<span
                                                    class="text-red"> *</span></label>
                                            <input type="text" id="kodesertifikat" name="kode_sertifikasi"
                                                class="form-control @error('kode_sertifikasi') is-invalid @enderror"
                                                value="{{ old('kode_sertifikasi') }}">
                                            @error('kode_sertifikasi')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="link" class="content-hidden">Link Sertifikasi<span
                                                    class="text-red"> *</span></label>
                                            <input type="text" id="link" name="link_sertifikasi"
                                                class="form-control @error('link_sertifikasi') is-invalid @enderror"
                                                value="{{ old('link_sertifikasi') }}">
                                            @error('link_sertifikasi')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="fileSertifikat" class="content-hidden">File Sertifikat<span
                                                    class="text-red"> *</span></label>
                                            <input class="form-control @error('file_sertifikasi') is-invalid @enderror"
                                                name="file_sertifikasi" type="file" id="fileSertifikat"
                                                value="{{ old('file_sertifikasi') }}">
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
            <div class="modal fade" id="lombaModal" tabindex="-1" role="dialog"
                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myLargeModalLabel">Folmulir Sertifikasi Perlombaan</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-hidden="true"></button>
                        </div>
                        <form action="/profile/sertifikasilomba/store" method="post" enctype="multipart/form-data">
                            @method('post')
                            @csrf
                            <input type="hidden" name="id" value="{{ $dataAlumni->id }}">
                            <input type="hidden" name="nisn" value="{{ $dataAlumni->nisn }}">
                            <div class="modal-body">
                                <div class="row p-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="sertifikatLomba" class="content-hidden">Nama Juara Kompetensi
                                                <span class="text-red"> *</span></label>
                                            <input type="text" id="sertifikatLomba" name="nama_juara_kompetensi"
                                                class="form-control @error('nama_juara_kompetensi') is-invalid @enderror"
                                                value="{{ old('nama_juara_kompetensi') }}">
                                            @error('nama_juara_kompetensi')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="tingkatLomba" class="content-hidden">Tingkat Perlombaan <span
                                                    class="text-red"> *</span></label>
                                            <select
                                                class="form-select full-size-width  @error('tingkat_perlombaan') is-invalid @enderror"
                                                id="tingkatLomba" name="tingkat_perlombaan">
                                                <option selected>Tingkat Perlombaan</option>
                                                @foreach ($dataTingkatPerlombaan as $data)
                                                    @if (old('tingkat_perlombaan') == $data->id)
                                                        <option value="{{ $data->id }}" selected>
                                                            {{ $data->tingkat_lomba }}</option>
                                                    @else
                                                        <option value="{{ $data->id }}">{{ $data->tingkat_lomba }}
                                                        </option>
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="content-hidden">Tahun Terbit <span class="text-red">
                                                    *</span></label>
                                            <input type="date" id="example-input-large" name="tanggal_terbit"
                                                class="form-control @error('tanggal_terbit') is-invalid @enderror"
                                                value="{{ old('tanggal_terbit') }}">
                                            @error('tanggal_terbit')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="content-hidden">Tahun Kadaluarsa <span class="text-red">
                                                    *</span></label>
                                            <input type="date" id="example-input-large" name="tanggal_kadaluarsa"
                                                class="form-control @error('tanggal_kadaluarsa') is-invalid @enderror"
                                                value="{{ old('tanggal_kadaluarsa') }}">
                                            @error('tanggal_kadaluarsa')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <p class="card-description fw-medium text-danger mt-2">
                                                Kosongkan tahun kadaluarsa jika sertifikat berlaku seumur hidup.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="fileSertifikat" class="content-hidden">File Sertifikat
                                                Perlombaan<span class="text-red"> *</span></label>
                                            <input class="form-control @error('file_sertifikasi') is-invalid @enderror"
                                                name="file_sertifikasi" type="file" id="fileSertifikat"
                                                value="{{ old('file_sertifikasi') }}">
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

            {{-- Modal Tambah Sertifikasi Lomba --}}
            {{-- <div class="modal fade" id="sertifikasiLombaModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                
            </div>
        </div> --}}
        @endsection
        @section('js-tambahan')
        @endsection
