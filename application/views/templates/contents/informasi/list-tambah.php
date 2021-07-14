<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <div class="card-header">
                <div class="d-flex justify-content-between w-100">
                    <h3 class="card-title">Tambah Informasi</h3>
                </div>
            </div>
            <form id="form-informasi">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="judul">Judul Informasi</label>
                                <input type="text" class="form-control" placeholder="Judul Informasi" id="judul" name="judul" value="<?= isset($informasi['judul']) ? $informasi['judul'] : '' ?>" required>
                                <input type="hidden" id="id" name="id" value="<?= isset($informasi['id']) ? $informasi['id'] : '' ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <select name="kategori" id="kategori" class="form-control">
                                    <?php foreach ($kategori as $k) {
                                        if (isset($informasi['id_kategori'])) {
                                            if ($k == $informasi['id_kategori']) {
                                                echo '<option value="' . $k['id'] . '" selected>' . $k['nama'] . '</option>';
                                            } else {
                                                echo '<option value="' . $k['id'] . '">' . $k['nama'] . '</option>';
                                            }
                                        } else {
                                            echo '<option value="' . $k['id'] . '">' . $k['nama'] . '</option>';
                                        }
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="penulis">Penulis</label>
                                <input type="text" class="form-control" placeholder="Penulis" id="penulis" name="penulis" value="<?= isset($informasi['informasi_judul']) ? $informasi['informasi_judul'] : '' ?>" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" class="form-control" placeholder="Tanggal" id="tanggal" name="tanggal" value="<?= isset($informasi['informasi_judul']) ? $informasi['informasi_judul'] : '' ?>" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="thumbnail">Gambar Thumbnail</label>
                                <input type="file" class="form-control-file" id="thumbnail" name="thumbnail" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi Informasi</label>
                        <textarea id="deskripsi" name="deskripsi"><?= isset($informasi['informasi_deskripsi']) ? $informasi['informasi_deskripsi'] : '' ?></textarea>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Simpan</button>
                    <a href="<?= base_url('informasi/listInformasi') ?>" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>