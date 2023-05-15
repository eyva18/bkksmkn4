<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <title>Bursa Kerja Khusus - SMKN 4 Banjarmasin</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Construction Html5 Template">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name=author content="Themefisher">
    <meta name=generator content="Themefisher Constra HTML Template v1.0">
    <link rel="icon" type="image/png" href="{{ URL::asset('images/homepage/logo.png') }}">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ URL::asset('asset/plugins/homepage/bootstrap/bootstrap.min.css') }}">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="{{ URL::asset('asset/plugins/homepage/fontawesome/css/all.min.css') }}">
    <!-- Animation -->
    <link rel="stylesheet" href="{{ URL::asset('asset/plugins/homepage/animate-css/animate.css') }}">
    <!-- slick Carousel -->
    <link rel="stylesheet" href="{{ URL::asset('asset/plugins/homepage/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('asset/plugins/homepage/slick/slick-theme.css') }}">
    <!-- Colorbox -->
    <link rel="stylesheet" href="{{ URL::asset('asset/plugins/homepage/colorbox/colorbox.css') }}">
    <!-- Template styles-->
    <link rel="stylesheet" href="{{ URL::asset('asset/plugins/homepage/css/style.css') }}">
</head>

<body>
    <div class="body-inner">

        <!-- Top Bar start -->
        <div id="top-bar" class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-8">
                        <ul class="top-info text-center text-md-left">
                            <li><i class="fas fa-map-marker-alt"></i>
                                <p class="info-text">Alamat : JL. Brigjend H. Hasan Basri No.7, Banjarmasin. 70123</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Top Bar End -->

        <!-- Header start -->
        <header id="header" class="header-two">
            <div class="site-navigation">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <nav class="navbar navbar-expand-lg navbar-light p-0">

                                <div class="flex flex-row gap-6 logo">
                                    <img loading="h-10" src="{{ URL::asset('images/homepage/logo.png') }}"
                                        alt="SMKN4">

                                </div><!-- logo end -->

                                <button class="navbar-toggler" type="button" data-toggle="collapse"
                                    data-target=".navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false"
                                    aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>

                                <div id="navbar-collapse" class="collapse navbar-collapse">
                                    <ul class="nav navbar-nav ml-auto align-items-center">
                                        <li class="nav-item">
                                            <h1 class="font-bold text-gray-800 text-xl">Bursa Kerja Khusus - SMKN 4
                                                Banjarmasin</h1>
                                        </li>
                                        <li class="header-get-a-quote">
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#loginmodal">
                                                Login
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <!--/ Col end -->
                    </div>
                    <!--/ Row end -->
                </div>
                <!--/ Container end -->
            </div>
            <!--/ Navigation end -->
        </header>
        <!--/ Header end -->

        <!-- Modal Login -->
        <div class="modal fade" id="loginmodal" tabindex="-1" role="dialog" aria-labelledby="loginmodalTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header color-theme-1">
                        <h3 class="modal-title text-white" id="exampleModalLongTitle">Login</h3>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="newsletter-email" class="content-hidden">E-Mail / Username</label>
                                <input type="email" name="email" id="newsletter-email"
                                    class="form-control form-control-lg" placeholder="E-Mail / Username"
                                    autocomplete="off" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password" class="content-hidden">Password</label>
                                <input type="password" name="password" id="password"
                                    class="form-control form-control-lg" placeholder="Password" autocomplete="off">
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Modal Login -->

        <div class="banner-carousel banner-carousel-2 mb-0">

            <div class="banner-carousel-item"
                style="background-image:url({{ URL::asset('images/homepage/slide-image/smkn4.jpg') }})">
                <div class="container">
                    <div class="box-slider-content">
                        <div class="box-slider-text">
                            <h2 class="box-slide-title">SMKN 4 BANJARMASIN</h2>
                            <h3 class="box-slide-sub-title">Siap Kerja, Cerdas dan Kompetitif</h3>
                            <p class="box-slide-description">Aplikasi ini sebagai sarana antara alumni SMK Negeri 4
                                Banjarmasin dan Mitra Dunia Usaha/Dunia Industri.</p>
                            <p>
                                <a href="https://smkn4bjm.sch.id/" class="slider btn btn-primary">Tentang SMKN 4
                                    Banjarmasin</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="banner-carousel-item"
                style="background-image:url({{ URL::asset('images/homepage/slide-image/smkn4.jpg') }})">
                <div class="slider-content text-left">
                    <div class="container">
                        <div class="box-slider-content">
                            <div class="box-slider-text">
                                <h2 class="box-slide-title">Bursa Kerja Khusus - SMKN 4 Banjarmasin</h2>
                                <h3 class="box-slide-sub-title">Login</h3>
                                <form action="{{ route('login') }}" method="post">
                                    <p class="box-slide-description">
                                        @csrf
                                    <div class="form-group">
                                        <label for="newsletter-email" class="content-hidden">E-Mail / Username</label>
                                        <input type="email" name="email" id="newsletter-email"
                                            class="form-control form-control-lg" placeholder="E-Mail / Username"
                                            autocomplete="off">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="content-hidden">Password</label>
                                        <input type="password" name="password" id="password"
                                            class="form-control form-control-lg" placeholder="Password"
                                            autocomplete="off">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    </p>
                                    <button type="submit" class="btn btn-primary">Login</button>
                                    <p>
                                </form>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="call-to-action no-padding">
            <div class="container">
                <div class="action-style-box">
                    <div class="row">
                        <div class="col-md-12 text-center text-md-left">
                            <div class="call-to-action-text">
                                <h3 class="action-title">"SMKN 4 Banjarmasin Unggul dan Berprestasi"</h3>
                                <h3 class="action-title">Menghasilkan Lulusan yang Kompeten Berlandaskan Nilai-nilai
                                    Luhur Pancasila</h3>
                            </div>
                        </div><!-- Col end -->
                    </div><!-- row end -->
                </div><!-- Action style box -->
            </div><!-- Container end -->
        </section><!-- Action end -->


        <section class="content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h3 class="column-title">Kutipan</h3>

                        <div id="testimonial-slide" class="testimonial-slide">
                            <div class="item">
                                <div class="quote-item">
                                    <span class="quote-text">
                                        Kalau magang itu berarti mereka sudah terjun langsung bekerja, Jadi siswa kami
                                        sudah siap terjun langsung ke dunia kerja. Harapan kami mereka akan mengikuti
                                        kelas dan magang kemudian membentuk kompetensi luar biasa untuk masuk dunia
                                        kerja.
                                    </span>

                                    <div class="quote-item-footer d-flex justify-content-center">
                                        <div class="testimonials d-flex flex-column">
                                            <img loading="lazy" class="testimonial-thumb"
                                                src="{{ URL::asset('images/homepage/testimonial/syafruddin-noor.jpeg') }}"
                                                alt="testimonial" style="max-width: 310px;">
                                            <div class="quote-item-info">
                                                <h3 class="quote-author">Drs Syafruddin Noor, M.Pd</h3>
                                                <span class="quote-subtext">KEPALA SMK NEGERI 4 BANJARMASIN</span>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- Quote item end -->
                            </div>
                            <!--/ Item 1 end -->

                            <div class="item">
                                <div class="quote-item">
                                    <span class="quote-text">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        inci done idunt ut
                                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitoa
                                        tion ullamco laboris
                                        nisi aliquip consequat.
                                    </span>

                                    <div class="quote-item-footerd d-flex justify-content-center">
                                        <div class="testimonials d-flex flex-column">
                                            <img loading="lazy" class="testimonial-thumb"
                                            src="{{ URL::asset('images/homepage/clients/testimonial2.png') }}"
                                            alt="testimonial" style="max-width: 310px;">
                                            <div class="quote-item-info">
                                                <h3 class="quote-author">Weldon Cash</h3>
                                                <span class="quote-subtext">CFO, First Choice</span>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- Quote item end -->
                            </div>
                            <!--/ Item 2 end -->

                            <div class="item">
                                <div class="quote-item">
                                    <span class="quote-text">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        inci done idunt ut
                                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitoa
                                        tion ullamco laboris
                                        nisi ut commodo consequat.
                                    </span>

                                    <div class="quote-item-footer d-flex justify-content-center">
                                        <div class="testimonials d-flex flex-column">
                                            <img loading="lazy" class="testimonial-thumb"
                                            src="{{ URL::asset('images/homepage/clients/testimonial3.jpg') }}"
                                            alt="testimonial" style="min-width: 310px;">
                                            <div class="quote-item-info">
                                                <h3 class="quote-author">Minter Puchan</h3>
                                                <span class="quote-subtext">Director, AKT</span>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- Quote item end -->
                            </div>
                            <!--/ Item 3 end -->

                        </div>
                        <!--/ Testimonial carousel end-->
                    </div><!-- Col end -->

                    <div class="col-lg-6 mt-5 mt-lg-0">

                        <h3 class="column-title">DUNIA USAHA / DUNIA INDUSTRI </h3>
                        <p>Dunia Usaha / Dunia Industri Yang Bekerja Sama Dengan SMKN 4 Banjarmasin</p>
                        <div class="row all-clients">
                            <div class="col-sm-4 col-6">
                                <figure class="clients-logo">
                                    <a href="#!"><img loading="lazy" class="img-fluid"
                                            src="{{ URL::asset('images/homepage/dudi/galaxy.jpg') }}"
                                            alt="clients-logo" /></a>
                                </figure>
                            </div><!-- Client 1 end -->

                            <div class="col-sm-4 col-6">
                                <figure class="clients-logo">
                                    <a href="#!"><img loading="lazy" class="img-fluid"
                                            src="{{ URL::asset('images/homepage/dudi/mercure.jpg') }}"
                                            alt="clients-logo" /></a>
                                </figure>
                            </div><!-- Client 2 end -->

                            <div class="col-sm-4 col-6">
                                <figure class="clients-logo">
                                    <a href="#!"><img loading="lazy" class="img-fluid"
                                            src="{{ URL::asset('images/homepage/dudi/pyramid.jpg') }}"
                                            alt="clients-logo" /></a>
                                </figure>
                            </div><!-- Client 3 end -->

                        </div><!-- Clients row end -->

                    </div><!-- Col end -->

                </div>
                <!--/ Content row end -->
            </div>
            <!--/ Container end -->
        </section><!-- Content end -->


        <section id="facts" class="facts-area dark-bg">
            <div class="container">
                <div class="facts-wrapper">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 ts-facts">
                            <div class="ts-facts-img">
                                <i class="fa fa-users icon-count" aria-hidden="true"></i>
                            </div>
                            <div class="ts-facts-content">
                                <h2 class="ts-facts-num"><span class="counterUp" data-count="{{$totalAlumni}}">0</span></h2>
                                <h3 class="ts-facts-title">Alumni</h3>
                            </div>
                        </div><!-- Col end -->

                        <div class="col-md-4 col-sm-6 ts-facts mt-5 mt-sm-0">
                            <div class="ts-facts-img">
                                <i class="fa fa-building icon-count" aria-hidden="true"></i>
                            </div>
                            <div class="ts-facts-content">
                                <h2 class="ts-facts-num"><span class="counterUp" data-count="{{$totalperusahaan}}">0</span></h2>
                                <h3 class="ts-facts-title">Perusahaan</h3>
                            </div>
                        </div><!-- Col end -->

                        <div class="col-md-4 col-sm-6 ts-facts mt-5 mt-md-0">
                            <div class="ts-facts-img">
                                <i class="fa fa-newspaper icon-count" aria-hidden="true"></i>
                            </div>
                            <div class="ts-facts-content">
                                <h2 class="ts-facts-num"><span class="counterUp" data-count="{{ $totallowongan }}">0</span></h2>
                                <h3 class="ts-facts-title">Lowongan</h3>
                            </div>
                        </div><!-- Col end -->

                    </div><!-- Col end -->

                </div> <!-- Facts end -->
            </div>
            <!--/ Content row end -->
    </div>
    <!--/ Container end -->
    </section><!-- Facts end -->

    <!--/ Kegiaran Start -->
    <section id="project-area" class="project-area solid-bg">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-12">
                    <h3 class="section-sub-title">Kegiatan Kami</h3>
                    <h2 class="section-title">Mengisi Kegiatan yang Bermanfaat, Untuk bisa berkompentensi menghadapi
                        dunia depan yang penuh rintangan dan godaan.</h2>
                </div>
            </div>
            <!--/ Title row end -->

            <div class="row">
                <div class="col-12">
                    <div class="row shuffle-wrapper">
                        <div class="col-1 shuffle-sizer"></div>

                        <div class="col-lg-4 col-md-6 shuffle-item"
                            data-groups="[&quot;government&quot;,&quot;healthcare&quot;]">
                            <div class="project-img-container">
                                <a class="gallery-popup"
                                    href="{{ URL::asset('images/homepage/kegiatan/kegiatan1.jpeg') }}"
                                    aria-label="project-img">
                                    <img class="img-fluid"
                                        src="{{ URL::asset('images/homepage/kegiatan/kegiatan1.jpeg') }}"
                                        alt="project-img">
                                    <span class="gallery-icon"><i class="fa fa-plus"></i></span>
                                </a>
                            </div>
                        </div><!-- shuffle item 1 end -->

                        <div class="col-lg-4 col-md-6 shuffle-item" data-groups="[&quot;healthcare&quot;]">
                            <div class="project-img-container">
                                <a class="gallery-popup"
                                    href="{{ URL::asset('images/homepage/kegiatan/kegiatan2.jpg') }}"
                                    aria-label="project-img">
                                    <img class="img-fluid"
                                        src="{{ URL::asset('images/homepage/kegiatan/kegiatan2.jpg') }}"
                                        alt="project-img">
                                    <span class="gallery-icon"><i class="fa fa-plus"></i></span>
                                </a>
                            </div>
                        </div><!-- shuffle item 2 end -->

                        <div class="col-lg-4 col-md-6 shuffle-item"
                            data-groups="[&quot;infrastructure&quot;,&quot;commercial&quot;]">
                            <div class="project-img-container">
                                <a class="gallery-popup"
                                    href="{{ URL::asset('images/homepage/kegiatan/kegiatan3.jpeg') }}"
                                    aria-label="project-img">
                                    <img class="img-fluid"
                                        src="{{ URL::asset('images/homepage/kegiatan/kegiatan3.jpeg') }}"
                                        alt="project-img">
                                    <span class="gallery-icon"><i class="fa fa-plus"></i></span>
                                </a>
                            </div>
                        </div><!-- shuffle item 3 end -->

                        <div class="col-lg-4 col-md-6 shuffle-item"
                            data-groups="[&quot;education&quot;,&quot;infrastructure&quot;]">
                            <div class="project-img-container">
                                <a class="gallery-popup"
                                    href="{{ URL::asset('images/homepage/kegiatan/kegiatan4.jpg') }}"
                                    aria-label="project-img">
                                    <img class="img-fluid"
                                        src="{{ URL::asset('images/homepage/kegiatan/kegiatan4.jpg') }}"
                                        alt="project-img">
                                    <span class="gallery-icon"><i class="fa fa-plus"></i></span>
                                </a>
                            </div>
                        </div><!-- shuffle item 4 end -->

                        <div class="col-lg-4 col-md-6 shuffle-item"
                            data-groups="[&quot;infrastructure&quot;,&quot;education&quot;]">
                            <div class="project-img-container">
                                <a class="gallery-popup"
                                    href="{{ URL::asset('images/homepage/kegiatan/kegiatan5.jpeg') }}"
                                    aria-label="project-img">
                                    <img class="img-fluid"
                                        src="{{ URL::asset('images/homepage/kegiatan/kegiatan5.jpeg') }}"
                                        alt="project-img">
                                    <span class="gallery-icon"><i class="fa fa-plus"></i></span>
                                </a>
                            </div>
                        </div><!-- shuffle item 5 end -->

                        <div class="col-lg-4 col-md-6 shuffle-item" data-groups="[&quot;residential&quot;]">
                            <div class="project-img-container">
                                <a class="gallery-popup"
                                    href="{{ URL::asset('images/homepage/kegiatan/kegiatan6.jpeg') }}"
                                    aria-label="project-img">
                                    <img class="img-fluid"
                                        src="{{ URL::asset('images/homepage/kegiatan/kegiatan6.jpeg') }}"
                                        alt="project-img">
                                    <span class="gallery-icon"><i class="fa fa-plus"></i></span>
                                </a>
                            </div>
                        </div><!-- shuffle item 6 end -->
                    </div><!-- shuffle end -->
                </div>
            </div><!-- Content row end -->
        </div>
        <!--/ Container end -->
    </section><!-- Kegiatan area end -->


    <section class="call-to-action no-padding">
        <div class="container">
            <div class="action-style-box">
                <div class="row">
                    <div class="col-md-8 text-center text-md-left">
                        <div class="call-to-action-text">
                            <h3 class="action-title">Mendaftar Menjadi Mitra Perusahaan</h3>
                            <p class="text-white text-subscribe">Apakah anda ingin mendapatkan pekerja yang
                                berkompeten? ayoo mendaftarlah sebagai mitra dunia usaha dan mitra dunia industri.</p>
                        </div>
                    </div><!-- Col end -->
                    <div class="col-md-4 text-center text-md-right mt-3 mt-md-0">
                        <div class="call-to-action-btn pt-20">
                            <a href="mailto:info@smkn4bhm.sch.id"><button class="btn btn-primary mb-2">Daftar Sebagai
                                    Mitra Perusahaan</button></a>
                        </div>
                    </div><!-- col end -->
                </div><!-- row end -->
            </div><!-- Action style box -->
        </div><!-- Container end -->
    </section>


    <section id="ts-service-area" class="ts-service-area pb-0">
        <div class="container-full-width">
            <div class="row text-center">
                <div class="col-12">
                    <h3 class="section-sub-title">Lokasi Kami</h3>
                    <h2 class="section-title">SMKN 4 BANJARMASIN</h2>
                </div>
            </div>
            <!--/ Title row end -->
            <iframe marginheight="0" marginwidth="0" title="map" scrolling="no" class="h-96"
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1991.612629856295!2d114.59081457434388!3d-3.2943097225278426!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de423a0b07eb9cd%3A0xc5fc816bceb7bcf7!2sVocational%20High%20School%204%20Banjarmasin!5e0!3m2!1sen!2sid!4v1631013044446!5m2!1sen!2sid"
                width="100%" height="100%" frameborder="0"></iframe>
        </div>
        <!--/ Container end -->
    </section><!-- Service Map end -->




    <footer id="footer" class="footer bg-overlay">
        <div class="copyright">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="copyright-info">
                            <span>© 2023 SMK Negeri 4 Banjarmasin - Bursa Kerja Khusus. All rights reserved.</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="footer-menu text-center text-md-right">
                            <ul class="list-unstyled">
                                <li><img src="{{ URL::asset('images/homepage/logo.png') }}" class="h-10"></li>
                                <li class="text-copyright-xl">Bursa Kerja Khusus - SMKN 4 Banjarmasin</li>
                            </ul>
                        </div>
                    </div>
                </div><!-- Row end -->

                <div id="back-to-top" data-spy="affix" data-offset-top="10" class="back-to-top position-fixed">
                    <button class="btn btn-primary" title="Back to Top">
                        <i class="fa fa-angle-double-up"></i>
                    </button>
                </div>

            </div><!-- Container end -->
        </div><!-- Copyright end -->
    </footer><!-- Footer end -->
    <!-- initialize jQuery Library -->
    <script src="{{ URL::asset('asset/plugins/homepage/jQuery/jquery.min.js') }}"></script>
    <!-- Bootstrap jQuery -->
    <script src="{{ URL::asset('asset/plugins/homepage/bootstrap/bootstrap.min.js') }}" defer></script>
    <!-- Slick Carousel -->
    <script src="{{ URL::asset('asset/plugins/homepage/slick/slick.min.js') }}"></script>
    <script src="{{ URL::asset('asset/plugins/homepage/slick/slick-animation.min.js') }}"></script>
    <!-- Color box -->
    <script src="{{ URL::asset('asset/plugins/homepage/colorbox/jquery.colorbox.js') }}"></script>
    <!-- shuffle -->
    <script src="{{ URL::asset('asset/plugins/homepage/shuffle/shuffle.min.js') }}" defer></script>
    <!-- Template custom -->
    <script src="{{ URL::asset('asset/js/homepage/script.js') }}"></script>

    </div><!-- Body inner end -->
</body>

</html>
