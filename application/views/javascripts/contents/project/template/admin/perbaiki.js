$(function () {
    function setSummernot(data) {
        $('.summernote').summernote(data.length ? 'enable' : 'disable');
        if (data.length) {
            $("button[type=submit]").removeAttr("disabled")
        } else {
            $("button[type=submit]").attr("disabled", "")
        }
    }

    // Summernote
    $('.summernote').summernote({
        toolbar: [
            ['fontsize', ['fontsize']], ['fontname', ['fontname']], ['style', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']], ['height', ['height']], ['color', ['color']], ['float', ['floatLeft', 'floatRight', 'floatNone']], ['remove', ['removeMedia']], ['table', ['table']], ['insert', ['link', 'unlink', 'picture', 'video', 'audio', 'hr']], ['mybutton', ['myVideo']], ['view', ['fullscreen', 'codeview']], ['help', ['help']]],
        height: 300,
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

    // Fungsi cari
    $('#sekolah').select2({
        ajax: {
            url: '<?= base_url() ?>sekolah/cari',
            dataType: 'json',
            method: 'post',
            data: function (params) {
                return {
                    q: params.term
                };
            },
        },
        dropdownParent: $(".card-body"),
        minimumInputLength: 1,
    })

    setSummernot($('#sekolah').select2('data'));
    // Set visible summernote
    $('#sekolah').on('select2:select', function (e) {
        setSummernot($('#sekolah').select2('data'));
    });

    // upload image summernote
    function uploadFile(image, id, tipe) {
        $(id).parent().LoadingOverlay("show", {
            image: "",
            progress: true,
            text: '0%'
        });
        var data = new FormData();
        data.append(tipe, image);
        data.append("tipe", tipe);
        data.append("id_template", $("#id_template").val());
        $.ajax({
            url: "<?= base_url() ?>project/template/upload",
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            type: "post",
            success: function (data) {
                if (tipe == "image") {
                    var image = $('<img>').attr('src', data.path);
                    image.attr('alt', data.file_name);
                    image.attr('data-filename', data.file_name);
                    image.addClass("img-fluid");
                    id.summernote("insertNode", image[0]);
                } else if (tipe == "audio") {
                    var audio = $('<audio>').attr('src', data.path);
                    audio.attr('data-filename', data.file_name);
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
                        $(id).parent().LoadingOverlay("progress", percentComplete);
                        $(id).parent().LoadingOverlay("text", percentCompleteReal.toFixed(2) + "%");
                        if (percentComplete == "100") {
                            $(id).parent().LoadingOverlay("hide");
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
                $(id).parent().LoadingOverlay("hide");
            }
        });
    }

    // simpan konten
    $("#form").submit(function (ev) {
        ev.preventDefault();
        let konten_image = [];
        let konten_audio = [];
        $('.summernote').each(function () {
            $(this).next().find("img").each(function () {
                konten_image.push(this.dataset.filename)
            })
            $(this).next().find("audio").each(function () {
                konten_audio.push(this.dataset.filename)
            })
        })

        $.LoadingOverlay("show");
        $.ajax({
            url: "<?= base_url() ?>project/template/insert",
            data: {
                id_template: $("#id_template").val(),
                id_sekolah: $('#sekolah').select2('data')[0].id,
                keterangan: $("#keterangan").summernote('code'),
                judul: $("#judul").val(),
                image: konten_image,
                audio: konten_audio,
                tipe: 'ubah'
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
    })
})