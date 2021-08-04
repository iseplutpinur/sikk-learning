<!-- Timelime example  -->
<div class="row">
    <div class="col-md-12">
        <!-- The time line -->
        <div class="timeline">
            <!-- timeline time label -->
            <div class="time-label">
                <span class="bg-red">Project</span>
            </div>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <div>
                <i class="fas fa-file-signature bg-dark"></i>
                <div class="timeline-item">
                    <h3 class="timeline-header no-border"><b>Judul: </b> <?= $detail['judul'] ?></h3>
                </div>
            </div>
            <!-- timeline item -->
            <div>
                <i class="fas fa-home bg-green"></i>
                <div class="timeline-item">
                    <h3 class="timeline-header no-border"><b>Sekolah: </b> <?= $detail['nama_sekolah'] ?></h3>
                </div>
            </div>
            <!-- END timeline item -->
            <!-- timeline item -->
            <div>
                <i class="fas fa-user bg-secondary"></i>
                <div class="timeline-item">
                    <h3 class="timeline-header no-border"><b>Guru: </b> <?= $detail['nama_guru'] ?></h3>
                </div>
            </div>
            <!-- END timeline item -->
            <!-- timeline item -->
            <div>
                <i class="fas fa-list bg-warning"></i>
                <div class="timeline-item">
                    <h3 class="timeline-header no-border"><b>Kelas: </b> <?= $detail['nama_kelas'] ?></h3>
                </div>
            </div>
            <!-- END timeline item -->
            <!-- timeline item -->
            <div>
                <i class="fas fa-check bg-info"></i>
                <div class="timeline-item">
                    <h3 class="timeline-header"><b>Pendahuluan</b></h3>
                    <div class="timeline-body">
                        <?= $detail['pendahuluan'] ?>
                    </div>
                </div>
            </div>
            <!-- END timeline item -->
            <!-- timeline item -->
            <div>
                <i class="fas fa-check bg-info"></i>
                <div class="timeline-item">
                    <h3 class="timeline-header"><b>Deskripsi</b></h3>
                    <div class="timeline-body">
                        <?= $detail['deskripsi'] ?>
                    </div>
                </div>
            </div>
            <!-- END timeline item -->
            <!-- timeline item -->
            <div>
                <i class="fas fa-check bg-info"></i>
                <div class="timeline-item">
                    <h3 class="timeline-header"><b>Tujuan</b></h3>
                    <div class="timeline-body">
                        <?= $detail['tujuan'] ?>
                    </div>
                </div>
            </div>
            <!-- END timeline item -->
            <!-- timeline item -->
            <div>
                <i class="fas fa-check bg-info"></i>
                <div class="timeline-item">
                    <h3 class="timeline-header"><b>Link Sumber</b></h3>
                    <div class="timeline-body">
                        <?= $detail['link_sumber'] ?>
                    </div>
                </div>
            </div>
            <!-- END timeline item -->
            <!-- timeline time label -->

            <div class="time-label">
                <span class="bg-green">Aktifitas</span>
            </div>

            <?php
            $number = 1;
            foreach ($list_aktifitas as $aktifitas) : ?>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <div>
                    <i class="fas bg-purple"><?= $number++ ?></i>
                    <div class="timeline-item">
                        <h3 class="timeline-header"><b><?= $aktifitas['judul'] ?></b></h3>
                        <div class="timeline-body">
                            <div class="callout callout-danger">
                                <h6>Naskah</h6>
                                <div>
                                    <?= $aktifitas['naskah'] ?>
                                </div>
                            </div>
                            <div class="callout callout-info">
                                <h6>Detail</h6>
                                <div>
                                    <?= $aktifitas['detail'] ?>
                                </div>
                            </div>
                            <div class="callout callout-warning">
                                <h6>Lembar Kerja</h6>
                                <div>
                                    <?= $aktifitas['lembar_kerja'] ?>
                                </div>
                            </div>
                            <div class="callout callout-success">
                                <h6>Jenis Upload</h6>
                                <div>
                                    <?= $aktifitas['jenis_upload'] ?>
                                </div>
                            </div>
                            <div class="callout callout-primary">
                                <h6>Nilai</h6>
                                <div>
                                    <?= $aktifitas['nilaiqq'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END timeline item -->
            <?php endforeach ?>
        </div>
    </div>
    <!-- /.col -->
</div>
<!-- /.timeline -->