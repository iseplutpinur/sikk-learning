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
                    <span class="shadow-md p-1 mb-1 bg-info rounded">Judul:</span>
                    <p class="card-text" id="detail-judul"></p>

                    <span class="shadow-md p-1 mb-1 bg-info rounded">Sekolah:</span>
                    <p class="card-text" id="detail-sekolah"></p>

                    <span class="shadow-md p-1 mb-1 bg-info rounded">Keterangan:</span>
                    <p class="card-text" id="detail-keterangan"></p>

                    <span class="shadow-md p-1 mb-1 bg-info rounded">Status:</span>
                    <p class="card-text" id="detail-status"></p>

                    <span class="shadow-md p-1 mb-1 bg-info rounded">Tanggal Ditambahkan:</span>
                    <p class="card-text" id="detail-created_at"></p>

                    <span class="shadow-md p-1 mb-1 bg-info rounded">Tanggal Diubah:</span>
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