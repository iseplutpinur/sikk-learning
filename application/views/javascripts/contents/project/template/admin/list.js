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
                "url": "<?= base_url()?>project/template/ajax_data/",
                "data": data,
                "type": 'POST'
            },
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "columns": [
                { "data": "nama_sekolah" },
                { "data": "judul" },
                {
                    "data": "status", render(data, type, full, meta) {
                        return data == '1' ? "Aktif" : 'Tidak Aktif'
                    }
                },
                { "data": "created_at" },
                { "data": "updated_at" },
                {
                    "data": "id", render(data, type, full, meta) {
                        return `<div class="pull-right">
                                    <button class="btn btn-info btn-xs" onclick="Info('${data}')">
                                        <i class="fa fa-info"></i> Lihat
                                    </button>
                                    <a href="<?php base_url() ?>template/perbaiki/${data}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Perbaiki</a>
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
            url: '<?= base_url() ?>project/template/delete',
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
        url: '<?= base_url() ?>project/template/getTemplate',
        data: {
            id: id
        }
    }).done((data) => {
        if (data.data) {
            data = data.data;
            $('#modalInfo').modal('toggle');
            $("#detail-judul").html(data.judul);
            $("#detail-sekolah").html(data.nama_sekolah);
            $("#detail-keterangan").html(data.keterangan);
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