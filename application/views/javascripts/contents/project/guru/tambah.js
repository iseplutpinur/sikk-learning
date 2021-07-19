$(function () {
    // Summernote
    $('#deskripsi').summernote({
        toolbar: [
            ['fontsize', ['fontsize']], ['fontname', ['fontname']], ['style', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']], ['height', ['height']], ['color', ['color']], ['float', ['floatLeft', 'floatRight', 'floatNone']], ['remove', ['removeMedia']], ['table', ['table']], ['insert', ['link', 'unlink', 'picture', 'video', 'audio', 'hr']], ['mybutton', ['myVideo']], ['view', ['fullscreen', 'codeview']], ['help', ['help']]],
        height: ($(window).height() - 400),
        callbacks: {
            onImageUpload: function (image) {
                uploadFile(image[0], $(this), 'image');
            },
            onAudioUpload: function (audio) {
                uploadFile(audio[0], $(this), 'audio');
            }
        },
        // 10 MB
        maximumAudioFileSize: 10483870.967741936,
        maximumImageFileSize: 10483870.967741936
    })

    // upload image summernote
    function uploadFile(image, id, tipe) {
        $.LoadingOverlay("show", {
            image: "",
            progress: true,
            text: '0%'
        });
        var data = new FormData();
        data.append(tipe, image);
        data.append("tipe", tipe);
        $.ajax({
            url: "<?= base_url() ?>/project/data/upload",
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            type: "post",
            success: function (data) {
                if (tipe == "image") {
                    var image = $('<img>').attr('src', data.path);
                    image.attr('alt', data.file_name);
                    id.summernote("insertNode", image[0]);
                } else if (tipe == "audio") {
                    var audio = $('<audio>').attr('src', data.path);
                    audio.attr('alt', data.file_name);
                    audio.attr('controls', '');
                    audio.addClass("note-audio-clip");
                    const output = $("<p>").append(audio[0]);
                    id.summernote("insertNode", output[0]);
                }
            },
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        var percentCompleteReal = percentComplete * 100;
                        percentComplete = parseInt(percentComplete * 100);
                        $.LoadingOverlay("progress", percentComplete);
                        $.LoadingOverlay("text", percentCompleteReal.toFixed(2) + "%");
                        if (percentComplete == "100") {
                            $.LoadingOverlay("hide");
                        }
                    }
                }, false);
                return xhr;
            },
            error: function (data) {
                console.log(data);
                setToast({ title: "Gagal", body: data.responseJSON.message, class: "bg-danger" });
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
            url: "<?= base_url() ?>/project/data/insert",
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