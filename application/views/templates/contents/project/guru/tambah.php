<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-secondary">
            <div class="card-header">
                <h3 class="card-title">
                    Tambah Project
                </h3>
            </div>
            <form id="form-project">
                <div class="card-body">
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input class="form-control" type="text" placeholder="Judul Project" id="judul" name="judul" required>
                        <input type="hidden" id="id_project" value="<?= $id_project['id'] ?>">
                        <input type="hidden" id="id_sekolah" value="<?= $id_sekolah ?>">
                        <input type="hidden" id="id_kelas" value="<?= $id_kelas ?>">
                    </div>
                    <div class="form-group">
                        <label for="pendahuluan">Pendahuluan</label>
                        <textarea class="form-control summernote" rows="3" placeholder="pendahuluan" id="Pendahuluan" name="pendahuluan"></textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control summernote" rows="3" placeholder="Deskripsi" id="deskripsi" name="deskripsi"></textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="tujuan">Tujuan</label>
                        <textarea class="form-control summernote" rows="3" placeholder="Tujuan" id="tujuan" name="tujuan"></textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="link_sumber">Link Sumber</label>
                        <textarea class="form-control summernote" rows="3" placeholder="Link Sumber" id="link_sumber" name="link_sumber"></textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="jumlah_aktifitas">Jumlah Aktifitas</label>
                        <input class="form-control" type="number" placeholder="Jumlah Aktifitas" id="jumlah_aktifitas" name="jumlah_aktifitas" required>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-secondary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>