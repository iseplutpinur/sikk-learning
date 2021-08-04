<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-secondary">
            <div class="card-header">
                <h3 class="card-title">
                    Perbaiki Template
                </h3>
            </div>
            <form id="form">
                <div class="card-body">
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input class="form-control" type="text" placeholder="Judul Template" id="judul" name="judul" value="<?= $detail['judul'] ?>" required>
                        <input type="hidden" id="id_template" value="<?= $detail['id'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="sekolah">Sekolah</label>
                        <select class="form-control" id="sekolah" name="sekolah" aria-placeholder="Pilih Sekolah" style="width: 100%;" required>
                            <option value="<?= $detail['id_sekolah'] ?>" selected><?= $detail['nama_sekolah'] ?></option>
                        </select>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control summernote" rows="3" placeholder="Keterangan" id="keterangan" name="keterangan"><?= $detail['keterangan'] ?></textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between w-100">
                        <button type="submit" class="btn btn-info">Simpan</button>
                        <a href="<?= base_url() ?>project/template" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>