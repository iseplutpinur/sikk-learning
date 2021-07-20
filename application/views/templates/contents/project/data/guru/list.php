<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between w-100">
            <h3 class="card-title" id="table-title">List Project Sekolah <b><?= $detail['nama_sekolah'] ?></b> Kelas <b><?= $detail['nama_kelas'] ?></b> Guru <b><?= $detail['nama_guru'] ?></b></h3>
            <a href="<?php base_url() ?>data/tambah" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="dt_basic" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <td>Judul</td>
                    <td>Jumlah Aktifitas</td>
                    <td>Status</td>
                    <td>Tgl. Dibuat</td>
                    <td>Tgl. Diubah</td>
                    <td>Aksi</td>
                </tr>
            </thead>
        </table>
    </div>
    <!-- /.card-body -->
</div>

<div class="modal fade" id="modalInfo" tabindex="-1" role="dialog" aria-labelledby="modalInfoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalInfoLabel">Project</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <h5 class="card-title">Judul:</h5>
                    <p class="card-text" id="detail-judul"></p>

                    <h5 class="card-title">Sekolah:</h5>
                    <p class="card-text" id="detail-sekolah"></p>

                    <h5 class="card-title">Kelas:</h5>
                    <p class="card-text" id="detail-kelas"></p>

                    <h5 class="card-title">Guru:</h5>
                    <p class="card-text" id="detail-guru"></p>

                    <h5 class="card-title">Pendahuluan:</h5>
                    <p class="card-text" id="detail-pendahuluan"></p>

                    <h5 class="card-title">Deskripsi:</h5>
                    <p class="card-text" id="detail-deskripsi"></p>

                    <h5 class="card-title">Tujuan:</h5>
                    <p class="card-text" id="detail-tujuan"></p>

                    <h5 class="card-title">Link Sumber:</h5>
                    <p class="card-text" id="detail-link_sumber"></p>

                    <h5 class="card-title">Jumlah Aktifitas:</h5>
                    <p class="card-text" id="detail-jumlah_aktifitas"></p>

                    <h5 class="card-title">Tanggal Ditambahkan:</h5>
                    <p class="card-text" id="detail-created_at"></p>

                    <h5 class="card-title">Tanggal Diubah:</h5>
                    <p class="card-text" id="detail-updated_at"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->