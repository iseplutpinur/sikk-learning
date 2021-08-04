<div class="container-fluid">
    <div class="card card-outline card-info">
        <div class="card-header">
            <div class="d-flex justify-content-between w-100">
                <h3 class="card-title" id="table-title"><?= $detail['judul'] ?> <b>(<span id="jml_aktifitas"><?= $detail['jumlah_aktifitas'] ?></span> Aktifitas)</b></h3>
                <button class="btn btn-primary btn-sm" id="btn-tambah-aktifitas"><i class="fa fa-plus"></i> Tambah Aktifitas</button>
                <input type="hidden" id="id_project" value="<?= $detail['id'] ?>">
                <input type="hidden" id="id_sekolah" value="<?= $detail['id_sekolah'] ?>">
            </div>
        </div>
    </div>

    <div id="list-aktifitas">
        <?php foreach ($list_aktifitas as $aktifitas) : ?>
            <div class="card card-info aktifitas" id="<?= $aktifitas['id'] ?>">
                <div class="card-header">
                    <h3 class="card-title title-aktifitas"><?= (isset($aktifitas['judul']) ? $aktifitas['judul'] : '') ? (isset($aktifitas['judul']) ? $aktifitas['judul'] : '') : 'Aktifitas' ?></h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize">
                            <i class="fas fa-expand"></i>
                        </button>
                        <button type="button" class="btn btn-tool remove" title="Hapus Aktifitas">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input class="form-control" type="text" placeholder="Judul Aktifitas" name="judul" value="<?= isset($aktifitas['judul']) ? $aktifitas['judul'] : '' ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="template">Template</label>
                                    <select class="form-control" name="template" style="min-width: 100px;" required>
                                        <?php foreach ($templates as $template) :
                                            $selected = ($aktifitas['id_template'] == $template['id']) ? 'selected' : '';
                                        ?>
                                            <option value="<?= $template['id'] ?>" <?= $selected ?>><?= $template['judul'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="naskah">Naskah</label>
                        <textarea class="form-control summernote" rows="3" placeholder="Naskah" name="naskah"><?= isset($aktifitas['naskah']) ? $aktifitas['naskah'] : '' ?></textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="detail">Detail</label>
                        <textarea class="form-control summernote" rows="3" placeholder="Detail" name="detail"><?= isset($aktifitas['detail']) ? $aktifitas['detail'] : '' ?></textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="lembar_kerja">Lembar Kerja</label>
                        <textarea class="form-control summernote" rows="3" placeholder="Lembar Kerja" name="lembar_kerja"><?= isset($aktifitas['lembar_kerja']) ? $aktifitas['lembar_kerja'] : '' ?></textarea>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jenis_upload">Jenis Upload</label>
                                <input type="text" class="form-control" placeholder="Jenis Upload" name="jenis_upload" value="<?= isset($aktifitas['jenis_upload']) ? $aktifitas['jenis_upload'] : '' ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nilai">Nilai</label>
                                <input type="number" class="form-control" placeholder="Nilai" name="nilai" value="<?= isset($aktifitas['nilai']) ? $aktifitas['nilai'] : '' ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>

    <!-- button -->
    <div class="card card-outline card-info">
        <div class="card-body">
            <div class="d-flex justify-content-between w-100">
                <button type="button" id="button-simpan" class="btn btn-info">Simpan</button>
                <a href="<?= base_url() ?>project/data" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>