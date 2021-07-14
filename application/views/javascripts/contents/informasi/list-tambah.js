$(function () {
    const currentDate = new Date()
    $('#tanggal').val(currentDate.toISOString().split('T')[0]);

    // Summernote
    $('#deskripsi').summernote({
        toolbar: [
            ['fontsize', ['fontsize']], ['fontname', ['fontname']], ['style', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']], ['height', ['height']], ['color', ['color']], ['float', ['floatLeft', 'floatRight', 'floatNone']], ['remove', ['removeMedia']], ['table', ['table']], ['insert', ['link', 'unlink', 'picture', 'video', 'hr']], ['mybutton', ['myVideo']], ['view', ['fullscreen', 'codeview']], ['help', ['help']]],
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
        data.append("folder", $("#id").val());
        $.ajax({
            url: "<?= base_url()?>informasi/listInformasi/uploadImage",
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
    // simpan informasi
    $("#form-informasi").submit(function (ev) {
        ev.preventDefault();
        // simpan thumbnailthumbnail
        var formData = new FormData(this);
        formData.append("folder", $("#id").val());
        $.LoadingOverlay("show");
        $.ajax({
            type: 'POST',
            url: '<?= base_url() ?>informasi/listInformasi/insertUpload',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (gambar) {
                insertInformasi(gambar.name);
            },
            error: function () {
                Toast.fire({
                    icon: 'error',
                    title: 'Gagal Disimpan..'
                })
            },
            complete: function () {
                $.LoadingOverlay("hide");
            }
        });

    })

    function insertInformasi(name) {
        let konten_image = [];
        $("#deskripsi").next().find("img").each(function () {
            konten_image.push(this.alt)
        })

        $.LoadingOverlay("show");
        $.ajax({
            url: "<?= base_url()?>infromasi/listInformasi/insert",
            data: {
                id: $("#id").val(),
                judul: $("#judul").val(),
                kategori: $("#kategori").val(),
                penulis: $("#penulis").val(),
                tanggal: $("#tanggal").val(),
                deskripsi: $("#deskripsi").summernote('code'),
                gambar: konten_image,
                folder: $("#id").val(),
                thumbnail: name
            },
            type: "post",
            success: function (data) {
                Toast.fire({
                    icon: 'success',
                    title: 'Berhasil Disimpan.'
                })
            },
            error: function (data) {
                Toast.fire({
                    icon: 'error',
                    title: 'Gagal Disimpan..'
                })
            },
            complete: function () {
                $.LoadingOverlay("hide");
            }
        });
    }
})