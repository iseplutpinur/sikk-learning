$(function () {
    // data table
    function dynamic(id_sekolah, status, kata_kunci) {
        let data = null;
        if (id_sekolah || status || kata_kunci) {
            data = {
                filter: {
                    id_sekolah: id_sekolah,
                    status: status,
                    kata_kunci: kata_kunci,
                }
            }
        }
        const table_html = $('#dt_basic');
        table_html.dataTable().fnDestroy()
        table_html.DataTable({
            "ajax": {
                "url": "<?= base_url()?>sekolah/siswa/ajax_data/",
                "data": data,
                "type": 'POST'
            },
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "columns": [
                { "data": "nisn" },
                { "data": "nama_sekolah" },
                { "data": "nama_kelas" },
                { "data": "nama" },
                { "data": "jenis_kelamin" },
                { "data": "alamat" },
                {
                    "data": "id", render(data, type, full, meta) {
                        return `<div class="pull-right">
									<button class="btn btn-info btn-xs" onclick="Info(${data})">
										<i class="fa fa-info"></i> Detail
									</button>
									<button class="btn btn-primary btn-xs" onclick="Ubah(${data})">
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

    // get kelas by id_sekolah
    function setKelas(id_sekolah, id_kelas = false) {
        $.ajax({
            method: 'get',
            url: '<?= base_url() ?>sekolah/siswa/getKelas',
            data: {
                id_sekolah: id_sekolah
            },
        }).done((data) => {
            $("#kelas").empty();
            $("#kelas").select2({
                data: data.data,
                dropdownParent: $("#myModal")
            })
            if (id_kelas) {
                $('#sekolah').val(id_kelas).trigger('change');
            }
        }).fail(($xhr) => {
            console.log($xhr);
        })
    }

    // init select 2
    $('#sekolah').select2({
        dropdownParent: $("#myModal")
    })

    $('#filter-sekolah').select2({
        dropdownParent: $("#filter")
    })

    // sekolah tambah diubah
    $('#sekolah').on('select2:select', function (e) {
        setKelas($(this).select2('data')[0].id);
    });

    // btn ubah di klik
    $("#btn-tambah").click(() => {
        $("#myModalLabel").text("Tambah Kelas");
        $('#id').val("");
        $('#nama').val("");
        $('#status').val("1");
        setKelas($('#sekolah').select2('data')[0].id);
    });

    // tambah dan ubah
    $("#form").submit(function (ev) {
        ev.preventDefault();
        $.LoadingOverlay("show");
        $.ajax({
            method: 'post',
            url: '<?= base_url() ?>sekolah/kelas/' + ($("#id").val() == "" ? 'insert' : 'update'),
            data: {
                id: $("#id").val(),
                nama: $("#nama").val(),
                status: $("#status").val(),
                sekolah: $('#sekolah').select2('data')[0].id,
            },
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
            url: '<?= base_url() ?>sekolah/kelas/delete',
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

    // filter
    $("#btn-filter").click(() => {
        const id_sekolah = $('#filter-sekolah').select2('data')[0].id;
        const status = $("#filter-aktif").val();
        const kata_kunci = $("#filter-key").val();
        dynamic(id_sekolah, status, kata_kunci);
    });
})

// Click Hapus
const Hapus = (id) => {
    $("#idCheck").val(id)
    $("#LabelCheck").text('Form Hapus')
    $("#ContentCheck").text('Apakah anda yakin akan menghapus data ini?')
    $('#ModalCheck').modal('toggle')
}


// Click Ubah
const Ubah = (id) => {
    $.LoadingOverlay("show");
    $.ajax({
        method: 'get',
        url: '<?= base_url() ?>sekolah/kelas/getKelas',
        data: {
            id: id
        }
    }).done((data) => {
        if (data.data) {
            data = data.data;
            $("#myModalLabel").text("Ubah Kelas");
            $('#id').val(data.id);
            $('#nama').val(data.nama);
            $('#status').val(data.status);
            $('#sekolah').val(data.id_sekolah).trigger('change');
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
        $.LoadingOverlay("hide");
    })
}