let global_dt_siswa = null;
let global_dt_kelompok = null;
let global_kelompok_sekarang = null;
let global_fungsi_hapus = null;
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
                            <button class="btn btn-danger btn-xs delete" data-tipe="kelompok" data-id="${data}">
                                <i class="fa fa-trash"></i> Hapus
                            </button>

                                `
                    }
                }
            ], "drawCallback": function (settings) {
                initDelete();
            }
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
                    id_kelompok: id_kelompok
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
                { "data": "nama_kelas" },
                { "data": "keterangan" },
                {
                    "data": "id", render(data, type, full, meta) {
                        return `
                                <button class="btn btn-danger btn-xs delete" data-tipe="siswa" data-id="${data}">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                                `
                    }
                }
            ], "drawCallback": function (settings) {
                initDelete();
            }
        });

        table_html.on('draw.dt', function () {
            console.log(this);

            //Number the first column
            // page_dt.column(1, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
            //     cell.innerHTML = i + 1;
            // });
        });

    }

    dt_kelompok();
    dt_siswa();

    global_dt_siswa = dt_siswa;
    global_dt_kelompok = dt_kelompok;

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
                $("#nama").val('');
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
    function initDelete() {
        $(".delete").click(function () {
            const dataset = this.dataset;
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Akan menghapus anggota kelompok ini.!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.LoadingOverlay("show");
                    $.ajax({
                        method: 'post',
                        url: '<?= base_url() ?>project/kelompok/' + (dataset.tipe == 'kelompok' ? 'deleteKelompok' : 'deleteAnggota'),
                        data: {
                            id: dataset.id
                        }
                    }).done((data) => {
                        Toast.fire({
                            icon: 'success',
                            title: 'Berhasil dihapus'
                        })
                        dt_kelompok();
                        dt_siswa(global_fungsi_hapus == 'kelompok' ? false : global_kelompok_sekarang);
                    }).fail(($xhr) => {
                        Toast.fire({
                            icon: 'error',
                            title: 'Gagal dihapus'
                        })
                    }).always(() => {
                        $.LoadingOverlay("hide");
                    })
                }
            })
        });
    }

    $("#btn-tambah").click(function () {
        $("#myModalLabel").html("Tambah Kelompok");
        $("#id").val('');
    });

    // =================================================================================================================
    // Keompok
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

    // Simpan anggota kelompok baru
    $("#form-tambah-anggota-kelompok").submit(function (ev) {
        ev.preventDefault();
        const namas = $('#siswa-anggota').select2('data');
        if (namas.length == 0) {
            Toast.fire({
                icon: 'error',
                title: 'Nama Belum Dipilih'
            })
            return;
        }

        let nisn_siswa = null;
        let nama_siswa = null;
        let keterangan = null;
        const nama = namas[0];
        if (nama.id == nama.text) {
            nama_siswa = nama.text;
        } else {
            nisn_siswa = nama.id;
            nama_siswa = nama.text.split('|')[1];
        }
        keterangan = $("#keterangan").val();

        setBtnLoading($('button[type=submit]'), 'Submit');
        $.ajax({
            url: '<?= base_url() ?>project/kelompok/tambahAnggotaKelompok',
            data: {
                id_kelompok: global_kelompok_sekarang,
                nisn: nisn_siswa,
                nama: nama_siswa,
                keterangan: keterangan
            },
            type: 'post',
            success: function (data) {
                Toast.fire({
                    icon: 'success',
                    title: 'Berhasil Disimpan'
                })
                global_dt_siswa(global_kelompok_sekarang);
                $('#siswa-anggota').val(null).trigger('change');
                $("#keterangan").val('');
                global_dt_kelompok();
            },
            error: function (data) {
                Toast.fire({
                    icon: 'error',
                    title: 'Gagal Disimpan'
                })
                console.log(data);
            },
            complete: function () {
                setBtnLoading($('button[type=submit]'), 'Submit', false);
                $("#modalTambahAnggotaKelompok").modal('toggle');
            }
        });
    })
    // =================================================================================================================
})

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
    global_kelompok_sekarang = data.dataset.id;
}

const KunciKelompok = (id_projcet) => {
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Akan mengunci kelompok project ini.!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Batal',
        confirmButtonText: 'Kunci'
    }).then((result) => {
        if (result.isConfirmed) {
            $.LoadingOverlay("show");
            $.ajax({
                method: 'post',
                url: '<?= base_url() ?>project/kelompok/kunciKelompok',
                data: {
                    id: id_projcet
                }
            }).done((data) => {
                Toast.fire({
                    icon: 'success',
                    title: 'Berhasil dikunci'
                })
                window.location.href = '<?= base_url() ?>project/data';
            }).fail(($xhr) => {
                Toast.fire({
                    icon: 'error',
                    title: 'Gagal dikunci'
                })
            }).always(() => {
                $.LoadingOverlay("hide");
            })
        }
    })
}