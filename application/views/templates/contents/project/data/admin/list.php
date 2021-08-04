<div class="card card-info card-outline" id="filter">
    <div class="card-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-end  align-items-star w-100 flex-md-row flex-column">
                <h3 class="card-title align-self-center">Filter Project: </h3>
                <div class="form-group  mb-lg-0 ml-lg-2">
                    <select class="form-control" id="filter-sekolah" name="filter-sekolah" style="min-width: 100px;">
                        <option value="" selected>Semua Sekolah</option>
                    </select>
                </div>
                <div class="form-group  mb-lg-0 ml-lg-2">
                    <select class="form-control" id="filter-kelas" name="filter-kelas" style="min-width: 100px;">
                        <option value="" selected>Semua Kelas</option>
                    </select>
                </div>
                <div class="form-group  mb-lg-0 ml-lg-2">
                    <select class="form-control" id="filter-guru" name="filter-guru" style="min-width: 100px;">
                        <option value="" selected>Semua Guru</option>
                    </select>
                </div>

                <!-- <div class="form-group  mb-lg-0 ml-lg-2">
                    <select class="form-control" id="filter-aktif" name="filter-aktif">
                    <option value="">Status</option>
                    <option value="1">Aktif</option>
                    <option value="2">Tidak Aktif</option>
                    </select>
                    </div> -->

                <div class="form-group  mb-lg-0 ml-lg-2">
                    <input type="text" class="form-control" id="filter-key" name="filter-key" placeholder="Kata Kunci" required />
                </div>

                <div class=" ml-lg-2">
                    <button type="button" class="btn btn-info btn" id="btn-filter" style="min-width: 72px;"><i class="fas fa-search"></i></i> Cari</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between w-100">
            <h3 class="card-title" id="table-title">List Project</b></h3>
            <a href="<?= base_url() ?>project/data/tambah" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="dt_basic" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <td>Sekolah</td>
                    <td>Kelas</td>
                    <td>Guru</td>
                    <td>Judul</td>
                    <td>Jml. Aktifitas</td>
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
                    <span class="shadow-md p-1 mb-1 bg-info rounded">Judul:</span>
                    <p class="card-text" id="detail-judul"></p>

                    <span class="shadow-md p-1 mb-1 bg-info rounded">Sekolah:</span>
                    <p class="card-text" id="detail-sekolah"></p>

                    <span class="shadow-md p-1 mb-1 bg-info rounded">Kelas:</span>
                    <p class="card-text" id="detail-kelas"></p>

                    <span class="shadow-md p-1 mb-1 bg-info rounded">Guru:</span>
                    <p class="card-text" id="detail-guru"></p>

                    <span class="shadow-md p-1 mb-1 bg-info rounded">Pendahuluan:</span>
                    <p class="card-text" id="detail-pendahuluan"></p>

                    <span class="shadow-md p-1 mb-1 bg-info rounded">Deskripsi:</span>
                    <p class="card-text" id="detail-deskripsi"></p>

                    <span class="shadow-md p-1 mb-1 bg-info rounded">Tujuan:</span>
                    <p class="card-text" id="detail-tujuan"></p>

                    <span class="shadow-md p-1 mb-1 bg-info rounded">Link Sumber:</span>
                    <p class="card-text" id="detail-link_sumber"></p>

                    <span class="shadow-md p-1 mb-1 bg-info rounded">Jumlah Aktifitas:</span>
                    <p class="card-text" id="detail-jumlah_aktifitas"></p>

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