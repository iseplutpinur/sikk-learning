
$(function () {


    // simpan slider
    $("#form-konten").submit(function (ev) {
        ev.preventDefault();
        $.LoadingOverlay("show");
        $.ajax({
            url: "<?= base_url()?>artikel/konten/insert",
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