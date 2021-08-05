<div class="card card-info card-outline">
    <div class="card-header">
        <div class="d-flex justify-content-between w-100">
            <h3 class="card-title">Memory Game</h3>
            <button type="button" class="btn btn-info btn-sm" id="btn-reload"><i class="fa fa-redo"></i> Reload</button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0 m-0">
        <iframe src="<?= base_url('game/memoryGameDisplay') ?>" style="width: 100%; height:90vh; border:0;" id="Iframe">
        </iframe>
    </div>
    <!-- /.card-body -->
</div>