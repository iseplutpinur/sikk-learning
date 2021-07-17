$(() => {
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
            }).fail(($xhr) => {
                console.log($xhr);
            })
        } else {
            $('#kelas').empty();
        }
    });

    // cek nip
    $("#nisn").change(function () {
        $.ajax({
            method: 'get',
            url: '<?= base_url() ?>sekolah/cari/cekNisn',
            data: {
                nisn: this.value
            },
        }).done((data) => {
            if (data.data > 0) {
                $(document).Toasts('create', {
                    delay: 4000,
                    class: 'bg-danger',
                    title: 'Gagal',
                    body: 'NISN Sudah Terdaftar'
                })
                setTimeout(() => $("#toastsContainerTopRight").remove(), 3000);
                this.value = '';
                this.focus();
            }
        }).fail(($xhr) => {
            console.log($xhr);
        })
    });

    $('#password-visibility').change(function () {
        const password = $('#password')
        const password1 = $('#password1')

        // password toggle
        if (this.checked) {
            password.attr('type', 'text')
            password1.attr('type', 'text')
        } else {
            password.attr('type', 'password')
            password1.attr('type', 'password')
        }
    })

    $('#password1').change(function () {
        if (this.value != $('#password').val()) {
            $(document).Toasts('create', {
                delay: 4000,
                class: 'bg-danger',
                title: 'Gagal',
                body: 'Ulangi Password Tidak Sama'
            })
            setTimeout(() => $("#toastsContainerTopRight").remove(), 3000);
            this.value = '';
            this.focus();
        }
    });

    $('#password').change(function () {
        if (this.value.length < 6) {
            $(document).Toasts('create', {
                delay: 4000,
                class: 'bg-danger',
                title: 'Gagal',
                body: 'Pajang karakter password minimal 6'
            })
            setTimeout(() => $("#toastsContainerTopRight").remove(), 3000);
            this.value = '';
            this.focus();
        }
    });

    // submit
    $("#form-registrasi").submit(function (e) {
        e.preventDefault();
        $.LoadingOverlay("show");
        $.ajax({
            method: 'post',
            url: '<?= base_url() ?>registrasi/insert_siswa',
            data: {
                nisn: $('#nisn').val(),
                nama: $('#nama').val(),
                tanggal_lahir: $('#tanggal_lahir').val(),
                jenis_kelamin: $('#jenis_kelamin').val(),
                alamat: $('#alamat').val(),
                password: $('#password').val(),
                no_telpon: $('#no_telpon').val(),
                id_sekolah: $('#sekolah').select2('data')[0].id,
                id_kelas: $('#kelas').val()
            },
        }).done((data) => {
            if (data.data > 0) {
                $(document).Toasts('create', {
                    delay: 4000,
                    class: 'bg-success',
                    title: 'Berhasil',
                    body: 'Registrasi berhasil. Silahakan tunggu akun di konfirmasi oleh guru sekolah.'
                })
                setTimeout(() => $("#toastsContainerTopRight").remove(), 10000);
            }
            $.LoadingOverlay("hide");
        }).fail(($xhr) => {
            console.log($xhr);
            $.LoadingOverlay("hide");
        })
    })
})


