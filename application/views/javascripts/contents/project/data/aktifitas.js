$(function () {
    // set nama
    $("input[name=judul]").change(function () {
        const card = $($(this).parents()[4]);
        card.find(".title-aktifitas").html(this.value == '' ? 'Aktifitas' : this.value);
    })

    // tambah aktifitas
    // get id_terbaru
    $("#btn-tambah-aktifitas").click(() => {
        setBtnLoading('#btn-tambah-aktifitas', 'Tambah Aktifitas')
        $.ajax({
            url: "<?= base_url() ?>project/aktifitas/tambahAktifitas",
            data: {
                id_sekolah: $("#id_sekolah").val(),
                id_project: $("#id_project").val()
            },
            type: "post",
            success: function (data) {
                let templates = '';
                data.list_template.forEach(template => {
                    templates += `<option value="${template.id}" >${template.judul}</option>`;
                })
                // render
                $("#list-aktifitas").append(`
                    <div class="card card-info aktifitas" id="${data.id_project.id}">
                        <div class="card-header">
                            <h3 class="card-title title-aktifitas">Aktifitas</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                    <i class="fas fa-expand"></i>
                                </button>
                                <button type="button" class="btn btn-tool remove" title="Hapus Aktifitas">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="judul">Judul</label>
                                        <input class="form-control" type="text" placeholder="Judul Aktifitas" name="judul" value="" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="template">Template</label>
                                            <select class="form-control" name="template" style="min-width: 100px;" required>
                                                ${templates}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="naskah">Naskah</label>
                                <textarea class="form-control summernote" rows="3" placeholder="Naskah" name="naskah"></textarea>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="detail">Detail</label>
                                <textarea class="form-control summernote" rows="3" placeholder="Detail" name="detail"></textarea>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="lembar_kerja">Lembar Kerja</label>
                                <textarea class="form-control summernote" rows="3" placeholder="Lembar Kerja" name="lembar_kerja"></textarea>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jenis_upload">Jenis Upload</label>
                                        <input type="text" class="form-control" placeholder="Jenis Upload" name="jenis_upload" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nilai">Nilai</label>
                                        <input type="number" class="form-control" placeholder="Nilai" name="nilai" value="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `);

                // set jumlah aktifitas
                const el_jml_aktifitas = $("#jml_aktifitas");
                el_jml_aktifitas.html(Number(el_jml_aktifitas.text()) + 1);
                summernoteInit();
                Toast.fire({
                    icon: 'success',
                    title: 'Aktifitas ditambahkan'
                })
            },
            error: function (data) {
                Toast.fire({
                    icon: 'error',
                    title: 'Gagal Mendapatkan data.'
                })
            },
            complete: function () {
                setBtnLoading('#btn-tambah-aktifitas', '<i class="fa fa-plus"></i> Tambah Aktifitas', false)
            }
        });
    });


    // upload handeler
    // Summernote
    function summernoteInit() {
        $('.summernote').summernote({
            toolbar: [
                ['fontsize', ['fontsize']], ['fontname', ['fontname']], ['style', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']], ['height', ['height']], ['color', ['color']], ['float', ['floatLeft', 'floatRight', 'floatNone']], ['remove', ['removeMedia']], ['table', ['table']], ['insert', ['link', 'unlink', 'picture', 'video', 'audio', 'hr']], ['mybutton', ['myVideo']], ['view', ['fullscreen', 'codeview']], ['help', ['help']]],
            height: (300),
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

        $(".remove").click(function () {
            const card = $(this).parents()[2];
            Swal.fire({
                title: 'Apakah anda yakin ingin akan menhapus aktifitas ini ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                const el_jml_aktifitas = $("#jml_aktifitas");
                if (Number(el_jml_aktifitas.text()) == 1) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Project minimal mempunayi 1 aktifitas'
                    })
                    return;
                }
                if (result.isConfirmed) {
                    $(card).CardWidget('remove')
                    // set jumlah aktifitas
                    el_jml_aktifitas.html(Number(el_jml_aktifitas.text()) - 1);
                    $(card).remove();
                }
            })
        });
    }
    summernoteInit();

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
        data.append("id_project", $("#id_project").val());
        $.ajax({
            url: "<?= base_url() ?>project/aktifitas/upload",
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
    $("#button-simpan").click(function () {
        // cek template
        let template_ok = false;
        $("select[name=template]").each(function () {
            if (this.value == '') {
                template_ok = true;
            }
        })
        if (template_ok) {
            Toast.fire({
                icon: 'error',
                title: 'Gagal Disimpan. Masih Terdapat template yang belum dipilih'
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
        // get data
        const aktifitas = new Map();
        $(".aktifitas").each(function () {
            const el = $(this);
            const data = {
                judul: el.find("input[name=judul]").val(),
                jenis_upload: el.find("input[name=jenis_upload]").val(),
                nilai: el.find("input[name=nilai]").val(),
                template: el.find("select[name=template]").val(),
                naskah: el.find("textarea[name=naskah]").summernote('code'),
                detail: el.find("textarea[name=detail]").summernote('code'),
                lembar_kerja: el.find("textarea[name=lembar_kerja]").summernote('code'),

            };
            const id = el.attr('id');
            aktifitas.set(id, data)
        });

        $.LoadingOverlay("show");
        $.ajax({
            url: "<?= base_url() ?>project/aktifitas/insert",
            data: {
                aktifitas: JSON.stringify(Object.fromEntries(aktifitas)),
                id_project: $("#id_project").val(),
                image: konten_image,
                audio: konten_audio
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