$(document).ready(function () {
    $("#form").submit(function (ev) {
        ev.preventDefault();
        let data = new FormData(this);

        if (!data.get('kelompok')) {
            Toast.fire({
                icon: 'error',
                title: 'Metode Pemilihan Kelompok Belum Dipilih..'
            })
            return;
        }
        setBtnLoading($("button[type=submit]"), 'Selanjutnya');
        $.ajax({
            url: "<?= base_url() ?>project/kelompok/simpan_metode",
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            type: "post",
            success: function (data) {
                Toast.fire({
                    icon: 'success',
                    title: 'Berhasil Disimpan'
                })
                window.location.href = '<?= base_url() ?>project/data';
            },
            error: function (data) {
                console.log(data);
            },
            complete: function () {
                setBtnLoading($("button[type=submit]"), 'Selanjutnya', false);
            }
        });
    })
})