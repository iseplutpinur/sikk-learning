<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-secondary">
            <div class="card-header">
                <h3 class="card-title">
                    Tambah Project
                </h3>
            </div>
            <form id="form">
                <div class="card-body">
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input class="form-control" type="text" placeholder="Judul Project" id="judul" name="judul" value="<?= $detail['judul'] ?>" required>
                        <input type="hidden" id="id_project" value="<?= $detail['id'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="pendahuluan">Pendahuluan</label>
                        <textarea class="form-control summernote" rows="3" placeholder="pendahuluan" id="pendahuluan" name="pendahuluan"><?= $detail['pendahuluan'] ?></textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control summernote" rows="3" placeholder="Deskripsi" id="deskripsi" name="deskripsi"><?= $detail['deskripsi'] ?></textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="tujuan">Tujuan</label>
                        <textarea class="form-control summernote" rows="3" placeholder="Tujuan" id="tujuan" name="tujuan"><?= $detail['tujuan'] ?></textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="link_sumber">Link Sumber</label>
                        <textarea class="form-control summernote" rows="3" placeholder="Link Sumber" id="link_sumber" name="link_sumber"><?= $detail['link_sumber'] ?></textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="jumlah_aktifitas">Jumlah Aktifitas</label>
                        <input class="form-control" type="number" placeholder="Jumlah Aktifitas" id="jumlah_aktifitas" name="jumlah_aktifitas" value="<?= $detail['jumlah_aktifitas'] ?>" required readonly>
                        <small class="text-muted">Jumlah Aktifitas bisa diubah saat berada pada halaman aktifitas dari project.</small>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between w-100">
                        <button type="submit" class="btn btn-info">Simpan</button>
                        <a href="<?= base_url() ?>project/data" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>