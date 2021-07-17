<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-secondary">
            <div class="card-header">
                <h3 class="card-title">
                    Tambah Project
                </h3>
            </div>
            <form id="form-konten">
                <div class="card-body">
                    <div class="form-group">
                        <label for="slider-judul">Judul</label>
                        <input type="text" class="form-control" placeholder="Slider Judul" id="slider-judul" name="slider-judul" value="<?= isset($about['slider_judul']) ? $about['slider_judul'] : '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="slider-deskripsi">Deskripsi</label>
                        <textarea class="form-control" rows="3" placeholder="Slider Deskripsi" id="slider-deskripsi" name="slider-deskripsi"><?= isset($about['slider_deskripsi']) ? $about['slider_deskripsi'] : '' ?></textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-secondary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>