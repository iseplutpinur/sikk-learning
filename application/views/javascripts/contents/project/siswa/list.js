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
                "url": "<?= base_url()?>project/siswa/ajax_data/",
                "data": data,
                "type": 'POST'
            },
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "columns": [
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
                        return `<div class="pull-right">
                                    <button style="display:none" class="btn btn-info btn-xs" data-id="${data}" onclick="Info(this)">
                                        <i class="fa fa-info"></i> Info
                                    </button>
                                    <a href="<?= base_url() ?>project/siswa/lihat/${data}" class="btn btn-info btn-xs"><i class="fa fa-info"></i> Lihat</a>
								</div>`
                    }, className: "nowrap"
                }
            ],
        });
    }
    dynamic();

})

function Info(data) {
    setBtnLoading(data, 'Lihat');
    $.ajax({
        method: 'get',
        url: '<?= base_url() ?>project/siswa/getProject',
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