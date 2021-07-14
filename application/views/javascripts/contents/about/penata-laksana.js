
$(function () {

    // simpan slider
    $("#form-slider").submit(function (ev) {
        ev.preventDefault();
        $.LoadingOverlay("show");
        $.ajax({
            url: "<?= base_url()?>about/penataLaksana/insert",
            data: {
                judul: $("#slider-judul").val(),
                deskripsi: $("#slider-deskripsi").val(),
            },
            type: "post",
            success: function (data) {
                Toast.fire({
                    icon: 'success',
                    title: 'Berhasil diubah.'
                })
            },
            error: function (data) {
                Toast.fire({
                    icon: 'error',
                    title: 'Gagal Diubah..'
                })
            },
            complete: function () {
                $.LoadingOverlay("hide");
            }
        });
    })


})