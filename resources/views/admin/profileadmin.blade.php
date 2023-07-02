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
                    <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Pusat Keamanan</h3>
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
                            <h3 class="card-title">Informasi Profil</h3>
                            <h6 class="card-subtitle">Update Informasi Profil dan Email Anda</h6>
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @elseif (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <form action="/admin/administrator/master/profile/update" method="POST" enctype="multipart/form-data">
                        @csrf
                </div>
            </div>
            <div class="card">
                <div class="card-body collapse show">
                    <div class="row">
                        <div class="col-md-9">
                            <h3 class="card-title">Pengguna</h3>
                            <h6 class="card-subtitle">Data Akses Pengguna</h6>
                        </div>
                    </div>
                    <div class="row pdt-20">
                        <div class="col-md-4">
                            <h4 class="text-black m-0">E-Mail<span class="text-red"> *</span></h4>
                            <p class="text-muted mt-0 text-sm">E-Mail User</p>
                        </div>
                        <div class="col-md-8 pdt-6">
                            <input type="text" class="form-control font-weight-normal" placeholder="..."
                                value="{{ $userUpdate->email }}" name="email">
                        </div>
                    </div>
                    <div class="row mrt-6">
                        <div class="col-md-4">
                            <h4 class="text-black m-0">Username<span class="text-red"> *</span></h4>
                            <p class="text-muted mt-0 text-sm">Username User</p>
                        </div>
                        <div class="col-md-8 pdt-6">
                            <input type="text" class="form-control font-weight-normal"
                                placeholder="..." name="username" value="{{ $userUpdate->name }}">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <h4 class="text-black m-0">Photo Profile<span class="text-red"> *</span></h4>
                            <p class="text-muted mt-0 text-sm">Kosongkan Untuk Tidak Mengubah Photo Proile</p>
                        </div>
                        <div class="col-md-8 pdt-6">
                            <input class="form-control" name="photo_profile" type="file" id="photo_profile">
                        </div>
                    </div>
                    <div class="row mrt-6">
                        <div class="col-md-12 pdt-6" style="text-align: right">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                            <a class="btn btn-secondary" href="/admin/dashboard">Cencel</a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body collapse show">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="card-title">Informasi Profil</h3>
                            <h6 class="card-subtitle">Pastikan Password yang anda gunakan, panjang dan random untuk menjaga
                                keamanan. <span class="text-red">Kosongkan Jika Tidak Ingin Mengubah Password</span></h6>
                        </div>
                    </div>
                    <form action="/admin/administrator/master/password/update" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mrt-6">
                            <div class="col-md-4">
                                <h4 class="text-black m-0">Current Password<span class="text-red"> *</span></h4>
                            </div>
                            <div class="col-md-8 pdt-6">
                                <input type="password"
                                    class="form-control font-weight-normal  @error('old_password') is-invalid @enderror"
                                    placeholder="Current Password" name="old_password">
                            </div>
                            @error('old_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row mrt-6">
                            <div class="col-md-4">
                                <h4 class="text-black m-0">New Password<span class="text-red"> *</span></h4>
                            </div>
                            <div class="col-md-8 pdt-6">
                                <input name="new_password" type="password"
                                    class="form-control @error('new_password') is-invalid @enderror" id="newPasswordInput"
                                    placeholder="New Password">
                                @error('new_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mrt-6">
                            <div class="col-md-4">
                                <h4 class="text-black m-0">Confirm Password<span class="text-red"> *</span></h4>
                            </div>
                            <div class="col-md-8 pdt-6">
                                <input name="new_password_confirmation" type="password" class="form-control"
                                    id="confirmNewPasswordInput" placeholder="Confirm New Password">
                            </div>
                        </div>
                        <div class="row mrt-6">
                            <div class="col-md-12 pdt-6" style="text-align: right">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                                <a class="btn btn-secondary" href="/admin/dashboard">Cencel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body collapse show">
                    <div class="row">
                        <div class="col-md-9">
                            <h3 class="card-title">Logout Dari Semua Device</h3>
                            <h6 class="card-subtitle">If necessary, you may log out of all of your other browser sessions across all of your devices. Some of your recent sessions are listed below; however, this list may not be exhaustive. If you feel your account has been compromised, you should also update your password. </h6>
                        </div>
                    </div>
                    <form action="/admin/administrator/master/logout/all-device" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mrt-6">
                            <div class="col-md-4">
                                <h4 class="text-black m-0">User Password<span class="text-red"> *</span></h4>
                            <p class="text-muted mt-0 text-sm">Silahkan Masukkan Password untuk Konfirmasi</p>
                            </div>
                            <div class="col-md-8 pdt-6">
                                <input type="password"
                                    class="form-control font-weight-normal "
                                    placeholder="User Password" name="password">
                            </div>
                        </div>
                        <div class="row mrt-6">
                            <div class="col-md-12 pdt-6" style="text-align: right">
                                <button class="btn btn-dark" type="submit">LOG OUT OTHER BROWSER SESSIONS</button>
                            </div>
                        </div>
                    </form>
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
@endsection
