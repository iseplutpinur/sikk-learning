<div class="hero-v1">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mr-auto text-center text-lg-left mb-5">
                <h1 class="heading mb-3"><?= isset($home['slider_judul']) ? $home['slider_judul'] : '' ?></h1>
                <p class="mb-5"><?= isset($home['slider_deskripsi']) ? $home['slider_deskripsi'] : '' ?></p>
                <p class="mb-4"><a href="./page/login.html" class="btn btn-primary mb-5">Menulis Sekarang</a></p>
            </div>
            <div class="col-lg-6 mb-3">
                <figure class="illustration">
                    <img src="./assets/images/student.png" alt="Image" class="img-fluid">
                </figure>
            </div>
            <div class="col-lg-6"></div>
        </div>
    </div>
</div>

<!-- MAIN -->
<!-- Informasi  -->
<div class="site-section mb-0">
    <div class="container">
        <div class="row mb-3">
            <div class="col-lg-7 text-center mx-auto">
                <h2 class="section-heading"><?= isset($home['informasi_judul']) ? $home['informasi_judul'] : '' ?></h2>
            </div>
        </div>
        <?= isset($home['informasi_deskripsi']) ? $home['informasi_deskripsi'] : '' ?>
    </div>
</div>

<!-- review -->
<div class="site-section bg-light">
    <div class="container">
        <div class="row mb-3">
            <div class="col-lg-7 text-center mx-auto">
                <h2 class="section-heading">Review</h2>
            </div>
        </div>
        <div class="row mx-auto my-auto">
            <div id="myCarousel" class="carousel slide w-100" data-ride="carousel">
                <div class="carousel-inner w-100  pt-5" role="listbox">
                    <div class="carousel-item active">
                        <div class="col-lg-4 col-md-6">
                            <div class="testimonial text-center">
                                <img src="./assets/images/person_1.jpg" alt="Image" class="img-fluid">
                                <blockquote>
                                    <p class="quote">1Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo repellendus nihil
                                        qui
                                        iure animi maxime consequuntur aliquid sed tempore, amet!</p>
                                    <cite class="author">Elizabeth Anderson, Senior</cite>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="col-lg-4 col-md-6">
                            <div class="testimonial text-center">
                                <img src="./assets/images/person_1.jpg" alt="Image" class="img-fluid">
                                <blockquote>
                                    <p class="quote">2Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo repellendus nihil
                                        qui
                                        iure animi maxime consequuntur aliquid sed tempore, amet!</p>
                                    <cite class="author">Elizabeth Anderson, Senior</cite>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="col-lg-4 col-md-6">
                            <div class="testimonial text-center">
                                <img src="./assets/images/person_1.jpg" alt="Image" class="img-fluid">
                                <blockquote>
                                    <p class="quote">3Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo repellendus nihil
                                        qui
                                        iure animi maxime consequuntur aliquid sed tempore, amet!</p>
                                    <cite class="author">Elizabeth Anderson, Senior</cite>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="col-lg-4 col-md-6">
                            <div class="testimonial text-center">
                                <img src="./assets/images/person_1.jpg" alt="Image" class="img-fluid">
                                <blockquote>
                                    <p class="quote">4Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo repellendus nihil
                                        qui
                                        iure animi maxime consequuntur aliquid sed tempore, amet!</p>
                                    <cite class="author">Elizabeth Anderson, Senior</cite>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="col-lg-4 col-md-6">
                            <div class="testimonial text-center">
                                <img src="./assets/images/person_1.jpg" alt="Image" class="img-fluid">
                                <blockquote>
                                    <p class="quote">5Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo repellendus nihil
                                        qui
                                        iure animi maxime consequuntur aliquid sed tempore, amet!</p>
                                    <cite class="author">Elizabeth Anderson, Senior</cite>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="col-lg-4 col-md-6">
                            <div class="testimonial text-center">
                                <img src="./assets/images/person_1.jpg" alt="Image" class="img-fluid">
                                <blockquote>
                                    <p class="quote">6Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo repellendus nihil
                                        qui
                                        iure animi maxime consequuntur aliquid sed tempore, amet!</p>
                                    <cite class="author">Elizabeth Anderson, Senior</cite>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev w-auto" href="#myCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next w-auto" href="#myCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Artikel terbaru -->
<div class="site-section">
    <div class="container">
        <div class="row mb-3">
            <div class="col-lg-7 mx-auto text-center">
                <h2 class="section-heading">Artikel Terbaru</h2>
            </div>
        </div>
        <div class="row artikel-terbaru">
            <div class="col-lg-6 mb-4">
                <div class="symptom">
                    <div class="text">
                        <div class="d-flex justify-content-between w-100">
                            <div class="d-flex flex-column mr-1">
                                <h3>Rohmad salam, Agus Salim Afrozi</h3>
                                <p class="mb-1">
                                    Pembuatan Bahan Shielding Radiasi Neutron Berbahan Serbuk Kayu dengan variaasi kandungan Boraks
                                </p>
                                <p class="font-weight-bold ml-3">DOI: 10.32493/jitk.v5i1.7008</p>
                            </div>
                            <div class="d-flex flex-column " style="font-size: 0.7em;">
                                <span>[ENGLISH]</span>
                                <span>Pdf</span>
                                <span>1-7</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-6 mb-4">
                <div class="symptom">
                    <div class="text">
                        <div class="d-flex justify-content-between w-100">
                            <div class="d-flex flex-column mr-1">
                                <h3>Ulfi Rahayu</h3>
                                <p class="mb-1">
                                    KINETIKA ADSORPSI ZAT WARNA DIRECT BROWN MENGGUNAKAN HIDROKSIAPATIT DENGAN VARIASI DOSIS ADSORBEN
                                    DAN PH LARUTAN
                                </p>
                                <p class="font-weight-bold ml-3">DOI: 10.32493/jitk.v5i1.7390</p>
                            </div>
                            <div class="d-flex flex-column " style="font-size: 0.7em;">
                                <span>[ENGLISH]<spanp>
                                        <span>Pdf</span>
                                        <span>8-19</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="symptom">
                    <div class="text">
                        <div class="d-flex justify-content-between w-100">
                            <div class="d-flex flex-column mr-1">
                                <h3>DIDIK ISWADI</h3>
                                <p class="mb-1">
                                    MODIFIKASI PEMBUATAN TAHU DENGAN PENGGUNAAN LAMA PERENDAMAN, LAMA PENGGILINGAN DAN PENGGUNAAN SUHU
                                    DALAM UPAYA MENINGKATKAN KUALITAS PRODUK TAHU </p>
                                <p class="font-weight-bold ml-3">DOI: 10.32493/jitk.v5i1.7008</p>
                            </div>
                            <div class="d-flex flex-column " style="font-size: 0.7em;">
                                <span>[ENGLISH]</span>
                                <span>Pdf</span>
                                <span>31-45</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="symptom">
                    <div class="text">
                        <div class="d-flex justify-content-between w-100">
                            <div class="d-flex flex-column mr-1">
                                <h3>DIDIK ISWADI</h3>
                                <p class="mb-1">
                                    MODIFIKASI PEMBUATAN TAHU DENGAN PENGGUNAAN LAMA PERENDAMAN, LAMA PENGGILINGAN DAN PENGGUNAAN SUHU
                                    DALAM UPAYA MENINGKATKAN KUALITAS PRODUK TAHU </p>
                                <p class="font-weight-bold ml-3">DOI: 10.32493/jitk.v5i1.7008</p>
                            </div>
                            <div class="d-flex flex-column " style="font-size: 0.7em;">
                                <span>[ENGLISH]</span>
                                <span>Pdf</span>
                                <span>31-45</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="symptom">
                    <div class="text">
                        <div class="d-flex justify-content-between w-100">
                            <div class="d-flex flex-column mr-1">
                                <h3>DIDIK ISWADI</h3>
                                <p class="mb-1">
                                    MODIFIKASI PEMBUATAN TAHU DENGAN PENGGUNAAN LAMA PERENDAMAN, LAMA PENGGILINGAN DAN PENGGUNAAN SUHU
                                    DALAM UPAYA MENINGKATKAN KUALITAS PRODUK TAHU </p>
                                <p class="font-weight-bold ml-3">DOI: 10.32493/jitk.v5i1.7008</p>
                            </div>
                            <div class="d-flex flex-column " style="font-size: 0.7em;">
                                <span>[ENGLISH]</span>
                                <span>Pdf</span>
                                <span>31-45</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>