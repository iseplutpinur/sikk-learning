let global_dt_siswa = null;
$(document).ready(function () {
    // data table
    function dt_kelompok() {
        const table_html = $('#dt_kelompok');
        table_html.dataTable().fnDestroy()
        table_html.DataTable({
            "ajax": {
                "url": "<?= base_url()?>project/kelompok/ajax_list_kelompok/",
                "data": {
                    id_projcet: $("#id_project").val()
                },
                "type": 'POST'
            },
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "columns": [
                { "data": "nama" },
                { "data": "jumlah_siswa" },
                {
                    "data": "id", render(data, type, full, meta) {
                        return `
                            <button class="btn btn-info btn-xs" data-id="${data}" data-nama="${full.nama}" onclick="Anggota(this)">
                                <i class="fa fa-users"></i> Anggota
                            </button>
                            <button class="btn btn-primary btn-xs" data-id="${data}" data-nama="${full.nama}" onclick="Ubah(this)">
                                <i class="fa fa-edit"></i> Ubah
                            </button>
                            <button class="btn btn-danger btn-xs" onclick="Hapus(${data})">
                                <i class="fa fa-trash"></i> Hapus
                            </button>

                                `
                    }
                }
            ],
        });
    }

    function dt_siswa(id_kelompok = false) {
        if (id_kelompok == false) {
            $("#card-anggota").attr("style", "display:none;");
            return;
        }
        $("#card-anggota").removeAttr("style");

        const table_html = $('#dt_siswa');
        table_html.dataTable().fnDestroy()
        table_html.DataTable({
            "ajax": {
                "url": "<?= base_url()?>project/kelompok/ajax_data_list_siswa_project/",
                "data": {
                    id_projcet: id_kelompok
                },
                "type": 'POST'
            },
            "processing": false,
            "serverSide": false,
            "paging": false,
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "columns": [
                { "data": "nisn" },
                { "data": "nama" },
                { "data": "nama" },
                { "data": "nama_kelompok" },
            ],
        });
    }

    dt_kelompok();
    dt_siswa();

    global_dt_siswa = dt_siswa;

    // insert or update
    $("#form").submit(function (ev) {
        ev.preventDefault();
        setBtnLoading('buttn[type=submit]', 'Submit');
        var data = new FormData(this);
        data.append('id_project', $("#id_project").val());
        $.ajax({
            url: '<?= base_url() ?>project/kelompok/' + ($("#id").val() == '' ? 'insertKelompok' : 'updateKelompok'),
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            type: 'post',
            success: function (data) {
                Toast.fire({
                    icon: 'success',
                    title: 'Berhasil Disimpan'
                })
                dt_siswa();
                dt_kelompok();
            },
            error: function (data) {
                Toast.fire({
                    icon: 'error',
                    title: 'Gagal Disimpan'
                })
                console.log(data);
            },
            complete: function () {
                setBtnLoading('buttn[type=submit]', 'Submit', false);
                $("#myModal").modal("toggle");
            }
        });
    })

    // delete
    $('#OkCheck').click(() => {
        let id = $("#idCheck").val()
        $.LoadingOverlay("show");
        $.ajax({
            method: 'post',
            url: '<?= base_url() ?>project/kelompok/deleteKelompok',
            data: {
                id: id
            }
        }).done((data) => {
            Toast.fire({
                icon: 'success',
                title: 'Berhasil dihapus'
            })
            dt_kelompok(); q
        }).fail(($xhr) => {
            Toast.fire({
                icon: 'error',
                title: 'Gagal dihapus'
            })
        }).always(() => {
            $('#ModalCheck').modal('toggle');
            $.LoadingOverlay("hide");
        })
    })

    $("#btn-tambah").click(function () {
        $("#myModalLabel").html("Tambah Kelompok");
        $("#id").val('');
    });

    // select2 tambah kelompok cari siswa
    $('#siswa-anggota').select2({
        ajax: {
            url: '<?= base_url() ?>project/kelompok/cariAnggotaUntukKelompok',
            dataType: 'json',
            method: 'post',
            data: function (params) {
                return {
                    q: params.term,
                    id_sekolah: $("#id_sekolah").val()
                };
            }
        },
        minimumInputLength: 1,
        dropdownParent: $("#body-tambah-anggota-kelompok")
    })

    $('#siswa-anggota').on('select2:select', function (e) {
        const data = $(this).select2('data')[0];
        const id = data.id;
        const kelas = data.nama_kelas;
        const nama = data.text;

        if (id == nama) {
            $("#keterangan").val('');
            $("#keterangan").focus();
        } else {
            $("#keterangan").val(`Siswa Kelas ${kelas}`);
        }
    });
})

// Click Hapus
const Hapus = (id) => {
    $("#idCheck").val(id)
    $("#LabelCheck").text('Form Hapus')
    $("#ContentCheck").text('Apakah anda yakin akan menghapus kelompok ini?')
    $('#ModalCheck').modal('toggle')
}

const Ubah = (data) => {
    $("#myModalLabel").html("Ubah Kelompok");
    $("#id").val(data.dataset.id)
    $("#nama").val(data.dataset.nama)
    $('#myModal').modal('toggle');
}

const Anggota = (data) => {
    $("#id-card-anggota").val(data.dataset.id);
    $("#title-card-anggota").html("List Anggota " + data.dataset.nama);
    $("#modalTambahAnggotaKelompokLabel").html("Tambah Anggota " + data.dataset.nama);
    global_dt_siswa(data.dataset.id);
}