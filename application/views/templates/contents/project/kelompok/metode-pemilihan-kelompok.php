<!-- general form elements disabled -->
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title">Metode Pemilihan Kelompok Siswa Project <b><?= $detail['judul'] ?></b> Kelas <b><?= $detail['nama_kelas'] ?></b></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form id="form" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label name="jumlah_max_siswa_per_kelompok" for="jumlah_max_siswa_per_kelompok">Jumlah Maksimal Siswa Per Kelompok</label>
                        <input type="number" value="1" min="1" class="form-control" name="jumlah_max_siswa_per_kelompok" id="jumlah_max_siswa_per_kelompok" required>
                        <input type="hidden" name="id_project" id="id_project" value="<?= $detail['id'] ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label name="jumlah_max_kelompok" for="jumlah_max_kelompok">Jumlah Max Kelompok</label>
                        <input type="number" value="1" min="1" class="form-control" name="jumlah_max_kelompok" id="jumlah_max_kelompok" required>
                        <small>Digunakan ketika siswa yang membuat kelompok</small>
                    </div>
                </div>
                <div class="col-md-12">
                    <hr>
                    <label for="">Metode Pemilihan Kelompok </label>
                    <div class="form-group">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="kelompok_dan_anggota_ditentukan_guru" name="kelompok" value="1">
                            <label for="kelompok_dan_anggota_ditentukan_guru" class="custom-control-label">Kelompok Dan Anggota-nya Ditentukan Guru</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="siswa_membuat_kelompok" name="kelompok" value="2">
                            <label for="siswa_membuat_kelompok" class="custom-control-label">Siswa Membuat Kelompok Dan Disetujui Guru</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="kelompok_ditentukan_guru" name="kelompok" value="3" disabled>
                            <label for="kelompok_ditentukan_guru" class="custom-control-label">Kelompok Ditentukan Guru Dan Siswa Memilih Kelompok</label>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer text-right">
        <button class="btn btn-info" type="submit" form="form">Selanjutnya</button>
    </div>
    <!-- /.card-body -->
</div>