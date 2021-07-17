$(function () {
    // data table
    function dynamic(id_sekolah, id_kelas, status, kata_kunci) {
        let data = null;
        if (id_sekolah || status || kata_kunci || id_kelas) {
            data = {
                filter: {
                    id_sekolah: id_sekolah,
                    id_kelas: id_kelas,
                    status: status,
                    kata_kunci: kata_kunci,
                }
            }
        }
        const table_html = $('#dt_basic');
        const column = [];
        if (level == 'Administrator') column.push({ "data": "nama_sekolah" });
        if (level == 'Administrator' || level == 'Guru Administrator') column.push({ "data": "nama_kelas" });
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
                ...column,
                { "data": "nama" },
                { "data": "jenis_kelamin" },
                { "data": "alamat" },
                {
                    "data": "status", render(data, type, full, meta) {
                        return data == '1' ? "Aktif" : (data == 2 ? 'Menunggu Dikofirmasi' : 'Tidak Aktif');
                    }
                },
                {
                    "data": "id", render(data, type, full, meta) {
                        let btn_konfirmasi = '';
                        if (full.status == '2') {
                            btn_konfirmasi = `
                                <button class="btn btn-secondary btn-xs" onclick="Konfirmasi('${data}')">
                                    <i class="fa fa-check"></i> Konfirmasi
                                </button>
                            `;
                        }

                        if (full.status != '2') {
                            btn_konfirmasi = `
                                <button class="btn btn-info btn-xs" onclick="Info('${data}')">
                                    <i class="fa fa-info"></i> Detail
                                </button>
                            `;
                        }

                        return `<div class="pull-right">
                                    ${btn_konfirmasi}
									<button class="btn btn-primary btn-xs" onclick="Ubah('${data}')">
										<i class="fa fa-edit"></i> Ubah
									</button>
									<button class="btn btn-danger btn-xs" onclick="Hapus('${data}')">
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

    $('#filter-kelas').select2({
        dropdownParent: $("#filter")
    })

    // sekolah tambah diubah
    $('#sekolah').on('select2:select', function (e) {
        setKelas($(this).select2('data')[0].id);
    });

    // sekolah tambah diubah
    $('#filter-sekolah').on('select2:select', function (e) {
        const id = $(this).select2('data')[0].id;
        if (id) {
            setKelas(id, false, { id: 'filter-kelas', parent: 'filter', pre: 'Semua Kelas' });
        } else {
            $('#filter-kelas').empty();
            $('#filter-kelas').select2({
                data: [{ id: '', text: 'Semua Kelas' }],
                dropdownParent: $('#filter')
            })
        }
    });



    // initial filter kelas
    {
        if (level == 'Guru Administrator') {
            const id = $('#filter-sekolah').select2('data')[0].id;
            setKelas(id, false, { id: 'filter-kelas', parent: 'filter', pre: 'Semua Kelas' });
        }
    }

    // initial filter kelas
    {
        if (level == 'Guru') {
            const id = $('#filter-sekolah').select2('data')[0].id;
            setKelas(id, false, { id: 'filter-kelas', parent: 'filter' });
        }
    }

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
        const id_kelas = $('#filter-kelas').select2('data')[0].id;
        const status = $("#filter-aktif").val();
        const kata_kunci = $("#filter-key").val();
        dynamic(id_sekolah, id_kelas, status, kata_kunci);
        setTitle();
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

    $("#form-konfirmasi").submit(function (e) {
        e.preventDefault();
        $.LoadingOverlay("show");
        $.ajax({
            method: 'post',
            url: '<?= base_url() ?>sekolah/siswa/konfirmasiSiswa',
            data: {
                nisn: $("#id-konfirmasi").val()
            }
        }).done((data) => {
            Toast.fire({
                icon: 'success',
                title: 'Berhasil Dikonfirmasi'
            })
            dynamic();
        }).fail(($xhr) => {
            Toast.fire({
                icon: 'error',
                title: 'Gagal mendapatkan data.'
            })
        }).always(() => {
            $.LoadingOverlay("hide");
            $('#modalInfo').modal('toggle');
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
const Ubah = (id) => {
    $.LoadingOverlay("show");
    $.ajax({
        method: 'get',
        url: '<?= base_url() ?>sekolah/siswa/getSiswa',
        data: {
            nisn: id
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
function setKelas(id_sekolah, id_kelas = false, kelas = { id: 'kelas', parent: 'myModal', pre: false },) {
    $('#sekolah').val(id_sekolah).trigger('change');
    $.ajax({
        method: 'get',
        url: '<?= base_url() ?>sekolah/siswa/getKelas',
        data: {
            id_sekolah: id_sekolah
        },
    }).done((data) => {
        $(`#${kelas.id}`).empty();
        if (kelas.pre) {
            data.data = [{ id: '', text: kelas.pre }, ...data.data];
        }
        $(`#${kelas.id}`).select2({
            data: data.data,
            dropdownParent: $(`#${kelas.parent}`)
        })

        if (id_kelas) {
            $('#kelas').val(id_kelas).trigger('change');
        }

        if (level == 'Guru Administrator' || level == 'Guru') {
            setTitle();
        }
    }).fail(($xhr) => {
        console.log($xhr);
    })
}

function Info(id) {
    $.LoadingOverlay("show");
    $.ajax({
        method: 'get',
        url: '<?= base_url() ?>sekolah/siswa/getSiswa',
        data: {
            nisn: id
        }
    }).done((data) => {
        if (data.data) {
            data = data.data;
            $("#btn-konfirmasi").attr("style", 'display:none');
            $('#modalInfo').modal('toggle');
            $('#modalInfoLabel').html('Detail Siswa');
            $("#detail-alamat").html(data.alamat);
            $("#detail-created_at").html(data.created_at);
            $("#detail-jenis_kelamin").html(data.jenis_kelamin);
            $("#detail-nama").html(data.nama);
            $("#detail-nama_kelas").html(data.nama_kelas);
            $("#detail-nama_sekolah").html(data.nama_sekolah);
            $("#detail-nisn").html(data.nisn);
            $("#detail-tanggal_lahir").html(data.tanggal_lahir);
            $("#detail-updated_at").html(data.updated_at == null ? '<i>Belum Pernah diubah</i>' : data.updated_at);
            $("#detail-user_phone").html(data.user_phone);
            $("#detail-status").html(data.status == 2 ? "Menunggu dikonfirmasi" : (data.status == 0 ? "Tidak Aktif" : (data.status == 1 ? "Aktif" : '')));
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
        $.LoadingOverlay("hide");
    })
}

function setTitle() {
    const sekolah = $('#filter-sekolah').select2('data');
    const kelas_title = $('#filter-kelas').select2('data');
    let detail = '';
    if (sekolah) {
        let text = sekolah[0].text;
        detail += text != 'Semua Sekolah' ? ` <b>${sekolah[0].text}</b>` : '';
    }
    if (kelas_title) {
        let text = kelas_title[0].text;
        detail += text != 'Semua Kelas' ? ` Kelas <b>${kelas_title[0].text}</b>` : '';
    }
    $("#table-title").html(`List Siswa ${detail}`);
}

function Konfirmasi(id) {
    $.LoadingOverlay("show");
    $.ajax({
        method: 'get',
        url: '<?= base_url() ?>sekolah/siswa/getSiswa',
        data: {
            nisn: id
        }
    }).done((data) => {
        if (data.data) {
            data = data.data;
            $("#btn-konfirmasi").removeAttr("style");
            $("#id-konfirmasi").val(id);
            $('#modalInfo').modal('toggle');
            $('#modalInfoLabel').html('Konfirmasi Siswa');
            $("#detail-alamat").html(data.alamat);
            $("#detail-created_at").html(data.created_at);
            $("#detail-jenis_kelamin").html(data.jenis_kelamin);
            $("#detail-nama").html(data.nama);
            $("#detail-nama_kelas").html(data.nama_kelas);
            $("#detail-nama_sekolah").html(data.nama_sekolah);
            $("#detail-nisn").html(data.nisn);
            $("#detail-tanggal_lahir").html(data.tanggal_lahir);
            $("#detail-updated_at").html(data.updated_at == null ? '<i>Belum Pernah diubah</i>' : data.updated_at);
            $("#detail-user_phone").html(data.user_phone);
            $("#detail-status").html(data.status == 2 ? "Menunggu dikonfirmasi" : (data.status == 0 ? "Tidak Aktif" : (data.status == 1 ? "Aktif" : '')));
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
        $.LoadingOverlay("hide");
    })
}