$(function () {
    global_npsn = '';
    function dynamic() {
        const table_html = $('#dt_basic');
        table_html.dataTable().fnDestroy()
        table_html.DataTable({
            "ajax": {
                "url": "<?= base_url()?>sekolah/daftarSekolah/ajax_data/",
                "data": null,
                "type": 'POST'
            },
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "columns": [
                { "data": "npsn" },
                { "data": "nama" },
                { "data": "alamat" },
                { "data": "no_telpon" },
                { "data": "status_str" },
                {
                    "data": "id", render(data, type, full, meta) {
                        return `<div class="pull-right">
                                    <button class="btn btn-info btn-xs" data-id="${data}" onclick="Info(this)">
                                        <i class="fa fa-info"></i> Detail
                                    </button>
									<button class="btn btn-primary btn-xs" data-id="${data}" onclick="Ubah(this)">
										<i class="fa fa-edit"></i> Ubah
									</button>
									<button class="btn btn-danger btn-xs" onclick="Hapus(${data})">
										<i class="fa fa-trash"></i> Hapus
									</button>
								</div>`
                    }, className: "nowrap"
                }
            ],
        });
    }
    dynamic();

    $("#btn-tambah").click(() => {
        $("#myModalLabel").text("Tambah Sekolah");
        $('#id').val("");
        $('#npsn').val("");
        $('#nama').val("");
        $('#alamat').val("");
        $('#no_telepon').val("");
        $('#status').val("1");
    });

    $("#npsn").change(function () {
        if ($('#id').val() != '' && global_npsn == this.value) {
            return;
        }
        $.ajax({
            method: 'post',
            url: '<?= base_url() ?>sekolah/daftarSekolah/cekNpsn',
            data: {
                npsn: this.value
            }
        }).done((data) => {
            if (data) {
                Toast.fire({
                    icon: 'error',
                    title: 'NPSN Sudah Terdaftar'
                })
                this.value = '';
                this.focus();
            }
        }).fail(($xhr) => {
            Toast.fire({
                icon: 'error',
                title: 'Gagal mendapatkan data'
            })
            this.value = '';
        });
    });

    // tambah dan ubah
    $("#form").submit(function (ev) {
        ev.preventDefault();
        const form = new FormData(this);
        $.LoadingOverlay("show");
        $.ajax({
            method: 'post',
            url: '<?= base_url() ?>sekolah/daftarSekolah/' + ($("#id").val() == "" ? 'insert' : 'update'),
            data: form,
            cache: false,
            contentType: false,
            processData: false,
        }).done((data) => {
            Toast.fire({
                icon: 'success',
                title: 'Data berhasil disimpan'
            })
            dynamic();
        }).fail(($xhr) => {
            Toast.fire({
                icon: 'error',
                title: 'Data gagal disimpan'
            })
        }).always(() => {
            $.LoadingOverlay("hide");
            $('#myModal').modal('toggle')
        })
    });

    // hapus
    $('#OkCheck').click(() => {
        let id = $("#idCheck").val()
        $.LoadingOverlay("show");
        $.ajax({
            method: 'post',
            url: '<?= base_url() ?>sekolah/daftarSekolah/delete',
            data: {
                id: id
            }
        }).done((data) => {
            Toast.fire({
                icon: 'success',
                title: 'Data berhasil dihapus'
            })
            dynamic();
        }).fail(($xhr) => {
            Toast.fire({
                icon: 'error',
                title: 'Data gagal dihapus'
            })
        }).always(() => {
            $('#ModalCheck').modal('toggle')
            $.LoadingOverlay("hide");
        })
    })
})

// Click Hapus
const Hapus = (id) => {
    $("#idCheck").val(id)
    $("#LabelCheck").text('Form Hapus')
    $("#ContentCheck").text('Apakah anda yakin akan menghapus data ini?')
    $('#ModalCheck').modal('toggle')
}

// Click Ubah
const Ubah = (data) => {
    setBtnLoading(data, 'Ubah');
    $.ajax({
        method: 'get',
        url: '<?= base_url() ?>sekolah/daftarSekolah/getSekolah',
        data: {
            id: data.dataset.id
        }
    }).done((data) => {
        if (data.data) {
            data = data.data;
            global_npsn = data.npsn;
            $("#myModalLabel").text("Ubah Sekolah");
            $('#id').val(data.id);
            $('#nama').val(data.nama);
            $('#npsn').val(data.npsn);
            $('#alamat').val(data.alamat);
            $('#no_telepon').val(data.no_telpon);
            $('#status').val(data.status);
            $('#myModal').modal('toggle')
        } else {
            Toast.fire({
                icon: 'error',
                title: 'Data tidak valid.'
            })
        }
    }).fail(($xhr) => {
        Toast.fire({
            icon: 'error',
            title: 'Gagal mendapatkan data.'
        })
    }).always(() => {
        setBtnLoading(data, '<i class="fa fa-edit"></i> Ubah', false);
    })
}

function Info(data) {
    setBtnLoading(data, 'Lihat');
    $.ajax({
        method: 'get',
        url: '<?= base_url() ?>sekolah/daftarSekolah/getSekolahDetail',
        data: {
            id: data.dataset.id
        }
    }).done((data) => {
        if (data.data) {
            data = data.data;
            $('#modalInfo').modal('toggle');
            $("#detail-npsn").html(data.npsn);
            $("#detail-nama").html(data.nama);
            $("#detail-alamat").html(data.alamat);
            $("#detail-no_telpon").html(data.no_telpon);
            $("#detail-status").html(data.status);
            $("#detail-jumlah_kelas").html(data.jumlah_kelas);
            $("#detail-jumlah_guru").html(data.jumlah_guru);
            $("#detail-jumlah_siswa").html(data.jumlah_siswa);
            $("#detail-jumlah_project").html(data.jumlah_project);
            $("#detail-created_at").html(data.created_at);
            $("#detail-updated_at").html(data.updated_at);
            $("#detail-status").html(data.status == 1 ? "Aktif" : "Tidak Aktif");
        } else {
            Toast.fire({
                icon: 'error',
                title: 'Gagal mendapatkan data.'
            })
        }
    }).fail(($xhr) => {
        Toast.fire({
            icon: 'error',
            title: 'Gagal mendapatkan data.'
        })
    }).always(() => {
        setBtnLoading(data, '<i class="fa fa-info"></i> Lihat', false);
    })
}