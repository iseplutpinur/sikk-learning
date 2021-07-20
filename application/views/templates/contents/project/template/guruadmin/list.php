<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between w-100">
            <h3 class="card-title" id="table-title">List Template Project Sekolah <b><?= $sekolah['nama'] ?></b></h3>
            <a href="<?= base_url() ?>project/template/tambah" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="dt_basic" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <td>Judul</td>
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
                <h4 class="modal-title" id="modalInfoLabel">Template</h4>
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

                    <h5 class="card-title">Keterangan:</h5>
                    <p class="card-text" id="detail-keterangan"></p>

                    <h5 class="card-title">Status:</h5>
                    <p class="card-text" id="detail-status"></p>

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