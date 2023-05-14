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
                                    </h4>
                                </div>
                                @foreach ($dataPendidikan as $item)
                                    <div class="card-body">
                                        <h3 class="card-text text-black">{{ $item->nama_instansi }} <button class="icon-button-modal" data-bs-toggle="modal" data-bs-target="#editRPendidikanexample"><i class="fas fa-pencil-alt text-black mrl-10"></i></button></h3>
                                        <p>{{ $item->jenis_pendidikan }} - Skor {{ $item->nilai_rata_rata }} <br>Lulus Tahun : 2022</p>
                                        <hr>
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
                                {{-- @foreach ($dataRiwayat as $item)
                                    <div class="card-body">
                                        <h3 class="card-text text-black">{{ $item-> }} <button class="icon-button-modal"
                                            data-bs-toggle="modal" data-bs-target="#pengalamankerja"><i
                                                class="fas fa-pencil-alt text-black mrl-10"></i></button></h3>
                                        <p>Tradisi kopi - Paruh Waktu <br>July 2022 - Saat Ini</p>
                                        <hr>
                                    </div>
                                @endforeach --}}
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
                    <form action="#" method="post">
                        @method('put')
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
                    <form action="#addriwayatpendidikan" method="post">
                        {{-- @method('put') --}}
                        @csrf
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
        {{-- Modal Edit Riwayat Pendidikan --}}
        <div class="modal fade" id="editRPendidikanexample" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Formulir Riwayat Pendidikan</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <form action="#addriwayatpendidikan" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="newsletter-kategori" class="content-hidden">Nama Instansi <span class="text-red"> *</span></label>
                                        <input type="text" id="example-input-large" name="nama_instansi" class="form-control" value="{{ old('nama_instansi') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="newsletter-kategori" class="content-hidden">Jenis Pendidikan <span
                                                class="text-red"> *</span></label>
                                        <select class="form-select full-size-width" id="inputGroupSelect01"
                                            name="idtahunlulus">
                                            <option selected="">Jenis Pendidikan</option>
                                            <option value="Kuliah">Kuliah</option>
                                            <option value="SMKA / SMK" selected>SMKA / SMK</option>
                                            <option value="SMP">SMP</option>
                                            <option value="SD">SD</option>
                                            <option value="Kursus">Kursus</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="newsletter-kategori" class="content-hidden">Nilai Rata - Rata <span
                                                class="text-red"> *</span></label>
                                        <input type="text" id="example-input-large" name="nama_instansi"
                                            class="form-control" value="88">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batalkan</button>
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
                    <form action="#addriwayatpendidikan" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="newsletter-kategori" class="content-hidden">Nama Perusahaan <span
                                                class="text-red"> *</span></label>
                                        <input type="text" id="example-input-large" name="nama_perusahaan"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="newsletter-kategori" class="content-hidden">Jenis Kepegawaian <span
                                                class="text-red"> *</span></label>
                                        <select class="form-select full-size-width" id="inputGroupSelect01"
                                            name="jenispekerjaan">
                                            <option selected="">Jenis Kepegawaian</option>
                                            <option value="Musiman">Musiman</option>
                                            <option value="Magang">Magang</option>
                                            <option value="Kontrak">Kontrak</option>
                                            <option value="Pekerja Lepas">Pekerja Lepas</option>
                                            <option value="Wiraswasta">Wiraswasta</option>
                                            <option value="Paruh Waktu">Paruh Waktu</option>
                                            <option value="Purna Waktu">Purna Waktu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="newsletter-kategori" class="content-hidden">Bidang <span
                                                class="text-red"> *</span></label>
                                        <input type="text" id="example-input-large" name="nama_instansi"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="newsletter-kategori" class="content-hidden">Tanggal Mulai<span
                                                class="text-red"> *</span></label>
                                        <select class="form-select full-size-width" id="inputGroupSelect01"
                                            name="bulanmulai">
                                            <option selected="">Pilih Bulan</option>
                                            <option value="">month</option>
                                            <option value="01">Januari</option>
                                            <option value="02">Februari</option>
                                            <option value="03">Maret</option>
                                            <option value="04">April</option>
                                            <option value="05">Mungkin</option>
                                            <option value="06">Juni</option>
                                            <option value="07">Juli</option>
                                            <option value="08">Agustus</option>
                                            <option value="09">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="newsletter-kategori" class="content-hidden"><span class="text-red">
                                                *</span></label>
                                        <select class="form-select full-size-width" id="inputGroupSelect01"
                                            name="tahunmulai">
                                            <option selected="">Pilih Tahun</option>
                                            <option value="2000">2000</option>
                                            <option value="2001">2001</option>
                                            <option value="2002">2002</option>
                                            <option value="2003">2003</option>
                                            <option value="2004">2004</option>
                                            <option value="2005">2005</option>
                                            <option value="2006">2006</option>
                                            <option value="2007">2007</option>
                                            <option value="2008">2008</option>
                                            <option value="2009">2009</option>
                                            <option value="2010">2010</option>
                                            <option value="2011">2011</option>
                                            <option value="2012">2012</option>
                                            <option value="2013">2013</option>
                                            <option value="2014">2014</option>
                                            <option value="2015">2015</option>
                                            <option value="2016">2016</option>
                                            <option value="2017">2017</option>
                                            <option value="2018">2018</option>
                                            <option value="2019">2019</option>
                                            <option value="2020">2020</option>
                                            <option value="2021">2021</option>
                                            <option value="2022">2022</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="newsletter-kategori" class="content-hidden">Tanggal Berakhir<span
                                                class="text-red"> *</span></label>
                                        <select class="form-select full-size-width" id="inputGroupSelect01"
                                            name="bulanberakhir">
                                            <option selected="">Pilih Bulan</option>
                                            <option value="">month</option>
                                            <option value="01">Januari</option>
                                            <option value="02">Februari</option>
                                            <option value="03">Maret</option>
                                            <option value="04">April</option>
                                            <option value="05">Mungkin</option>
                                            <option value="06">Juni</option>
                                            <option value="07">Juli</option>
                                            <option value="08">Agustus</option>
                                            <option value="09">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="newsletter-kategori" class="content-hidden"><span class="text-red">
                                                *</span></label>
                                        <select class="form-select full-size-width" id="inputGroupSelect01"
                                            name="tahunberakhir">
                                            <option selected="">Pilih Tahun</option>
                                            <option value="2000">2000</option>
                                            <option value="2001">2001</option>
                                            <option value="2002">2002</option>
                                            <option value="2003">2003</option>
                                            <option value="2004">2004</option>
                                            <option value="2005">2005</option>
                                            <option value="2006">2006</option>
                                            <option value="2007">2007</option>
                                            <option value="2008">2008</option>
                                            <option value="2009">2009</option>
                                            <option value="2010">2010</option>
                                            <option value="2011">2011</option>
                                            <option value="2012">2012</option>
                                            <option value="2013">2013</option>
                                            <option value="2014">2014</option>
                                            <option value="2015">2015</option>
                                            <option value="2016">2016</option>
                                            <option value="2017">2017</option>
                                            <option value="2018">2018</option>
                                            <option value="2019">2019</option>
                                            <option value="2020">2020</option>
                                            <option value="2021">2021</option>
                                            <option value="2022">2022</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batalkan</button>
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
