<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between w-100">
            <h3 class="card-title">List Data Level Pengguna</h3>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" id="btn-tambah"><i class="fa fa-plus"></i> Tambah</button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="dt_basic" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>NPSN</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No Telepon</th>
                    <th>Status</th>
                    <th>Aksi</th>
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
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="npsn">NPSN</label>
                                <input type="text" class="form-control" id="npsn" name="npsn" placeholder="Pokok Sekolah Nasional" required />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nama">Nama Sekolah</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Sekolah" required />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="alamat">Alamat Sekolah</label>
                                <textarea name="alamat" id="alamat" rows="3" class="form-control" placeholder="Alamat Sekolah"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="no_telepon">Nomor Telepon</label>
                                <input type="text" class="form-control" id="no_telepon" name="no_telepon" placeholder="Nomor Telepon" required />
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
                                </select>
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
                <h4 class="modal-title" id="modalInfoLabel">Detail Sekolah</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <h5 class="card-title">Nomor Pokok Sekolah Nasional:</h5>
                    <p class="card-text" id="detail-npsn"></p>

                    <h5 class="card-title">Nama:</h5>
                    <p class="card-text" id="detail-nama"></p>

                    <h5 class="card-title">Alamat:</h5>
                    <p class="card-text" id="detail-alamat"></p>

                    <h5 class="card-title">No Telpon:</h5>
                    <p class="card-text" id="detail-no_telpon"></p>

                    <h5 class="card-title">Status:</h5>
                    <p class="card-text" id="detail-status"></p>

                    <h5 class="card-title">Jumlah Kelas:</h5>
                    <p class="card-text" id="detail-jumlah_kelas"></p>

                    <h5 class="card-title">Jumlah Guru:</h5>
                    <p class="card-text" id="detail-jumlah_guru"></p>

                    <h5 class="card-title">Jumlah Siswa:</h5>
                    <p class="card-text" id="detail-jumlah_siswa"></p>

                    <h5 class="card-title">Jumlah Project:</h5>
                    <p class="card-text" id="detail-jumlah_project"></p>

                    <h5 class="card-title">Tanggal Ditambahkan:</h5>
                    <p class="card-text" id="detail-created_at"></p>

                    <h5 class="card-title">Tanggal Diubah:</h5>
                    <p class="card-text" id="detail-updated_at"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->