<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login - Bursa Kerja Khusus - SMKN 4 Banjarmasin</title>
    <link rel="stylesheet"
        href="{{ URL::asset('asset/plugins/alumnipage/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('asset/plugins/alumnipage/vendors/base/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('asset/plugins/alumnipage/css/style.css') }}">
    <link rel="icon" type="image/png" href="{{ URL::asset('images/homepage/logo.png') }}">
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="main-panel">
                <div class="content-wrapper d-flex align-items-center auth px-0">
                    <div class="row w-100 mx-0">
                        <div class="col-lg-4 mx-auto">
                            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                                <div class="brand-logo">
                                    <img src="{{ URL::asset('images/homepage/logo.png') }}" alt="logo">
                                </div>
                                <h4>Bursa Kerja Khusus - SMKN 4 Banjarmasin</h4>
                                <h6 class="font-weight-light">Sign in to continue.</h6>
                                <form class="pt-3" action="{{ route('login') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email"  name="email" class="form-control form-control-lg"
                                            id="exampleInputEmail1" placeholder="Email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-lg"
                                            id="exampleInputPassword1" placeholder="Password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <button
                                            class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                            type="submit">SIGN IN</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- base:js -->
    <script src="../../vendors/base/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="../../js/template.js"></script>
    <!-- endinject -->
</body>

</html>
