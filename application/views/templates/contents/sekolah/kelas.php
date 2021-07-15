<div class="card card-info card-outline" id="filter">
    <div class="card-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-end align-items-center w-100">
                <h3 class="card-title">Filter Kelas: </h3>
                <div class="row d-flex justify-content-end ml-1">
                    <div class="col-sm-4 mb-1">
                        <div class="form-group m-0">
                            <select class="form-control" id="filter-sekolah" name="filter-sekolah" style="width: 100%;">
                                <option value="" selected>Semua Kelas</option>
                                <?php foreach ($sekolah as $s) {
                                    echo '<option value="' . $s['id'] . '">' . $s['nama'] . '</option>';
                                } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-2 mb-1">
                        <div class="form-group m-0">
                            <select class="form-control" id="filter-aktif" name="filter-aktif">
                                <option value="">Status</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-3 mb-1">
                        <div class="form-group m-0">
                            <input type="text" class="form-control" id="filter-key" name="filter-key" placeholder="Kata Kunci" required />
                        </div>
                    </div>
                    <div class="col-sm-3 mb-1">
                        <div>
                            <button type="button" class="btn btn-info btn  no-wrap" id="btn-filter" style="width: 100%;"><i class="fas fa-search"></i></i> Cari</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between w-100">
            <h3 class="card-title">List Kelas</h3>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" id="btn-tambah"><i class="fa fa-plus"></i> Tambah</button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="dt_basic" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Sekolah</th>
                    <th>Nama Kelas</th>
                    <th>Jumlah Murid</th>
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
                                <label for="sekolah">Sekolah</label>
                                <select class="form-control" id="sekolah" name="sekolah" style="width: 100%;">
                                    <?php foreach ($sekolah as $s) {
                                        echo '<option value="' . $s['id'] . '">' . $s['nama'] . '</option>';
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Kelas" required />
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