<div class="card card-purple card-outline" id="filter">
    <div class="card-header">
        <div class="d-flex justify-content-end  align-items-star w-100 flex-md-row flex-column">
            <button type="button" class="btn btn-info btn-sm" onclick="KunciKelompok('<?= $detail['id'] ?>')"><i class="fas fa-key"></i></i> Simpan Dan Kunci Kelompok</button>
        </div>
    </div>
</div>
<input type="hidden" id="id_project" value="<?= $detail['id'] ?>">
<input type="hidden" id="id_sekolah" value="<?= $detail['id_sekolah'] ?>">

<div class="card  card-info card-outline">
    <div class="card-header">
        <div class="d-flex justify-content-between w-100">
            <h3 class="card-title">List Kelompok</h3>
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" id="btn-tambah"><i class="fa fa-plus"></i> Tambah</button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="dt_kelompok" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <td>Nama</td>
                    <td>Jumlah Anggota</td>
                    <td>Aksi</td>
                </tr>
            </thead>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<div class="card  card-primary card-outline" id="card-anggota" style="display: none;">
    <div class="card-header">
        <div class="d-flex justify-content-between w-100">
            <h3 class="card-title" id="title-card-anggota">List Anggota</h3>
            <input type="hidden" id="id-card-anggota">
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalTambahAnggotaKelompok" id="btn-tambah-anggota-kelompok"><i class="fa fa-plus"></i> Tambah</button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="dt_siswa" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <td>NISN</td>
                    <td>Nama</td>
                    <td>Kelas</td>
                    <td>Ketetrangan</td>
                    <td>Aksi</td>
                </tr>
            </thead>
        </table>
    </div>
    <!-- /.card-body -->
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Kelompok</label>
                        <input type="hidden" name="id" id="id">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Kelompok" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        Cancel
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modalTambahAnggotaKelompok" tabindex="-1" role="dialog" aria-labelledby="modalTambahAnggotaKelompokLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="form-tambah-anggota-kelompok">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTambahAnggotaKelompokLabel"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="body-tambah-anggota-kelompok">
                    <label for="siswa-anggota">Peserta</label>
                    <div class="form-group">
                        <select class="form-control" id="siswa-anggota" name="siswa-anggota" style="width: 100%;">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        Cancel
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->