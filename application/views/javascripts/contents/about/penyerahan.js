const penyerahan_image = new Set();
$(function () {
    // Summernote
    $('.summernote').summernote({
        toolbar: [
            ['fontsize', ['fontsize']], ['fontname', ['fontname']], ['style', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']], ['height', ['height']], ['color', ['color']], ['float', ['floatLeft', 'floatRight', 'floatNone']], ['remove', ['removeMedia']], ['table', ['table']], ['insert', ['link', 'unlink', 'picture', 'hr']], ['mybutton', ['myVideo']], ['view', ['fullscreen', 'codeview']], ['help', ['help']]],
        height: ($(window).height() - 400),
        callbacks: {
            onImageUpload: function (image) {
                uploadImage(image[0], $(this));
            }, onMediaDelete: function (target) {
                deleteFile(target[0].alt, $(this));
            }
        },
        buttons: {
            myVideo: function (context) {
                var ui = $.summernote.ui;
                var button = ui.button({
                    contents: '<i class="note-icon-video">',
                    tooltip: 'Youtube Video',
                    click: function () {
                        var div = document.createElement('div');
                        div.classList.add('embed-container');

                        var iframe = document.createElement('iframe');
                        const yturl = prompt('Enter video youtube url:');
                        if (yturl == "") {
                            return;
                        }

                        iframe.src = 'https://www.youtube.com/embed/' + getId(yturl);

                        iframe.setAttribute('frameborder', 0);
                        iframe.setAttribute('width', '788.54');
                        iframe.setAttribute('height', '443');
                        iframe.setAttribute('allowfullscreen', true);
                        div.appendChild(iframe);
                        context.invoke('editor.insertNode', div);
                    }
                });
                return button.render();
            }
        }
    })

    function getId(url) {
        const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
        const match = url.match(regExp);

        return (match && match[2].length === 11) ? match[2] : null;
    }

    function uploadImage(image, id) {
        $.LoadingOverlay("show");
        var data = new FormData();
        data.append("image", image);
        $.ajax({
            url: "<?= base_url()?>about/penyerahan/uploadImage",
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
                    const path = data.url.path_upload;
                    if (id.prop("id") == "penyerahan-deskripsi") {
                        profile_image.add(path);
                    } else {
                        penyerahan_image.add(path);
                    }
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

    function deleteFile(name, id) {
        $.LoadingOverlay("show");
        $.ajax({
            url: "<?= base_url()?>about/penyerahan/deleteImage",
            data: {
                name: name
            },
            type: "post",
            success: function (data) {
                const path = data.url.path_upload;
                if (id.prop("id") == "profile-deskripsi") {
                    profile_image.delete(path);
                } else {
                    penyerahan_image.delete(path);
                }
            },
            error: function (data) {
                alert(data.message);
            },
            complete: function () {
                $.LoadingOverlay("hide");
            }
        });
    }


    // simpan penyerahan
    $("#form-penyerahan").submit(function (ev) {
        ev.preventDefault();
        $.LoadingOverlay("show");
        $.ajax({
            url: "<?= base_url()?>about/penyerahan/insert",
            data: {
                slider_judul:       $("#slider-judul").val(),
                slider_deskripsi:   $("#slider-deskripsi").val(),
                judul_1:            $("#judul-1").val(),
                deskripsi_1:        $("#deskripsi-1").summernote('code'),
                judul_2:            $("#judul-2").val(),
                deskripsi_2:        $("#deskripsi-2").summernote('code'),
                judul_3:            $("#judul-3").val(),
                deskripsi_3:        $("#deskripsi-3").summernote('code'),
                judul_4:            $("#judul-4").val(),
                deskripsi_4:        $("#deskripsi-4").summernote('code'),
                judul_5:            $("#judul-5").val(),
                deskripsi_5:        $("#deskripsi-5").summernote('code'),
                judul_6:            $("#judul-6").val(),
                deskripsi_6:        $("#deskripsi-6").summernote('code'),
                gambar: Array.from(penyerahan_image)
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