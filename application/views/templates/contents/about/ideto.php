<div class="hero-v1" style="padding-top: 100px; padding-bottom: 0;">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-6 text-center mx-auto">
                <h1 class="heading mb-3"><?= isset($about['slider_judul']) ? $about['slider_judul'] : '' ?></h1>
                <?= isset($about['slider_deskripsi']) ? $about['slider_deskripsi'] : '' ?>
            </div>
        </div>
    </div>
</div>

<div class="site-section">
    <div class=" container">
        <div class="row">
            <div class="col-lg ml-auto">
                <h2 class="mb-4 section-heading"><?= isset($about['profil_judul']) ? $about['profil_judul'] : '' ?></h2>
                <?= isset($about['profil_deskripsi']) ? $about['profil_deskripsi'] : '' ?>
            </div>
        </div>
    </div>
</div>

<div class="site-section bg-light">
    <div class=" container">
        <div class="row">
            <div class="col-lg ml-auto">
                <h2 class="mb-4 section-heading"><?= isset($about['sejarah_judul']) ? $about['sejarah_judul'] : '' ?></h2>
                <?= isset($about['sejarah_deskripsi']) ? $about['sejarah_deskripsi'] : '' ?>
            </div>
        </div>
    </div>
</div>