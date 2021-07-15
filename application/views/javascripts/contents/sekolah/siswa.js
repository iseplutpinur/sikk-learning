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
        $("#myModalLabel").text("Tambah Siswa");
        $('#id').val('');
        $('#nisn').val('');
        $('#nama').val('');
        $('#password').val('123456');
        $('#tanggal_lahir').val('');
        $('#alamat').val('');
        $('#no_telepon').val('');
        setKelas($('#sekolah').select2('data')[0].id);
    });

    // tambah dan ubah
    $("#form").submit(function (ev) {
        ev.preventDefault();
        // validasi password
        if ($("#id").val() == "") {

            if ($("#password").val().length < 6) {
                Toast.fire({
                    icon: 'error',
                    title: 'Password kurang dari 6 karakter'
                })
                $("#password").focus();
                return;
            }
        }

        if ($('#sekolah').select2('data')[0].id == '') {
            Toast.fire({
                icon: 'error',
                title: 'Sekolah harus di pilih'
            })
            return;
        }

        if ($('#kelas').select2('data')[0].id == '') {
            Toast.fire({
                icon: 'error',
                title: 'Kelas harus di pilih'
            })
            return;
        }

        // return;
        $.LoadingOverlay("show");
        $.ajax({
            method: 'post',
            url: '<?= base_url() ?>sekolah/siswa/' + ($("#id").val() == "" ? 'insert' : 'update'),
            data: {
                id: $('#id').val(),
                nisn: $('#nisn').val(),
                nama: $('#nama').val(),
                status: $('#status').val(),
                tanggal_lahir: $('#tanggal_lahir').val(),
                jenis_kelamin: $('#jenis_kelamin').val(),
                alamat: $('#alamat').val(),
                password: $('#password').val(),
                no_telpon: $('#no_telpon').val(),
                id_kelas: $('#kelas').select2('data')[0].id
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
            url: '<?= base_url() ?>sekolah/siswa/delete',
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

    // cek nisn
    $("#nisn").change(function () {
        $.ajax({
            method: 'get',
            url: '<?= base_url() ?>sekolah/siswa/cekNisn',
            data: {
                nisn: this.value
            },
        }).done((data) => {
            if (data.data > 0) {
                Toast.fire({
                    icon: 'error',
                    title: 'NISN Sudah Terdaftar'
                })
                this.value = '';
                this.focus();
            }
        }).fail(($xhr) => {
            console.log($xhr);
        })
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
        url: '<?= base_url() ?>sekolah/siswa/getSiswa',
        data: {
            id_siswa: id
        }
    }).done((data) => {
        if (data.data) {
            data = data.data;
            $("#myModalLabel").text("Ubah Siswa");
            $('#id').val(data.id);
            $('#nisn').val(data.nisn);
            $('#nama').val(data.nama);
            $('#status').val(data.status);
            $('#tanggal_lahir').val(data.tanggal_lahir);
            $('#jenis_kelamin').val(data.jenis_kelamin);
            $('#alamat').val(data.alamat);
            $('#no_telpon').val(data.user_phone);
            $('#password').val('');
            setKelas(data.id_sekolah, data.id_kelas);
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

// get kelas by id_sekolah
function setKelas(id_sekolah, id_kelas = false) {
    $('#sekolah').val(id_sekolah).trigger('change');
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
            $('#kelas').val(id_kelas).trigger('change');
        }
    }).fail(($xhr) => {
        console.log($xhr);
    })
}