<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between w-100">
            <h3 class="card-title">List Informasi</h3>
            <a href="<?= base_url('informasi/listInformasi/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="dt_basic" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Tanggal</th>
                    <th>Penulis</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Tgl. Dibuat</th>
                    <th>Tgl. Diubah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
    <!-- /.card-body -->
</div>