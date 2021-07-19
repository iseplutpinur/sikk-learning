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
        table_html.dataTable().fnDestroy()
        table_html.DataTable({
            "ajax": {
                "url": "<?= base_url()?>project/data/ajax_data/",
                "data": data,
                "type": 'POST'
            },
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "columns": [
                { "data": "judul" },
                { "data": "jumlah_aktifitas" },
                {
                    "data": "status", render(data, type, full, meta) {
                        return data == '1' ? "Aktif" : 'Tidak Aktif'
                    }
                },
                {
                    "data": "id", render(data, type, full, meta) {
                        return `<div class="pull-right">
                                    <button class="btn btn-info btn-xs" onclick="Info('${data}')">
                                        <i class="fa fa-info"></i> Lihat
                                    </button>
                                    <a href="<?php base_url() ?>data/perbaiki/${data}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Perbaiki</a>
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
        url: '<?= base_url() ?>project/data/getProject',
        data: {
            id: id
        }
    }).done((data) => {
        if (data.data) {
            data = data.data;
            $('#modalInfo').modal('toggle');
            $("#detail-judul").html(data.judul);
            $("#detail-guru").html(data.nama_guru);
            $("#detail-sekolah").html(data.nama_sekolah);
            $("#detail-kelas").html(data.nama_kelas);
            $("#detail-pendahuluan").html(data.pendahuluan);
            $("#detail-deskripsi").html(data.deskripsi);
            $("#detail-link_sumber").html(data.link_sumber);
            $("#detail-tujuan").html(data.tujuan);
            $("#detail-jumlah_aktifitas").html(data.jumlah_aktifitas);
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