
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">
                    Lain-lain
                </h3>
            </div>
            <form id="form-lain-lain">
                <div class="card-body">
                    <div class="form-group">
                        <label for="slider-judul">Judul Slider</label>
                        <input type="text" class="form-control" placeholder="Slider Judul" id="slider-judul" name="slider-judul" value="<?= isset($about['slider_judul']) ? $about['slider_judul'] : '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="slider-deskripsi">Deskripsi Slider</label>
                        <textarea class="form-control" rows="3" placeholder="Slider Deskripsi" id="slider-deskripsi" name="slider-deskripsi"><?= isset($about['slider_deskripsi']) ? $about['slider_deskripsi'] : '' ?></textarea>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <label for="judul-1">Judul 1</label>
                        <input type="text" class="form-control" placeholder="Judul 1" id="judul-1" name="judul-1" value="<?= isset($about['judul_1']) ? $about['judul_1'] : '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi-1">Deskripsi 1</label>
                        <textarea id="deskripsi-1" name="deskripsi-1" class="summernote"><?= isset($about['deskripsi_1']) ? $about['deskripsi_1'] : '' ?></textarea>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <label for="judul-2">Judul 2</label>
                        <input type="text" class="form-control" placeholder="Judul 2" id="judul-2" name="judul-2" value="<?= isset($about['judul_2']) ? $about['judul_2'] : '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi-2">Deskripsi 2</label>
                        <textarea id="deskripsi-2" name="deskripsi-2" class="summernote"><?= isset($about['deskripsi_2']) ? $about['deskripsi_2'] : '' ?></textarea>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <label for="judul-3">Judul 3</label>
                        <input type="text" class="form-control" placeholder="Judul 3" id="judul-3" name="judul-3" value="<?= isset($about['judul_3']) ? $about['judul_3'] : '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi-3">Deskripsi 3</label>
                        <textarea id="deskripsi-3" name="deskripsi-3" class="summernote"><?= isset($about['deskripsi_3']) ? $about['deskripsi_3'] : '' ?></textarea>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <label for="judul-4">Judul 4</label>
                        <input type="text" class="form-control" placeholder="Judul 4" id="judul-4" name="judul-4" value="<?= isset($about['judul_4']) ? $about['judul_4'] : '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi-4">Deskripsi 4</label>
                        <textarea id="deskripsi-4" name="deskripsi-4" class="summernote"><?= isset($about['deskripsi_4']) ? $about['deskripsi_4'] : '' ?></textarea>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-info" form="form-lain-lain">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>