<?php
$level = $this->session->userdata('data')['level'];
$label = '';
$setFilterSekolah = '';
$setFilterKelas = '';

if ($level == 'Guru Administrator' || $level == 'Guru') {
    $setFilterSekolah = 'style="display:none"';
}
?>
<div class="card card-info card-outline" id="filter">
    <div class="card-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-end  align-items-star w-100 flex-md-row flex-column">
                <h3 class="card-title align-self-center">Filter Guru: </h3>
                <div class="form-group  mb-lg-0 ml-lg-2" <?= $setFilterSekolah ?>>
                    <select class="form-control" id="filter-sekolah" name="filter-sekolah" style="min-width: 100px;">
                        <?php if ($level == 'Administrator') : ?>
                            <option value="" selected>Semua Sekolah</option>
                        <?php endif ?>
                        <?php foreach ($sekolah as $s) {
                            echo '<option value="' . $s['id'] . '">' . $s['nama'] . '</option>';
                        } ?>
                    </select>
                </div>

                <div class="form-group  mb-lg-0 ml-lg-2">
                    <select class="form-control" id="filter-kelas" name="filter-kelas" style="min-width: 100px;">
                        <option value="" selected>Semua Kelas</option>
                    </select>
                </div>

                <div class="form-group  mb-lg-0 ml-lg-2">
                    <select class="form-control" id="filter-aktif" name="filter-aktif">
                        <option value="">Status</option>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                        <option value="2">Konfirmasi</option>
                    </select>
                </div>

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
            <h3 class="card-title" id="table-title">List Guru</h3>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" id="btn-tambah"><i class="fa fa-plus"></i> Tambah</button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="dt_basic" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>NIP</th>
                    <?php if ($level == 'Administrator') : ?>
                        <th>Sekolah</th>
                    <?php endif ?>
                    <th>Kelas</th>
                    <th>Sebagai</th>
                    <th>Nama guru</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
    <!-- /.card-body -->
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sekolah">Sekolah</label>
                                        <select class="form-control" id="sekolah" name="sekolah" style="width: 100%;">
                                            <?php foreach ($sekolah as $s) {
                                                echo '<option value="' . $s['id'] . '">' . $s['nama'] . '</option>';
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kelas">Kelas</label>
                                        <select class="form-control" id="kelas" name="kelas" style="width: 100%;">

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nip">NIP</label>
                                        <input type="text" class="form-control" id="nip" name="nip" placeholder="NIP guru" required />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama guru" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <textarea name="alamat" id="alamat" rows="3" class="form-control" placeholder="Alamat guru" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="text" class="form-control" id="password" name="password" placeholder="Masukan Password" value="123456" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_telpon">Nomor Telepon</label>
                                        <input type="text" class="form-control" id="no_telpon" name="no_telpon" placeholder="Nomor Telepon" value="" required />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jenis_kelamin">Jenis Kelamin</label>
                                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                            <option value="Laki-Laki">Laki-Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="level">Sebagai</label>
                                        <select class="form-control" id="level" name="level">
                                            <option value="4">Guru</option>
                                            <option value="3">Guru Administrator</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" id="status" name="status">
                                            <option value="1">Aktif</option>
                                            <option value="0">Tidak Aktif</option>
                                            <option value="2">Konfirmasi</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
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

<div class="modal fade" id="modalInfo" tabindex="-1" role="dialog" aria-labelledby="modalInfoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalInfoLabel">Detail guru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <h5 class="card-title">Nama:</h5>
                    <p class="card-text" id="detail-nama"></p>

                    <h5 class="card-title">Jenis kelamin:</h5>
                    <p class="card-text" id="detail-jenis_kelamin"></p>

                    <h5 class="card-title">Tanggal Lahir:</h5>
                    <p class="card-text" id="detail-tanggal_lahir"></p>

                    <h5 class="card-title">Alamat:</h5>
                    <p class="card-text" id="detail-alamat"></p>

                    <h5 class="card-title">Nomor Telepon:</h5>
                    <p class="card-text" id="detail-user_phone"></p>

                    <h5 class="card-title">Nomor Induk guru Nasional:</h5>
                    <p class="card-text" id="detail-nip"></p>

                    <h5 class="card-title">Sekolah:</h5>
                    <p class="card-text" id="detail-nama_sekolah"></p>

                    <h5 class="card-title">Kelas:</h5>
                    <p class="card-text" id="detail-nama_kelas"></p>

                    <h5 class="card-title">Status:</h5>
                    <p class="card-text" id="detail-status"></p>

                    <h5 class="card-title">Sebagai:</h5>
                    <p class="card-text" id="detail-level"></p>

                    <h5 class="card-title">Tanggal Ditambahkan:</h5>
                    <p class="card-text" id="detail-created_at"></p>

                    <h5 class="card-title">Tanggal Diubah:</h5>
                    <p class="card-text" id="detail-updated_at"></p>
                </div>
                <form action="" id="form-konfirmasi">
                    <input type="hidden" id="id-konfirmasi">
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="form-konfirmasi" class="btn btn-primary" id="btn-konfirmasi">
                    Konfirmasi
                </button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    const level = '<?= $level ?>';
</script>