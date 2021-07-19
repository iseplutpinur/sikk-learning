$(function () {
    // Summernote
    $('#deskripsi').summernote({
        toolbar: [
            ['fontsize', ['fontsize']], ['fontname', ['fontname']], ['style', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']], ['height', ['height']], ['color', ['color']], ['float', ['floatLeft', 'floatRight', 'floatNone']], ['remove', ['removeMedia']], ['table', ['table']], ['insert', ['link', 'unlink', 'picture', 'video', 'audio', 'hr']], ['mybutton', ['myVideo']], ['view', ['fullscreen', 'codeview']], ['help', ['help']]],
        height: ($(window).height() - 400),
        callbacks: {
            onImageUpload: function (image) {
                uploadImage(image[0], $(this));
            },
            onAudioUpload: function (audio) {
                uploadImage(audio[0], $(this));
            }
        }
    })

    // upload image summernote
    function uploadImage(image, id) {
        $.LoadingOverlay("show");
        var data = new FormData();
        data.append("image", image);
        $.ajax({
            url: "<?= base_url()?>project/data/uploadImage",
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            type: "post",
            success: function (data) {
                if (data.url.status == 1) {
                    var image = $('<img>').attr('src', data.url.path);
                    image.attr('alt', data.url.file_name);
                    id.summernote("insertNode", image[0]);
                } else {
                    alert(data.url.message)
                }
            },
            error: function (data) {
                console.log(data);
            },
            complete: function () {
                $.LoadingOverlay("hide");
            }
        });
    }

    // simpan konten
    $("#form-konten").submit(function (ev) {
        ev.preventDefault();
        let konten_image = [];
        $("#informasi-deskripsi").next().find("img").each(function () {
            konten_image.push(this.alt)
        })

        $.LoadingOverlay("show");
        $.ajax({
            url: "<?= base_url()?>home/konten/insert",
            data: {
                slider_judul: $("#slider-judul").val(),
                slider_deskripsi: $("#slider-deskripsi").val(),
                informasi_judul: $("#informasi-judul").val(),
                informasi_deskripsi: $("#informasi-deskripsi").summernote('code'),
                gambar: konten_image
            },
            type: "post",
            success: function (data) {
                Toast.fire({
                    icon: 'success',
                    title: 'Berhasil diubah.'
                })
                if (typeof (data.status) == "string") {
                    $("#last-update").text(data.status);
                }
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