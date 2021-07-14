const profile_image = new Set();
const sejarah_image = new Set();
$(function () {
    // Summernote
    $('.summernote').summernote({
        toolbar: [
            ['fontsize', ['fontsize']], ['fontname', ['fontname']], ['style', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']], ['height', ['height']], ['color', ['color']], ['float', ['floatLeft', 'floatRight', 'floatNone']], ['remove', ['removeMedia']], ['table', ['table']], ['insert', ['link', 'unlink', 'picture', 'video', 'hr']], ['view', ['fullscreen', 'codeview']], ['help', ['help']]],
        height: ($(window).height() - 400),
        callbacks: {
            onImageUpload: function (image) {
                uploadImage(image[0], $(this));
            }
        }
    })

    function uploadImage(image, id) {
        $.LoadingOverlay("show");
        var data = new FormData();
        data.append("image", image);
        data.append("folder", id.prop("id"));
        $.ajax({
            url: "<?= base_url()?>about/ideto/uploadImage",
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

    // simpan slider
    $("#form-slider").submit(function (ev) {
        ev.preventDefault();
        $.LoadingOverlay("show");
        $.ajax({
            url: "<?= base_url()?>about/ideto/insertSlider",
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


    // simpan Profile
    $("#form-profile").submit(function (ev) {
        ev.preventDefault();
        let konten_image = [];
        let textarea_id = 'profile-deskripsi';
        $(`#${textarea_id}`).next().find("img").each(function () {
            konten_image.push(this.alt)
        })
        $.LoadingOverlay("show");
        $.ajax({
            url: "<?= base_url()?>about/ideto/insertProfile",
            data: {
                judul: $("#profile-judul").val(),
                deskripsi: $(`#${textarea_id}`).summernote('code'),
                gambar: konten_image,
                folder: textarea_id
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

    // simpan Sejarah
    $("#form-sejarah").submit(function (ev) {
        ev.preventDefault();
        let konten_image = [];
        let textarea_id = 'sejarah-deskripsi';
        $(`#${textarea_id}`).next().find("img").each(function () {
            konten_image.push(this.alt)
        })
        $.LoadingOverlay("show");
        $.ajax({
            url: "<?= base_url()?>about/ideto/insertSejarah",
            data: {
                judul: $("#sejarah-judul").val(),
                deskripsi: $(`#${textarea_id}`).summernote('code'),
                gambar: konten_image,
                folder: textarea_id
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