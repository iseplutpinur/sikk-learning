$(function () {
    // data table
    function dynamic(id_sekolah, id_kelas, nip_guru, status, kata_kunci) {
        let data = null;
        if (id_sekolah || id_kelas || nip_guru || status || kata_kunci) {
            data = {
                filter: {
                    id_sekolah: id_sekolah,
                    id_kelas: id_kelas,
                    nip_guru: nip_guru,
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
                { "data": "nama_sekolah" },
                { "data": "nama_kelas" },
                { "data": "nama_guru" },
                { "data": "judul" },
                { "data": "jumlah_aktifitas" },
                {
                    "data": "status", render(data, type, full, meta) {
                        return data == '1' ? "Aktif" : 'Tidak Aktif'
                    }
                },
                { "data": "created_at" },
                { "data": "updated_at" },
                {
                    "data": "id", render(data, type, full, meta) {
                        return `<div style="min-width:150px">
                                    <button class="btn btn-info btn-xs" data-id="${data}" onclick="Info(this)">
                                        <i class="fa fa-info"></i> Lihat
                                    </button>
                                    <a href="<?php base_url() ?>data/perbaiki/${data}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Perbaiki</a>
                                    <a href="<?php base_url() ?>aktifitas/detail/${data}" class="btn btn-secondary btn-xs"><i class="fa fa-list"></i> Aktifitas</a>
                                    <a href="<?php base_url() ?>kelompok/detail/${data}" class="btn btn-warning btn-xs"><i class="fa fa-users"></i> Kelompok</a>
									<button class="btn btn-danger btn-xs" onclick="Hapus('${data}')">
										<i class="fa fa-trash"></i> Hapus
									</button>
								</div>`
                    }
                }
            ],
        });
    }
    dynamic();

    // initial filter
    $('#filter-sekolah').select2({
        ajax: {
            url: '<?= base_url() ?>sekolah/cari',
            dataType: 'json',
            method: 'post',
            data: function (params) {
                return {
                    q: params.term,
                    all: true
                };
            },
        },
        minimumInputLength: 1,
        dropdownParent: $("#filter")
    })

    // cari kelas
    $('#filter-sekolah').on('select2:select', function (e) {
        const id = $(this).select2('data')[0].id;
        if (id) {
            $('#filter-kelas').html();
            $.ajax({
                method: 'get',
                url: '<?= base_url() ?>sekolah/cari/getKelas',
                data: {
                    id_sekolah: id
                },
            }).done((data) => {
                $('#filter-kelas').empty();
                $('#filter-kelas').append($('<option>', { value: '', text: 'Semua Kelas' }))
                data.results.forEach(function (e) {
                    $('#filter-kelas').append($('<option>', { value: e.id, text: e.text }))
                })

                setListGuru($('#filter-kelas').val());
            }).fail(($xhr) => {
                console.log($xhr);
            })
        } else {
            $('#filter-kelas').empty();
            $('#filter-kelas').append($('<option>', { value: '', text: 'Semua Kelas' }))
            $('#filter-guru').empty();
            $('#filter-guru').append($('<option>', { value: '', text: 'Semua Guru' }))
        }
    });

    // cari guru
    $('#filter-kelas').change(function () {
        setListGuru(this.value);
    })

    // set list guru
    function setListGuru(id_kelas) {
        $.ajax({
            method: 'get',
            url: '<?= base_url() ?>sekolah/cari/getListGuruByIdKelas',
            data: {
                id_kelas: id_kelas
            },
        }).done((data) => {
            $('#filter-guru').empty();
            $('#filter-guru').append($('<option>', { value: '', text: 'Semua Guru' }))
            data.results.forEach(function (e) {
                $('#filter-guru').append($('<option>', { value: e.id, text: e.text }))
            })
        }).fail(($xhr) => {
            console.log($xhr);
        })
    }

    // hapus
    $('#OkCheck').click(() => {
        let id = $("#idCheck").val()
        $.LoadingOverlay("show");
        $.ajax({
            method: 'post',
            url: '<?= base_url() ?>project/data/delete',
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
        const nama_sekolah = $('#filter-sekolah').select2('data')[0].text;
        const kata_kunci = $("#filter-key").val();
        const id_kelas = $("#filter-kelas").val();
        const nip_guru = $("#filter-guru").val();
        dynamic(id_sekolah, id_kelas, nip_guru, status, kata_kunci);
        $("#table-title").html(`List Data Project ${nama_sekolah != 'Semua Sekolah' ? ' Sekolah <b>' + nama_sekolah + '</b>' : ''}`);
    });
})

// Click Hapus
const Hapus = (id) => {
    $("#idCheck").val(id)
    $("#LabelCheck").text('Form Hapus')
    $("#ContentCheck").text('Apakah anda yakin akan menghapus data ini?')
    $('#ModalCheck').modal('toggle')
}

function Info(data) {
    setBtnLoading(data, 'Lihat');
    $.ajax({
        method: 'get',
        url: '<?= base_url() ?>project/data/getProject',
        data: {
            id: data.dataset.id
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
        setBtnLoading(data, '<i class="fa fa-info"></i> Lihat', false);
    })
}