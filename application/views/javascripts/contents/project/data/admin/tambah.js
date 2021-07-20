$(function () {
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

    // initial select 2 sekolah
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

    // cari kelas
    $('#sekolah').on('select2:select', function (e) {
        const id = $(this).select2('data')[0].id;
        if (id) {
            $('#kelas').html();
            $.ajax({
                method: 'get',
                url: '<?= base_url() ?>sekolah/cari/getKelas',
                data: {
                    id_sekolah: id
                },
            }).done((data) => {
                $('#kelas').empty();
                data.results.forEach(function (e) {
                    $('#kelas').append($('<option>', { value: e.id, text: e.text }))
                })

                setListGuru($('#kelas').val());
            }).fail(($xhr) => {
                console.log($xhr);
            })
        } else {
            $('#kelas').empty();
        }
    });

    // cari guru
    $('#kelas').change(function () {
        setListGuru(this.value);
    })

    // set list guru
    function setListGuru(id_kelas) {
        $.ajax({
            method: 'get',
            url: '<?= base_url() ?>sekolah/cari/getListGuruByIdKelas',
            data: {
                id_kelas: id_kelas
            },
        }).done((data) => {
            $('#guru').empty();
            data.results.forEach(function (e) {
                $('#guru').append($('<option>', { value: e.id, text: e.text }))
            })
        }).fail(($xhr) => {
            console.log($xhr);
        }).always(() => {
            setSummernot();
        })
    }

    // set summernote
    function setSummernot() {
        const val = Boolean($('#sekolah').select2('data')) && Boolean($("#kelas").val()) && Boolean($("#guru").val());
        $("#pendahuluan").summernote(val ? 'enable' : 'disable');
        $("#deskripsi").summernote(val ? 'enable' : 'disable');
        $("#tujuan").summernote(val ? 'enable' : 'disable');
        $("#link_sumber").summernote(val ? 'enable' : 'disable');
        if (val) {
            $("button[type=submit]").removeAttr("disabled")
        } else {
            $("button[type=submit]").attr("disabled", "")
        }
        return val;
    }
    setSummernot();

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
        data.append("id_project", $("#id_project").val());
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
                if (data.responseJSON) {
                    setToast({ title: "Gagal", body: data.responseJSON.message, class: "bg-danger" });
                } else {
                    setToast({ title: "Gagal", body: data.responseText, class: "bg-danger" });
                }
            },
            complete: function () {
                $.LoadingOverlay("hide");
            }
        });
    }

    // simpan konten
    $("#form").submit(function (ev) {
        ev.preventDefault();
        if (!setSummernot()) {
            Toast.fire({
                icon: 'error',
                title: 'Data belum lengkap'
            })
            return;
        }
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
            url: "<?= base_url() ?>/project/data/insert",
            data: {
                jumlah_aktifitas: $("#jumlah_aktifitas").val(),
                id_project: $("#id_project").val(),
                id_sekolah: $("#sekolah").val(),
                id_kelas: $("#kelas").val(),
                nip_guru: $("#guru").val(),
                pendahuluan: $("#pendahuluan").summernote('code'),
                deskripsi: $("#deskripsi").summernote('code'),
                tujuan: $("#tujuan").summernote('code'),
                link_sumber: $("#link_sumber").summernote('code'),
                jumlah_aktifitas: $("#jumlah_aktifitas").val(),
                judul: $("#judul").val(),
                image: konten_image,
                audio: konten_audio
            },
            type: "post",
            success: function (data) {
                Toast.fire({
                    icon: 'success',
                    title: 'Berhasil Disimpan.'
                })
                setTimeout(() => {
                    window.location.reload();
                }, 3000);
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