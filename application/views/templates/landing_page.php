<!doctype html>
<html lang="en">

<head>
    <title><?= $title ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('template') ?>/assets/fonts/icomoon/style.css">
    <link rel="stylesheet" href="<?= base_url('template') ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('template') ?>/assets/css/jquery-ui.css">
    <link rel="stylesheet" href="<?= base_url('template') ?>/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url('template') ?>/assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?= base_url('template') ?>/assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?= base_url('template') ?>/assets/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="<?= base_url('template') ?>/assets/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="<?= base_url('template') ?>/assets/fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="<?= base_url('template') ?>/assets/fonts/flaticon-covid/font/flaticon.css">
    <link rel="stylesheet" href="<?= base_url('template') ?>/assets/css/aos.css">
    <link rel="stylesheet" href="<?= base_url('template') ?>/assets/css/style.css">

    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="<?= base_url('template') ?>/assets/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= base_url('template') ?>/assets/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= base_url('template') ?>/assets/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('template') ?>/assets/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= base_url('template') ?>/assets/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= base_url('template') ?>/assets/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= base_url('template') ?>/assets/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= base_url('template') ?>/assets/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('template') ?>/assets/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url('template') ?>/assets/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('template') ?>/assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url('template') ?>/assets/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('template') ?>/assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?= base_url('template') ?>/assets/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?= base_url('template') ?>/assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#6f42c1">
    <link rel="shortcut icon" href="<?= base_url('template') ?>/assets/favicon/favicon.ico" type="image/x-icon">
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
    <a href="#" id="toTopBtn" class="cd-top text-replace js-cd-top cd-top--is-visible cd-top--fade-out" data-abc="true"></a>

    <div id="overlayer"></div>
    <div class="loader">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>


    <div class="site-wrap">

        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>


        <header class="site-navbar light js-sticky-header site-navbar-target" role="banner">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-6 col-xl-2">
                        <div class="mb-0 site-logo"><a href="<?= base_url() ?>" class="mb-0">IDETO<span class="text-primary">.co.id</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-md-10 d-none d-xl-block">
                        <nav class="site-navigation position-relative text-right" role="navigation">
                            <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                                <li><a href="<?= base_url() ?>" class="nav-link  nav-top-link" data-name="home">Home</a></li>
                                <li class="has-children">
                                    <a href="<?= base_url() ?>" class="nav-link  nav-top-link" data-name="about">About Us</a>
                                    <ul class="dropdown">
                                        <li><a href="<?= base_url() ?>about/ideto" class="nav-link nav-top-link" data-name="about-ideto">About Ideto</a></li>
                                        <li><a href="<?= base_url() ?>about/penataLaksana" class="nav-link nav-top-link" data-name="about-penatalaksana">Penata Laksana</a></li>
                                        <li><a href="<?= base_url() ?>about/kebijakan" class="nav-link nav-top-link" data-name="about-kebijakan">Kebijakan</a></li>
                                        <li><a href="<?= base_url() ?>about/lainLain" class="nav-link nav-top-link" data-name="about-penyerahan">Penyerahan</a></li>
                                        <li><a href="<?= base_url() ?>about/penyerahan" class="nav-link nav-top-link" data-name="about-lain_lain">Lain-lain</a></li>
                                    </ul>
                                </li>
                                <li><a href="<?= base_url() ?>artikel" class="nav-link nav-top-link" data-name="artikel">Artikel</a></li>
                                <li><a href="<?= base_url() ?>arsip" class="nav-link nav-top-link" data-name="arsip">Arsip</a></li>
                                <li><a href="<?= base_url() ?>informasi" class="nav-link nav-top-link" data-name="informasi">Informasi</a></li>
                                <li><a href="<?= base_url() ?>pencarian" class="nav-link nav-top-link" data-name="pencarian">Pencarian</a></li>
                                <li><a href="<?= base_url() ?>login" class="nav-link nav-top-link" data-name="login">Login</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle float-right"><span class="icon-menu h3 text-black"></span></a>
                    </div>
                </div>
            </div>
        </header>
        <!-- content start -->

        <?php if (file_exists(VIEWPATH . "templates/contents/{$content}.php")) : ?>
            <?php $this->load->view("templates/contents/{$content}.php"); ?>
        <?php endif; ?>

        <!-- content end -->
        <!-- footer -->
        <div class="site-footer" style="background-color: rgba(111, 66, 193, 0.1);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <h2 class="footer-heading mb-4">About</h2>
                        <p>Jurnal Ilmiah Teknik Kimia Universitas Pamulang merupakan wadah bagi para dosen, peneliti maupun
                            mahasiswa
                            sebagai media publikasi penelitian ilmiah dalam bidang Teknik Kimia dan Kimia.</p>
                        <div class="my-5">
                            <a href="#" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
                            <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
                            <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
                            <a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-4">
                                <h2 class="footer-heading mb-4">Quick Links</h2>
                                <ul class="list-unstyled">
                                    <li><a href="#">Symptoms</a></li>
                                    <li><a href="#">Prevention</a></li>
                                    <li><a href="#">FAQs</a></li>
                                    <li><a href="#">About Coronavirus</a></li>
                                    <li><a href="#">Contact Us</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-4">
                                <h2 class="footer-heading mb-4">Helpful Link</h2>
                                <ul class="list-unstyled">
                                    <li><a href="#">Helathcare Professional</a></li>
                                    <li><a href="#">LGU Facilities</a></li>
                                    <li><a href="#">Protect Your Family</a></li>
                                    <li><a href="#">World Health</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-4">
                                <h2 class="footer-heading mb-4">Resources</h2>
                                <ul class="list-unstyled">
                                    <li><a href="#">WHO Website</a></li>
                                    <li><a href="#">CDC Website</a></li>
                                    <li><a href="#">Gov Website</a></li>
                                    <li><a href="#">DOH Website</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-md-12">
                        <div class="border-top pt-5">
                            <p class="copyright"><small>
                                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                    Copyright &copy;
                                    <script>
                                        document.write(new Date().getFullYear());
                                    </script>
                                    IDETO.co.id
                                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                </small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url('template') ?>/assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url('template') ?>/assets/js/jquery-ui.js"></script>
    <script src="<?= base_url('template') ?>/assets/js/popper.min.js"></script>
    <script src="<?= base_url('template') ?>/assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url('template') ?>/assets/js/owl.carousel.min.js"></script>
    <script src="<?= base_url('template') ?>/assets/js/jquery.countdown.min.js"></script>
    <script src="<?= base_url('template') ?>/assets/js/jquery.easing.1.3.js"></script>
    <script src="<?= base_url('template') ?>/assets/js/aos.js"></script>
    <script src="<?= base_url('template') ?>/assets/js/jquery.fancybox.min.js"></script>
    <script src="<?= base_url('template') ?>/assets/js/jquery.sticky.js"></script>
    <script src="<?= base_url('template') ?>/assets/js/isotope.pkgd.min.js"></script>
    <script src="<?= base_url('template') ?>/assets/js/main.js"></script>
    <!-- change nav top active -->
    <script>
        const nav_top = $(".nav-top-link");
        const nav_arr = JSON.parse('<?= json_encode($navigation_array) ?>');
        nav_top.each(function() {
            if (nav_arr.includes(this.dataset.name)) {
                $(this).addClass("active1");
            } else {
                $(this).removeClass("active1");
            }
        })
    </script>
</body>

</html>